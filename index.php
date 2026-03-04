<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home - dutu.dev</title>
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
            <div class="banner">
                <p class="bannerText">
                    <?php
                    for($i = 0; $i < 20; $i++)
                    {
                        echo $bannerMessage;
                        echo '&nbsp&nbsp&nbsp';
                    }
                    ?>
                </p>
            </div>
            <p>
                Welcome to my site, i am dutudev, i like to make games and videos. Here i will have download links for my games and i will make some updates from time to time.
            </p>
            <div class="separator"></div>
            <div class="sectiontitle">
                <h1>Latest Project</h1>

            </div>
            <img class="latestProjImg" src=<?php echo $latestProject["image"];?> alt="">
            <div class="latestProjDetails">
                <h1><?php echo $latestProject["title"];?></h1>
                <div class="latestProjLinks">
                    <a href=<?php echo $latestProject["itchLink"];?> >itch.io</a>
                    <a href=<?php echo $latestProject["archiveLink"];?> >archive</a>
                </div>
            </div>
            <div class="separator"></div>
            <div class="sectiontitle">
                <h1>Recent Games</h1>
            </div>
            <div class="games">

                <?php
                    $jsonFile = "./GamesData/dataGames.json";
                    $jsonContents = json_decode(file_get_contents($jsonFile), true);
                    $filteredGames = [];
                    $tagToSearch = "mainGame";
                    foreach ($jsonContents as $game) {
                        if($game["tag"] == $tagToSearch){
                            $filteredGames[] = $game;
                        }
                    }

                    foreach(array_slice($filteredGames, $latestProject["topGames"], $latestProject["topGames"] + 3) as $post){
                        echo '<div class="game">
                                <img src="images/' . str_replace(' ', '', $post["title"]) . '.png" alt="">
                                <p>' . $post["title"] . '</p>
                                <a href="game.php?game=' . str_replace(' ', '', $post["title"]) . '">View</a>
                                </div>';
                    }
                    
                ?>
            </div>
            <div class="separator"></div>
            <div class="sectiontitle">
                <h1>Recent Logs</h1>
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