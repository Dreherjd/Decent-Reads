<?php

function getAllTags(){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            tags
    ");
    $result = $query->execute();
    if($result){
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    } else {
        return false;
    }
}

function getTagDataByTagId($tag_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            tags
        WHERE
            tag_id = :tag_id
    ");
    $result = $query->execute(
        array(
            'tag_id' => $tag_id
        )
    );
    if($result){
        $tag = $query->fetch(PDO::FETCH_ASSOC);
        return $tag;
    } else {
        return null;
    }
}

/**
 * addNewTag
 * inserts a new tag into the database
 * @param  string $tag_title
 * @return int - the id of the inserted record.
 */
function addNewTag($tag_title){
    global $pdo;
    $query = $pdo->prepare("
        INSERT INTO
            tags
            (tag_title)
        VALUES
            (:tag_title)
    ");
    $result = $query->execute(
        array(
            'tag_title' => $tag_title
        )
    );
    if($result === false){
        throw new Exception("error inserting tag");
    }
    return $pdo->lastInsertId();
}

function editTagByTagId($tag_id, $tag_title){
    global $pdo;
    $query = $pdo->prepare("
        UPDATE
            tags
        SET
            tag_title = :tag_title
        WHERE
            tag_id = :tag_id
    ");
    $result = $query->execute(
        array(
            'tag_title' => $tag_title,
            'tag_id' => $tag_id
        )
    );
    if($result){
        return $tag_id;
    } else {
        return null;
    }
}

function getAllTagsOtherThanAssigned($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            tags
        WHERE
            tag_id NOT IN (select tag_id from books_tags where book_id = :book_id)
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    } else {
        return null;
    }
}

function assignTagToBook($tag_id, $book_id){
    global $pdo;
    $query = $pdo->prepare("
        INSERT INTO
            books_tags
            (book_id, tag_id)
        VALUES
            (:book_id, :tag_id)
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id,
            'tag_id' => $tag_id
        )
    );
    if($result === false){
        throw new Exception("error assigning tag");
    }
    return $pdo->lastInsertId();
}

?>