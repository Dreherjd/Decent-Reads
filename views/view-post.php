<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/view-post-controller.php');

if(isset($_SESSION['loggedin'])){
    if (isset($_GET['book_review_id'])) {
        $book_review_id = $_GET['book_review_id'];
        # get the rest of the book data
        if ($book_review_id) {
            $review = getBookReviewByReviewId($book_review_id);
        }
    }

    if($_POST){
        if(isset($_POST['delete-post'])){
            $keys = array_keys($_POST['delete-post']);
            $delete_post_id = $keys[0];
            if($delete_post_id){
                deletePost($delete_post_id);
                header('location:' . BASE_URL . 'index.php');
            }
        }
    }
} else {
    header('location: login.php');
}




?>

<?php include('../includes/header.php'); ?>
<br /><br />

<br /><br />
<div class="content">
    <h1><?php echo $review['book_review_title']; ?></h1>
    <small><a href="<?php echo BASE_URL ?>views/view-book.php?book_id=<?php echo $review['book_id'] ?>"><?php echo getBookNameByBookId($review['book_id']) ?></a>, written by <a href="#"><?php echo getAuthorNameById(getAuthorByBookId($review['book_id'])) ?></a></small>
    <br />
    <small><i>Rated <?php echo $review['book_review_score'] ?> out of 5</i></small>
    <p><?php echo convertNewLinesToParagraphs($review['book_review_content']); ?></p>
    <h4>Written By <?php echo getUserNameByUserId($review['book_review_user_id']) ?> - <?php echo getDateForDatabase($review['book_review_created']); ?></h4>
    <?php if($_SESSION['user_id'] == $review['book_review_user_id']) : ?>
    <div class="buttons">
        <a href="<?php echo BASE_URL?>views/post-form.php?book_review_id=<?php echo $review['book_review_id']?>" class="button is-primary">Edit</a>
        <form action="" method="post">
            <input type="submit" class="button is-danger is-light" name="delete-post[<?php echo $review['book_review_id'];?> ?>]" value="Delete">
        </form>
    </div>
    <?php endif ;?>
    <h2>Comments</h2>
    <p>{comment form}</p>

</div>

<?php include('../includes/footer.php'); ?>