
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "localhost";

$username = "root"; 

$password = ""; 

$dbname = "dashboard"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {

    echo "Connection unsuccessfull";

}

$sno=$_POST['sno'];
$sql = "SELECT * FROM Information WHERE `sno`='$sno'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $sno=$_POST['sno'];
    $header = $_POST['header'];
    $data = $_POST['data'];
    $image = $_FILES['imageFile']['name'];
    $image_tmp_name=$_FILES['imageFile']['tmp_name'];
    $image_folder="images/".$image;
    move_uploaded_file($image_tmp_name,$image_folder);
    $sql = "UPDATE `Information` SET `header`='$header',`data`='$data',`image`='$image' WHERE `Information`.`sno`='$sno'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Data updated successfully";
    }
    
}
?>




    <form action="update.php" method="post"  enctype="multipart/form-data" >
    <div class="header">
    <input type='hidden' name='sno' value='
<?php if (!empty($_GET[`sno`]))
{
    echo $_GET[`sno`];
} else {
    die('failboat');
} ?>'>

        <input type="text" name="header" value="<?php echo $row['header'];?>"id="">
    </div>
    <div class="body">
        <input type="text" name="data" value="<?php echo $row['data'];?> "id="">
    </div>
    <div class="image">
        <input type="file" name="imageFile" value=" <?php echo $row['image'];?> "id="imageFile">
    </div>
    <div class="update">
        <input type="submit" name="update" value="update">
    </div>

</body>
</html>