<?php
#https://codewithbish.com/how-to-build-a-php-login-system-with-session-step-by-step/
session_start();
require_once("common/common.php");
require_once("common/dbconnect.php");
global $pdo;
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $pdo->prepare("
        SELECT * FROM users WHERE user_un = :username
    ");
    $result = $query->execute(
        array(
            'username' => $username
        )
    );
    if (!$result) {
        die("Error logging in");
    }
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $user_id = $row['user_id'];
        $user_un = $row['user_un'];
        $user_name = $row['user_full_name'];
        $user_pw = $row['user_pw'];
        $user_role = $row['user_role'];
    }

    if ($user_un == $username && $user_pw == $password) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_full_name'] = $user_name;
        $_SESSION['user_un'] = $user_un;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['loggedin'] = true;
        header('location: index.php?user_id=' . $user_id);
    } else {
        header('location: login.php');
    }
}

?>

<style>
    <?php include 'assets/styles/bulma.css'; ?>
</style>

<section class="hero is-primary is-halfheight">
    <div class="hero-body">
        <div class="">
            <p class="title">Decent Reads</p>
        </div>
    </div>
</section>
<br /><br />
<form method="post" action="">
<div class="container2">
    <div class="columns">
        <div class="column is-2">
            <div class="content">
                <h3>Username</h3>
            </div>
            <input class="input" name="username" type="text" placeholder="BookNerd22" />
            <br /><br />
            <div class="content">
                <h3>Password</h3>
            </div>
            <input class="input" type="password" name="password" placeholder="*******" />
            <br /><br />
            <div class="buttons">
                <input type="submit" name="signin" value="Sign In" class="button is-primary">
                <button class="button is-info">Sign Up</button>
            </div>
        </div>
    </div>
</div>
</form>