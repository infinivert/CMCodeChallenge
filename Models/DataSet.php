<?php

namespace JCC\Models;

class DataSet
{
    private $conn;

    public $data = [];

    // Connect to the provided database connection object using dependency injection from the Model Factory.
    public function __construct(\PDO $connection) {
        $this->conn = $connection;
    }

    // Retrieves a set of Model objects and stores them into the data attribute.
    public function get(
        $modelName,
        $sortBy = 'id',
        $sortDir = 'ASC',
        $startRow = 0,
        $maxRows = 10
    )
    {
        $staticModelName = (file_exists(APPPATH . 'Models' . DIRECTORY_SEPARATOR . $modelName . '.php')) ? '\\JCC\\Models\\' . $modelName : '\\JCC\\Models\\' . $modelName . 'Model';

        $table = $staticModelName::$table;

        $sql = "SELECT * FROM `" . $this->sanitizeString($table) . "` ORDER BY `" . $this->sanitizeString($sortBy) . "` " . $this->sanitizeString($sortDir) . " LIMIT " . (int) $startRow . ", " . (int) $maxRows;

        $query = $this->conn->query($sql);

        $count = 0;
        foreach ($this->conn->query($sql) as $row) {
            $count++;
            $this->data[$count] = ModelFactory::make($modelName);
            $this->data[$count]->loadArray($row);
        }
    }

    private function sanitizeString($string) {
        return str_replace(';', '', filter_var($string, FILTER_SANITIZE_STRING));
    }
}