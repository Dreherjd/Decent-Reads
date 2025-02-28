<?php
session_start();
require_once("common/common.php");
require_once("common/dbconnect.php");
if (isset($_SESSION['user_id'])) {
    #get all posts/reviews to fill out index page
    global $pdo;
    $query = $pdo->query("
    SELECT
        *
    FROM
        book_reviews
    ORDER BY
        book_review_created DESC
");
    $result = $query->execute();
    $all_posts = $query->fetchAll(PDO::FETCH_ASSOC);


    if ($_POST) {
        if (isset($_POST['delete-post'])) {
            $keys = array_keys($_POST['delete-post']);
            $delete_post_id = $keys[0];
            if ($delete_post_id) {
                deletePost($delete_post_id);
                header('location:' . BASE_URL . 'index.php');
            }
        }
    }
} else {
    header('location: login.php');
}
?>


<?php include("includes/header.php"); ?>
<br /><br /><br />
<div class="columns is-multiline">
    <?php foreach ($all_posts as $post): ?>
        <div class="column is-centered is-4">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title"><strong><?php echo isTrunc($post['book_review_title']) ?></strong></p>
                </header>
                <div class="card-content">
                    <div class="content">
                        <p>A Review For&nbsp;<i><a
                                    href="<?php echo BASE_URL ?>views/view-book.php?book_id=<?php echo $post['book_id'] ?>"><?php echo getBookNameByBookId($post['book_id']) ?></a></i>
                        </p>
                        <?php echo substr($post['book_review_content'], 0, 250) . "..." ?>
                        <br />
                        <small><i>Rated <?php echo $post['book_review_score'] ?> out of 5</i></small>
                        <br />
                        <small><i>Written by: </i><a
                                href="<?php echo BASE_URL ?>views/user-profile.php?user_id=<?php echo $post['book_review_user_id'] ?>"><?php echo getUserNameByUserId($post['book_review_user_id']) ?></a></small>
                        <br />
                        <p><?php echo getDateForDatabase($post['book_review_created']) ?> </p>
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="<?php echo BASE_URL ?>views/view-post.php?book_review_id=<?php echo $post['book_review_id'] ?>"
                        class="card-footer-item">View Review</a>
                </footer>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
<?php include("includes/footer.php"); ?>