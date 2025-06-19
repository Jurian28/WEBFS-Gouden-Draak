<?php
// dit script zet de geexporteerde productie database op je lokale development database.
$prodSqlDump = __DIR__ . '/sql/live_gouden_draak.sql';
$host = 'localhost';
$user = 'root';
$pass = '';
$devDbName = 'dev_gouden_draak';

$conn = new mysqli($host, $user, $pass, $devDbName);
if ($conn->connect_error) {
    die("Fout bij verbinden: " . $conn->connect_error);
}

$sql = file_get_contents($prodSqlDump);
if (!$sql) {
    die("Kan SQL-bestand niet openen.");
}

$conn->query("SET FOREIGN_KEY_CHECKS = 0;");
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $conn->query("DROP TABLE IF EXISTS `$row[0]`");
}
$conn->query("SET FOREIGN_KEY_CHECKS = 1;");

if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    } while ($conn->more_results() && $conn->next_result());

    echo "Import gelukt.";
} else {
    echo "Fout tijdens import: " . $conn->error;
}
$conn->close();
