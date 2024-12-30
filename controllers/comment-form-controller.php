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

function editComment($comment_id, $comment_content){
    global $pdo;
    $query = $pdo->prepare("
        UPDATE
            comments
        SET
            comment_content = :comment_content
        WHERE
            comment_id = :comment_id
    ");
    $result = $query->execute(
        array(
            'comment_content' => $comment_content,
            'comment_id' => $comment_id
        )
    );
    if(!$result){
        throw new Exception("error updating comment");
    }
    return $comment_id;
}



?>