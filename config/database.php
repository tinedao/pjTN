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
        //tu dong update voucher
        $this->conn->query("UPDATE vouchers
SET status = CASE
    WHEN start_date <= CURDATE() AND end_date >= CURDATE() THEN 1
    ELSE 0
END;");
    }
    
    // Thêm dữ liệu vào bảng
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        
        // Chuẩn bị placeholders `?` cho Prepared Statement
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
       
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        // var_dump($sql);
        // exit();
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $this->conn->error);
            return false;
        }
        
        // Xác định kiểu dữ liệu và giá trị
        $types = ""; 
        $values = [];
        foreach ($data as $value) {
            $types .= $this->getType($value); // Xác định kiểu dữ liệu
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
        $types = "";
        $values = [];
        
        // Chuẩn bị các cột và giá trị
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
            $types .= $this->getType($value); // Xác định kiểu dữ liệu
            $values[] = $value;
        }
        var_dump($data);
        // Loại bỏ dấu ", " cuối cùng
        $set = rtrim($set, ", ");
        
        // Câu lệnh SQL
        $sql = "UPDATE $table SET $set WHERE id = ?";
        $types .= "i"; // Thêm kiểu dữ liệu cho ID (int)
    
        // Thêm ID vào cuối mảng values
        $values[] = $id;
    
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("Failed to prepare statement: " . $this->conn->error);
            return false;
        }
    
        // Gắn dữ liệu vào câu lệnh Prepared Statement
        $stmt->bind_param($types, ...$values);
    
        // Thực thi câu lệnh
        if (!$stmt->execute()) {
            error_log("Update query failed: " . $stmt->error);
            return false;
        }
    
        return true;
    }
    
    // Hàm để xác định kiểu dữ liệu cho từng giá trị
    private function getType($value) {
        if (is_int($value)) {
            return "i"; // Integer
        } elseif (is_float($value)) {
            return "d"; // Double
        } elseif (is_string($value)) {
            return "s"; // String
        } elseif (is_null($value)) {
            return "s"; // Null xử lý như chuỗi
        }
        return "s"; // Mặc định là String
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
    // Truy vấn SELECT với điều kiện và giới hạn
public function select($table, $condition = "", $limit = "") {
    $sql = "SELECT * FROM $table";
    
    if (!empty($condition)) {
        $sql .= " WHERE $condition";
    }
    
    if (!empty($limit)) {
        $sql .= " LIMIT $limit";
    }

    // In câu SQL để kiểm tra
    error_log("SQL Query: " . $sql);

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