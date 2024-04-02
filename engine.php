<?php
$Hostel_id = '';
$country = '';
$County = '';
$SubCounty = '';
$Ward = '';
$Street = '';
$Estate = '';
$ward_no = '';
$contact_no = '';
$Hostel_type = '';
$estimated_price = '';
$total_rooms = '';
$bedroom = '';
$living_room = '';
$Space = '';
$bathroom = '';
$description = '';
$latitude = '';
$longitude = '';
$owner_id = '';

$db = new mysqli('localhost', 'root', '', 'renthouse');

if ($db->connect_error) {
    echo "Error connecting database";
}

if (isset($_POST['add_Hostel'])) {
    add_Hostel();
}

if (isset($_POST['owner_update'])) {
    owner_update();
}

function add_Hostel() {
    global $Hostel_id, $country, $County, $SubCounty, $Ward, $Street, $Estate, $contact_no, $Hostel_type, $estimated_price, $total_rooms, $bedroom, $living_room, $Space, $bathroom, $description, $latitude, $path, $p_photo, $Hostel_photo_id, $longitude, $owner_id, $db;

    $country = validate($_POST['Country']);
    $County = validate($_POST['county']);
    $SubCounty = validate($_POST['SubCounty']);
    $Ward = validate($_POST['Ward']);
    $Street = validate($_POST['Street']);
    $Estate = validate($_POST['Estate']);
    $contact_no = validate($_POST['contact_no']);
    $Hostel_type = validate($_POST['Hostel_type']);
    $estimated_price = validate($_POST['estimated_price']);
    $total_rooms = validate($_POST['total_rooms']);
    $bedroom = validate($_POST['bedroom']);
    $living_room = validate($_POST['living_room']);
    $Space = validate($_POST['Space']);
    $bathroom = validate($_POST['bathroom']);
    $description = validate($_POST['description']);
    $latitude = validate($_POST['latitude']);
    $longitude = validate($_POST['longitude']);

    $u_email = $_SESSION['email'];
    $sql1 = "SELECT * from owner where email='$u_email'";
    $result1 = mysqli_query($db, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        while ($rowss = mysqli_fetch_assoc($result1)) {
            $owner_id = $rowss['owner_id'];

            $sql = "INSERT INTO add_Hostel(country,County,SubCounty,Ward,Street,Estate,contact_no,Hostel_type,estimated_price,total_rooms,bedroom,living_room,Space,bathroom,description,latitude,longitude,owner_id) VALUES('$country','$County','$SubCounty','$Ward','$Street','$Estate','$contact_no','$Hostel_type','$estimated_price','$total_rooms','$bedroom','$living_room','$Space','$bathroom','$description','$latitude','$longitude','$owner_id')";
            $query = mysqli_query($db, $sql);

            $Hostel_id = mysqli_insert_id($db);

            $countfiles = count($_FILES['p_photo']['name']);

            for ($i = 1; $i < $countfiles; $i++) {
                $paths = $_FILES['p_photo']['tmp_name'][$i];
                if ($paths!= "") {
                    $path = "product-photo/". $_FILES['p_photo']['name'][$i];
                    if (move_uploaded_file($paths, $path)) {
                        $sql2 = "INSERT INTO Hostel_photo(p_photo,Hostel_id) VALUES('$path','$Hostel_id')";
                        $query = mysqli_query($db, $sql2);
                    }
                }
            }

            if (!empty($query)) {
?>

<style>
.alert {
 padding: 20px;
 background-color: #DC143C;
 color: white;
}

.closebtn {
 margin-left: 15px;
 color: white;
 font-weight: bold;
 float: right;
 font-size: 22px;
 line-height: 20px;
 cursor: pointer;
 transition: 0.3s;
}

.closebtn:hover {
 color: black;
}
</style>
<script>
window.setTimeout(function() {
 $(".alert").fadeTo(1000, 0).slideUp(500, function(){
 $(this).remove(); 
 });
}, 2000);
</script>
<div class="container">
<div class="alert" role='alert'>
 <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
 <center><strong>Your Product has been uploaded.</strong></center>
</div></div>

<?php
}
else {
echo "error";
}

}
}}

function owner_update() {
    global $owner_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $errors, $db;
    $owner_id = validate($_POST['owner_id']);
    $full_name = validate($_POST['full_name']);
    $email = validate($_POST['email']);
    $phone_no = validate($_POST['phone_no']);
    $address = validate($_POST['address']);
    $id_type = validate($_POST['id_type']);
    
    // Note: It seems like $password is missing. Assuming it's being validated too.
    $password = validate($_POST['password']);
    $password = md5($password); // Encrypt password
    
    $sql = "UPDATE owner SET full_name='$full_name', email='$email', phone_no='$phone_no', address='$address', id_type='$id_type', password='$password' WHERE owner_id='$owner_id'";
    
    $query = mysqli_query($db, $sql);
    
    if (!empty($query)) {
?>
<style>
.alert {
  padding: 20px;
  background-color: #DC143C;
  color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<script>
  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(500, function(){
      $(this).remove(); 
    });
  }, 2000);
</script>
<div class="container">
  <div class="alert" role='alert'>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <center><strong>Your Information has been updated.</strong></center>
  </div>
</div>
<?php
    } else {
        echo "Error updating information";
    }
}


function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


