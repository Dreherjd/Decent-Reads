<?php
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once("../controllers/comment-form-controller.php");
$comment_content = null;
if (isset($_SESSION['loggedin'])) {
    if(!empty($_POST)){
        $comment_content = $_POST['comment_content'];
        addComment($book_review_id, $comment_content, $_SESSION['user_id']);
        // header_remove();
        // header('location:' . BASE_URL . 'views/view-post.php?book_review_id=' . $book_review_id);
    }
} else {
    header('location:' . BASE_URL . 'login.php');
}


?>
<form action="" method="post">
    <article class="media">
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea class="textarea" name="comment_content" placeholder="Add a comment..."><?php echo $comment_content ?></textarea>
                </p>
            </div>
            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <input type="submit" value="Submit" class="button is-primary">
                    </div>
                </div>
            </nav>
        </div>
    </article>
</form>