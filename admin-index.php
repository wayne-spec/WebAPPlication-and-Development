<?php 
session_start();
if(!isset($_SESSION["email"])){
  header("location:../index.php");
}

include("navbar.php");

 ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

 <div class="container-fluid">
  <ul class="nav nav-pills nav-justified">
    <li class="active" style="background-color: #FFF8DC"><a data-toggle="pill" href="#home">Hostel Lists</a></li>
    <li style="background-color: #FAF0E6"><a data-toggle="pill" href="#menu1">Owners Details</a></li>
    <li style="background-color: #FFFACD"><a data-toggle="pill" href="#menu2">Student Details</a></li>
    <li style="background-color: #FFFAF0"><a data-toggle="pill" href="#menu6">Update Hostel</a></li>
    <li style="background-color: #FAFACD"><a data-toggle="pill" href="#menu3">Booked hostel</a></li>
    <li style="background-color: #FAF0E6"><a data-toggle="pill" href="#menu4">Add Hostel</a></li>
    

  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <center><h3>Hostel Lists</h3></center>
      <div class="container-fluid">
      <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..." title="Type in a name">
            <div style="overflow-x:auto;">
              <table id="myTable">
                <tr class="header">
                  <th>Id.</th>
                  <th>Country</th>
                  <th>county</th>
                  <th>Subcounty</th>
                  <th>Ward</th>
                  <th>Street</th>
                  <th>Estate</th>
                  <th>Contact No.</th>
                  <th>Hostel Name</th>
                  <th>Latitude</th>
                  <th>Longitude</th>
                  <th>Estmated Price</th>
                  <th>Total Rooms</th>
                  <th>Bedroom</th>
                  <th>Living Room</th>
                  <th>Space</th>
                  <th>Bathroom</th>
                  <th>Description</th>
                  <th>Photos</th>
                </tr>
                <?php 
        include("../config/config.php");

        $sql="SELECT * from add_hostel";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          $Hostel_id=$rows['Hostel_id'];
       ?>
                <tr>
                  <td><?php echo $rows['Hostel_id'] ?></td>
                  <td><?php echo $rows['Country'] ?></td>
                  <td><?php echo $rows['county'] ?></td>
                  <td><?php echo $rows['SubCounty'] ?></td>
                  <td><?php echo $rows['Ward'] ?></td>
                  <td><?php echo $rows['Street'] ?></td>
                  <td><?php echo $rows['Estate'] ?></td>
                  <td><?php echo $rows['contact_no'] ?></td>
                  <td><?php echo $rows['Hostel_Type'] ?></td>
                  <td><?php echo $rows['latitude'] ?></td>
                  <td><?php echo $rows['longitude'] ?></td>
                  <td>Ksh.<?php echo $rows['estimated_price'] ?></td>
                  <td><?php echo $rows['total_rooms'] ?></td>
                  <td><?php echo $rows['bedroom'] ?></td>
                  <td><?php echo $rows['living_room'] ?></td>
                  <td><?php echo $rows['Space'] ?></td>
                  <td><?php echo $rows['bathroom'] ?></td>
                  <td><?php echo $rows['description'] ?></td><td>
<?php $sql2="SELECT * from hostel_photo where Hostel_id='$Hostel_id'";
        $query=mysqli_query($db,$sql2);

        if(mysqli_num_rows($query)>0)
      {
          while($row=mysqli_fetch_assoc($query)){ ?>
                  <img src="../owner/<?php echo $row['p_photo'] ?>" width="50px">
                <?php }}}} ?>
                </td>
                </tr>
              </table> 
            </div>
    </div>
  </div>


    <div id="menu1" class="tab-pane fade">
      <center><h3>Owner Details</h3></center>
      <div class="container-fluid">
      <input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search..." title="Type in a name">

              <table id="myTable2">
                <tr class="header">
                  <th>Id.</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone No.</th>
                  <th>Address</th>
                  <th>Type of Id</th>
                  <th>Id Photo</th>
                  <th>Action </th>


                </tr>
                <?php 
        include("../config/config.php");

        $sql="SELECT * from owner";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          
       ?>
                <tr>
                  <td><?php echo $rows['owner_id'] ?></td>
                  <td><?php echo $rows['full_name'] ?></td>
                  <td><?php echo $rows['email'] ?></td>
                  <td><?php echo $rows['phone_no'] ?></td>
                  <td><?php echo $rows['address'] ?></td>
                  <td><?php echo $rows['id_type'] ?></td>
                  <td><img id="myImg" src="../<?php echo $rows['id_photo'] ?>" width="50px"></td>
                  <td>
                      <button onclick="deleteOwner(<?php echo $rows['owner_id']; ?>)">Delete</button>
                  </td>
                  <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                  </div>
                </tr>
              <?php }} ?>
              </table>   
    </div>
    </div>

<div id="menu2" class="tab-pane fade">
  <center><h3>Student Details</h3></center>
  <div class="container">
    <input type="text" id="myInput3" onkeyup="myFunction3()" placeholder="Search..." title="Type in a name">
    <table id="myTable3">
      <tr class="header">
        <th>Id</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone No.</th>
        <th>Address</th>
        <th>Type of Id</th>
        <th>Id Photo</th>
        <th>Action</th> <!-- New column for delete action -->
      </tr>

      <?php 
        include("../config/config.php");
        $sql="SELECT * FROM student";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result) > 0) {
          while($rows=mysqli_fetch_assoc($result)){
      ?>
      <tr>
        <td><?php echo $rows['student_id'] ?></td>
        <td><?php echo $rows['full_name'] ?></td>
        <td><?php echo $rows['email'] ?></td>
        <td><?php echo $rows['phone_no'] ?></td>
        <td><?php echo $rows['address'] ?></td>
        <td><?php echo $rows['id_type'] ?></td>
        <td><img src="../<?php echo $rows['id_photo'] ?>" width="50px"></td>
        <td>
          <button onclick="deletestudent(<?php echo $rows['student_id']; ?>)">Delete</button>
        </td>
      </tr>
      <?php }} ?>
    </table> 
  </div>
</div>



    <div id="menu3" class="tab-pane fade">
      <center><h3>Booked hostel</h3></center>
      <div class="container">
        <input type="text" id="myInput4" onkeyup="myFunction4()" placeholder="Search..." title="Type in a name">

              <table id="myTable4">
                <tr class="header">
                  <th>Booked Id</th>
                  <th>Booked By</th>
                  <th>Booker Address</th>
                  <th>Hostel county</th>
                  <th>Hostel SubCounty</th>
                  <th>Hostel Ward</th>
                  <th>Hostel Estate</th>
                  <th>Hostel Name</th>
                  <th>Hostel Owner</th>
                  <th>Owner Address</th>
                </tr>

      <?php 
        include("../config/config.php");
        

        $sql="SELECT * from booking";
        $result=mysqli_query($db,$sql);

        if(mysqli_num_rows($result)>0)
      {
          while($rows=mysqli_fetch_assoc($result)){
          
       ?>
                <tr>
                  <td><?php echo $rows['booking_id'] ?></td>
                  
        <?php 
        $student_id=$rows['student_id'];
        $Hostel_id=$rows['Hostel_id'];
        $sql1="SELECT * from student where student_id='$student_id'";
        $result1=mysqli_query($db,$sql1);

        if(mysqli_num_rows($result1)>0)
      {
          while($row=mysqli_fetch_assoc($result1)){
          
       ?>


        <td><?php echo $row['full_name']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <?php 
        $sql2="SELECT * from add_hostel where Hostel_id='$Hostel_id'";
        $result2=mysqli_query($db,$sql2);

        if(mysqli_num_rows($result2)>0)
      {
          while($ro=mysqli_fetch_assoc($result2)){
          
       ?>


                  <td><?php echo $ro['county']; ?></td>
                  <td><?php echo $ro['SubCounty']; ?></td>
                  <td><?php echo $ro['Ward']; ?></td>
                  <td><?php echo $ro['Estate']; ?></td>
                  <td><?php echo $ro['Hostel_Type']; ?></td>
            <?php 
            $owner_id=$ro['owner_id'];
            $sql3="SELECT * from owner where owner_id='$owner_id'";
            $result3=mysqli_query($db,$sql3);

            if(mysqli_num_rows($result3)>0)
          {
              while($rowss=mysqli_fetch_assoc($result3)){
              
           ?>
                  <td><?php echo $rowss['full_name']; ?></td>
                  <td><?php echo $rowss['address']; ?></td>
                </tr>
              <?php }}}}}}}} ?>
              </table> 
                  <form method="post" action="export.php">
               <input type="submit" name="export" class="btn btn-success" value="Export" />
              </form>
    </div>
    </div>



<div id="menu6" class="tab-pane fade">
    <center><h3>Update Hostel</h3></center>
    <div class="container-fluid">
        <input type="text" id="myInput" onkeyup="updateHostel()" placeholder="Search..." title="Type in a name">
        <div style="overflow-x:auto;">
            <table id="myTable">
                <tr class="header">
                    <th>Id.</th>
                    <th>Country</th>
                    <th>County</th>
                    <th>Ward</th>
                    <th>Street</th>
                    <th>Estate</th>
                    <th>Contact No.</th>
                    <th>Hostel Type</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Estimated Price</th>
                    <th>Total Rooms</th>
                    <th>Bedroom</th>
                    <th>Living Room</th>
                    <th>Space</th>
                    <th>Bathroom</th>
                    <th>Description</th>
                    <th>Photos</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php 
                $sql="SELECT * FROM add_Hostel";
                $result=mysqli_query($db,$sql);

                if(mysqli_num_rows($result) > 0) {
                    while($rows=mysqli_fetch_assoc($result)){
                        $Hostel_id=$rows['Hostel_id'];
                ?>
                <tr>
                    <td><?php echo $rows['Hostel_id'] ?></td>
                    <td><?php echo $rows['Country'] ?></td>
                    <td><?php echo $rows['SubCounty'] ?></td>
                    <td><?php echo $rows['Ward'] ?></td>
                    <td><?php echo $rows['Street'] ?></td>
                    <td><?php echo $rows['Estate'] ?></td>
                    <td><?php echo $rows['contact_no'] ?></td>
                    <td><?php echo $rows['Hostel_Type'] ?></td>
                    <td><?php echo $rows['latitude'] ?></td>
                    <td><?php echo $rows['longitude'] ?></td>
                    <td>Rs.<?php echo $rows['estimated_price'] ?></td>
                    <td><?php echo $rows['total_rooms'] ?></td>
                    <td><?php echo $rows['bedroom'] ?></td>
                    <td><?php echo $rows['living_room'] ?></td>
                    <td><?php echo $rows['Space'] ?></td>
                    <td><?php echo $rows['bathroom'] ?></td>
                    <td><?php echo $rows['description'] ?></td>
                    <td>
                        <?php 
                        $sql2="SELECT * FROM Hostel_photo WHERE Hostel_id='$Hostel_id'";
                        $query=mysqli_query($db,$sql2);

                        if(mysqli_num_rows($query) > 0) {
                            while($row=mysqli_fetch_assoc($query)){ 
                        ?>
                        <img src="<?php echo $row['p_photo'] ?>" width="50px">
                        <?php 
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <a data-toggle="pill" class="btn btn-success" name="edit_Hostel" href="edit.php?Hostel_id=<?php echo $rows['Hostel_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <form method="POST" action="delete.php">
                            <input type="hidden" name="Hostel_id" value="<?php echo $rows['Hostel_id']; ?>">
                            <button type="submit" class="btn btn-danger" name="delete_Hostel">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php 
                    }
                }
                ?>
            </table> 
        </div>
    </div>
</div>


    <div id="menu4" class="tab-pane fade">
      <center><h3>Add Hostel</h3></center>
      <div class="container">

      
<div id="map_canvas"></div>
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
              <label for="Country">Country:</label>
              <select class="form-control" name="Country" required="required">
                                <option value="">--Select Country--</option>
                                <option value="Kenya">Kenya</option>
              </select>
            </div>
            <div class="form-group">
              <label for="county">County:</label>
              <select class="form-control" name="county" required="required">
                                <option value="">--Select County--</option>
                                <option value="Nairobi">Nairobi</option>
              </select>
            </div>
            <div class="form-group">
              <label for="SubCounty">SubCounty:</label>
              <select class="form-control" name="SubCounty" required="required">
                                <option value="">--Select SubCounty--</option>
                                <option value="Lang'ata Sub-county">Lang'ata Sub-county</option>
                              
              </select>
            </div>
            <div class="form-group">
              <label for="Ward">Ward:</label>
              <select class="form-control" name="Ward" required="required">
                                <option value="">--Select Ward--</option>
                                    <option value="Madaraka">Madaraka</option>
                            </select>
            </div>
            <div class="form-group">
              <label for="Street">Street:</label>
              <select class="form-control" name="Street" required="required">
                                <option value="">--Select street--</option>
                                <option value="Lang'ata South Road">Lang'ata South Road</option>
                                <option value="Ole Shapara Avenue">Ole Shapara Avenue</option>
                                <option value="Bunyala Road">Bunyala Road</option>
                            </select>
            </div>
            <div class="form-group">
              <label for="Estate">Estate:</label>
              <input type="text" class="form-control" id="Estate" placeholder="Enter Estate" name="Estate">
            </div>
      
   
            <div class="form-group">
              <label for="contact_no">Contact No.:</label>
              <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact No." name="contact_no">
            </div>
            <div class="form-group">
               <label for="Hostel_Name">Hostel Name:</label>
                <input type="text" class="form-control" id="Hostel_Type" placeholder="Hostel_Name" name="Hostel_Name">
            </div>                      
            <div class="form-group">
                <label for="estimated_price">Estimated Price:</label>
                <input type="estimated_price" class="form-control" id="estimated_price" placeholder="Enter Estimated Price" name="estimated_price">
            </div>
        </div>

        <div class="col-sm-6">
                  <div class="form-group">
                    <label for="total_rooms">Total No. of Rooms:</label>
                    <input type="number" class="form-control" id="total_rooms" placeholder="Enter Total No. of Rooms" name="total_rooms">
                  </div>
                  <div class="form-group">
                    <label for="bedroom">No. of Bedroom:</label>
                    <input type="number" class="form-control" id="bedroom" placeholder="Enter No. of Bedroom" name="bedroom">
                  </div>
                  <div class="form-group">
                    <label for="living_room">No. of Living Room:</label>
                    <input type="number" class="form-control" id="living_room" placeholder="Enter No. of Living Room" name="living_room">
                  </div>
                  <div class="form-group">
                    <label for="Space">No. of Space:</label>
                    <input type="number" class="form-control" id="Space" placeholder="Enter No. of Space" name="Space">
                  </div>
                  <div class="form-group">
                    <label for="bathroom">No. of Bathroom/Washroom:</label>
                    <input type="number" class="form-control" id="bathroom" placeholder="Enter No. of Bathroom/Washroom" name="bathroom">
                  </div>
                  <div class="form-group">
                    <label for="description">Full Description:</label>
                    <textarea type="comment" class="form-control" id="description" placeholder="Enter Hostel Description" name="description"></textarea>
                  </div>
                  <table class="table table-bordered" border="0">  
                  <tr> 
                    <div class="form-group"> 
                    <label><b>Latitude/Longitude:</b><span style="color:red; font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Click on Button</span></label>                    
                    <td><input type="text" name="latitude" placeholder="Latitude" id="latitude" class="form-control name_list" readonly required /></td>
                    <td><input type="text" name="longitude" placeholder="Longitude" id="longitude" class="form-control name_list" readonly required /></td> 
                    <td><input type="button" value="Get Latitude and Longitude" onclick="getLocation()" class="btn btn-success col-lg-12"></td>  
                  </div>
                  </tr>  
                </table>
                  <tname_list" required accept="image/*" /></td> 
                    <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>  
                  </able class="table" id="dynamic_field">  
                  <tr> 
                    <div class="form-group"> 
                    <label><b>Photos:</b></label>                    
                    <td><input type="file" name="p_photo[]" placeholder="Photos" class="form-control div>
                  </tr>  
                </table>
                <input name="lat" type="text" id="lat" hidden>
                <input name="lng" type="text" id="lng" hidden>
                  <hr>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Add Hostel" name="add_Hostel">
                  </div>
                </div>
              </div>
              </form>
              <br><br>

    </div>
    </div>


  </div>
</body>




<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
      for(var j=0; j<th.length; j++){
        td = tr[i].getElementsByTagName("td")[j];      
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
          {
            tr[i].style.display = "";
            break;
           }
        }
      }
  }
}
</script>

<script>
function myFunction2() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
      for(var j=0; j<th.length; j++){
        td = tr[i].getElementsByTagName("td")[j];      
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
          {
            tr[i].style.display = "";
            break;
           }
        }
      }
  }
}
</script>

<script>
function myFunction3() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable3");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
      for(var j=0; j<th.length; j++){
        td = tr[i].getElementsByTagName("td")[j];      
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
          {
            tr[i].style.display = "";
            break;
           }
        }
      }
  }
}
</script>
<script>
function myFunction4() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable4");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
      for(var j=0; j<th.length; j++){
        td = tr[i].getElementsByTagName("td")[j];      
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
          {
            tr[i].style.display = "";
            break;
           }
        }
      }
  }
}
</script>


              <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

<script>
// Get the modal
var modal2 = document.getElementById("myModal2");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img2 = document.getElementById("myImg2");
var modalImg2 = document.getElementById("img02");
var captionText2 = document.getElementById("caption2");
img2.onclick = function(){
  modal2.style.display = "block";
  modalImg2.src = this.src;
  captionText2.innerHTML = this.alt;
}
var span2 = document.getElementsByClassName("close")[1];
span2.onclick = function() { 
  modal2.style.display = "none";
}
</script>
<script>
  function deletestudent(studentId) {
    if (confirm("Are you sure you want to delete this student?")) {
      // Send an AJAX request to delete the student
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          location.reload(); // Refresh the page after deletion
        }
      };
      xhttp.open("GET", "delete_student.php?delete_student=true&student_id=" + studentId, true);
      xhttp.send();
    }
  }
</script>
<script>
              function updateHostel() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                th = table.getElementsByTagName("th");
                for (i = 1; i < tr.length; i++) {
                  tr[i].style.display = "none";
                    for(var j=0; j<th.length; j++){
                      td = tr[i].getElementsByTagName("td")[j];      
                      if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)
                        {
                          tr[i].style.display = "";
                          break;
                         }
                      }
                    }
                }
              }
              </script>