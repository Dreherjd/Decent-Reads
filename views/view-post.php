<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/view-post-controller.php');

if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['book_review_id'])) {
        $book_review_id = $_GET['book_review_id'];
        # get the rest of the book data
        if ($book_review_id) {
            $review = getBookReviewByReviewId($book_review_id);
            $comments = getCommentsByReviewId($book_review_id);
            if ($review) {
                $book_id = $review['book_id'];
                $tags = getAllTagsForBookByBookId($book_id);
            }
        }
    }

    if ($_POST) {
        if (isset($_POST['delete-post'])) {
            $keys = array_keys($_POST['delete-post']);
            $delete_post_id = $keys[0];
            if ($delete_post_id) {
                deletePost($delete_post_id);
                header('location:' . BASE_URL . 'index.php');
            }
        }
        if(isset($_POST['delete-comment'])){
            $keys = array_keys($_POST['delete-comment']);
            $delete_comment_id = $keys[0];
            if($delete_comment_id){
                deleteComment($delete_comment_id);
                header('location:' . BASE_URL . 'views/view-post.php?book_review_id=' . $book_review_id);
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
    <?php foreach ($tags as $tag) : ?>
        <span class="tag is-info"><?php echo getTagNameByTagId($tag['tag_id']) ?></span>
    <?php endforeach; ?>
    <br /><br />
    <h4>Written By <?php echo getUserNameByUserId($review['book_review_user_id']) ?> - <?php echo getDateForDatabase($review['book_review_created']); ?></h4>
    <?php if ($_SESSION['user_id'] == $review['book_review_user_id']) : ?>
        <div class="buttons">
            <a href="<?php echo BASE_URL ?>views/post-form.php?book_review_id=<?php echo $review['book_review_id'] ?>" class="button is-primary">Edit</a>
            <form action="" method="post">
                <input type="submit" class="button is-danger is-light" name="delete-post[<?php echo $review['book_review_id']; ?>]" value="Delete">
            </form>
        </div>
    <?php endif; ?>
    <h2>Comments</h2>
    <h4>Add Your Thoughts!</h4>
    <?php include 'comment-form.php' ?>
    <br /><br />
    <h4>Here's what other people are saying about <?php echo getBookNameByBookId($book_id) ?></h4>
</div>
<?php foreach ($comments as $comment) : ?>
    <article class="message is-primary">
        <div class="message-header">
            <p><?php echo getUserNameByUserId($comment['author']) ?> - <?php echo getDateForDatabase($comment['created']) ?></p>
            <?php if ($_SESSION['user_id'] == $comment['author']) : ?>
                <form action="" method="post">
                    <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id'] ?>">
                    <input type="submit" name="delete-comment[<?php echo $comment['comment_id']?>]" value="Delete" class="button is-danger">
                </form>
            <?php endif; ?>

        </div>
        <div class="message-body">
            <?php echo $comment['comment_content']; ?>
        </div>
    </article>
<?php endforeach; ?>
<?php include('../includes/footer.php'); ?>