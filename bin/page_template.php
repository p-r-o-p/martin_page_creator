<?php
    $conn = new mysqli("%s", "%s", "%s", "%s", "%s", "%s");
    $visitor_ip = $_SERVER['REMOTE_ADDR']; //Does not account for client-side proxies
    $visit_time = date("Y-m-d H:i:s");
    $author = "%s";
    $query_string = sprintf("INSERT INTO page_visits (visitor_ip,visit_time,author) VALUES('%%s', '%%s', '%%s')", $visitor_ip, $visit_time, $author);
    if($conn->query($query_string)) {
        $html = <<<HTMLDATA
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>%%s's side.</title>
</head>
<body>
<h1>Velkommen til %%s's side!</h1>
    <form method="post" action="../form_reciever.php">
        <input type="hidden" value="%%s" id="author" name="author"/>
        <input type="hidden" value="%%d" id="visit_id" name="visit_id"/>
        <label for="visitor_name">Navn:</label><input type="text" id="visitor_name" name="visitor_name"/><br/>
        <label for="visitor_email">Email:</label><input type="text" id="visitor_email" name="visitor_email"/><br/>
        <input type="submit" value="Send"/> 
    </form>
</body>
</html>
HTMLDATA;
        echo sprintf($html, $author, $author, $author, $conn->insert_id);
    }
    else {
        error_log($conn->error);
    }
?>
