<?php
$link = mysqli_connect('webpagesdb.it.auth.gr','ante34','ante34');
mysqli_set_charset($link, "utf8");

if (!$link) {
    echo '<p>Error connecting to the database <br>';  
    echo 'Please try again.</p>';
    exit(); 
}

$sel_db = mysqli_select_db($link,'ante_db');

if (!$sel_db) {
    echo '<p>Error selecting database table <br>';  
    echo 'Please try again.</p>';
    exit(); 
}


?>