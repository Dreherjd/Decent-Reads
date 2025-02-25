<?php

function getNumberOfReviewsByUserId($user_id){
    global $pdo;
    $query = $pdo->prepare("
        select COUNT(book_review_id) AS number_of_reviews FROM book_reviews WHERE book_review_user_id = :user_id
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id
        )
    );
    if($result){
        $number_of_reviews = $query->fetchColumn();
        return $number_of_reviews;
    } else {
        return 0;
    }
}

function getAvgReviewScoreByUserId($user_id){
    global $pdo;
    $query = $pdo->prepare("
        select AVG(book_review_score) AS avg_score FROM book_reviews WHERE book_review_user_id = :user_id AND complete_or_dnf != 'DNF'
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id
        )
    );
    if($result){
        $avg_score = $query->fetchColumn();
        return round($avg_score, 2);
    } else {
        return 0;
    }
}

function getNumberOfBooksReadByUserId($user_id){
    global $pdo;
    $query = $pdo->prepare("
        select COUNT(book_review_id) AS number_of_books_read FROM book_reviews WHERE book_review_user_id = :user_id AND complete_or_dnf != 'DNF'
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id
        )
    );
    if($result){
        $number_of_books_read = $query->fetchColumn();
        return $number_of_books_read;
    } else {
        return 0;
    }
}

function getLast4PostsByUserId($user_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT * FROM book_reviews WHERE book_review_user_id = :user_id LIMIT 4
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id
        )
    );
    if($result){
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    } else {
        return null;
    }
}