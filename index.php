<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";

$username = "root"; 

$password = ""; 

$dbname = "dashboard"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn){
    echo "connection unsuccesfull";
}
?>
<?php
if(isset($_POST['submit'])){
  $header = $_POST['header'];
  echo $header;
  $data = $_POST['data'];
  $Bcolor=$_POST['Bcolor'];
  $image = $_FILES['image']['name'];
  $image_tmp_name=$_FILES['image']['tmp_name'];
  $image_folder="images/".$image;
  move_uploaded_file($image_tmp_name,$image_folder);
  $sql = "INSERT INTO `Info` ( `header`, `data`, `image`,`Bcolor`) VALUES ( '$header', '$data', '$image','$Bcolor')";
  $result = mysqli_query($conn, $sql);
  if(!$result){
      echo "Data not inserted successfully";
  }
  
  $select=mysqli_query($conn,"SELECT * FROM Info");


}
if(isset($_POST['delete'])){
  $id=$_POST['sno'];
  $sql = "DELETE FROM `Info` WHERE sno=$id";
  $result = mysqli_query($conn, $sql);
  if(!$result){
      echo "Data deleted unsuccessfull";
  }
  $select=mysqli_query($conn,"SELECT * FROM Info");}
?>

<!doctype html>
<html lang="en">
 <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha484-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW4" crossorigin="anonymous">

    <title>Dashboard</title>
  </head>
  <style>
    input{
    display: flex;
    align-items: inherit;
    margin:20px;
}
a.btn.btn-primary{
    margin:auto;
    margin-top:10px;
    margin-bottom:10px;

}
button.btn.btn-primary{
    border-radius: 10px 10px 10px 10px;
    display: flex;
    justify-content:space-evenly;

}
.card{
    margin:5px;
}
.card.bg-danger{
    margin:10px;
}
.new{
    width:auto;
    height:auto;
    align-items: center;
}
h4{
    text-align:center;
}
.col-sm-3{
     border-radius: 25px 25px 25px 25px;
}
.card{
    background-color: blue;
}
.container1{
    display: flex;
    align-items: center;
}a{
    text-align:center;
}

.containerimg{

    align-items: center;
    text-align: center;
}
img{
    height:70px;
    width:80px;
}
.card.bg-danger{
    background-color: #32a85a!important;
}
.card.bg-primary {
    background-color: rgba(0, 0, 0, 0.2)!important;
}
.card.bg-primary {
    background-color: rgba(0, 0, 0, 0.2)!important;
}
    </style>
  <body>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="placement.png" class="d-inline-block align-text-center">
            Director's Dashboard </a>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Login
  </button>
  
  
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5>Dashboard Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
               
              </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>

          
        </div>
      </div>
    </div>
  </div>          
        </div>
      </nav>
</div>       

    </div>
    <div class="container1">
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="text" name="header" id="">
<input type="text" name="data" id="">
<input type="file" name="image" id="">
<input type="text" name="Bcolor" id="">
<input type="submit" name="submit" value="submit">

</form>  
  </div>
    <div class="container">
      <div class="row">
      <?php
  $select=mysqli_query($conn,"SELECT * FROM Info");

      while($row=mysqli_fetch_array($select)){
            echo '<div class="col-sm-3">'; 
            echo "<div style='background-color:".$row['Bcolor']."!important' class='card bg-primary'>";
                       
            echo '<div class="card-body">';
            echo ' <div class="container1">';
            echo"<img src='images/".$row['image']."'>";
            echo"<p>" .$row['header']."</p>";
            echo'   </div>';

            echo "<h4 class='card-text'>".$row['data']."</h4>";
            echo '</div>';
        echo"  <div class='card-footer'>";
        echo"<div class='ceneter'>";
        echo "<div class='row'>";
        echo '<div class="col-sm-3">'; 

        echo "<button> <a href='update.php?sno=".$row['sno']."'>Update</a></button>";
        echo"</div>";
        echo '<div class="col-sm-3">'; 

        echo "<form action='index.php' method='post'><input type='hidden' name='sno' value='".$row['sno']."'>
        <input type='submit' name='delete' value='delete'></form>";
        echo"</div>";

        echo"</div>";
        echo"</div>";
         echo" </div>";
          echo '</div>';
          echo '</div>'; }
      ?>
</div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha484-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
