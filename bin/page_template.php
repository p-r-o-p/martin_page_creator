<?php
    $conn = new mysqli("%HOSTNAME%", "%USERNAME%", "%PASSWDd%", "%DBNAME%", "%PORT%", "%SOCKET%");
    $visitor_ip = $_SERVER['REMOTE_ADDR']; //Does not account for client-side proxies
    $visit_time = date("Y-m-d H:i:s");
    $author = "%AUTHOR_NAME";
    $query_string = sprintf("SELECT COUNT(*) FROM page_visits WHERE author = '%s'", $author);
    $query_string = "INSERT INTO page_visits VALUES('$visitor_ip', '$visit_time', '$author')";

    $conn->autocommit(FALSE);
    if( !$conn->commit()) {
        $conn->rollback();
        error_log($conn->error);
    }
?>
<!DOCTYPE html>
<head>

</head>
