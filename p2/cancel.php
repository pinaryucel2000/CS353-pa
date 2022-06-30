<?php
require 'Connection.php';
$connection = Connection::connect();

session_start();
$sid = $_SESSION['sid'];

if (isset($_GET['cancel'])) {
    $cid = $_GET['cancel'];

    $query = "SELECT count(*) as count
              FROM apply
              WHERE sid = '$sid' AND cid = '$cid'";
    $result = $connection->query($query) or die('Query error: ' . $connection->error);
    $count = $result->fetch_assoc();
    $count = $count['count'];

    if ($count == 0) {
        echo '<script type="text/javascript">';
        echo 'alert("Error on cancellation. Application was not found.");';
        echo 'window.location.href = "welcome.php";';
        echo '</script>';
    } else {
        $query = "DELETE
                  FROM apply
                  WHERE sid = '$sid' AND cid = '$cid'";

        $connection->query($query) or die('Error in query: ' . $connection->error);

        echo '<script type="text/javascript">';
        echo 'alert("Application has been cancelled.");';
        echo 'window.location.href = "welcome.php";';
        echo '</script>';
    }
}
