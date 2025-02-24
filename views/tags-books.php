<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/tags-controller.php');

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['book_id'])) {
        $book = getBookDataByBookId($_GET['book_id']);
        $tags = getAllTagsOtherThanAssigned($_GET['book_id']);
    }

    if(!empty($_POST)){
        #add tag to book
        assignTagToBook($_POST['tag_id'], $_GET['book_id']);
        header('location:' . BASE_URL . 'views/view-book.php?book_id=' . $book['book_id']);
    }

} else {
    header('location: ' . BASE_URL . 'login.php');
}

?>

<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />

<div class="content">
    <h3 class="title">
        Add a Tag to: <?php echo $book['book_title']; ?>
    </h3>
</div>

<div class="tags">
    <?php foreach ($tags as $tag) : ?>
        <form action="" method="post" id="form">
            <input type="hidden" name="tag_id" value="<?php echo $tag['tag_id']?>">
            <input type="hidden" name="tag_title" value="<?php echo $tag['tag_title']?>">
            <input type="submit" class="button is-info" value="<?php echo $tag['tag_title']?>">
        </form>
    <?php endforeach; ?>
</div>
<div class="buttons">
    <a href="<?php echo BASE_URL ?>views/view-book.php?book_id=<?php echo $book['book_id'] ?>" class="button is-primary">Cancel</a>
</div>
<?php include '../includes/footer.php'; ?>