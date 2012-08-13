<?php

require('base62map.php');

function encodeBase62($num)
{
	$baseNum = 62;
    global $base62Map;
    $numContainer = array();
    $numerator = $num;
    while ($numerator >= $baseNum) {
        $rem = $numerator % $baseNum;
        $numerator = $numerator / $baseNum;
        array_push($numContainer, $base62Map[$rem]);
    }
    array_push($numContainer, $base62Map[$numerator]);
    return implode("", $numContainer);
}

function decodeBase62($str)
{
    $baseNum = 62;
    global $base62Map;
    $decodeArr = array_flip($base62Map);
    $num = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $num = $num + ($decodeArr[$str[$i]] * pow($baseNum, $i));
    }
    return $num;
}

$num = 2147483647;
$encoded = encodeBase62($num);
$decoded = decodeBase62($encoded);

echo "Number: ",$num, "\n";
echo "Encoded: ",$encoded, "\n";
echo "Decoded : ",$decoded,"\n";
