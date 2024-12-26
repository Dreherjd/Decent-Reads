<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/tags-controller.php');
if (isset($_SESSION['loggedin'])) {
    $tag_title = null;
    #add a new tag
    if (isset($_GET['tag_id'])) {
        #edit
        $tag = getTagDataByTagId($_GET['tag_id']);
        // $tag_id = $_GET['tag_id'];
        // $tag_title = getTagDataByTagId($tag_id)['tag_title'];
        if ($tag) {
            $tag_title = $tag['tag_title'];
        }

        if (!empty($_POST)) {
            $errors = array();
            $tag_title = $_POST['tag_title'];
            if (!$tag_title) {
                $errors[] = "You need a title for this tag";
            }


            if (!$errors) {
                if (isset($_GET['tag_id'])) {
                    # edit
                    $tag_id = $_GET['tag_id'];
                    editTagByTagId($tag_id, $tag_title);
                } else {
                    #add
                    $tag_id = addNewTag($tag_title);
                    if (!$tag_id) {
                        $errors[] = "Error adding new tag";
                    }
                }
                if (!$errors) {
                    header('location: ' . BASE_URL . 'views/tags.php');
                }
            }
        }
    }
} else {
    header('location: ' . BASE_URL . 'login.php');
}

?>

<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />
<form action="" method="post">
    <input class="input" name="tag_title" type="text" value="<?php echo $tag_title ?>" placeholder="Genre-Defining" />
    <br /><br />
    <div class="buttons">
        <input type="submit" class="button is-primary" value="Submit">
        <a href="<?php echo BASE_URL?>views/tags.php" class="button is-info">Cancel</a>
    </div>

</form>
<?php include '../includes/footer.php'; ?>