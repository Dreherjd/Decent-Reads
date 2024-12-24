<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once("../controllers/books-controller.php");
if (isset($_SESSION['loggedin'])) {
    try {
        $books = getAllBooks();
    } catch (PDOException) {
        #error or something
        die();
    }
}
?>

<?php include('../includes/header.php'); ?>
<br /><br /><br /><br />
<div class="columns">
    <?php foreach ($books as $book) : ?>
        <div class="column is-4">
            <div class="card">
                <a href="#">
                    <header class="card-header">
                        <p class="card-header-title"><?php echo $book['book_title'] ?> - <?php echo getAuthorNameById($book['author_id']) ?></p>
                    </header>
                </a>
                <div class="card-content">
                    <div class="content">
                        <?php echo isTruncBookSynops($book['brief_synops']) ?>
                        <br />
                        Published <?php echo $book['published_date'] ?>
                        <br />
                        <?php foreach (getAllTagsForBookByBookId($book['book_id']) as $tag): ?>
                            <span class="tag is-primary"><?php echo getTagNameByTagId($tag['tag_id']) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <footer class="card-footer">
                    <p class="card-footer-item">Avg Rating: 3.4/5</p>
                    <a href="<?php echo BASE_URL ?>views/view-book.php?book_id=<?php echo $book['book_id'] ?>" class="card-footer-item">View Book</a>
                </footer>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include('../includes/footer.php'); ?>