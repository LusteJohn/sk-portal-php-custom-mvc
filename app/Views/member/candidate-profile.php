<?php
$title = "Candidate Profile";
require __DIR__ . "/components/layout.php";
?>

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold">Candidate Profile</h1>
        <p class="text-base-content/70">
            Manage your platform and advocacies.
        </p>
    </div>

    <button
        class="btn btn-primary"
        onclick="profile_modal.showModal()">

        <?= empty($profile) ? 'Add Profile' : 'Edit Profile' ?>

    </button>

</div>

<div class="card bg-base-100 shadow-xl">

    <div class="card-body">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="card-title text-2xl">

                    <?= htmlspecialchars(
                        $_SESSION['user']['username']
                        ?? $_SESSION['user']['email']
                    ) ?>

                </h2>

                <p class="text-base-content/60">
                    Candidate Information
                </p>

            </div>

            <div class="avatar placeholder">

                <div class="bg-primary text-primary-content rounded-full w-20">

                    <span class="text-3xl">

                        <?= strtoupper(substr(
                            $_SESSION['user']['username']
                            ?? $_SESSION['user']['email'],
                            0,
                            1
                        )) ?>

                    </span>

                </div>

            </div>

        </div>

        <div class="divider"></div>

        <div class="space-y-6">

            <div>

                <h3 class="font-bold text-lg">
                    Platform Summary
                </h3>

                <div class="bg-base-200 rounded-lg p-4 mt-2">

                    <?= !empty($profile['platform_summary'])
                        ? nl2br(htmlspecialchars($profile['platform_summary']))
                        : '<span class="text-gray-400">No information available.</span>'; ?>

                </div>

            </div>

            <div>

                <h3 class="font-bold text-lg">
                    Key Advocacies
                </h3>

                <div class="bg-base-200 rounded-lg p-4 mt-2">

                    <?= !empty($profile['key_advocacies'])
                        ? nl2br(htmlspecialchars($profile['key_advocacies']))
                        : '<span class="text-gray-400">No information available.</span>'; ?>

                </div>

            </div>

            <div>

                <h3 class="font-bold text-lg">
                    Priority Issues
                </h3>

                <div class="bg-base-200 rounded-lg p-4 mt-2">

                    <?= !empty($profile['priority_issues'])
                        ? nl2br(htmlspecialchars($profile['priority_issues']))
                        : '<span class="text-gray-400">No information available.</span>'; ?>

                </div>

            </div>

            <div>

                <h3 class="font-bold text-lg">
                    Campaign Slogan
                </h3>

                <div class="mt-2">

                    <?php if (!empty($profile['slogan'])): ?>

                        <div class="badge badge-primary badge-lg">

                            <?= htmlspecialchars($profile['slogan']) ?>

                        </div>

                    <?php else: ?>

                        <span class="text-gray-400">
                            No slogan available.
                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>


<dialog id="profile_modal" class="modal">

    <div class="modal-box max-w-4xl">

        <h3 class="font-bold text-2xl mb-6">

            <?= empty($profile) ? 'Add Candidate Profile' : 'Edit Candidate Profile' ?>

        </h3>

        <form
            method="POST"
            action="/member/candidate-profile/store">

            <input
                type="hidden"
                name="candidate_id"
                value="<?= $candidate['candidate_id'] ?? '' ?>">

            <div class="space-y-5">

                <div>

                    <label class="label">

                        <span class="label-text">
                            Platform Summary
                        </span>

                    </label>

                    <textarea
                        class="textarea textarea-bordered w-full"
                        name="platform_summary"
                        rows="4"
                        required><?= htmlspecialchars($profile['platform_summary'] ?? '') ?></textarea>

                </div>

                <div>

                    <label class="label">

                        <span class="label-text">
                            Key Advocacies
                        </span>

                    </label>

                    <textarea
                        class="textarea textarea-bordered w-full"
                        name="key_advocacies"
                        rows="4"
                        required><?= htmlspecialchars($profile['key_advocacies'] ?? '') ?></textarea>
                </div>

                <div>
                    <label class="label">
                        <span class="label-text">
                            Priority Issues
                        </span>
                    </label>
                    <textarea class="textarea textarea-bordered w-full" name="priority_issues" rows="4" required><?= htmlspecialchars($profile['priority_issues'] ?? '') ?></textarea>
                </div>

                <div>
                    <label class="label">
                        <span class="label-text">
                            Campaign Slogan
                        </span>
                    </label>

                    <input type="text" name="slogan" class="input input-bordered w-full" value="<?= htmlspecialchars($profile['slogan'] ?? '') ?>" required>
                </div>
            </div>

            <div class="modal-action">

                <button type="submit" class="btn btn-primary">Save Profile</button>

                <button type="button" class="btn" onclick="profile_modal.close()">Cancel</button>
            </div>
        </form>
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
<?php require __DIR__ . "/components/footer.php"; ?>