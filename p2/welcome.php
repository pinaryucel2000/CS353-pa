<?php
require 'Connection.php';
$connection = Connection::connect();

session_start();
$sid = $_SESSION['sid'];
$sname = $_SESSION['sname'];

$query = "SELECT cid, cname, quota
          FROM company NATURAL JOIN apply
          WHERE sid = '$sid'";
$result = $connection->query($query) or die('Query error: ' . $connection->error);

$connection->close();

?>

<!doctype html>
<html>

<head>
    <title>Welcome</title>
</head>
<style>
    * {
        font-family: sans-serif;
        text-align: center;
        font-size: 20;
    }

    .content-table {
        border-collapse: collapse;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        margin-left: auto;
        margin-right: auto;
    }

    .content-table thead tr {
        background-color: #33AFFF;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 2px solid #33AFFF;
    }

    .content-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }

    .redButton {
        display: inline-block;
        padding: 5px 15px;
        font-size: 20;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #EC2828;
        border: none;
        border-radius: 5px;
    }

    .redButton:hover {
        background-color: #BF2020
    }

    .greenButton {
        display: inline-block;
        padding: 5px 15px;
        font-size: 20;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #20BF38;
        border: none;
        border-radius: 5px;
    }

    .greenButton:hover {
        background-color: #167624
    }
</style>

<body>
    <h1>WELCOME <?php echo strtoupper($sname) ?></h1>
    <caption>Your Applications</caption>
    <table class="content-table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Quota</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row['cid'] ?></td>
                    <td><?php echo $row['cname'] ?></td>
                    <td><?php echo $row['quota'] ?></td>
                    <td> <a href="cancel.php?cancel=<?php echo $row['cid']; ?>" class="redButton">Cancel</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="application.php" class="greenButton">Apply for a New Internship</a>
    <br><br>
    <a href="index.php" class="redButton">Logout</a>
</body>

</html>