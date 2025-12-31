<?php
/**
 * Nama Class: Database
 * Deskripsi: Class untuk mengelola koneksi dan operasi database
 */
class Database
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct()
    {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        
        // Check koneksi
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
        // Set charset
        $this->conn->set_charset("utf8");
    }

    private function getConfig()
    {
        // Include file konfigurasi
        $config_file = dirname(__DIR__) . '/config.php';
        
        if (file_exists($config_file)) {
            include($config_file);
            $this->host = $config['host'];
            $this->user = $config['username'];
            $this->password = $config['password'];
            $this->db_name = $config['db_name'];
        } else {
            die("File konfigurasi tidak ditemukan!");
        }
    }

    /**
     * Execute query
     * @param string $sql SQL query
     * @return mysqli_result|bool
     */
    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    /**
     * Get single row data
     * @param string $table Table name
     * @param string $where WHERE condition
     * @return array|null
     */
    public function get($table, $where = null)
    {
        $sql = "SELECT * FROM " . $table;
        
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        
        $sql .= " LIMIT 1";
        
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        
        return null;
    }

    /**
     * Get all data from table
     * @param string $table Table name
     * @param string $where WHERE condition
     * @param string $order ORDER BY clause
     * @param int $limit LIMIT
     * @return array
     */
    public function getAll($table, $where = null, $order = null, $limit = null)
    {
        $sql = "SELECT * FROM " . $table;
        
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        
        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        
        if ($limit) {
            $sql .= " LIMIT " . $limit;
        }
        
        $result = $this->conn->query($sql);
        $data = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        
        return $data;
    }

    /**
     * Insert data
     * @param string $table Table name
     * @param array $data Data to insert
     * @return int|bool Last insert ID or false
     */
    public function insert($table, $data)
    {
        if (!is_array($data)) {
            return false;
        }
        
        $columns = [];
        $values = [];
        
        foreach ($data as $key => $val) {
            $columns[] = $key;
            $values[] = "'" . $this->conn->real_escape_string($val) . "'";
        }
        
        $columns_str = implode(", ", $columns);
        $values_str = implode(", ", $values);
        
        $sql = "INSERT INTO " . $table . " (" . $columns_str . ") VALUES (" . $values_str . ")";
        
        if ($this->conn->query($sql)) {
            return $this->conn->insert_id;
        }
        
        return false;
    }

    /**
     * Update data
     * @param string $table Table name
     * @param array $data Data to update
     * @param string $where WHERE condition
     * @return bool
     */
    public function update($table, $data, $where)
    {
        if (!is_array($data)) {
            return false;
        }
        
        $update_values = [];
        
        foreach ($data as $key => $val) {
            $update_values[] = $key . " = '" . $this->conn->real_escape_string($val) . "'";
        }
        
        $update_str = implode(", ", $update_values);
        $sql = "UPDATE " . $table . " SET " . $update_str . " WHERE " . $where;
        
        return $this->conn->query($sql);
    }

    /**
     * Delete data
     * @param string $table Table name
     * @param string $where WHERE condition
     * @return bool
     */
    public function delete($table, $where)
    {
        $sql = "DELETE FROM " . $table . " WHERE " . $where;
        return $this->conn->query($sql);
    }

    /**
     * Count rows
     * @param string $table Table name
     * @param string $where WHERE condition
     * @return int
     */
    public function count($table, $where = null)
    {
        $sql = "SELECT COUNT(*) as total FROM " . $table;
        
        if ($where) {
            $sql .= " WHERE " . $where;
        }
        
        $result = $this->conn->query($sql);
        
        if ($result) {
            $row = $result->fetch_assoc();
            return (int)$row['total'];
        }
        
        return 0;
    }

    /**
     * Get last error
     * @return string
     */
    public function getError()
    {
        return $this->conn->error;
    }

    /**
     * Escape string
     * @param string $string String to escape
     * @return string
     */
    public function escape($string)
    {
        return $this->conn->real_escape_string($string);
    }

    /**
     * Get last insert ID
     * @return int
     */
    public function getLastInsertId()
    {
        return $this->conn->insert_id;
    }

    /**
     * Close connection
     */
    public function close()
    {
        $this->conn->close();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        // $this->close();
    }
}
?>