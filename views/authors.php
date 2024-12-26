<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once('../controllers/authors-controller.php');
if (isset($_SESSION['loggedin'])) {
    $authors = getAllAuthors();
} else {
    header('location:' . BASE_URL . 'index.php');
}
?>

<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />
<?php if ($_SESSION['user_role'] == 'admin') : ?>
    <a href="#" class="button is-primary">Add an Author</a>
    <br /><br />
<?php endif; ?>
<div class="columns">
    <?php foreach ($authors as $author) : ?>
        <div class="column is-3">
            <a href="<?php echo BASE_URL ?>views/view-author.php?author_id=<?php echo $author['author_id'] ?>">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-128x128">
                            <img
                                src="../assets/images/sking.jpg"
                                alt="Stephen King" />
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4"><?php echo $author['author_name'] ?></p>
                                <p class="subtitle is-6"><?php echo $author['author_handle'] ?></p>
                            </div>
                        </div>
                        <div class="content">
                            <?php echo isTruncBookSynops($author['about_the_author']) ?>
                            <br />
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>


<?php include '../includes/footer.php'; ?>