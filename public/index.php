<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL shortener</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <div class="form">
        <form method="POST" >
            <input class="input" type="text" name="input_url" placeholder="https://katalam.com/" required>
            <input class="button" type="submit" name="submit" value="&#xf105;">
        </form>
        <p id="error"></p>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script type="text/javascript">
function copyToClipboard(str) {
  const el = document.createElement('textarea')
  el.value = str
  el.setAttribute('readonly', '')
  el.style.position = 'absolute'
  el.style.left = '-9999px'
  document.body.appendChild(el)
  el.select()
  document.execCommand('copy')
  document.body.removeChild(el)
}

function errorMsg(msg) {
    $('#error').first().text(msg)
}
</script>
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
        header('Location: ' . $_ENV['DOMAIN']);
        exit;
    }
}
if (isset($_POST['submit'])) {
    $url = $_POST['input_url'];
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        echo '<script type="text/javascript">',
        `errorMsg('Not a valid url.');`,
        '</script>';
        return;
    }
    $slug = store($url);
    echo '<script type="text/javascript">',
    'copyToClipboard(' . $slug . ');',
    '</script>';
}
?>
