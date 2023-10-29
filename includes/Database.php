<?php

define('HOST', '127.0.0.1');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DB_NAME', 'bookwiz');

class Database
{
    private $connection;

    public function __construc()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->connnection = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
        if (!$this->connection) {
            die('Connection Error : ' . mysqli_connect_error());
        }
    }
    //sql query execution
    public function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);

        if (!$result) {
            die("Query Failed: " . mysqli_errno($this->connection));
        }

        return $result;
    }
    //fetching list of data from sql query result
    public function fetch_array($result)
    {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $result_array[] = $row;
            }
            return $result_array;
        }
    }

    public function fetch_row($result)
    {
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }

    public function escape_value($value)
    {
        return $this->connection->real_escape_string($value);
    }

    public function close_connection()
    {
        $this->connection->close();
    }
}

$database = new Database();

?>