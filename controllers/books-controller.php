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


function addBook($book_title, $brief_synops, $author, $number_of_pages, $published_date){
    global $pdo;
    $query = $pdo->prepare("
        INSERT INTO
            books(book_title, brief_synops, author_id, published_date, number_of_pages)
        VALUES
            (:book_title, :brief_synops, :author, :published_date, :number_of_pages)
    ");
    $result = $query->execute(
        array(
            'book_title' => $book_title,
            'brief_synops' => $brief_synops,
            'author' => $author,
            'number_of_pages' => $number_of_pages,
            'published_date' => $published_date
        )
    );
    if(!$result){
        throw new Exception('Error in adding book');
    }
    return $pdo->lastInsertId();
}



?>