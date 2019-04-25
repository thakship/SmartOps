<?php
$myfile = fopen("../../../../temp/newfile.txt", "w") or die("Unable to open file!"); // Craete the file handle

$txt = "rizvi Kareem\n";
fwrite($myfile, $txt);
$txt = "Suneth Lankapura\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);

fclose($myfile); // Closing Text file

// - Downloader force to user
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename('newfile.txt'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize('newfile.txt'));
readfile('newfile.txt');
exit;
?>

