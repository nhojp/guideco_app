<?php
include 'conn.php'; // Database connection

// Handle delete student request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $student_id = $_POST['delete_id'];

    // Delete student record from students table
    $query_delete_student = "DELETE FROM students WHERE id = ?";
    $stmt_delete_student = $conn->prepare($query_delete_student);
    $stmt_delete_student->bind_param("i", $student_id);

    if ($stmt_delete_student->execute()) {
        echo json_encode(['success' => true, 'message' => 'Student deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete student']);
    }

    $stmt_delete_student->close();
    exit();
}
?>
