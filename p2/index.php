<?php
// Destroy any previous session
session_start();
session_unset();
session_destroy();
?>

<!doctype html>
<html>

<head>
    <title>Career Center</title>
</head>

<style>
    * {
        font-family: sans-serif;
        font-size: 20px;
        text-align: center;
    }

    h1 {
        font-size: 40px;
    }

    input {
        width: 200px;
        margin-bottom: 10px;
        border-radius: 3px;
        background-color: #fff;
    }

    button {
        display: inline-block;
        padding: 5px 25px;
        font-size: 24px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #33AFFF;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
    }

    button:hover {
        background-color: #006FB6
    }

    button:active {
        background-color: #006FB6;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
</style>

<body>
    <h1>Career Center</h1>
    <form method='post' onsubmit='return validateForm();' action='login.php'>
        Username<br>
        <input type='text' id='usernameInput' name='username'><br>
        Password<br>
        <input type='password' id='passwordInput' name='password'><br>
        <button type='submit'>Login</button>
    </form>
</body>

</html>