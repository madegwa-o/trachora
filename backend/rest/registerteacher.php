<?php
//registerteacher.php

ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    echo "Form submitted successfully. <br>"; 

    include_once '../includes/DbConnector.php';
    include_once '../includes/student.php';
    include_once '../includes/subject.php';
    include_once '../includes/teacher.php';

    // Retrieve form data
    $fullName = $_POST['fullname'];
    $IDNumber = $_POST['IDNumber'];
    $selected_subjects = isset($_POST['subjects']) ? $_POST['subjects'] : [];

    // Create Student object
    $teacher = new Teacher($pdo);
    $teacher->fullName = $fullName;
    $teacher->teacherId = $IDNumber;

    // Add student to database
    if ($teacher->addTeacher()) {
        $steacherId = $pdo->lastInsertId();  // Get the last inserted student's ID

        // Insert subjects into student_subject relationship table
        if (!empty($selected_subjects)) {
            foreach ($selected_subjects as $subjectId) {
                $query = "INSERT INTO teacher_subject (teacherId, subjectId) VALUES (:teacherId, :subjectId)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':teacherId', $teacherId, PDO::PARAM_INT);
                $stmt->bindParam(':subjectId', $subjectId);
                $stmt->execute();
            }
        }

        echo "teacher registered successfuly!";
    } else {
        echo "Error registering teacher!";
    }
}
?>
