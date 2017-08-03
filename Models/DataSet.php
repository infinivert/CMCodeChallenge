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

        $sql = "SELECT * FROM `:table` ORDER BY `:sortBy` :sortDir LIMIT :startRow, :maxRows;";

        $data = [
            ':table' => $table,
            ':sortBy' => $sortBy,
            ':sortDir' => $sortDir,
            ':startRow' => (int) $startRow,
            ':maxRows' => (int) $maxRows
        ];

        $query = $this->conn->prepare($sql);
        $query->execute($data);

        $count = 0;

        while ($startRow = $query->fetch(\PDO::FETCH_ASSOC)) {
            $count++;
            $this->data[$count] = ModelFactory::make($modelName);
            $this->data[$count]->loadArray($row);
        }
    }
}