<?php

/**
 * Created by PhpStorm.
 * User: sstienface
 * Date: 04/12/2018
 * Time: 11:25
 */

// Premiere ligne


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jointure";






$conn = new mysqli($servername,$username,$password);

if($conn ->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
// Selectionner la base à utiliser
    $conn->select_db($dbname);

}

function description ()
{
    global $conn;
    $sql = "SELECT * FROM eleves, eleves_information where eleves_information.eleves_id = eleves.id";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc())
    {   $value = $row['id'];
        $avatar = $row["avatar"];
        echo "<a href='page2.php?value=$value' >".$row['prenom']." ". $row['nom']." ".$row['age']." habite a ".$row['ville']." avatar : "."<img src='$avatar' width='100px' height='150px'></a><br>";

    }}

description();

echo "<hr>";

