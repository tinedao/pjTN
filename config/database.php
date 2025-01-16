<?php
class Database {
    public $conn;

    // Thông tin kết nối cơ sở dữ liệu
    private const DB_SERVER = "localhost";
    private const DB_USERNAME = "root";
    private const DB_PASSWORD = "";
    private const DB_NAME = "pjTN";

    public function __construct() {
        // Kết nối cơ sở dữ liệu
        $this->conn = new mysqli(self::DB_SERVER, self::DB_USERNAME, self::DB_PASSWORD, self::DB_NAME);

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Database connection failed: " . $this->conn->connect_error);
        }

        // Đặt bộ mã ký tự UTF-8
        $this->conn->set_charset("utf8mb4");
    }

    // Thêm dữ liệu vào bảng
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        
        // Chuẩn bị placeholders `?` cho Prepared Statement
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $this->conn->error);
            return false;
        }
        
        // Gắn kiểu dữ liệu và giá trị vào câu lệnh Prepared Statement
        $types = ""; // Chuỗi kiểu dữ liệu: 's' (string), 'i' (integer), 'd' (double), 'b' (blob)
        $values = [];
        foreach ($data as $key => $value) {
            if (is_int($value)) {
                $types .= "i";
            } elseif (is_float($value)) {
                $types .= "d";
            } elseif (is_null($value)) {
                $types .= "s"; // NULL được xử lý như string
                $value = null;
            } else {
                $types .= "s";
            }
            $values[] = $value;
        }
        
        // Gắn dữ liệu vào câu lệnh Prepared Statement
        $stmt->bind_param($types, ...$values);
        
        // Thực thi câu lệnh
        if (!$stmt->execute()) {
            error_log("Insert query failed: " . $stmt->error);
            return false;
        }
        
        return true;
    }
    

    // Cập nhật dữ liệu trong bảng
    public function update($table, $id, $data) {
        $set = "";
        foreach ($data as $column => $value) {
            $set .= "$column = '" . $this->conn->real_escape_string($value) . "', ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE $table SET $set WHERE id = $id";

        if (!$this->conn->query($sql)) {
            error_log("Update query failed: " . $this->conn->error);
            return false;
        }
        return true;
    }

    // Lấy dữ liệu theo ID
    public function getById($table, $id) {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = $this->conn->query($sql);

        if ($result === false) {
            error_log("GetById query failed: " . $this->conn->error);
            return null;
        }
        return $result->fetch_assoc();
    }

    // Truy vấn SELECT với điều kiện và giới hạn
    public function select($table, $condition = "", $limit = "") {
        $sql = "SELECT * FROM $table";
        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        if (!empty($limit)) {
            $sql .= " LIMIT $limit";
        }

        $result = $this->conn->query($sql);

        if ($result === false) {
            error_log("Select query failed: " . $this->conn->error);
            return [];
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Hàm tải lên ảnh
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

    // Xóa dữ liệu
public function delete($table, $id) {
    $sql = "DELETE FROM $table WHERE id = $id";
    $this->conn->query($sql);
}


    public function __destruct() {
        $this->conn->close();
    }
}
