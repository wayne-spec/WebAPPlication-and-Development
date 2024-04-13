<?php  
session_start();

include("../config/config.php");
if(isset($_POST["export"]))
{
    $sql = "SELECT * FROM owner"; // Selecting all owners
    $result = mysqli_query($db, $sql);

    if(mysqli_num_rows($result) > 0) {
        $output = '
        <table id="myTable">
            <tr class="header">
                <th>Booked By</th>
                <th>Booker Address</th>
                <th>Hostel SubCounty</th>
                <th>Hostel Street</th>
                <th>Hostel Ward</th>
                <th>Booking Date</th>
                <th>Hostel Name</th>
            </tr>';

        while($rowss = mysqli_fetch_assoc($result)) {
            $owner_id = $rowss['owner_id'];

            $sql2 = "SELECT * FROM add_Hostel WHERE owner_id='$owner_id'";
            $result2 = mysqli_query($db, $sql2);

            if(mysqli_num_rows($result2) > 0) {
                while($ro = mysqli_fetch_assoc($result2)) {
                    $Hostel_id = $ro['Hostel_id'];

                    $sql = "SELECT * FROM booking WHERE Hostel_id='$Hostel_id'";
                    $result = mysqli_query($db, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        while($rows = mysqli_fetch_assoc($result)) {
                            $student_id = $rows['student_id'];
                            $Hostel_id = $rows['Hostel_id'];

                            $sql1 = "SELECT * FROM student WHERE student_id='$student_id'";
                            $result1 = mysqli_query($db, $sql1);

                            if(mysqli_num_rows($result1) > 0) {
                                while($row = mysqli_fetch_assoc($result1)) {
                                    $output .= '
                                    <tr>
                                        <td>'.$row['full_name'].'</td>
                                        <td>'.$row['address'].'</td>
                                        <td>'.$ro['SubCounty'].'</td>
                                        <td>'.$ro['Street'].'</td>
                                        <td>'.$ro['Ward'].'</td>
                                        <td>'.$rows['booking_date'].'</td>
                                    </tr>';
                                }
                            }
                        }
                    }
                }
            }
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}
?>
