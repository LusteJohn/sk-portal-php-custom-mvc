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

<ul>
    <li><a href="/admin/election-setting">Manage SK Elections</a></li>
    <li><a href="/admin/partylist">Manage Partylist</a></li>
    <li><a href="/admin/candidate">Manage Candidates</a></li>
</ul>
<a href="/logout">Logout</a>

</body>
</html>