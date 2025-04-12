

<?php
//registerStudent.php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "Form submitted successfully. <br>"; 

    include_once '../includes/DbConnector.php';
    include_once '../includes/student.php';
    include_once '../includes/subject.php';
    include_once '../includes/teacher.php';

    // Retrieve form data
    $fullName = $_POST['fullName'];
    $admNo = $_POST['admNo'];
    $gender = $_POST['gender'];
    $emergencyContact = $_POST['emergencyContact'];
    $house = $_POST['house'];
    $selected_subjects = isset($_POST['subjects']) ? $_POST['subjects'] : [];

    // Create Student object
    $student = new Student($pdo);
    $student->fullName = $fullName;
    $student->admNo = $admNo;
    $student->gender = $gender;
    $student->emergencyContact = $emergencyContact;
    $student->house = $house;

    // Add student to database
    if ($student->addStudent()) {
        $studentId = $pdo->lastInsertId();  // Get the last inserted student's ID

        // Insert subjects into student_subject relationship table
        if (!empty($selected_subjects)) {
            foreach ($selected_subjects as $subjectId) {
                $query = "INSERT INTO student_subject (studentId, subjectId) VALUES (:studentId, :subjectId)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':studentId', $studentId);
                $stmt->bindParam(':subjectId', $subjectId);
                $stmt->execute();
            }
        }

        echo "Student registered successfully!";
    } else {
        echo "Error registering student!";
    }
}
?>