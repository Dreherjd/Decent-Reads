<?php 

function getAllAuthors(){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            authors
    ");
    $result = $query->execute();
    if($result){
        $authors = $query->fetchAll(PDO::FETCH_ASSOC);
        return $authors;
    } else {
        return null;
    }
}

?>