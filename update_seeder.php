<?php
$seederPath = 'd:/Joki/jahra pengasinan/alazhar/database/seeders/DatabaseSeeder.php';
$seederContent = file_get_contents($seederPath);

$newInfaqData = file_get_contents('d:/Joki/jahra pengasinan/alazhar/infaq_array.txt');

// Find the start and end of the old $infaqData array
$startStr = '$infaqData = [';
$endStr = '        ];';

$startPos = strpos($seederContent, $startStr);
$endPos = strpos($seederContent, $endStr, $startPos) + strlen($endStr);

if ($startPos !== false && $endPos !== false) {
    $newSeederContent = substr($seederContent, 0, $startPos) . ltrim($newInfaqData) . substr($seederContent, $endPos);
    file_put_contents($seederPath, $newSeederContent);
    echo "Successfully replaced infaqData.\n";
} else {
    echo "Could not find infaqData array in DatabaseSeeder.php.\n";
}
