<?php
require 'Connection.php';
$connection = Connection::connect();

session_start();
$sid = $_SESSION['sid'];
$cid = $_POST['cid'];

$query = "SELECT count(*) as count
          FROM student NATURAL JOIN apply
          WHERE sid = '$sid'";
$result = $connection->query($query) or die('Query error: ' . $connection->error);
$count = $result->fetch_assoc();
$count = $count['count'];

if ($count == 3) {
    echo '<script type="text/javascript">';
    echo 'alert("You have reached the maximum limit for internship application.");';
    echo 'window.location.href = "welcome.php";';
    echo '</script>';
} else {
    $query = "SELECT count(*) as count
              FROM company as c
              WHERE cid not in (SELECT cid
                                FROM apply
                                WHERE sid = '$sid')
                  AND quota > (SELECT count(*) as count
                               FROM apply as a
                               WHERE a.cid = c.cid )
                  AND cid = '$cid'";

    $result = $connection->query($query) or die('Query error: ' . $connection->error);
    $count = $result->fetch_assoc();
    $count = $count['count'];

    if ($count > 0) {
        $insertion = "INSERT INTO apply (sid, cid) VALUES ('$sid', '$cid')";

        if ($connection->query($insertion) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'alert("Application has been successful.");';
            echo 'window.location.href = "application.php";';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Application was unsuccessful.");';
            echo 'window.location.href = "application.php";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Application was unsuccessful.");';
        echo 'window.location.href = "application.php";';
        echo '</script>';
    }
}
