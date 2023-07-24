<?php

$db_user = "root";
$db_host = "localhost";
$db_eng = "mysql";
$db_name = "vitamine";

// $db_user = "root2";
// $db_pw = "server";
// $db_host = "localhost";
// $db_eng = "mysql";
// $db_name = "e2fi1_vitamine";

function db_connect() {
    global $db_user, $db_host, $db_eng, $db_name;
    try {
        $db_server = "$db_eng:host=$db_host;dbname=$db_name";
        //$dbh = new PDO($db_server, $db_user, $db_pw);
        $dbh = new PDO($db_server, $db_user);
        //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
    catch(PDOException $e) {
        //echo "<p>Error:<br>";
        //echo $e->getMessage()."</p>";
    } 
}

?>