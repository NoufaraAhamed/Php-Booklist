<?php
include('database.php');
if (isset($_POST["create"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $sqlInsert = "INSERT INTO books (title , content , date , description) VALUES ('$title','$content','$date', '$description')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Book Added Successfully!";
        header("Location: index.php");
    }else{
        die("Something went wrong");
    }
}
?>