<!DOCTYPE html>
<html>
<head>
    <title>SK Election Management</title>
</head>
<body>

<h2>SK Election Configuration</h2>

<!-- ========================= -->
<!-- CREATE FORM -->
<!-- ========================= -->
<form method="POST" action="/admin/election-setting/store">

    <input type="text" name="election_year" placeholder="Election Year" required><br>

    <input type="text" name="barangay" placeholder="Barangay" required><br>
    <input type="text" name="municipality" placeholder="Municipality" required><br>
    <input type="text" name="province" placeholder="Province" required><br>
    <input type="text" name="region" placeholder="Region" required><br>

    <input type="number" name="chairman_seat" placeholder="Chairman Seats" required><br>
    <input type="number" name="councilor_seat" placeholder="Councilor Seats" required><br>

    <input type="number" name="voter_age_min" placeholder="Min Age" required><br>
    <input type="number" name="voter_age_max" placeholder="Max Age" required><br>

    <button type="submit">Create Election</button>
</form>

<hr>

<!-- ========================= -->
<!-- LIST -->
<!-- ========================= -->
<h3>Existing Elections</h3>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Year</th>
        <th>Location</th>
        <th>Status</th>
        <th>Seats</th>
        <th>Age Range</th>
        <th>Action</th>
    </tr>

    <?php foreach ($elections as $e): ?>
        <tr>
            <td><?= $e['election_id'] ?></td>
            <td><?= $e['election_year'] ?></td>
            <td>
                <?= $e['barangay'] ?>,
                <?= $e['municipality'] ?>,
                <?= $e['province'] ?>,
                <?= $e['region'] ?>
            </td>
            <td><?= $e['status'] ?></td>
            <td>
                Chair: <?= $e['chairman_seat'] ?> |
                Councilor: <?= $e['councilor_seat'] ?>
            </td>
            <td>
                <?= $e['voter_age_min'] ?> - <?= $e['voter_age_max'] ?>
            </td>
            <td>

                <!-- EDIT BUTTON -->
                <a href="/admin/election-setting/edit?id=<?= $e['election_id'] ?>">
                    Edit
                </a>

                <!-- DELETE -->
                <form method="POST" action="/admin/election-setting/delete" style="display:inline;">
                    <input type="hidden" name="election_id" value="<?= $e['election_id'] ?>">
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
    <?php endforeach; ?>

</table>

<hr>

<!-- ========================= -->
<!-- UPDATE FORM (AUTO-FILLED) -->
<!-- ========================= -->

<?php if (isset($editElection)): ?>

<h3>Update Election</h3>

<form method="POST" action="/admin/election-setting/update">

    <input type="hidden" name="election_id" value="<?= $editElection['election_id'] ?>">

    <input type="text" name="election_year" value="<?= $editElection['election_year'] ?>" required><br>

    <input type="text" name="barangay" value="<?= $editElection['barangay'] ?>" required><br>
    <input type="text" name="municipality" value="<?= $editElection['municipality'] ?>" required><br>
    <input type="text" name="province" value="<?= $editElection['province'] ?>" required><br>
    <input type="text" name="region" value="<?= $editElection['region'] ?>" required><br>

    <input type="text" name="status" value="<?= $editElection['status'] ?>" required><br>

    <input type="number" name="chairman_seat" value="<?= $editElection['chairman_seat'] ?>" required><br>
    <input type="number" name="councilor_seat" value="<?= $editElection['councilor_seat'] ?>" required><br>

    <input type="number" name="voter_age_min" value="<?= $editElection['voter_age_min'] ?>" required><br>
    <input type="number" name="voter_age_max" value="<?= $editElection['voter_age_max'] ?>" required><br>

    <button type="submit">Update Election</button>
</form>

<?php endif; ?>

</body>
</html>