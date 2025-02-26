<?php
if (isset($_POST['signout'])) {
    session_destroy();
    header('location: ' . BASE_URL . 'login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decent Reads</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/bulma.css">
</head>

<body>
    <style>
        <?php include 'assets/styles/bulma.css'; ?>
    </style>
    <nav class="navbar is-spaced has-shadow" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo BASE_URL ?>index.php">
                <img src="<?php echo BASE_URL ?>assets/images/book_icon.png" alt="">
                Decent Reads
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <a href="<?php echo BASE_URL ?>views/books.php" class="navbar-item">
                    View all Books
                </a>
                <a href="<?php echo BASE_URL ?>views/user-profile.php?user_id=<?php echo $_SESSION['user_id'] ?>"
                    class="navbar-item">
                    User Profile
                </a>
                <form action="" method="post">
                    <button type="submit" name="signout" class="navbar-item">Sign Out</button>
                </form>
                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Admin
                        </a>
                        <div class="navbar-dropdown">
                            <a href="<?php echo BASE_URL ?>views/authors.php" class="navbar-item">
                                Authors
                            </a>
                            <a href="<?php echo BASE_URL ?>views/tags.php" class="navbar-item">
                                Tags
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">