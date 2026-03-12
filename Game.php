<?php
    $gamesData = json_decode(file_get_contents("GamesData/dataGames.json"), true);
    $gamesTitles = [];
    $gameTitle = "";
    if (empty($_GET["game"])) {
        http_response_code(404);
        exit;
    }
    $gameQuery = $_GET["game"];
    foreach($gamesData as $game){
        $gamesTitles[] = str_replace(" ", "", $game["title"]);
        if($gameQuery == str_replace(" ", "", $game["title"])){
            $gameTitle = $game["title"];
        }
    }
    if($gameTitle == ""){
        http_response_code(404);
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $gameTitle;?> - dutu.dev</title>
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php 
    include 'staticData/indexData.php'; 
    include 'Parsedown/Parsedown.php';    
    ?>
    <div class="contents">
        <div class="navbar">
            <div class="homelink">
                <a href="/">dutu.dev</a>
            </div>
            <?php include 'staticData/navbar.php';?>
        </div>
        <div class="holder">
            <div class="markdownText">
            <?php
                $parsedown = new Parsedown();

                $file = "GamesData/" . $_GET["game"] . ".md";
                $markdown = explode("?~~?", file_get_contents($file))[1];
                echo $parsedown->text($markdown);
            ?>
            </div>
        </div> 
    </div>
</body>
</html>