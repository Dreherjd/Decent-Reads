<?php
session_start();
require_once('../common/common.php');
require_once('../common/dbconnect.php');
require_once('../controllers/view-list-controller.php');
if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['list_id'])) {
        $list_contents = getListContentsByListId($_GET['list_id']);
        if ($list_contents) {
            $books_in_list = [];
            foreach ($list_contents as $list_entry) {
                $temp_book = getBookDataByBookId($list_entry['book_id']);
                array_push($books_in_list, $temp_book);
            }
        }
        $list_data = getListDataByListId($_GET['list_id']);
    }
} else {
    header('location: ' . BASE_URL . 'login.php');
}


?>

<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />


<section class="hero is-primary">
    <div class="hero-body">
        <p class="title"><?php echo $list_data['list_name'] ?></p>
        <p class="subtitle"><?php echo $list_data['list_desc'] ?></p>
    </div>
</section>
<br /><br />
<?php if (sizeof($list_contents) < 1): ?>
    <div class="content">
        <h4 class="is-centered">There are no books in this list.</h4>
    </div>
<?php else: ?>
    <table class="table is-striped is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Published Date</th>
                <th>Number of Pages</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Published Date</th>
                <th>Number of Pages</th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($books_in_list as $list_item): ?>
                <tr>
                    <td><?php echo $list_item['book_title'] ?></td>
                    <td><?php echo $list_item['author_id'] ?></td>
                    <td><?php echo $list_item['published_date'] ?></td>
                    <td><?php echo $list_item['number_of_pages'] ?></td>
                    <td><a href="#" class="button is-danger is-light">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>