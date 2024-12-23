<?php
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/view-post.php');

if (isset($_GET['book_review_id'])) {
    $book_review_id = $_GET['book_review_id'];
    # get the rest of the book data
    if ($book_review_id) {
        $review = getBookReviewByReviewId($book_review_id);
    }
}


?>

<?php include('../includes/header.php'); ?>
<br /><br /><br /><br />
<div class="content">
    <h1><?php echo $review['book_review_title']; ?></h1>
    <small><a href="#"><?php echo getBookNameByBookId($review['book_id']) ?></a>, written by <a href="#"><?php echo getAuthorById(getAuthorByBookId($review['book_id'])) ?></a></small>
    <br />
    <small><i>Rated <?php echo $review['book_review_score']?> out of 5</i></small>
    <p><?php echo convertNewLinesToParagraphs($review['book_review_content']); ?></p>
    <h4>Written By <?php echo $review['book_review_author']?>  - <?php echo getDateForDatabase($review['book_review_created']);?></h4>
    <h2>Comments</h2>
    <p>{comment form}</p>

</div>

<?php include('../includes/footer.php'); ?>