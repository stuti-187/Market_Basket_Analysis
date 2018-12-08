<?php

require_once("recommend.php");
require_once("sample_list.php");
$re = new Recommend();
print_r($re->getRecommendations($books, "sameer"));
$similarity =  $re->similarityDistance($books, "tom", "peter");
//Converted to percent.
echo sprintf("%.2f", $similarity * 100) . "%";

?>