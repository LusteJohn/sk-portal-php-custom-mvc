<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Tailwind CSS + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center">

    <div class="card w-full max-w-md bg-base-100 shadow-2xl">
        <div class="card-body">

            <div class="text-center mb-4">
                <h1 class="text-3xl font-bold">Create Account</h1>
                <p class="text-base-content/70 mt-2">
                    Register a new account to get started
                </p>
            </div>

            <form method="POST" action="/register">

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">
                        Username
                    </legend>

                    <input
                        type="text"
                        name="username"
                        class="input input-bordered w-full"
                        placeholder="Enter your username"
                        required>
                </fieldset>

                <fieldset class="fieldset mt-3">
                    <legend class="fieldset-legend">
                        Email Address
                    </legend>

                    <input
                        type="email"
                        name="email"
                        class="input input-bordered w-full"
                        placeholder="Enter your email"
                        required>
                </fieldset>

                <fieldset class="fieldset mt-3">
                    <legend class="fieldset-legend">
                        Password
                    </legend>

                    <input
                        type="password"
                        name="password"
                        class="input input-bordered w-full"
                        placeholder="Create a password"
                        required>
                </fieldset>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        Create Account
                    </button>
                </div>

            </form>

            <div class="divider">OR</div>

            <p class="text-center">
                Already have an account?
                <a href="/login" class="link link-primary font-semibold">
                    Login here
                </a>
            </p>

        </div>
    </div>

</body>
</html>