<?php
session_start();
require_once("../common/common.php");
require_once("../common/dbconnect.php");
require_once("../controllers/books-controller.php");

$book_title = null;
$brief_synops = null;
$author = null;
$published_date = null;
$number_of_pages = null;


if (isset($_SESSION["loggedin"])) {
    $authors = getAllAuthors();

    if (isset($_GET['book_id'])) {
        #edit
    } else {
        #add
    }



    if (!empty($_POST)) {
        $errors = array();
        $book_title = $_POST["book_title"];
        if (!$book_title) {
            $errors[] = "You need to have a title!";
        }
        $brief_synops = $_POST['brief_synops'];
        if (!$brief_synops) {
            $errors[] = 'You need to have a synopsis';
        }
        $author = $_POST['author_id'];
        if (!$author) {
            $errors[] = 'You must have an author';
        }
        $number_of_pages = $_POST['number_of_pages'];
        if (!$number_of_pages) {
            $errors[] = 'You need to have a page count';
        }
        $published_date = $_POST['published_date'];
        if (!$published_date) {
            $errors[] = 'You must have a published date';
        }
        if (!$errors) {
            if (!isset($_GET)) {
                #Do the add
                $new_book_id = addBook($book_title, $brief_synops, $author, $number_of_pages, $published_date);
                if (!$new_book_id) {
                    $errors = 'Error in adding book';
                }
                if (!$errors) {
                    header("location: " . BASE_URL . "views/view-book.php?book_id=" . $new_book_id);
                }
            } else {
                #do the edit
            }
        }
    }
} else {
    header("location: login.php");
}

?>
<?php include '../includes/header.php'; ?>

<br /><br /><br /><br />
<form action="" method="post">
    <div class="columns">
        <div class="column is-6">
            <div class="field">
                <label class="label">Book Title</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" value="<?php echo $book_title ?>"
                        placeholder="Physician's Field Reference">
                </div>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column is-12">
            <div class="field">
                <label class="label">Brief Synopsis</label>
                <div class="control">
                    <textarea class="textarea"
                        placeholder="It all started with a few hobbits"><?php echo $brief_synops ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column is-2">
            <div class="field">
                <label class="label">Author</label>
                <div class="control">
                    <div class="select">
                        <select>
                            <?php if ($authors): ?>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?php echo $author['author_id'] ?>"><?php echo $author['author_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="An Author">An Author</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <label class="label">Number of Pages</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" value="<?php echo $number_of_pages ?>" placeholder="Too Many">
                </div>
            </div>
        </div>
        <div class="column is-2">
            <div class="field">
                <label class="label">Publication Date</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" value="<?php echo $published_date ?>" placeholder="1-28-77">
                </div>
            </div>
        </div>
    </div>

    <div class="columns">
        <div class="column is-4">
            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-primary">Submit</button>
                </div>
                <div class="control">
                    <button class="button is-light">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>




<?php include '../includes/footer.php'; ?>