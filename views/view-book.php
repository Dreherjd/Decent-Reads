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
    #get the list of tags for the book
    $list_of_tags = getAllTagsForBookByBookId($_GET['book_id']);
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
        <a href="<?php echo BASE_URL ?>views/view-author.php?author_id=<?php echo $book['author_id'] ?>" class="subtitle"><?php echo getAuthorNameById($book['author_id']) ?></a>
    </div>
</section>
<br />
<small><i>Tags</i></small>
<div class="tags">
    <?php foreach ($list_of_tags as $tag) : ?>
        <span class="tag is-info"><?php echo getTagNameByTagId($tag['tag_id']) ?></span>
    <?php endforeach; ?>
    <?php if ($_SESSION['user_role'] == 'admin') : ?>
        <a href="<?php echo BASE_URL ?>views/tags-books.php?book_id=<?php echo $book['book_id'] ?>"><span class="tag is-info">Add a Tag</span></a>
    <?php endif; ?>
</div>
<br /><br />
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
            <?php if (getAvgRatingByBookId($book['book_id']) != 0) : ?>
                <p class="title"><?php echo getAvgRatingByBookId($book['book_id']) ?> out of 5</p>
            <?php else : ?>
                <p class="title">No ratings, yet.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="level-item has-text-centered">
        <div>
            <p class="heading"># of Pages</p>
            <p class="title"><?php echo $book['number_of_pages'] ?></p>
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
        <a href="<?php echo BASE_URL ?>views/view-author.php?author_id=<?php echo $author['author_id'] ?>" class="subtitle"><?php echo $author['author_name'] ?></a>
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
            <p class="title is-centered">Your Review</p>
        </div>
    </section>
    <br />

    <div class="columns is-mobile is-centered">
        <div class="column is-half">
            <p class="bd-notification is-primary">
            <div class="content">
                <h1 class="has-text-centered is-underlined"><?php echo $current_user_review['book_review_title'] ?></h1>
            </div>
            </p>
        </div>
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
                <p class="heading">Completion Status</p>
                <p class="title"><?php echo $current_user_review['complete_or_dnf'] ?></p>
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
    <br /><br />
    <div class="columns is-centered">
        <a href="<?php BASE_URL ?>post-form.php?book_id=<?php echo $book['book_id'] ?>&book_review_id=<?php echo $current_user_review['book_review_id'] ?>" class="button is-large is-primary">Edit your review</a>
    </div>
    <br /><br />
    <br /><br /><br />
<?php else : ?>
    <!-- link to write review -->
    <div class="columns is-centered">
        <div class="content">
            <h3>Read this one? What did you think?</h3>
        </div>
    </div>
    <div class="columns is-centered">
        <a href="<?php BASE_URL ?>post-form.php?book_id=<?php echo $book['book_id'] ?>" class="button is-large is-primary">Write a Review!</a>
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
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <p class="bd-notification is-primary">
                <div class="content">
                    <h1 class="has-text-centered is-underlined"><?php echo $review['book_review_title'] ?></h1>
                </div>
                </p>
            </div>
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
                    <p class="heading">Completion Status</p>
                    <p class="title"><?php echo $review['complete_or_dnf'] ?></p>
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