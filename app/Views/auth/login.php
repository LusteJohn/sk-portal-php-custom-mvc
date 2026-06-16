<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST" action="/login">
    <input name="identifier" placeholder="Email or Username">
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit">Login</button>
    <p>
        Don't have an account?
        <a href="/register">Register here</a>
    </p>
</form>

</body>
</html>