<!DOCTYPE html>
<html>
<head>
    <title>Candidate Management</title>
</head>
<body>

<h2>Candidate Management</h2>

<!-- ===================== -->
<!-- CREATE FORM -->
<!-- ===================== -->
<form method="POST" action="/admin/candidate/store" enctype="multipart/form-data">

    <!-- Partylist Dropdown -->
    <label>Partylist</label><br>
    <select name="partylist_id" required>
        <option value="">Select Partylist</option>

        <?php foreach ($partylists as $p): ?>
            <option value="<?= $p['partylist_id'] ?>">
                <?= $p['partylist_name'] ?> (<?= $p['acronym'] ?>)
            </option>
        <?php endforeach; ?>

    </select>

    <br><br>

    <!-- Personal Info -->
    <input type="text" name="first_name" placeholder="First Name" required><br>
    <input type="text" name="middle_name" placeholder="Middle Name"><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br>
    <input type="text" name="ext_name" placeholder="Extension (Jr, Sr)"><br>

    <br>

    <!-- Candidate Info -->
    <input type="text" name="position" placeholder="Position" required><br>

    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>

    <br><br>

    <input type="date" name="birthdate" required><br>
    <?php if (!empty($editCandidate['photoUrl'])): ?>
        <img
            src="<?= $editCandidate['photoUrl'] ?>"
            width="100"
            alt="Candidate Photo">
        <br>
    <?php endif; ?>

    <input type="file"
       name="photoUrl"
       accept="image/*"
       required>
    <br>
    <input type="text" name="address" placeholder="Address"><br>

    <label>
        <input type="checkbox" name="isIncumbent" value="1">
        Incumbent
    </label>

    <br><br>

    <select name="status">
        <option value="pending">Pending</option>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <br><br>

    <button type="submit">Create Candidate</button>
</form>

<hr>

<!-- ===================== -->
<!-- LIST -->
<!-- ===================== -->
<h3>Candidate List</h3>

<table border="1" cellpadding="5">

    <tr>
        <th>ID</th>
        <th>Partylist</th>
        <th>Full Name</th>
        <th>Position</th>
        <th>Gender</th>
        <th>Birthdate</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($candidates as $c): ?>

        <tr>

            <td><?= $c['candidate_id'] ?></td>

            <td>
                <?= $c['partylist_name'] ?? '' ?>
            </td>

            <td>
                <?= $c['first_name'] ?>
                <?= $c['middle_name'] ?>
                <?= $c['last_name'] ?>
                <?= $c['ext_name'] ?>
            </td>

            <td><?= $c['position'] ?></td>

            <td><?= $c['gender'] ?></td>

            <td><?= $c['birthdate'] ?></td>

            <td><?= $c['status'] ?></td>

            <td>

                <a href="/admin/candidate/edit?id=<?= $c['candidate_id'] ?>">
                    Edit
                </a>

                <form method="POST" action="/admin/candidate/delete" style="display:inline;">
                    <input type="hidden" name="candidate_id" value="<?= $c['candidate_id'] ?>">
                    <button type="submit">Delete</button>
                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<!-- ===================== -->
<!-- UPDATE FORM -->
<!-- ===================== -->
<?php if (isset($editCandidate) && $editCandidate): ?>

<hr>

<h3>Update Candidate</h3>

<form method="POST" action="/admin/candidate/update" enctype="multipart/form-data">

    <input type="hidden" name="candidate_id" value="<?= $editCandidate['candidate_id'] ?>">

    <!-- Partylist Dropdown -->
    <label>Partylist</label><br>
    <select name="partylist_id" required>

        <?php foreach ($partylists as $p): ?>
            <option value="<?= $p['partylist_id'] ?>"
                <?= $p['partylist_id'] == $editCandidate['partylist_id'] ? 'selected' : '' ?>>
                <?= $p['partylist_name'] ?> (<?= $p['acronym'] ?>)
            </option>
        <?php endforeach; ?>

    </select>

    <br><br>

    <input type="text" name="first_name" value="<?= $editCandidate['first_name'] ?>" required><br>
    <input type="text" name="middle_name" value="<?= $editCandidate['middle_name'] ?>"><br>
    <input type="text" name="last_name" value="<?= $editCandidate['last_name'] ?>" required><br>
    <input type="text" name="ext_name" value="<?= $editCandidate['ext_name'] ?>"><br>

    <input type="text" name="position" value="<?= $editCandidate['position'] ?>" required><br>

    <select name="gender">
        <option value="Male" <?= $editCandidate['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $editCandidate['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <br><br>

    <input type="date" name="birthdate" value="<?= $editCandidate['birthdate'] ?>"><br>
    <input type="file" name="photoUrl" accept="image/*"><br>
    <input type="text" name="address" value="<?= $editCandidate['address'] ?>"><br>

    <select name="status">
        <option value="pending" <?= $editCandidate['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
        <option value="active" <?= $editCandidate['status'] == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $editCandidate['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
    </select>

    <br><br>

    <button type="submit">Update Candidate</button>
</form>

<?php endif; ?>

</body>
</html>