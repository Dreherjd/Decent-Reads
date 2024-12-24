<?php
/**
 * Gets all books
 */
function getAllBooks(){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            books
    ");
    $result = $query->execute();
    if($result){
        $books = $query->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    } else {
        return null;
    }
}


?>