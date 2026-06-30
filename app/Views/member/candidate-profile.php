<?php
$title = "Candidate Profile";
require __DIR__ . "/components/layout.php";
?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-4xl font-bold">Campaign Platform</h1>
        <p class="text-base-content/70 mt-2">
            Showcase your vision, advocacies, and priorities for the community.
        </p>
    </div>

    <button
        class="btn btn-primary btn-wide"
        onclick="profile_modal.showModal()">

        <?= empty($profile) ? 'Create Campaign' : 'Edit Campaign' ?>

    </button>

</div>


<!-- Featured Campaign Slogan -->

<div class="hero rounded-box bg-primary text-primary-content shadow-xl">

    <div class="hero-content text-center py-12">

        <div>

            <div class="badge badge-lg badge-secondary mb-4">
                CAMPAIGN SLOGAN
            </div>

            <h2 class="text-4xl font-bold">

                <?= !empty($profile['slogan'])
                    ? '"' . htmlspecialchars($profile['slogan']) . '"'
                    : 'No Campaign Slogan Yet'; ?>

            </h2>

        </div>

    </div>

</div>


<div class="grid lg:grid-cols-3 gap-6 mt-8">

    <div class="card bg-base-100 shadow-lg border border-base-300">

        <div class="card-body">

            <div class="text-primary text-3xl">📖</div>

            <h2 class="card-title">
                Platform Summary
            </h2>

            <p class="leading-8 text-base-content/80">

                <?= !empty($profile['platform_summary'])
                    ? nl2br(htmlspecialchars($profile['platform_summary']))
                    : 'No platform summary available.'; ?>

            </p>

        </div>

    </div>


    <div class="card bg-base-100 shadow-lg border border-base-300">

        <div class="card-body">

            <div class="text-success text-3xl">🌱</div>

            <h2 class="card-title">
                Key Advocacies
            </h2>

            <p class="leading-8 text-base-content/80">

                <?= !empty($profile['key_advocacies'])
                    ? nl2br(htmlspecialchars($profile['key_advocacies']))
                    : 'No advocacies added yet.'; ?>

            </p>

        </div>

    </div>


    <div class="card bg-base-100 shadow-lg border border-base-300">

        <div class="card-body">

            <div class="text-warning text-3xl">🎯</div>

            <h2 class="card-title">
                Priority Issues
            </h2>

            <p class="leading-8 text-base-content/80">

                <?= !empty($profile['priority_issues'])
                    ? nl2br(htmlspecialchars($profile['priority_issues']))
                    : 'No priority issues listed.'; ?>

            </p>

        </div>

    </div>

</div>


<div class="mt-8">

    <div class="alert">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="stroke-current shrink-0 h-6 w-6"
             fill="none"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21
                  12a9 9 0 11-18
                  0 9 9 0 0118 0z" />

        </svg>

        <div>

            <h3 class="font-bold">
                Campaign Overview
            </h3>

            <div class="text-sm">

                This information will be presented to voters to help them
                understand your platform, advocacies, and priorities during
                the election.

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