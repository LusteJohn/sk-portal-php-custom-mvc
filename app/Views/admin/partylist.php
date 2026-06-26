<!DOCTYPE html>
<html>
<head>
    <title>Partylist Management</title>
</head>
<body>

<h2>Partylist Management</h2>

<!-- CREATE PARTYLIST -->

<form method="POST" action="/admin/partylist/store">

    <label>Election</label><br>

    <select name="election_id" required>
        <option value="">Select Election</option>

        <?php foreach ($elections as $e): ?>
            <option value="<?= $e['election_id'] ?>">
                <?= $e['election_year'] ?>
            </option>
        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Partylist Name</label><br>
    <input
        type="text"
        name="partylist_name"
        required
    >

    <br><br>

    <label>Acronym</label><br>
    <input
        type="text"
        name="acronym"
        required
    >

    <br><br>

    <button type="submit">
        Create Partylist
    </button>

</form>

<hr>

<h3>Partylist List</h3>

<table border="1" cellpadding="5">

    <tr>
        <th>ID</th>
        <th>Election Year</th>
        <th>Partylist Name</th>
        <th>Acronym</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($partylists as $party): ?>

        <tr>

            <td><?= $party['partylist_id'] ?></td>

            <td><?= $party['election_year'] ?></td>

            <td><?= $party['partylist_name'] ?></td>

            <td><?= $party['acronym'] ?></td>

            <td><?= $party['status'] ?></td>

            <td>

                <a href="/admin/partylist/edit?id=<?= $party['partylist_id'] ?>">
                    Edit
                </a>

                <form
                    method="POST"
                    action="/admin/partylist/delete"
                    style="display:inline;"
                >

                    <input
                        type="hidden"
                        name="partylist_id"
                        value="<?= $party['partylist_id'] ?>"
                    >

                    <button type="submit">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>
<a href="/admin/dashboard">Back to Dashboard</a>

<!-- UPDATE FORM -->

<?php if (isset($editPartylist) && $editPartylist): ?>

<hr>

<h3>Update Partylist</h3>

<form method="POST" action="/admin/partylist/update">

    <input
        type="hidden"
        name="partylist_id"
        value="<?= $editPartylist['partylist_id'] ?>"
    >

    <label>Election</label><br>

    <select name="election_id" required>

        <?php foreach ($elections as $e): ?>

            <option
                value="<?= $e['election_id'] ?>"
                <?= ($e['election_id'] == $editPartylist['election_id']) ? 'selected' : '' ?>
            >
                <?= $e['election_year'] ?>
            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <label>Partylist Name</label><br>

    <input
        type="text"
        name="partylist_name"
        value="<?= $editPartylist['partylist_name'] ?>"
        required
    >

    <br><br>

    <label>Acronym</label><br>

    <input
        type="text"
        name="acronym"
        value="<?= $editPartylist['acronym'] ?>"
        required
    >

    <br><br>

    <label>Status</label><br>

    <select name="status">

        <option
            value="pending"
            <?= $editPartylist['status'] == 'pending' ? 'selected' : '' ?>
        >
            Pending
        </option>

        <option
            value="active"
            <?= $editPartylist['status'] == 'active' ? 'selected' : '' ?>
        >
            Active
        </option>

        <option
            value="inactive"
            <?= $editPartylist['status'] == 'inactive' ? 'selected' : '' ?>
        >
            Inactive
        </option>

    </select>

    <br><br>

    <button type="submit">
        Update Partylist
    </button>

</form>

<?php endif; ?>

</body>
</html>