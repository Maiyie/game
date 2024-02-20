<?php
// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pinayan san pedro_log_register');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch match history from the database
$sql = "SELECT * FROM pinayan san pedro_log_register";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match History</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Match History</h2>

<table>
    <tr>
        <th>Game ID</th>
        <th>Player 1</th>
        <th>Player 2</th>
        <th>Winner</th>
        <th>Date</th>
    </tr>
    <?php
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["game_id"] . "</td>";
        echo "<td>" . $row["player1"] . "</td>";
        echo "<td>" . $row["player2"] . "</td>";
        echo "<td>" . $row["winner"] . "</td>";
        echo "<td>" . $row["timestamp"] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>

<?php
// Close the database connection
mysqli_close($db);
?>