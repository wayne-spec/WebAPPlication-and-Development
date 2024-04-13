<?php
include("../config/config.php");

if(isset($_GET['delete_student']) && isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];

    $sql_delete_student = "DELETE FROM student WHERE student_id='$student_id'";
    $result_delete_student = mysqli_query($db, $sql_delete_student);

    if($result_delete_student) {
        // Handle success, maybe display a success message
        echo "Student deleted successfully!";
    } else {
        // Handle failure to delete student
        echo "Error deleting student: " . mysqli_error($db);
    }
}
?>

