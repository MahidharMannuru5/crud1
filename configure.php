<?php

$servername = "localhost";

$username = "root"; 

$password = ""; 

$dbname = "dashboard"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {

    echo "Connection unsuccessfull";

}
?>