<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once("../controllers/tags-controller.php");
if (isset($_SESSION['loggedin'])) {
    #get all tags
    $all_tags = getAllTags();
} else {
    header('location: login.php');
}

?>
<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />
<a href="<?php BASE_URL ?>tag-form.php" class="button is-primary">Add a Tag</a>
<br /><br />
<?php foreach ($all_tags as $tag) : ?>
    <a href="<?php echo BASE_URL?>views/tag-form.php?tag_id=<?php echo $tag['tag_id']?>"><span class="tag is-info"><?php echo $tag['tag_title']; ?></span></a>
<?php endforeach; ?>
<?php include '../includes/footer.php'; ?>