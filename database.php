<?php

try {
    $db = new PDO('mysql:host=localhost:3306; dbname=blog', 'root', 'root');
}catch(PDOException $error){
    echo $error->getMessage();
}

?>