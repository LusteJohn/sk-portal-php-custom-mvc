<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    h1>Welcome to your Dashboard</h1>
    <p><?php if (isset($_SESSION['user'])): ?>
        Hello, <?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>
    <?php endif; ?></p>
    <a href="/member/profile">Manage Candidates</a>
    <br><br>
    <a href="/logout">Logout</a>

</body>
</html>