<?php
    if (!empty($_POST)){

        if (array_key_exists("action",$_POST)){
            if ($_POST["action"] == "select"){
                select();
            }elseif ($_POST["action"] == "insert") {
                insert();
            }

        }
       
    }


    function select(){
        $valid = false;
        $and = true;
        if (array_key_exists("filter_vitamine",$_POST) && !empty($_POST["filter_vitamine"])){
            $sql = 'SELECT * FROM ((obst INNER JOIN relation_obst_vitamine ON obst.o_id = relation_obst_vitamine.r_o_id) INNER JOIN vitamine ON vitamine.v_id = relation_obst_vitamine.r_v_id';
            $sql .= ") WHERE (";
            $first = true;
            foreach ($_POST["filter_vitamine"] as $v){
                if (!$first){ $sql .= " OR"; }
                $sql .= ' vitamine.v_name = "'.$v.'"';
                $first = false;
            }
            $sql .= " ) ";
            $valid = true;
        }else{
            $sql = 'SELECT * FROM obst WHERE ';
            $and = false;
        }

        if (isset($_POST["name"]) && $_POST["name"] != ""){
            if ($and){ $sql .= ' AND'; }
            $sql .= ' obst.o_name LIKE "%'.$_POST["name"].'%"';
            $and = true;
            $valid = true;
        }
        if (isset($_POST["kalorien"]) && $_POST["kalorien"] != ""){
            if ($and){ $sql .= ' AND'; }
            $sql .= ' obst.o_kalorien <= '.$_POST["kalorien"].'';
            $and = true;
            $valid = true;
        }
        if (isset($_POST["fett"]) && $_POST["fett"] != ""){
            if ($and){ $sql .= ' AND'; }
            $sql .= ' obst.o_fett <= '.$_POST["fett"].'';
            $and = true;
            $valid = true;
        }
        if (isset($_POST["zucker"]) && $_POST["zucker"] != ""){
            if ($and){ $sql .= ' AND'; }
            $sql .= ' obst.o_zucker <= '.$_POST["zucker"].'';
            $and = true;
            $valid = true;
        }

        if ($valid){
            $_POST["sql"] = $sql;

            // ??? won't let me require (no driver found)
            $db_user = "root";
            $db_host = "localhost";
            $db_eng = "mysql";
            $db_name = "vitamine";

            $db_server = "$db_eng:host=$db_host;dbname=$db_name";
            //$dbh = new PDO($db_server, $db_user, $db_pw);
            $db = new PDO($db_server, $db_user);
               
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $filter = $stmt->fetchAll();
            $collector = [];
            foreach ($filter as $f){
                if ( !in_array($f["o_name"], $collector) ){
                    $collector[] = $f;
                }
            }
            
            $_POST["result"] = $collector;
        }
    }

    function insert(){
        if (isset($_POST["name"]) && $_POST["name"] != "" && array_key_exists("filter_vitamine",$_POST) && !empty($_POST["filter_vitamine"]) ){
            
            $db_user = "root";
            $db_host = "localhost";
            $db_eng = "mysql";
            $db_name = "vitamine";

            $db_server = "$db_eng:host=$db_host;dbname=$db_name";
            //$dbh = new PDO($db_server, $db_user, $db_pw);
            $db = new PDO($db_server, $db_user);
            $sql = 'SELECT * FROM obst WHERE obst.o_name = "'.$_POST["name"].'"';
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $found = $stmt->fetch();

            if (is_array($found)){ // UPDATE
                //ToDo
            }else{ // INSERT
                $stmt = $db->prepare("INSERT INTO obst (o_name, o_kalorien, o_fett, o_zucker) VALUES (:name, :kalorien, :fett, :zucker)");

                $kalorien = "0";
                if (isset($_POST["kalorien"]) && $_POST["kalorien"] != ""){
                    $kalorien = $_POST["kalorien"];
                }
                $fett = "0";
                if (isset($_POST["fett"]) && $_POST["fett"] != ""){
                    $fett = $_POST["fett"];
                }
                $zucker = "0";
                if (isset($_POST["zucker"]) && $_POST["zucker"] != ""){
                    $zucker = $_POST["zucker"];
                }
                $stmt->bindParam(':name', $_POST["name"]);
                $stmt->bindParam(':kalorien', $kalorien);
                $stmt->bindParam(':fett', $fett);
                $stmt->bindParam(':zucker', $zucker);

                $stmt->execute();

                $sql = 'INSERT INTO obst (o_name, o_kalorien, o_fett, o_zucker) VALUES ("'.$_POST["name"].'", '.$kalorien.', '.$fett.', '.$zucker.');';
                $insertID = $db->lastInsertId();

                $_POST["sql"] = $sql;
                $search = "SELECT v_id FROM vitamine WHERE (";
                $first = true;
                foreach ($_POST["filter_vitamine"] as $v){
                    if (!$first){ $search .= " OR"; }
                    $search .= ' v_name = "'.$v.'"';
                    $first = false;
                }
                $search .= ");";

                $_POST["sql"] .= "<br>" . $search;
                $stmt = $db->prepare($search);
                $stmt->execute();
                $vitamine = $stmt->fetchAll();
                foreach ($vitamine as $v){
                    $add = 'INSERT INTO relation_obst_vitamine (r_id, r_o_id, r_v_id) VALUES (NULL, :o_id, :v_id);';
                    $stmt = $db->prepare($add);
                    $stmt->bindParam(':o_id', $insertID);
                    $stmt->bindParam(':v_id', $v["v_id"]);
                    $stmt->execute();
                    $sql = 'INSERT INTO relation_obst_vitamine (r_id, r_o_id, r_v_id) VALUES (NULL, '.$insertID.', '.$v["v_id"].');';
                    $_POST["sql"] .= "<br>" . $sql;
                }
            }
        }
    }
?>
