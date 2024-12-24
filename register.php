<?php

if (isset($_POST['signup'])) {
    global $pdo;
    $username = $_POST['username'];
    $user_full_name = $_POST['user_full_name'];
    $password = $_POST['password'];

    $query = $pdo->prepare("
        INSERT INTO users(user_full_name, user_pw, user_un) VALUES(:user_full_name, :password, :username)
    ");
    $add_user = $query->execute(
        array(
            'user_full_name' => $user_full_name,
            'password' => $password,
            'username' => $username
        )
    );
    if (!$add_user) {
        die("error in adding user");
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
            <p class="title">Sign Up</p>
        </div>
    </div>
</section>
<br /><br />
<form action="post" action="">
    <div class="container2">
        <div class="columns">
            <div class="column is-2">
                <div class="content">
                    <h3>Full Name</h3>
                </div>
                <input class="input" type="text" placeholder="Mark Twain" />
                <br /><br />
                <div class="content">
                    <h3>Username</h3>
                </div>
                <input class="input" type="text" placeholder="BookNerd22" />
                <br /><br />
                <div class="content">
                    <h3>Password</h3>
                </div>
                <input class="input" type="password" placeholder="*******" />
                <br /><br />
                <div class="buttons">
                    <input type="submit" name="signin" value="Sign In" class="button is-primary">
                    <button class="button is-info">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</form>