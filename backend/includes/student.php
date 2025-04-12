<?php
class Student {
    private $conn;
    private $table_name = "student";
    
    public $studentId;
    public $fullName;
    public $admNo;
    public $gender;
    public $emergencyContact;
    public $house;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function addStudent() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET fullName=:fullName, admNo=:admNo, gender=:gender, emergencyContact=:emergencyContact, house=:house";
        
        $stmt = $this->conn->prepare($query);
        
        $this->fullName = htmlspecialchars(strip_tags($this->fullName));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->house = htmlspecialchars(strip_tags($this->house));
        $this->emergencyContact = htmlspecialchars(strip_tags($this->emergencyContact));
        
        
        $stmt->bindParam(":fullName", $this->fullName);
        $stmt->bindParam(":admNo", $this->admNo);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":emergencyContact", $this->emergencyContact);
        $stmt->bindParam(":house", $this->house);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
