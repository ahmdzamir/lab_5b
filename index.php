<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="matric">Matrics Number:</label>
        <input type="text" name="matric" id="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
        
        <div class="container signin">
    <p><a href="registerForm.php">Register</a> here if you have not.</p>
  </div>
    </form>
</body>
</html>
