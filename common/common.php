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
 * truncates the text, but allows more characters than the other one
 * @param String - the text you want trucated
 */
function isTruncBookSynops($text){
    if (strlen($text) >= 200) {
        return substr($text,0,197) . "...";
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

function getUserNameByUserId($user_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            user_full_name
        FROM
            users
        WHERE
            user_id = :user_id
    ");
    $result = $query->execute(
        array(
            'user_id' => $user_id
        )
    );
    if($result){
        $user_name = $query->fetch(PDO::FETCH_ASSOC);
        return $user_name['user_full_name'];
    } else {
        return null;
    }
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
 * gets the author name by author_id
 * @param int - the author id
 */
function getAuthorNameById($author_id){
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

function getAuthorRecordByAuthorId($author_id){
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
        return $author;
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

/**
 * gets tag name by tag id
 * @param int - the tag id
 */
function getTagNameByTagId($tag_id){
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
        if($tag){
            return $tag['tag_title'];
        } else {
            return null;
        }
    } else {
        return null;
    }
}

/**
 * gets list of tags for book by book id
 * @param int - the book id
 */
function getAllTagsForBookByBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            books_tags
        WHERE
            book_id = :book_id
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

/**
 * gets the average rating of a book from the reviews table by book id
 * then rounds it down to two decimal places
 * @param int - the book id
 */
function getAvgRatingByBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            ROUND(avg(book_review_score),1) as avg_score
        FROM
            book_reviews
        WHERE
            book_id = :book_id
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $avg_score = $query->fetch(PDO::FETCH_ASSOC);
        return $avg_score['avg_score'];
    } else {
        return 0;
    }
}

/**
 * gets reviews related to book id
 * @param int - the book id
 */
function getReviewsByBookId($book_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            book_reviews
        WHERE
            book_id = :book_id
            AND book_review_content IS NOT NULL
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id
        )
    );
    if($result){
        $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    } else {
        return null;
    }
}

/**
 * gets reviews related to book id, excluding current user
 * @param int - the book id
 */
function getReviewsByBookIdExcludingCurrentUser($book_id, $user_id){
    global $pdo;
    $query = $pdo->prepare("
        SELECT
            *
        FROM
            book_reviews
        WHERE
            book_id = :book_id
            AND book_review_user_id != :user_id
            AND book_review_content IS NOT NULL
    ");
    $result = $query->execute(
        array(
            'book_id' => $book_id,
            'user_id' => $user_id
        )
    );
    if($result){
        $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reviews;
    } else {
        return null;
    }
}

/**
 * deletePost
 * deletes a review based on review id
 * @param  int $book_review_id
 * @return void
 */
function deletePost($book_review_id){
    global $pdo;
    $query = $pdo->prepare("
        DELETE FROM
            book_reviews
        WHERE
            book_review_id = :book_review_id
    ");
    $result = $query->execute(
        array(
            'book_review_id' => $book_review_id
        )
    );
    return $result !== false;
}

function getBookDataByBookId($book_id){
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
        $book = $query->fetch(PDO::FETCH_ASSOC);
        return $book;
    } else {
        return null;
    }
}