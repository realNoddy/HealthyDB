<!DOCTYPE html>
<html lang="de" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitamin Datenbank</title>

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/pico.classless.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>

<body>
<?php
    require_once "code.php";
?>

<main>
    <!-- UI -->
    <div class="sidebar">
        <a href="#" onclick="switchMode()"><i id="sidebar-switch-icon" class="fad <?php if ( (array_key_exists("action",$_POST) && $_POST["action"] != "insert" ) || !array_key_exists("action",$_POST) ) {echo 'fa-plus';} else {echo 'fa-search';} ?>"></i></a>
    </div>

    <?php
        if (isset($_POST['sql']) && $_POST["sql"] != "") {
            echo '<div class="sql"> <!-- SQL Befehl anzeige -->';
            echo '<article>  ';
            echo '<h3>SQL Befehl</h3>';
            echo '<p>'.$_POST["sql"].'</p>';
            echo '</article>';
            echo '</div>';
        }
    ?>
    
    <div id="insert" style="display: <?php if ( (array_key_exists("action",$_POST) && $_POST["action"] != "insert" ) || !array_key_exists("action",$_POST) ) {echo 'none;';} ?>">
    <article>
        <div class="cmd_insert"> <!-- Insert anzeige -->
        <h1>Eintrag hinzufügen</h1>
            <form method="POST">
            
                <label for="name">
                    Name:
                    <input type="text" name="name" id="name" placeholder="Apfel" required>
                </label>

                <div class="grid">
                    <div>
                        <label for="kalorien">
                            Kalorien:
                            <input type="number" name="kalorien" id="kalorien" placeholder="30">
                        </label>
                    </div>
                    <div>
                        <label for="fett">
                            Fett:
                            <input type="number" name="fett" id="fett" placeholder="10">
                        </label>
                    </div>
                    <div>
                        <label for="zucker">
                            Zucker:
                            <input type="number" name="zucker" id="zucker" placeholder="23">
                        </label>
                    </div>
                </div>

                <div class="vitamine-checkbox">
                    <?php
                        require_once "db_functions.php";
                        $db =  db_connect();
                        $stmt = $db->prepare("SELECT v_name FROM vitamine");
                        $stmt->execute();
                        $vitamine = $stmt->fetchAll();
                        foreach ($vitamine as $v){
                            echo '
                                <label for="'.$v['v_name'].'">
                                    <input type="checkbox" name="filter_vitamine[]" value="'.$v['v_name'].'" id="'.$v['v_name'].'">
                                    '.$v['v_name'].'
                                </label>
                            ';
                        }
                    ?>
                </div>
                <button name="action" value="insert">Obst zur Datenbank hinzufügen</button>
            </form>    
        </div>

    </article>
    </div>

    <div id="select" style="display: <?php if ( (array_key_exists("action",$_POST) && $_POST["action"] != "select" ) ) {echo 'none;';} ?>" >
    <article>
        <div class="cmd_select"> <!-- Select anzeige -->
        <h1>Einträge anzeigen</h1>
            <form method="POST">
                
                <label for="name">
                    Name:
                    <input type="text" name="name" id="name" placeholder="Apfel">
                </label>

                <div class="grid">
                    <div>
                        <label for="kalorien">
                            < Kalorien:
                            <input type="number" name="kalorien" id="kalorien" placeholder="30">
                        </label>
                    </div>
                    <div>
                        <label for="fett">
                            < Fett:
                            <input type="number" name="fett" id="fett" placeholder="10">
                        </label>
                    </div>
                    <div>
                        <label for="zucker">
                            < Zucker:
                            <input type="number" name="zucker" id="zucker" placeholder="23">
                        </label>
                    </div>
                </div>

                <div class="vitamine-checkbox">
                    <?php
                        require_once "db_functions.php";
                        $db =  db_connect();
                        $stmt = $db->prepare("SELECT v_name FROM vitamine");
                        $stmt->execute();
                        $vitamine = $stmt->fetchAll();
                        foreach ($vitamine as $v){
                            echo '
                                <label for="'.$v['v_name'].'">
                                    <input type="checkbox" name="filter_vitamine[]" value="'.$v['v_name'].'" id="'.$v['v_name'].'">
                                    '.$v['v_name'].'
                                </label>
                            ';
                        }
                    ?>
                </div>

                <button name="action" value="select">Filtern</button>

            </form>
        </div>

        <div class="view_select">
            <figure>
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Kalorien</th>
                        <th>Fett</th>
                        <th>Zucker</th>
                        <th>Vitamine</th>
                    </thead>
                    <tbody>
                        <?php
                            if (array_key_exists("result",$_POST) && !empty($_POST["result"])){
                                $obst = $_POST["result"];
                            }else{
                                require_once "db_functions.php";
                                $db =  db_connect();
                                $stmt = $db->prepare("SELECT * FROM obst");
                                $stmt->execute();
                                $obst = $stmt->fetchAll();
                            }
                            foreach ($obst as $o){
                                echo '<tr>';
                                    echo '<td>'.$o['o_id'].'</td>';
                                    echo '<td>'.$o['o_name'].'</td>';
                                    echo '<td>'.$o['o_kalorien'].'</td>';
                                    echo '<td>'.$o['o_fett'].'</td>';
                                    echo '<td>'.$o['o_zucker'].'</td>';
                                    $vit_stmt = $db->prepare('SELECT vitamine.v_name, vitamine.v_info FROM ((obst INNER JOIN relation_obst_vitamine ON obst.o_id = relation_obst_vitamine.r_o_id) INNER JOIN vitamine ON vitamine.v_id = relation_obst_vitamine.r_v_id AND obst.o_name = "'.$o['o_name'].'");');
                                    $vit_stmt->execute();
                                    $vit_list = $vit_stmt->fetchAll();
                                    $vit_text = "";
                                    if (!empty($vit_list)){
                                        $first = true;
                                        foreach ($vit_list as $v){
                                            if (!$first){
                                                $vit_text .= ", ";
                                            }
                                            //$vit_text .= '<span data-tooltip="'.$v["v_info"].'">'.$v["v_name"].'</span>';
                                            $vit_text .= '<span data-tooltip="Ist gut!">'.$v["v_name"].'</span>';
                                            $first = false;
                                        }
                                    }
                                    echo '<td>'.$vit_text.'</td>';

                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </figure>
        </div>
    </article>
    </div>
</main>                    
</body>

<script src="assets/app.js"></script>


</html>
