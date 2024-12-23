<?php
try{
    $pdo = new PDO("mysql:host=localhost;dbname=decentreads","root","");
} catch(PDOException){
    die();
}