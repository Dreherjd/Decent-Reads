<?php 

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



?>