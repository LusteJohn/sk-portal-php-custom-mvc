<!DOCTYPE html>
<html>
<head>
    <title>Candidate Management</title>
</head>
<body>

<h2>Candidate Management</h2>
<a href="/member/dashboard">Back to Dashboard</a>

<?php if (!isset($candidates) || !$candidates): ?>

<p>No candidate record found. Please contact admin to create your candidate profile.</p>

<?php else: ?>

<hr>

<h3>Update Candidate</h3>

<form method="POST" action="/member/candidate/update" enctype="multipart/form-data">

    <input type="hidden" name="candidate_id" value="<?= $candidates['candidate_id'] ?>">

    <input type="text" name="first_name" value="<?= $candidates['first_name'] ?? '' ?>" required><br>
    <input type="text" name="middle_name" value="<?= $candidates['middle_name'] ?? '' ?>"><br>
    <input type="text" name="last_name" value="<?= $candidates['last_name'] ?? '' ?>" required><br>
    <input type="text" name="ext_name" value="<?= $candidates['ext_name'] ?? '' ?>"><br>

    Gender:
    <select name="gender">
        <option value="Male" <?= ($candidates['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= ($candidates['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <br><br>

    <input type="date" name="birthdate" value="<?= $candidates['birthdate'] ?? '' ?>"><br>
    <input type="file" name="photoUrl" accept="image/*"><br>
    <input type="text" name="address" value="<?= $candidates['address'] ?? '' ?>"><br>

    <button type="submit">Update Candidate</button>
</form>

<?php endif; ?>

<br><br>
<a href="/logout">Logout</a>

</body>
</html>