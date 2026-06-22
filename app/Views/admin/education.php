<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Educational Background</title>
</head>
<body>
    <h2>Candidate Educational Background</h2>

    <form method="POST" action="/admin/education/store">
        <input type="hidden" name="candidate_id" value="<?= $candidate->id ?? '' ?>">
        <input type="text" name="level" placeholder="Level" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="school" placeholder="School" required>
        <input type="number" name="year_start" placeholder="Year Start" required>
        <input type="number" name="year_end" placeholder="Year End" required>
        <button type="submit">Add Education</button>
    </form>
</body>
</html>