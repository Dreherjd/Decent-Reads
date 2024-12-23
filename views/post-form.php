<?php
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/post-form.php');

$book_title = $review_title = $review_content = $review_complete = $review_score = null;

if (isset($_GET['book_review_id'])) {
    $page_state = "edit";
    $review = getBookReviewByReviewId($_GET['book_review_id']);
    if($review){
        $book_title = getBookNameByBookId($review['book_id']);
        $review_title = $review['book_review_title'];
        $review_content = $review['book_review_content'];
        $review_complete = $review['complete_or_dnf'];
        $review_score = $review['book_review_score'];
    }
} else {
    $page_state = "add";
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
} else {
    #no book id set
}
?>


<?php include('../includes/header.php'); ?>
<br /><br /><br /><br />
<div class="content">
    <h1><?php echo ($page_state == "edit") ? "Edit" : "Share" ?> your thoughts about <?php echo $book_title ?></h1>
</div>


<form action="post">
    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input" value="<?php echo $review_title?>" type="text">
                </div>
            </div>
        </div>
        <div class="column"></div>
        <div class="column"></div>
        <div class="column"></div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="field">
                <label class="label">Content</label>
                <div class="control">
                    <textarea class="textarea"><?php echo $review_content?></textarea>
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
                        <select selected="selected">
                            <option value="complete">Yes</option>
                            <option value="DNF">I did not finish it</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label class="label">Your Score</label>
                <div class="control">
                    <input class="input" type="text">
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
                    <button class="button is-primary">Submit</button>
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