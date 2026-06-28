<!DOCTYPE html>
<html>
<head>
    <title>Candidate Programs</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <p><?php if (isset($_SESSION['user'])): ?>
        Hello, <?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>
    <?php endif; ?></p>

    <h2>Candidate Programs</h2>

    <hr>

    <form method="POST" action="/member/candidate-programs/store">

        <input type="hidden" name="candidate_id" value="<?= $candidate['candidate_id'] ?? '' ?>">

        <label>Program Title</label><br>
        <textarea name="title" rows="4" cols="50" required><?= $program['title'] ?? '' ?></textarea>
        <br><br>

        <label>Description</label><br>
        <textarea name="description" rows="4" cols="50" required><?= $program['description'] ?? '' ?></textarea>
        <br><br>

        <label>Beneficiary</label><br>
        <textarea name="beneficiary" rows="4" cols="50" required><?= $program['beneficiary'] ?? '' ?></textarea>
        <br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="pending" <?= ($program['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="active" <?= ($program['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= ($program['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>

        <br><br>

        <button type="submit">Save Program</button>
    </form>

    <a href="/member/dashboard">Back to Dashboard</a>
    <br><br>
    <a href="/logout">Logout</a>

</body>
</html>