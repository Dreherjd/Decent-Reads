<?php

function getListContentsByListId($list_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT * FROM books_lists WHERE list_id = :list_id
    ");
    $result = $query->execute(
        array(
            'list_id' => $list_id
        )
    );
    if($result){
        $list_contents = $query->fetchAll(PDO::FETCH_ASSOC);
        return $list_contents;
    } else {
        return null;
    }
}

function getListDataByListId($list_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT * FROM user_lists WHERE list_id = :list_id
    ");
    $result = $query->execute(
        array(
            'list_id' => $list_id
        )
    );
    if($result){
        $list_data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $list_data;
    } else {
        return null;
    }
}