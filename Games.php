<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>games - dutu.dev</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php 
    include 'staticData/indexData.php'; 
    ?>
    <div class="contents">
        <div class="navbar">
            <div class="homelink">
                <a href="/">dutu.dev</a>
            </div>
            <?php include 'staticData/navbar.php';?>
        </div>
        <div class="holder">
            <div class="sectiontitle">
                <h1>Latest Games</h1>
            </div>

            <?php
                $jsonContent = file_get_contents("GamesData/dataGames.json");
                $GamesArray = json_decode($jsonContent, true);
                $Games = [];
                $GamesJam = [];
                foreach($GamesArray as $game){
                    if($game["tag"] == "mainGame"){
                        $Games[] = $game;
                    }else if($game["tag"] == "jamGame"){
                        $GamesJam[] = $game;
                    }
                }
                for($i = 0 ; $i < sizeof($Games); $i++){
                    $gray = "";
                    if($i%2!=0){
                        $gray =" gray";
                    }
                    echo "<div class='gameEntry" . $gray . "'>
                            <p>" . $Games[$i]['title'] . "</p>
                            <a href='Game.php?game=" . str_replace(' ', '', $Games[$i]['title']) . "'>View</a>
                            </div>";
                }
                echo '<p>! Currently Incomplete Catalog, Check dutudev.itch.io For All Games !</p>';
                echo ' <div class="separator" style="margin-top:2em"></div>
                        <div class="sectiontitle">
                        <h1>Game Jams & Hackathons</h1>
                    </div>';

                for($i = 0 ; $i < sizeof($GamesJam); $i++){
                    $gray = "";
                    if($i%2!=0){
                        $gray =" gray";
                    }
                    echo "<div class='gameEntry" . $gray . "'>
                            <p>" . $GamesJam[$i]['title'] . "</p>
                            <a href='Game.php?game=" . str_replace(' ', '', $GamesJam[$i]['title']) . "'>View</a>
                            </div>";
                }
            ?>
            
        </div> 
    </div>
</body>
</html>