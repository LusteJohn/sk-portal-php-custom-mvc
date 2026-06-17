<!DOCTYPE html>
<html>
<head>
    <title>SK Election Management</title>
</head>
<body>

<h2>SK Election Configuration</h2>

<!-- CREATE FORM -->
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

<!-- LIST -->
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
                <form method="POST" action="/admin/election-setting/delete">
                    <input type="hidden" name="election_id" value="<?= $e['election_id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>