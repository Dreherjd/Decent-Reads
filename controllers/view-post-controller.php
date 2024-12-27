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

function getCommentsByReviewId($book_review_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            comments
        WHERE
            post_id = :book_review_id
    ");
    $result = $query->execute(
        array(
            'book_review_id' => $book_review_id
        )
    );
    if($result){
        $comments = $query->fetchAll(PDO::FETCH_ASSOC);
        return $comments;
    } else {
        return null;
    }
}

function deleteComment($comment_id){
    global $pdo;
    $query = $pdo->prepare("
        DELETE FROM
            comments
        WHERE
            comment_id = :comment_id
    ");
    $result = $query->execute(
        array(
            'comment_id' => $comment_id
        )
    );
    return $result !== false;
}



?>