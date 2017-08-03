<?php

namespace JCC\Models;

abstract class BaseModel
{
    // Every Model gets a connection to a database on creation.
    protected $conn;

    // Every Model MUST have a table name and a list of database fields (besides an id field) defined. The id field is optional.
    public static $table;
    public static $fields;
    public $id;

    // Connect to the provided database connection object using dependency injection from the Model Factory.
    public function __construct(\PDO $connection)
    {
        $this->conn = $connection;
    }

    // Creates a new record in the database.
    public function create()
    {
        if (!empty($this->id) || empty(static::$table) || empty(static::$fields)) {
            return false;
        }

        $sql = "INSERT INTO `" . static::$table . "` (`" . implode('`,`', static::$fields) . "`) VALUES (:" . implode(',:', static::$fields) . ")";

        
        $this->conn->prepare($sql)->execute($this->valuesArray(null, true));

        $this->id = $this->conn->lastInsertId();
    }

    // Reads data from the database for a single record. Requires an id to be set. Updates the Model Object.
    public function read()
    {
        if (empty($this->id) || empty(static::$table)) {
            return false;
        }

        $sql = "SELECT * FROM `" . static::$table . "` WHERE `id` = :id;";

        $query = $this->conn->prepare($sql);
        $query->execute([':id' => $this->id]);
        $results = $query->fetch(\PDO::FETCH_ASSOC);
        if (!empty($results) && is_array($results)) {
            $this->loadArray($results);
        }
    }

    // Updates data in the database for a single record. Requires an id to be set.
    public function update()
    {
        if (empty($this->id) || empty(static::$table) || empty(static::$fields)) {
            return false;
        }

        $sql = "UPDATE `" . static::$table . "` SET ";
        $count = 0;
        foreach (static::$fields as $field) {
            $sql .= ($count > 0) ? ", " : "";
            $sql .= "`" . $field . "` = :" . $field;
            $count++;
        }
        $sql .= " WHERE `id` = :id;";

        $this->conn->prepare($sql)->execute(array_merge($this->valuesArray(null, true), [':id' => $this->id]));
    }

    // Updates data in the database for a single record. Requires an id to be set.
    public function delete()
    {
        if (empty($this->id) || empty(static::$table)) {
            return false;
        }

        $sql = "DELETE FROM `" . static::$table . "` WHERE `id` = :id;";

        $this->conn->prepare($sql)->execute([':id' => $this->id]);
    }

    // Loads data from an associative array into an object.
    public function loadArray($fieldsAndVaules = null)
    {
        foreach ($fieldsAndVaules as $field => $value) {
            $this->$field = $value;
        }
    }

    // Retrieves an associative array of object data from a specified set of fields. Optionally adds a colon the the key, which is useful in creating PDO prepared statements.
    public function valuesArray($fields = null, $addColon = false)
    {
        if ($fields === null) {
            $fields = static::$fields;
        }

        $values = [];
        foreach ($fields as $field) {
            $k = ($addColon) ? ':' . $field : $field;
            $values[$k] = $this->$field;
        }

        return $values;
    }
}
