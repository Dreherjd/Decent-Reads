<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decent Reads</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/styles/bulma.css">
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo BASE_URL ?>index.php">
                <img src="<?php echo BASE_URL ?>assets/images/book_icon.png" alt="">
                Decent Reads
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item">
                    About
                </a>


            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            Admin
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                Add a Book
                            </a>
                            <a class="navbar-item">
                                Add an Author
                            </a>
                            <a class="navbar-item">
                                Add a Tag
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">