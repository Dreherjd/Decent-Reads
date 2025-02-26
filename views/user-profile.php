<?php
session_start();
require_once('../common/common.php');
require_once('../common/dbconnect.php');
require_once('../controllers/user-profile-controller.php');
if (isset($_SESSION['loggedin'])) {
    if (isset($_GET['user_id'])) {
        $user = getUserDataByUserId($_GET['user_id']);
        #get number of reviews
        $number_of_reviews = getNumberOfReviewsByUserId($user['user_id']);
        #avg rating given across all reviews
        $avg_review_score = getAvgReviewScoreByUserId($user['user_id']);
        #most reviewed tag?
        #number of books read that are tracked by the db
        $number_of_books_read = getNumberOfBooksReadByUserId($user['user_id']);
        #get the last 4 posts written by passed in user
        $last_few_posts = getLast4PostsByUserId($user['user_id']);
        #Get all lists for passed in user
        $lists = getAllListsByUserId($user['user_id']);
        #Check if user has any lists
        $user_has_lists = checkUserHasLists($user['user_id']);
    }
} else {
    header('location: ' . BASE_URL . 'login.php');
}
?>
<?php include '../includes/header.php'; ?>
<br /><br /><br /><br />
<div class="columns is-multiline">
    <div class="column is-one-third">
        <figure class="image is-128x128">
            <img src="../assets/images/sking.jpg" alt="Stephen King" />
        </figure>
        <p><?php echo $user['user_f_name'] . " " . $user['user_l_name'] ?> (<?php echo $user['preferred_pronoun'] ?>)
        </p>
        <p><?php echo $user['user_location'] ?></p>
        <br />
        <a href="#" class="button is-primary is-full-width">Edit Your Info</a>
        <br /><br />
    </div>
    <div class="column is-two-thirds">
        <nav class="level">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading"># of Ratings</p>
                    <p class="title"><?php echo $number_of_reviews ?></p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Avg Rating Given</p>
                    <p class="title"><?php echo $avg_review_score ?></p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Followers</p>
                    <p class="title">456K</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Number of Books Read</p>
                    <p class="title"><?php echo $number_of_books_read ?></p>
                </div>
            </div>
        </nav>
        <br /><br />
        <p><?php echo $user['user_bio'] ?></p>
    </div>
</div>
<div class="columns is-multiline">
    <div class="column is-one-third">
        <div class="content">
            <?php if ($user_has_lists == true): ?>
                <?php if ($_SESSION['user_id'] == $user['user_id']): ?>
                    <h4 class="is-underlined">Your Recent Lists</h4>
                <?php else: ?>
                    <h4 class="is-underlined"><?php echo $user['user_f_name'] ?>'s Recent Lists</h>
                    <?php endif; ?>
                <?php else: ?>
                    <h4 class="is-underlined">This person doesn't have any lists!</h4>
                <?php endif; ?>
        </div>
        <ul>
            <?php foreach ($lists as $list): ?>
                <li><a href="<?php echo BASE_URL ?>views/view-list.php?list_id=<?php echo $list['list_id']?>"><?php echo $list['list_name'] ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="column is-two-thirds">
        <div class="content">
            <h3><?php echo $_SESSION['user_id'] != $user['user_id'] ? "Some of " . $user['user_f_name'] . "'s Recent Reviews" : "Some of Your Recent Reviews" ?>
            </h3>
        </div>
        <div class="columns is-multiline">
            <?php foreach ($last_few_posts as $post): ?>
                <div class="column is-centered is-4">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title"><strong><?php echo isTrunc($post['book_review_title']) ?></strong>
                            </p>
                        </header>
                        <div class="card-content">
                            <a style="color: black;"
                                href="<?php echo BASE_URL ?>views/view-post.php?book_review_id=<?php echo $post['book_review_id'] ?>">
                                <div class="content">
                                    <p><a
                                            href="<?php echo BASE_URL ?>views/user-profile.php?user_id=<?php echo $post['book_review_user_id'] ?>"><?php echo getUserNameByUserId($post['book_review_user_id']) ?></a>&nbsp;reviewed&nbsp;<i><a
                                                href="<?php echo BASE_URL ?>views/view-book.php?book_id=<?php echo $post['book_id'] ?>"><?php echo getBookNameByBookId($post['book_id']) ?></a></i>
                                    </p>
                                    <?php echo substr($post['book_review_content'], 0, 250) . "..." ?>
                                    <br />
                                    <small><i>Rated <?php echo $post['book_review_score'] ?> out of 5</i></small>
                                    <br />
                                    <p><?php echo getDateForDatabase($post['book_review_created']) ?> </p>
                                </div>
                            </a>
                            <br />
                            <div class="buttons">
                                <?php if ($post['book_review_user_id'] == $_SESSION['user_id']): ?>
                                    <a href="<?php echo BASE_URL ?>views/post-form.php?book_review_id=<?php echo $post['book_review_id'] ?>"
                                        class="button is-primary is-fullwidth">Edit</a>
                                <?php endif; ?>
                                <a href="<?php echo BASE_URL ?>views/view-post.php?book_review_id=<?php echo $post['book_review_id'] ?>"
                                    class="button is-primary is-fullwidth">View More</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>