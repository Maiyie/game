<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <script>
        // Function to save game data
        function saveGameData(playerX, playerO, winner) {
            // Create an object with game data
            const gameData = {
                playerX: playerX,
                playerO: playerO,
                winner: winner
            };

            // Send a POST request to the PHP script
            fetch('save_game_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(gameData)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Data saved successfully:', data);
            })
            .catch(error => {
                console.error('Error saving data:', error);
            });
        }
        
        // Example usage: Call saveGameData function when the game ends
        const playerX = 'John';
        const playerO = 'Jane';
        const winner = 'X'; // X, O, or Draw
        saveGameData(playerX, playerO, winner);
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match History</title>
    <!-- Add your CSS stylesheets and other resources here -->
</head>
<body>
    <h1>Match History</h1>
    <div id="matchHistoryContainer">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pinayan san pedro_log_register";

        // Create connection
        $mysqli = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "SELECT * FROM match_history";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Player X: " . $row["playerX"] . " - Player O: " . $row["playerO"] . "<br>";
            }
        } else {
            echo "0 results";
        }
        // Retrieve game data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

// Prepare SQL statement to insert game data into the database
$sql = "INSERT INTO game_results (playerX, playerO, winner) VALUES ('" . $data['playerX'] . "', '" . $data['playerO'] . "', '" . $data['winner'] . "')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // Send a response indicating success
    echo json_encode(array("message" => "Data saved successfully"));
} else {
    // Send a response indicating failure
    echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
}

        $mysqli->close();
        ?>
    </div>
    <!-- Add your JavaScript code and other scripts here -->
</body>
</html>
