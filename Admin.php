<?php 
  include('session.php');
 //connect to the database
  $conn = mysqli_connect('localhost', 'Babli', '12345', 'biba');
  // check connection
  if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
  }

  $sql = "SELECT  Name, Phone_number, Table_for, Ocassions, rDate,  Other_requirements, cStatus, id FROM reservation ";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  if(isset($_POST['confirm'])){
    $Id = $_POST['confirm'];
    $sql = "UPDATE reservation SET cStatus = 'Confirmed' WHERE id = '$Id' ";
    if(mysqli_query($conn, $sql)){
     //echo "<script> alert('booking confirmed')</script>";
      header("location: Admin.php");
    }
  }


  if(isset($_POST['delete'])){
    $Id = $_POST['delete'];
    $sql = "DELETE FROM reservation WHERE id = '$Id' ";
    if(mysqli_query($conn, $sql)){
     //echo "<script> alert('booking confirmed')</script>";
      header("location: Admin.php");
    }
  }

   mysqli_close($conn);
  
  ?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="../css/Admin.css">

  <title>Admin Panel</title>
</head>
<body>
<table class="flat-table">
  <tbody>
    <tr>
     
      <th>Name</th>
      <th>Phone</th>
      <th>Number of Person</th>
      <th>Occassion</th>
      <th>Date</th>
      <th>Other Requirements</th>
      <th>status</th>
       <th>Id</th>
       <th></th>
      <th></th>

    </tr>
<?php   $i = 0;
  $arr = array('id');
foreach ( $data as $det) {
  
  ?>
  <tr>
    <?php  foreach ($det as $key => $value) {
      if($key == "id"){
        array_push($arr, $value);
        $i = $i +1;
         echo "<td> $i </td>";
      }
     else{
       echo "<td> $value </td>";
       }
    } 
    echo "<td><form action='Admin.php' method='post'>

    <button type='submit' name='confirm' value='$arr[$i]'>confirm</button>
</form> </td>";
 echo "<td><form action='Admin.php' method='post'>
     <button type='submit' name='delete' value='$arr[$i]'>delete</button>
</form> </td>";

 ?> 
    </tr>
  <?php } ?>
  </tbody>
	</table>
  <div class="logout"> <h2><a href="Logout.php">LOGOUT</a></h2></div>
</body >
</html>
<!-- login page 
about page
mail button in admin  -->
