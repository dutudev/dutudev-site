<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logs - dutu.dev</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php 
    include 'staticData/indexData.php'; 
    ?>
    <div class="contents">
        <div class="navbar">
            <div class="homelink">
                <a href="index.php">dutu.dev</a>
            </div>
            <?php include 'staticData/navbar.php';?>
        </div>
        <div class="holder">
            <div class="sectiontitle">
                <h1>Logs</h1>
            </div>

            <?php
                $jsonContent = file_get_contents("LogsData/dataLogs.json");
                $Logs = json_decode($jsonContent, true);
                for($i = 0 ; $i < sizeof($Logs); $i++){
                    $gray = "";
                    if($i%2!=0){
                        $gray =" gray";
                    }
                    echo "<div class='gameEntry" . $gray . "'>
                            <p>" . $Logs[$i]['title'] . "</p>
                            <a href='Log.php?log=" . str_replace(' ', '', $Logs[$i]['title']) . "'>View</a>
                            </div>";
                }

            ?>
            
        </div> 
    </div>
</body>
</html>