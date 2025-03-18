<?php
class Database {
    public $conn;

    // private const DB_SERVER = "sql106.infinityfree.com";
    // private const DB_USERNAME = "if0_38547391";
    // private const DB_PASSWORD = "ULu0KQrvzHw";
    // private const DB_NAME = "if0_38547391_pjtn";

    private const DB_SERVER = "localhost";
    private const DB_USERNAME = "root";
    private const DB_PASSWORD = "";
    private const DB_NAME = "pjtn";

    public function __construct() {
        $this->conn = new mysqli(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);

        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
        $this->conn->query("UPDATE vouchers
SET status = CASE
    WHEN start_date <= CURDATE() AND end_date >= CURDATE() THEN 1
    ELSE 0
END;");
    }
    
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
       
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        // var_dump($sql);
        // exit();
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $this->conn->error);
            return false;
        }
        
        $types = ""; 
        $values = [];
        foreach ($data as $value) {
            $types .= $this->getType($value); 
            $values[] = $value;
        }
        
        $stmt->bind_param($types, ...$values);
        if (!$stmt->execute()) {
            error_log("Insert query failed: " . $stmt->error);
            return false;
        }
        
        return true;
    }  

    public function update($table, $id, $data) {
        $set = "";
        $types = "";
        $values = [];
        
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
            $types .= $this->getType($value);
            $values[] = $value;
        }
        var_dump($data);
        $set = rtrim($set, ", ");
        
        $sql = "UPDATE $table SET $set WHERE id = ?";
        $types .= "i"; 
    
        $values[] = $id;
    
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $this->conn->error);
            return false;
        }
    
        $stmt->bind_param($types, ...$values);
    
        if (!$stmt->execute()) {
            error_log("Update query failed: " . $stmt->error);
            return false;
        }
    
        return true;
    }
    
    private function getType($value) {
        if (is_int($value)) {
            return "i"; 
        } elseif (is_float($value)) {
            return "d"; 
        } elseif (is_string($value)) {
            return "s"; 
        } elseif (is_null($value)) {
            return "s"; 
        }
        return "s"; 
    }
    

 
    public function getById($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result === false) {
            error_log("GetById query failed: " . $this->conn->error);
            return null;
        }
        return $result->fetch_assoc();
    }

public function select($table, $condition = "", $limit = "") {
    $sql = "SELECT * FROM $table";
    
    if (!empty($condition)) {
        $sql .= " WHERE $condition";
    }
    
    if (!empty($limit)) {
        $sql .= " LIMIT $limit";
    }

    error_log("SQL Query: " . $sql);

    $result = $this->conn->query($sql);

    if ($result === false) {
        error_log("Select query failed: " . $this->conn->error);
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}


    public function uploadImage($file, $target_dir, &$alert) {
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $token = bin2hex(random_bytes(16));
        $target_file = $target_dir . $token . "." . $imageFileType;

        if ($file["size"] > 5000000) {
            $alert = "Sorry, your file is too large.";
            return false;
        }

        $allowed_types = ["jpg", "png", "jpeg", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            $alert = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return false;
        }

        if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            $alert = "Sorry, there was an error uploading your file.";
            return false;
        }

        return $token . "." . $imageFileType;
    }

public function delete($table, $id) {
    $sql = "DELETE FROM $table WHERE id = $id";
    $this->conn->query($sql);
}

    
    public function __destruct() {
        $this->conn->close();
    }

}