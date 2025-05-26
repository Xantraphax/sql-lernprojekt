<?php
$config = include('config.php');

$conn = new mysqli(
    $config['host'],
    $config['username'],
    $config['password'],
    $config['dbname']
);

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$sql = $_POST['sql'];
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $wert) {
            echo "<td>$wert</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} elseif ($result === TRUE) {
    echo "Abfrage erfolgreich ausgeführt.";
} else {
    echo "Fehler: " . $conn->error;
}

$conn->close();
?>