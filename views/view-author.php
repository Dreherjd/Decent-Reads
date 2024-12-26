<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");

if(isset($_SESSION['loggedin'])){
    if(isset($_GET['author_id'])){
        $author = getAuthorRecordByAuthorId($_GET['author_id']);
    }
} else {
    header('location: login.php');
}

?>

<?php include '../includes/header.php' ; ?>
<br /><br /><br /><br />




<?php include '../includes/footer.php' ; ?>