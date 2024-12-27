<?php

function addComment($review_id, $comment_content, $comment_author){
    global $pdo;
    $errors = array();
    $query = $pdo->prepare("
        INSERT INTO
            comments
            (post_id, comment_content, author)
        VALUES
            (:post_id, :comment_content, :author)
    ");
    $result = $query->execute(
        array(
            'post_id' => $review_id,
            'comment_content' => $comment_content,
            'author' => $comment_author
        )
    );
    if($result === false){
        $error_info = $query->errorInfo();
        if($error_info){
            $errors[] = $error_info[2];
        }
    }
}



?>