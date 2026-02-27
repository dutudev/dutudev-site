<?php
//mainGame jamGame
function sortMeta($a, $b){
    return $b["date"] <=> $a["date"];
}

$files = scandir("."); 
$games = [];

foreach($files as $file){
    if(is_file($file) && pathinfo($file, PATHINFO_EXTENSION) == 'md'){
        $contents = file_get_contents($file);
        $metadata = explode("?~~?", $contents)[0];
        $metaLines = explode("\n", $metadata);
        $meta = [];
        foreach($metaLines as $line){
            if(strpos($line, ":") !== false){
                list($key, $value) = explode(":", $line, 2);
                $meta[trim($key)] = trim($value);
                //echo trim($key) . '  ' . $meta[trim($key)] . '<br>';
                }
        }
        $games[] = $meta;
    }
}

usort($games, "sortMeta");

$jsonFinish = json_encode($games, JSON_PRETTY_PRINT);

$jsonFile = "./dataGames.json";
if (!file_exists($jsonFile) || file_get_contents($jsonFile) !== $jsonFinish) {
    file_put_contents($jsonFile, $jsonFinish);
}

// logs here
$files = scandir("../LogsData"); 
$games = [];

foreach($files as $file){
    echo $file . "<br>";
    if(is_file("../LogsData/" . $file) && pathinfo($file, PATHINFO_EXTENSION) == 'md'){
        $contents = file_get_contents("../LogsData/" . $file);
        $metadata = explode("?~~?", $contents)[0];
        $metaLines = explode("\n", $metadata);
        $meta = [];
        foreach($metaLines as $line){
            if(strpos($line, ":") !== false){
                list($key, $value) = explode(":", $line, 2);
                $meta[trim($key)] = trim($value);
                //echo trim($key) . '  ' . $meta[trim($key)] . '<br>';
                }
        }
        $games[] = $meta;
    }
}

usort($games, "sortMeta");

$jsonFinish = json_encode($games, JSON_PRETTY_PRINT);

$jsonFile = "../LogsData/dataLogs.json";
if (!file_exists($jsonFile) || file_get_contents($jsonFile) !== $jsonFinish) {
    file_put_contents($jsonFile, $jsonFinish);
}
?>