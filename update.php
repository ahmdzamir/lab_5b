<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            width: 300px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: purple;
            margin-left: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "lab_5b";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $oldMatric = $_GET['matric'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $role = $_POST['role'];

        $sql = "UPDATE users SET matric = ?, name = ?, role = ? WHERE matric = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $matric, $name, $role, $oldMatric);

        if ($stmt->execute()) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $stmt->close();
        echo "<br><a href='display.php'>Back to Table</a>";
    } else {
        $sql = "SELECT matric, name, role FROM users WHERE matric = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $oldMatric);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <form method="POST" action="">
                <label for="matric">Matric:</label>
                <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($row['matric']); ?>" required>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

                <label for="role">Access Level:</label>
                <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select><br><br>
                <input type="submit" value="Update">
                <a href="display.php">Cancel</a>
            </form>

            <?php
        } else {
            echo "No record found.";
        }

        $stmt->close();
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

</body>
</html>
