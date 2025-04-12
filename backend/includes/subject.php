<?php
class Subject {
    private $conn;
    private $table_name = "subject";
    public $subjectId;
    public $subjectName;
    
    public function __construct($pdo) {
        $this->conn = $pdo;
    }
    
    public function getSubjects() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY subjectId DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
