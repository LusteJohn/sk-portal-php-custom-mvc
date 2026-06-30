<!DOCTYPE html>
<html>
<head>
    <title>Candidate Programs Session</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <p><?php if (isset($_SESSION['user'])): ?>
        Hello, <?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>
    <?php endif; ?></p>

    <h2>Candidate Programs Session</h2>

    <hr>

    <form method="POST" action="/member/candidate-sessions/store">

        <input type="hidden" name="candidate_id" value="<?= $candidate['candidate_id'] ?? '' ?>">

        <label>Total Sessions</label><br>
        <textarea name="total_session" rows="4" cols="50" required><?= $session['total_session'] ?? '' ?></textarea>
        <br><br>

        <label>Total Attended</label><br>
        <textarea name="total_attended" rows="4" cols="50" required><?= $session['total_attended'] ?? '' ?></textarea>
        <br><br>

        <label>Attended Rate</label><br>
        <textarea name="attended_rate" rows="4" cols="50" required><?= $session['attended_rate'] ?? '' ?></textarea>
        <br><br>

        <button type="submit">Save Session</button>
    </form>

    <a href="/member/dashboard">Back to Dashboard</a>
    <br><br>
    <a href="/logout">Logout</a>

</body>
</html>