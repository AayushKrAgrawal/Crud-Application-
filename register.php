<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = sanitize($_POST['full_name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email exists
    $check_query = "SELECT id FROM users WHERE email = '$email'";
    $result = $db->query($check_query);
    
    if ($result->num_rows > 0) {
        $error = "Email already exists";
    } else {
        $query = "INSERT INTO users (full_name, email, phone, password) 
                  VALUES ('$full_name', '$email', '$phone', '$password')";
        
        if ($db->query($query)) {
            header('Location: login.php');
            exit();
        } else {
            $error = "Registration failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ML Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200 flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-3xl font-bold mb-6 text-center text-blue-400">Register</h2>

        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white px-4 py-3 rounded mb-4">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="full_name">
                    Full Name
                </label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-blue-400"
                       type="text" name="full_name" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="email">
                    Email
                </label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-blue-400"
                       type="email" name="email" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="phone">
                    Phone
                </label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-blue-400"
                       type="tel" name="phone" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="password">
                    Password
                </label>
                <input class="w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-blue-400"
                       type="password" name="password" required>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
                    Register
                </button>
            </div>

            <div class="mt-4 text-center">
                <a class="text-blue-400 hover:underline" href="login.php">Already have an account? Login</a>
            </div>
        </form>
    </div>
</body>
</html>
