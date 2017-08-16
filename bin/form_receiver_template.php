<?php
if(!empty($_POST['author']) &&
    !empty($_POST['visit_id']) &&
    !empty($_POST['visitor_name']) &&
    !empty($_POST['visitor_email'])) {
    $conn = new mysqli("%s", "%s", "%s", "%s", "%s", "%s");
    $query_string = sprintf("SELECT id FROM page_visits WHERE id = %%d AND author = '%%s'", $_POST['visit_id'], $_POST['author']);
    $result = $conn->query($query_string);
    if($result->num_rows === 1) {
        $query_string = sprintf("INSERT INTO page_form_commits (visitor_name,visitor_email,page_visit_id) VALUES ('%%s','%%s',%%d)", $_POST['visitor_name'], $_POST['visitor_email'], $_POST['visit_id']);
        if(!$conn->query($query_string)) {
            error_log($conn->error);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modtager side.</title>
</head>
<body>
<h1>Tak for hjælpen!</h1>
</body>
</html>