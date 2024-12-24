<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    require_once("../common/common.php");
    require_once("../common/dbconnect.php");
    require_once("../controllers/view-book-controller.php");
    if (isset($_GET['book_id'])) {
        $book = getBookDataByBookId($_GET['book_id']);
        $reviews = getReviewsByBookIdExcludingCurrentUser($_GET['book_id'], $_SESSION['user_id']);
        $author = getAuthorRecordByAuthorId($book['author_id']);
        $current_user_review = getCurrentUserReview($_SESSION['user_id'], $book['book_id']);
    }
} else {
    header("location: login.php");
}


?>


<?php include('../includes/header.php'); ?>
<br /><br /><br /><br />
<!-- Book info -->
<section class="hero is-primary is-small">
    <div class="hero-body">
        <p class="title"><?php echo $book['book_title'] ?></p>
        <p class="subtitle"><?php echo getAuthorNameById($book['author_id']) ?></p>
    </div>
</section>
<br />
<nav class="level is-mobile">
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Published</p>
            <p class="title"><?php echo $book['published_date'] ?></p>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading"># of Reviews</p>
            <p class="title"><?php echo getNumberOfReviews($book['book_id']) ?></p>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading">Avg Rating</p>
            <?php if(getAvgRatingByBookId($book['book_id']) != 0) : ?>
            <p class="title"><?php echo getAvgRatingByBookId($book['book_id']) ?> out of 5</p>
            <?php else : ?>
                <p class="title">No ratings, yet.</p>
            <?php endif ; ?>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading"># of Ratings</p>
            <p class="title"><?php echo getNumberOfReviewsForBookId($book['book_id']) ?></p>
        </div>
    </div>
</nav>
<section class="section">
    <p class="subtitle"><?php echo convertNewLinesToParagraphs($book['brief_synops']) ?></p>
</section>

<!-- About the Author -->
<section class="hero is-small has-background-primary-70">
    <div class="hero-body">
        <p class="title">About the Author</p>
        <p class="subtitle"><?php echo $author['author_name'] ?></p>
    </div>
</section>
<section class="section">
    <p class="subtitle"><?php echo convertNewLinesToParagraphs($author['about_the_author']) ?></p>
</section>

<br /><br /><br />
<!-- Reviews about the book -->
<!-- Current users review, if there is one -->
<?php if (checkIfCurrentUserHasReview($_SESSION['user_id'], $book['book_id'])): ?>
    <section class="hero is-small has-background-primary-70">
        <div class="hero-body">
            <p class="title">Your Review</p>
        </div>
    </section>
    <br />
    <div class="content centered">
        <h2><?php echo $current_user_review['book_review_title'] ?></h2>
    </div>
    <nav class="level is-mobile">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Author</p>
                <p class="title"><?php echo getUserNameByUserId($current_user_review['book_review_user_id']) ?></p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Written</p>
                <p class="title"><?php echo getDateForDatabase($current_user_review['book_review_created']) ?></p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Rated</p>
                <p class="title"><?php echo $current_user_review['book_review_score'] ?> out of 5</p>
            </div>
        </div>
    </nav>
    <div class="content">
        <blockquote>
            <?php echo isTruncBookSynops(convertNewLinesToParagraphs($current_user_review['book_review_content'])) ?><a href="<?php echo BASE_URL ?>views/view-post.php?book_review_id=<?php echo $review['book_review_id'] ?>">View More</a>
        </blockquote>
    </div>
    <br /><br /><br />
<?php else : ?>
    <!-- link to write review -->
    <div class="columns is-centered">
        <div class="content">
            <h3>Read this one? What did you think?</h3>
        </div>
    </div>
    <div class="columns is-centered">
        <a href="<?php BASE_URL?>post-form.php?book_id=<?php echo $book['book_id'] ?>" class="button is-large is-primary">Write a Review!</a>
    </div>
    <br /><br />
<?php endif; ?>
<!-- All reviews, if there are any -->
<?php if ($reviews): ?>
    <section class="hero is-small has-background-primary-70">
        <div class="hero-body">
            <p class="title">Some Recent Reviews</p>
        </div>
    </section>
    <br />
    <?php foreach ($reviews as $review) : ?>
        <div class="content centered">
            <h2><?php echo $review['book_review_title'] ?></h2>
        </div>
        <nav class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Author</p>
                    <p class="title"><?php echo getUserNameByUserId($review['book_review_user_id']) ?></p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Written</p>
                    <p class="title"><?php echo getDateForDatabase($review['book_review_created']) ?></p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Rated</p>
                    <p class="title"><?php echo $review['book_review_score'] ?> out of 5</p>
                </div>
            </div>
        </nav>
        <div class="content">
            <blockquote>
                <?php echo isTruncBookSynops(convertNewLinesToParagraphs($review['book_review_content'])) ?><a href="<?php echo BASE_URL ?>views/view-post.php?book_review_id=<?php echo $review['book_review_id'] ?>">View More</a>
            </blockquote>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<?php include("../includes/footer.php"); ?>