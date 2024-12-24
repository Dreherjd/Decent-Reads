<?php 

function getBookDataByBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            books
        WHERE
            book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $book = $query->fetch(PDO::FETCH_ASSOC);
        return $book;
    } else {
        return null;
    }
}

/**
 * gets the total number of reviews for a book id
 * @param int - the book id
 */
function getNumberOfReviewsForBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            count(*) as count
        FROM
            book_reviews
        WHERE
            book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $num_rows = $query->fetch(PDO::FETCH_ASSOC);
        return $num_rows['count'];
    } else {
        return 0;
    }
}

/**
 * gets number of reviews that have an actual review by book id
 * @param int - the book id.
 */
function getNumberOfReviews($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            count(*) as count
        FROM
            book_reviews
        WHERE
            book_id = :book_id
            AND book_review_content IS NOT NULL
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $num_reviews = $query->fetch(PDO::FETCH_ASSOC);
        return $num_reviews['count'];
    } else {
        return 0;
    }
}

/**
 * checks if current user has written a review for the
 * currently selected book
 * @param int - the user id
 * @param int - the book id
 */
function checkIfCurrentUserHasReview($user_id, $book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            book_reviews
        WHERE
            book_review_user_id = :user_id
            AND book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id,
            'book_id' => $book_id
        )
    );
    if($result){
        if($query->fetchColumn()){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Gets the review of the current book, written by the current user
 * if there is one
 * @param int - the user id
 * @param int - the book id
 */
function getCurrentUserReview($user_id, $book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT * FROM book_reviews WHERE book_review_user_id = :user_id AND book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id,
            'book_id' => $book_id
        )
    );
    if($result){
        $review = $query->fetch(PDO::FETCH_ASSOC);
        return $review;
    } else {
        return null;
    }
}

?>