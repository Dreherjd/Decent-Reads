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
    <div class="buttons">
        <a href="<?php echo BASE_URL?>views/post-form.php?book_review_id=<?php echo $review['book_review_id']?>" class="button is-primary">Edit</a>
        <button class="button is-danger is-light">Delete</button>
    </div>
    <h2>Comments</h2>
    <p>{comment form}</p>

</div>

<?php include('../includes/footer.php'); ?>