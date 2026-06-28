<!DOCTYPE html>
<html>
<head>
    <title>Candidate Profile</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <p><?php if (isset($_SESSION['user'])): ?>
        Hello, <?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>
    <?php endif; ?></p>

    <h2>Candidate Profile</h2>

    <hr>

    <h3>Platform & Advocacies</h3>

    <form method="POST" action="/member/candidate-profile/store">

        <input type="hidden" name="candidate_id" value="<?= $candidate['candidate_id'] ?? '' ?>">

        <label>Platform Summary</label><br>
        <textarea name="platform_summary" rows="4" cols="50" required><?= $profile['platform_summary'] ?? '' ?></textarea>
        <br><br>

        <label>Key Advocacies</label><br>
        <textarea name="key_advocacies" rows="4" cols="50" required><?= $profile['key_advocacies'] ?? '' ?></textarea>
        <br><br>

        <label>Priority Issues</label><br>
        <textarea name="priority_issues" rows="4" cols="50" required><?= $profile['priority_issues'] ?? '' ?></textarea>
        <br><br>

        <label>Slogan</label><br>
        <input type="text" name="slogan" value="<?= $profile['slogan'] ?? '' ?>" required><br>

        <br><br>

        <button type="submit">Save Profile</button>
    </form>

    <br><br>
    <a href="/logout">Logout</a>

</body>
</html>