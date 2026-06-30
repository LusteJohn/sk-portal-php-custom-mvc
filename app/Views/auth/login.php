<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tailwind CSS + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center">

    <div class="card w-full max-w-md bg-base-100 shadow-2xl">
        <div class="card-body">

            <div class="text-center mb-4">
                <h1 class="text-3xl font-bold">Welcome Back</h1>
                <p class="text-base-content/70 mt-2">
                    Sign in to your account
                </p>
            </div>

            <form method="POST" action="/login">

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">
                        Email or Username
                    </legend>

                    <input
                        type="text"
                        name="identifier"
                        class="input input-bordered w-full"
                        placeholder="Enter your email or username"
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
                        placeholder="Enter your password"
                        required>
                </fieldset>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        Login
                    </button>
                </div>

            </form>

            <div class="divider">OR</div>

            <p class="text-center">
                Don't have an account?
                <a href="/register" class="link link-primary font-semibold">
                    Register here
                </a>
            </p>

        </div>
    </div>

</body>
</html>