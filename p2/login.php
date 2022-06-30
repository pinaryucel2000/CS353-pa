<?php
require 'Connection.php';
$connection = Connection::connect();

$username = strtolower($_POST['username']);
$password = $_POST['password'];

if ($username == "" || $password == "") {
    echo '<script type="text/javascript">';
    echo 'alert("Please fill all of the input fields.");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
} else {
    $query = "SELECT count(*) as count
              FROM student
              WHERE LOWER(sname) = '$username' AND sid = '$password'";

    $result = $connection->query($query) or die('Error in query: ' . $connection->error);
    $data = $result->fetch_assoc();

    if ($data['count'] > 0) {
        session_start();
        $_SESSION['sid'] = $password;
        $_SESSION['sname'] = $username;
        header('Location: welcome.php');
    } else {
        echo '<script>alert("Wrong credentials.");';
        echo 'document.location = "index.php";</script>';
    }
}


$connection->close();
