<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL shortener</title>
</head>
<body>
    <center>
        <form method="POST">
            <input type="text" name="input_url" required>
            <input type="submit" name="submit" value="shorten">
        </form>
    </center>
</body>
</html>
<?php
require '../database.php';

if (isset($_GET['slug'])) {
    $redirection = getRedirection($_GET['slug']);
    if ($redirection != null) {
        if (strpos($redirection, 'http') === false) $redirection = 'http://' . $redirection;
        header('Location: ' . $redirection);
        exit;
    } else {
        header('Location: https://url.katalam.com');
        exit;
    }
}
if (isset($_POST['submit'])) {
    $url = $_POST['input_url'];
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
       echo 'Not a valid url.';
       return;
    }
    echo store($url);
}
?>
