<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin/dashboard.php');
            } else {
                header('Location: user/dashboard.php');
            }
            exit();
        }
    }
    $error = "Invalid credentials";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ML Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg flex overflow-hidden">
        <!-- Left Side: Login Form -->
        <div class="w-1/2 p-8">
            <h2 class="text-3xl font-bold text-blue-400 mb-6 text-center">Login</h2>

            <?php if (isset($error)): ?>
                <div class="bg-red-500 text-white px-4 py-3 rounded mb-4">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:border-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-300 text-sm font-semibold mb-2">Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-lg focus:outline-none focus:border-blue-400">
                </div>

                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-lg">
                    Sign In
                </button>
            </form>

            <p class="text-sm text-gray-400 mt-4 text-center">
                Don't have an account? <a href="register.php" class="text-blue-400 hover:underline">Sign up</a>
            </p>
        </div>

        <!-- Right Side: Quote & Image -->
        <div class="w-1/2 flex flex-col justify-center items-center bg-blue-600 text-white p-8">
            <blockquote class="text-lg italic mb-4 text-center">"🧠 "The best way to predict the future is to create it—with data and algorithms." 🚀

"</blockquote>
<img src="assets/images/AI.jpg" alt="Mindful Moments" class="rounded-lg shadow-md">
    </div>
</body>
</html>
