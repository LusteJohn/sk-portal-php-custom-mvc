<?php
$title = "Candidate Information";
require __DIR__ . "/components/layout.php";
?>

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold">
            Candidate Information
        </h1>

        <p class="text-base-content/70">
            View and update your personal information.
        </p>
    </div>

    <?php if ($candidates): ?>

        <button
            class="btn btn-primary"
            onclick="candidate_modal.showModal()">

            Edit Information

        </button>

    <?php endif; ?>

</div>

<?php if (!$candidates): ?>

<div class="alert alert-warning shadow">

    <span>
        No candidate record found. Please contact the administrator.
    </span>

</div>

<?php else: ?>

<div class="card bg-base-100 shadow-xl">

    <div class="card-body">

        <div class="flex flex-col md:flex-row items-center gap-8">

            <div>

                <?php if (!empty($candidates['photoUrl'])): ?>

                    <div class="avatar">

                        <div class="w-40 rounded-xl">

                            <img
                                src="/uploads/candidates/<?= htmlspecialchars($candidates['photoUrl']) ?>"
                                alt="Candidate">

                        </div>

                    </div>

                <?php else: ?>

                    <div class="avatar placeholder">

                        <div class="bg-primary text-primary-content rounded-xl w-40">

                            <span class="text-6xl">

                                <?= strtoupper(substr($candidates['first_name'],0,1)) ?>

                            </span>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

            <div class="flex-1">

                <h2 class="text-3xl font-bold">

                    <?= htmlspecialchars(
                        trim(
                            $candidates['first_name'].' '.
                            $candidates['middle_name'].' '.
                            $candidates['last_name'].' '.
                            $candidates['ext_name']
                        )
                    ) ?>

                </h2>

                <div class="badge badge-primary mt-2">

                    Candidate

                </div>

                <div class="divider"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <p class="font-semibold">
                            Gender
                        </p>

                        <p>
                            <?= htmlspecialchars($candidates['gender']) ?>
                        </p>

                    </div>

                    <div>

                        <p class="font-semibold">
                            Birthdate
                        </p>

                        <p>
                            <?= htmlspecialchars($candidates['birthdate']) ?>
                        </p>

                    </div>

                    <div class="md:col-span-2">

                        <p class="font-semibold">
                            Address
                        </p>

                        <p>
                            <?= htmlspecialchars($candidates['address']) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php endif; ?>


<dialog id="candidate_modal" class="modal">

<div class="modal-box max-w-4xl">

<h3 class="font-bold text-2xl mb-6">

Update Candidate Information

</h3>

<form
method="POST"
action="/member/candidate/update"
enctype="multipart/form-data">

<input
type="hidden"
name="candidate_id"
value="<?= $candidates['candidate_id'] ?>">

<div class="grid md:grid-cols-2 gap-5">

<div>

<label class="label">
<span class="label-text">
First Name
</span>
</label>

<input
type="text"
name="first_name"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['first_name']) ?>"
required>

</div>

<div>

<label class="label">
<span class="label-text">
Middle Name
</span>
</label>

<input
type="text"
name="middle_name"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['middle_name']) ?>">

</div>

<div>

<label class="label">
<span class="label-text">
Last Name
</span>
</label>

<input
type="text"
name="last_name"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['last_name']) ?>"
required>

</div>

<div>

<label class="label">
<span class="label-text">
Extension Name
</span>
</label>

<input
type="text"
name="ext_name"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['ext_name']) ?>">

</div>

<div>

<label class="label">
<span class="label-text">
Gender
</span>
</label>

<select
name="gender"
class="select select-bordered w-full">

<option value="Male"
<?= ($candidates['gender']=='Male') ? 'selected' : '' ?>>

Male

</option>

<option value="Female"
<?= ($candidates['gender']=='Female') ? 'selected' : '' ?>>

Female

</option>

</select>

</div>

<div>

<label class="label">
<span class="label-text">
Birthdate
</span>
</label>

<input
type="date"
name="birthdate"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['birthdate']) ?>">

</div>

<div class="md:col-span-2">

<label class="label">
<span class="label-text">
Address
</span>
</label>

<input
type="text"
name="address"
class="input input-bordered w-full"
value="<?= htmlspecialchars($candidates['address']) ?>">

</div>

<div class="md:col-span-2">

<label class="label">
<span class="label-text">
Profile Photo
</span>
</label>

<input
type="file"
name="photoUrl"
class="file-input file-input-bordered w-full"
accept="image/*">

</div>

</div>

<div class="modal-action">

<button
type="submit"
class="btn btn-primary">

Save Changes

</button>

<button
type="button"
class="btn"
onclick="candidate_modal.close()">

Cancel

</button>

</div>

</form>

</div>

<form method="dialog" class="modal-backdrop">
<button>close</button>
</form>

</dialog>

<?php require __DIR__ . "/components/footer.php"; ?>