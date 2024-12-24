<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>

    <h2>Registration Form</h2>
    <form method="POST" action="">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select><br><br>

        <button type="submit" name="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Database connection
        $host = 'localhost:3307'; // Note the port
        $username = 'root';
        $password = '';
        $dbname = 'lab_5b'; // Replace with your database name

        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Collect form data
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = $_POST['password']; 
        $role = $_POST['role'];

        // Insert data into the database
        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $matric, $name, $password, $role);

        if ($stmt->execute()) {
            echo "<p>Registration successful!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
