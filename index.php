<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home - dutu.dev</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    include 'staticData/indexData.php'; 
    include 'Parsedown/Parsedown.php';    
    ?>
    <div class="contents">
        <div class="navbar">
            <div class="homelink">
                <a href="index.html">dutu.dev</a>
            </div>
            <div class="pages">
                <a href="index.html">Games</a>
                <a href="index.html">Logs</a>
                <a href="index.html">About</a>
            </div>
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
                    <a href=<?php echo $latestProject["itchLink"];?> target="_blank" rel="noopener noreferrer">itch.io</a>
                    <a href=<?php echo $latestProject["archiveLink"];?> target="_blank" rel="noopener noreferrer">archive</a>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>