<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? "SK Member Panel" ?></title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-base-200">

<div class="flex">

    <?php require __DIR__ . '/sidebar.php'; ?>

    <main class="flex-1">

        <div class="navbar bg-base-100 shadow">

            <div class="flex-1">
                <h1 class="text-xl font-bold">
                    <?= $title ?? "Dashboard" ?>
                </h1>
            </div>

            <div class="flex-none">

                <?php if (isset($_SESSION['user'])): ?>

                    <div class="badge badge-primary badge-lg">

                        <?= htmlspecialchars(
                            $_SESSION['user']['username']
                            ?? $_SESSION['user']['email']
                        ); ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

        <div class="p-6">