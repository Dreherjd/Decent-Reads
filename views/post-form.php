<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/post-form-controller.php');

if (isset($_SESSION['loggedin'])) {
    $book_title = $review_title = $review_content = $review_complete = $review_score = null;
    if (isset($_GET['book_id'])) {
        $book_title = getBookNameByBookId($_GET['book_id']);
    }
    if (isset($_GET['book_review_id'])) {
        $page_state = "edit";
        $review = getBookReviewByReviewId($_GET['book_review_id']);
        if ($review) {
            $book_title = getBookNameByBookId($review['book_id']);
            $review_title = $review['book_review_title'];
            $review_content = $review['book_review_content'];
            $review_complete = $review['complete_or_dnf'];
            $review_score = $review['book_review_score'];
        }
    } else {
        $page_state = "add";
        #default complete status to completed
        $review_complete = "Completed it";
    }

    if (!empty($_POST)) {
        $errors = array();
        if (!empty($_POST)) {
            $review_title = $_POST['review_title'];
            if (!$review_title) {
                $errors[] = "You need to have a title!";
            }
            $review_content = $_POST['review_content'];
            if (!$review_content) {
                $errors[] = "You need content to post!";
            }
            $review_complete = $_POST['review_complete'];
            if (!$review_complete) {
                $errors[] = "You have to choose a completion status";
            }
            $review_score = $_POST['review_score'];
            if (!$review_score) {
                $errors[] = "You must give a score!";
            }
        }
        if (!$errors) {
            if (isset($_GET['book_review_id'])) {
                $review_id = $_GET['book_review_id'];
                echo 'right before trying to edit the review';
                editReview($review_id, $review_title, $review_content, $review_complete, $review_score);
            } else {
                #postid = addpost()
                /*if(!postid){
                    error out
                } */
                $author = $_SESSION['user_id'];
                echo 'right before trying to add new review';
                $review_id = addReview($review_title, $review_content, $review_complete, $review_score, $author, $_GET['book_id']);
                if (!$review_id) {
                    $errors[] = "Error adding new review";
                }
            }
            if (!$errors) {
                header('location:' . BASE_URL . 'views/view-post.php?book_review_id=' . $review_id);
            }
        }
    }

    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];
    } else {
        #no book id set.
        #If you get here, something is wrong.
        #there should always be a book id set.
    }
} else {
    header('location: login.php');
}
?>


<?php include('../includes/header.php'); ?>
<br /><br /><br /><br />
<div class="content">
    <h1><?php echo ($page_state == "edit") ? "Edit" : "Share" ?> your thoughts about <?php echo $book_title ?></h1>
</div>


<form action="" method="post">
    <div class="columns">
        <div class="column is-3">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input" name="review_title" value="<?php echo $review_title ?>" type="text">
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Content</label>
                <div class="control">
                    <textarea name="review_content" class="textarea"><?php echo $review_content ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Did you finish it?</label>
                <div class="control">
                    <div class="select">
                        <select name="review_complete" selected="selected">
                            <option <?php ($review_complete == 'Completed it') ? "selected" : "" ?> value="Completed it">Completed it</option>
                            <option <?php ($review_complete == 'DNF') ? "selected" : "" ?> value="DNF">I did not finish it</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">Your Score</label>
                <div class="control">
                    <input name="review_score" value="<?php echo $review_score ?>" class="input" type="text">
                </div>
            </div>
        </div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Submit" class="button is-primary"></input>
                </div>
                <div class="control">
                    <button class="button is-light">Cancel</button>
                </div>
            </div>
        </div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
    </div>

</form>


<?php include('../includes/footer.php'); ?>