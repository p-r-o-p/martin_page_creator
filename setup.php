<?php
include_once "bin/PageInit.php";
$db_info = array();
fwrite(STDOUT, "DB Hostname: ");
$db_info['hostname'] = trim(fgets(STDIN));
fwrite( STDOUT, "DB Username: ");
$db_info['username'] = trim(fgets(STDIN));
fwrite( STDOUT, "DB Password (may be blank): ");
$db_info['passwd'] = trim(fgets(STDIN));
fwrite( STDOUT, "DB Database name: ");
$db_info['dbname'] = trim(fgets(STDIN));
fwrite( STDOUT, "DB Port (may be blank): ");
$db_info['dbport'] = intval(trim(fgets(STDIN)));
fwrite( STDOUT, "DB Socket (may be blank): ");
$db_info['dbsocket'] = trim(fgets(STDIN));
$test_conn = new mysqli($db_info['hostname'], $db_info['username'], $db_info['passwd'], $db_info['dbname'], $db_info['dbport'], $db_info['dbsocket']);
if($test_conn->connect_errno) {
    exit($test_conn->connect_error);
}
$test_conn->close();

$template_handle = fopen("bin/form_receiver_template.php", "r");
if(!file_exists("pages")) {
    mkdir("pages");
}
$page_content = sprintf(fread($template_handle, filesize("bin/form_receiver_template.php")),
    $db_info['hostname'], $db_info['username'], $db_info['passwd'], $db_info['dbname'], $db_info['dbport'], $db_info['dbsocket']);
fclose($template_handle);

$receiver_handle = fopen( "pages/form_receiver.php", "w");
fwrite($receiver_handle, $page_content);
fclose($receiver_handle);

$folder_name = "pages/".date("Y-m-d");
if(!file_exists($folder_name)) {
    mkdir($folder_name);
}
fwrite( STDOUT, "List of author names: ");
$names_path = trim(fgets(STDIN));
$names_handle = fopen($names_path, "r");
while($name = fgets($names_handle, filesize($names_path))) {
    $name = trim($name);
    PageInit::create_page($name, $folder_name, $db_info);
}
fclose($names_handle);