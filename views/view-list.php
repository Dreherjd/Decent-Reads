<?php
session_start();
require_once('../common/common.php');
require_once('../common/dbconnect.php');
require_once('../controllers/view-list-controller.php');
if(isset($_SESSION['loggedin'])){
    if(isset($_GET['list_id'])){
        $list_contents = getListContentsByListId($_GET['list_id']);
        $list_data = getListDataByListId($_GET['list_id']);
    }
} else {
    header('location: ' . BASE_URL . 'login.php');
}


?>

<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />



<?php include '../includes/footer.php'; ?>