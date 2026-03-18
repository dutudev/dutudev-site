<?php
//mainGame jamGame

include '../Parsedown/Parsedown.php';   
$parsedown = new Parsedown(); 
date_default_timezone_set('Europe/Bucharest');

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

$rssText ='<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
    <channel>
        <title>dutudev</title>
        <link>https://dutu.dev/</link>
        <description>The latest logs from the dutu.dev site. The personal site of dutudev.</description>
        <language>en-us</language>
        <category>Logs</category>
        <generator>RSS Generator made by dutudev</generator>
        <docs>https://www.rssboard.org/rss-specification</docs>
        <ttl>60</ttl>
        <lastBuildDate>' . date(DATE_RSS) . '</lastBuildDate>
    ';


foreach($files as $file){
   
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
        $meta["content"] = explode("?~~?", $contents)[1];
        $games[] = $meta;
    }
}

usort($games, "sortMeta");


foreach($games as $item){
    $date = new DateTime($item["date"], new DateTimeZone("Europe/Bucharest"));
        
    $rssItem = '<item>
        <title>' . $item["title"] . '</title>
        <link>https://dutu.dev/Log.php?log=' . str_replace(" ", "", $item["title"]) . '</link>
        <guid isPermaLink="true">https://dutu.dev/Log.php?log=' . str_replace(" ", "", $item["title"]) . '</guid>
        <description><![CDATA[' . $parsedown->text($item["content"]) . ']]></description>
        <pubDate>' . $date->format(DATE_RSS) . '</pubDate>
        <author>dutudev</author>
        </item>
        ';
    $rssText = $rssText . $rssItem;
}

$jsonFinish = json_encode($games, JSON_PRETTY_PRINT);

$jsonFile = "../LogsData/dataLogs.json";
if (!file_exists($jsonFile) || file_get_contents($jsonFile) !== $jsonFinish) {
    file_put_contents($jsonFile, $jsonFinish);
}


// Generate rss feed

$rssFile = "../feed.xml";
$rssText = $rssText . "</channel></rss>";

if(!file_exists($rssFile) || file_get_contents($rssFile) != $rssText){
    file_put_contents($rssFile ,$rssText);
}


?>