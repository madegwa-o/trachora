<?php
class Teacher {
    private $conn;
    private $table_name = "teacher";
    
    public $teacherId;
    public $fullName;
    public $email;
    public $phone;
    public $address;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    public function addTeacher() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET fullName=:fullName, email=:email, phone=:phone, address=:address";
        
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->fullName = htmlspecialchars(strip_tags($this->fullName));
        
        // bind values
        $stmt->bindParam(":fullName", $this->fullName);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":address", $this->address);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
