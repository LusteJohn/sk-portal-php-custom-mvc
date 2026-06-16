<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Welcome to your Dashboard</h1>
<p><?php if (isset($_SESSION['user'])): ?>
    Hello, <?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>
<?php endif; ?></p>

<a href="/logout">Logout</a>

</body>
</html>