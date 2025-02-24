<?php
function getAllBooksByTagId($tag_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT book_id FROM (SELECT * FROM books_tags where tag_id = :tag_id) AS book_ids; 
    ");
    $result = $query->execute(
        array(
            'tag_id' => $tag_id
        )
    );
    if($result){
        $book_ids = $query->fetchAll(PDO::FETCH_ASSOC);
        return $book_ids;
    } else {
        return null;
    }
}


?>