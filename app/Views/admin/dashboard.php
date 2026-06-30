<?php
$title = "Dashboard";
require __DIR__ . "/components/layout.php";
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <h2 class="card-title">
                Election Settings
            </h2>

            <p>Manage SK Elections.</p>

            <div class="card-actions justify-end">
                <a href="/admin/election-setting" class="btn btn-primary">
                    Open
                </a>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <h2 class="card-title">
                Partylist
            </h2>

            <p>Manage political partylists.</p>

            <div class="card-actions justify-end">
                <a href="/admin/partylist" class="btn btn-primary">
                    Open
                </a>
            </div>
        </div>
    </div>

    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <h2 class="card-title">
                Candidates
            </h2>

            <p>Manage candidate information.</p>

            <div class="card-actions justify-end">
                <a href="/admin/candidate" class="btn btn-primary">
                    Open
                </a>
            </div>
        </div>
    </div>

</div>

<?php require __DIR__ . "/components/footer.php"; ?>