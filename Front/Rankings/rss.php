<?php
  session_start();
$vector = array($_SESSION["table"], $_SESSION["bus"] , $_SESSION["church"], $_SESSION["traffic"], $_SESSION["internet"], $_SESSION["job"] );
$names = array("Table", "Bus", "Church", "Traffic", "Internet", "Job" );


header("Content-Type: text/xml;charset=iso-8859-1");

$base_url = "http://localhost/Front/Rankings/";

echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
echo "<rss version='2.0'>".PHP_EOL;
echo "<channel>".PHP_EOL;
echo "<title>Top 5 users on every category</title>".PHP_EOL;
echo "<link>".$base_url."Rankings.php</link>".PHP_EOL;
echo "<description>RSS feed</description>".PHP_EOL;
echo "<language>en-us</language>".PHP_EOL;


foreach ($vector as $key => $value) 
{
 echo "<item>\n";
     echo "<title>$names[$key]</title>\n";
     echo "<description>Top 5 users for $names[$key] category</description>\n";
     echo "<pubDate>" . date("Y/m/d") . "</pubDate>\n";
     foreach($value as $key=>$value)
        {
            echo "<User>" . $key . "-". $value ."pts" ."</User>\n";
        }
 echo "</item>";
}

echo '</channel>'.PHP_EOL;
echo '</rss>'.PHP_EOL;