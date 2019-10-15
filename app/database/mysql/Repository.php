<?php

require_once(APP_PATH . "/database/mysql/MySQLConnection.php");

class Repository
{
    private $connection;

    private static $instance;

    private function __construct() {
        $this->connection = MySQLConnection::getConnection();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Repository();
        }
        return self::$instance;
    }

    public function insert($model) {
        $table = get_class($model);
        $fields = "";
        $wild_cards = "";
        $values_types = "";
        $values = [];

        foreach ($model->toPublic() as $key => $value) {
            if ($key != "id") {
                $fields .= $key . ",";
                $wild_cards .= "?,";
                $values_types .= "s";
                $values[] = $value;
            }
        }
        $fields = substr($fields, 0, -1);
        $wild_cards = substr($wild_cards, 0, -1);

        $sql = "INSERT INTO $table ($fields) VALUES ($wild_cards)";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, $values_types, ...$values);

        if ($stmt->execute()) {
            return mysqli_insert_id($this->connection);
        } else {
            return false;
        }
    }

    public function delete($model) {
        $sql = "DELETE FROM " . get_class($model) . " WHERE id = ?";

        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $model->getId());

        if ($stmt->execute()) {
            return mysqli_insert_id($this->connection);
        } else {
            return false;
        }
    }
}