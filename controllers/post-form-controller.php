<?php 

/**
 * gets a book review by the book review id
 * @param int - the book review id
 */
function getBookReviewByReviewId($book_review_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            book_reviews
        WHERE
            book_review_id = :book_review_id
    ");
    $result = $query->execute(
        array(
            'book_review_id' => $book_review_id
        )
    );
    if($result){
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row;
    } else {
        return null;
    }
}


/**
 * editReview
 * edits review, by the id passed in.
 * @param  int - $book_review_id
 * @param  string -  $review_title
 * @param  string - $review_content
 * @param  mixed - $review_complete
 * @param  mixed $review_score
 * @return int - the book_review_id
 */
function editReview($book_review_id, $review_title, $review_content, $review_complete, $review_score){
    global $pdo;
    $query = $pdo->prepare("
        UPDATE
            book_reviews
        SET
            book_review_title = :book_review_title,
            book_review_content = :book_review_content,
            complete_or_dnf = :review_complete,
            book_review_score = :review_score
        WHERE
            book_review_id = :book_review_id
    ");
    $result = $query->execute(
        array(
            'book_review_title' => $review_title,
            'book_review_content' => $review_content,
            'review_complete' => $review_complete,
            'review_score' => $review_score,
            'book_review_id' => $book_review_id,
        )
    );
    if(!$result){
        throw new Exception("Error in trying to execute edit query");
    }
    return $book_review_id;
}

/**
 * addReview
 * adds a new review to the database, and returns the new id
 * @param  string $review_title
 * @param  string $review_content
 * @param  mixed $review_complete
 * @param  int $review_score - the score given to the review
 * @param  int $review_author - the user id of the author
 * @param  int $book_id - the id of the book
 * @return int - the id of the inserted record
 */
function addReview($review_title, $review_content, $review_complete, $review_score, $review_author, $book_id){
    global $pdo;
    $query = $pdo->prepare("
        INSERT INTO
            book_reviews
                (book_review_title, book_review_content, complete_or_dnf, book_review_score, book_review_user_id, book_id)
            VALUES
                (:book_review_title, :book_review_content, :complete_or_dnf, :book_review_score, :book_review_user_id, :book_id)
    ");
    $result = $query->execute(
        array(
            'book_review_title' => $review_title,
            'book_review_content' => $review_content,
            'complete_or_dnf' => $review_complete,
            'book_review_score' => $review_score,
            'book_review_user_id' => $review_author,
            'book_id' => $book_id,
        )
    );
    if(!$result){
        throw new Exception("Error in adding review");
    }
    return $pdo->lastInsertId();
}



?>