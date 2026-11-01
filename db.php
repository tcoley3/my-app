<?php
// src/db.php — one shared database connection, configured by Render's DATABASE_URL.
function db(): PDO
{
static $pdo = null;
if ($pdo === null) {
$url = parse_url(getenv('DATABASE_URL'));
$dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s',
$url['host'], $url['port'] ?? 5432, ltrim($url['path'], '/'));
$pdo = new PDO($dsn, urldecode($url['user']), urldecode($url['pass']), [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
// Create your tables if they don't exist yet.
$pdo->exec(file_get_contents(__DIR__ . '/schema.sql'));
}
return $pdo;
}
?>
