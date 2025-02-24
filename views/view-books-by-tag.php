<?php
session_start();
require_once('../common/common.php');
require_once('../common/dbconnect.php');
require_once('../controllers/view-books-by-tag-controller.php');
if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['tag_id'])) {
        $tag_id = $_GET['tag_id'];
        $book_ids = getAllBooksByTagId($tag_id);
        $books = [];
        foreach($book_ids as $book){
            $ind_book = getBookDataByBookId($book['book_id']);
            array_push($books,$ind_book);
        }
    }
} else {
    header('location:' . BASE_URL .'/login.php');
}

?>


<?php include '../includes/header.php' ; ?>
<br /><br /><br /><br />
<div class="content">
<h3>Books tagged: <?php echo getTagNameByTagId($_GET['tag_id'])?></h3>
</div>
<div class="columns is-multiline">
    <?php foreach ($books as $book) : ?>
        <div class="column is-one-third">
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
                            <span class="tag is-info"><?php echo getTagNameByTagId($tag['tag_id']) ?></span>
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


<?php include '../includes/footer.php' ; ?>