<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
function store($url) {
    $conn = new PDO($_ENV['DB'], $_ENV['USER'], $_ENV['PW']);
    $store = alreadyStored($url);
    if ($store != null) return $store;
    $statement = $conn->prepare(
        'INSERT INTO urls (id, slug, url) VALUES (?, ?, ?)'
    );
    do {
        $slug = randomChar();
    } while(!isUniqueSlug($slug));
    $statement->execute(array(null, $slug, $url));
    $conn = null;
    return $slug;
}

function randomChar() {
    return substr(md5(microtime()), rand(0, 26), 5);
}

function isUniqueSlug($slug) {
    $conn = new PDO($_ENV['DB'], $_ENV['USER'], $_ENV['PW']);
    $statement = $conn->prepare('SELECT * FROM urls WHERE slug=?');
    $statement->execute([$slug]);
    $conn = null;
    return $statement->rowCount() > 0 ? false : true;
}

function getRedirection($slug) {
    $conn = new PDO($_ENV['DB'], $_ENV['USER'], $_ENV['PW']);
    $statement = $conn->prepare('SELECT * FROM urls WHERE slug=?');
    $statement->execute([$slug]);
    $conn = null;
    return $statement->rowCount() > 0 ? $statement->fetch()['url'] : null;
}

function alreadyStored($url) {
    $conn = new PDO($_ENV['DB'], $_ENV['USER'], $_ENV['PW']);
    $statement = $conn->prepare('SELECT * FROM urls WHERE url=?');
    $statement->execute([$url]);
    $conn = null;
    return $statement->rowCount() > 0 ? $statement->fetch()['slug'] : null;
}
?>
