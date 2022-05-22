<?php
include 'configure.php';

if(isset($_POST['submit'])){
    $header = $_POST['header'];
    $data = $_POST['data'];
    $image = $_FILES['imageFile']['name'];
    $image_tmp_name=$_FILES['imageFile']['tmp_name'];
    $image_folder="images/".$image;
    move_uploaded_file($image_tmp_name,$image_folder);
    $sql = "INSERT INTO `Information` ( `header`, `data`, `image`) VALUES ( '$header', '$data', '$image')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Data inserted successfully";
    }
    else{
        echo "Data not inserted";
    }
    $select=mysqli_query($conn,"SELECT * FROM Information");

}

if(isset($_POST['delete'])){
    $id=$_POST['sno'];
    $sql = "DELETE FROM `Information` WHERE sno=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "Data deleted successfully";
    }
    else{
        echo "Data not deleted";
    }
    $select=mysqli_query($conn,"SELECT * FROM Information");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post"  enctype="multipart/form-data" >
    <div class="header">
        <input type="text" name="header" id="">
    </div>
    <div class="body">
        <input type="text" name="data" id="">
    </div>
    <div class="image">
        <input type="file" name="imageFile" id="imageFile">
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="submit">
    </div>
</form>

<div class="container">
    <table>
        <?php
        while($row=mysqli_fetch_array($select)){
            echo "<tr>";
            echo "<td>".$row['header']."</td>";
            echo "<td>".$row['data']."</td>";
            echo "<td><img src='images/".$row['image']."'></td>";
            //update the row data in this table
            echo "<td><a href='update.php?sno=".$row['sno']."'>Update</a></td>";
            echo "<td><form action='index.php' method='post'><input type='hidden' name='sno' value='".$row['sno']."'>
            <input type='submit' name='delete' value='delete'></form></td>";
            echo "</tr>";
        }
?>
               
    </table>
    
</div>

</body>    
</namem>
</body>
</html>
