<?php
define("BASE_URL", "/decentreads/");
define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/decentreads/");

function getRightNowSqlDate(){
    return date('Y-m-d H:i:s');
}

/**
 * @param String - the html you'd like escaped
 * @return String - the escaped string
 */
function escapeHTML($html){
    return htmlspecialchars($html, ENT_HTML5, 'UTF-8');
}

/**
 * Converts new lines entered in a textArea into ptags
 * @param String - the text with new lines
 * @return String - the text with p tags
 */
function convertNewLinesToParagraphs($text){
    $escaped = escapeHTML($text);
    return '<p>' . str_replace("\n", "</p><p>", $escaped) . '</p>';
}

/**
 * redirects user to passed in path
 * @param String - the path you wish to have the user redirected to
 */
function redirect($url){
    echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
}

/**
 * truncates text based on character count, puts ... at the end
 * @param String - the text you wish to have truncated
 */
function isTrunc($text)
{
    if (strlen($text) >= 39) {
        return substr($text,0,36) . "...";
    } else {
        return $text;
    }
}

/**
 * returns a readable date format
 * @param String - the date you want formatted
 */
function getDateForDatabase(string $date): string
{
    $timestamp = strtotime($date);
    $date_formated = date('m/d/y - g:ia', $timestamp);
    return $date_formated;
}

/**
 * gets a book record associated with the id that's passed
 * @param int - the book id
 */
function getBookNameByBookId($id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            books
        WHERE
            book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'book_id' => $id
        )
    );
    if($result){
        $book = $query->fetch(PDO::FETCH_ASSOC);
        return $book['book_title'];
    } else {
        return null;
    }
}

/**
 * gets the author by author_id
 * @param int - the author id
 */
function getAuthorById($author_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            authors
        WHERE
            author_id = :author_id
    ");
    $result = $query->execute(
        array(
            'author_id' => $author_id
        )
    );
    if($result){
        $author = $query->fetch(PDO::FETCH_ASSOC);
        return $author['author_name'];
    } else {
        return null;
    }
}

/**
 * gets author based on book id
 * @param id - the book id
 */
function getAuthorByBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            books
        WHERE
            book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['author_id'];
    } else {
        return null;
    }
}