<?php
include("../config/config.php");

if(isset($_POST['delete_owner'])){
    $owner_id = $_POST['owner_id'];

    // Delete associated data from the chat table first
    $sql_delete_chat = "DELETE FROM chat WHERE owner_id='$owner_id'";
    $result_delete_chat = mysqli_query($db, $sql_delete_chat);

    if($result_delete_chat !== false) { // Check if deletion was successful or not
        // Proceed to delete associated data from the add_hostel table
        $sql_delete_hostels = "DELETE FROM add_hostel WHERE owner_id='$owner_id'";
        $result_delete_hostels = mysqli_query($db, $sql_delete_hostels);

        if($result_delete_hostels !== false) { // Check if deletion was successful or not
            // Proceed to delete the owner
            $sql_delete_owner = "DELETE FROM owner WHERE owner_id='$owner_id'";
            $result_delete_owner = mysqli_query($db, $sql_delete_owner);

            if($result_delete_owner !== false) { // Check if deletion was successful or not
                // Handle success, maybe display a success message
                echo "Owner and associated data deleted successfully!";
            } else {
                // Handle failure to delete owner
                echo "Error deleting owner: " . mysqli_error($db);
            }
        } else {
            // Handle failure to delete associated data from add_hostel table
            echo "Error deleting associated hostels: " . mysqli_error($db);
        }
    } else {
        // Handle failure to delete associated data from chat table
        echo "Error deleting associated chat records: " . mysqli_error($db);
    }
}
?>
