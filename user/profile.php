<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = $db->query($user_query);
$user = $user_result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_account'])) {
        $delete_query = "DELETE FROM users WHERE id = $user_id";
        if ($db->query($delete_query)) {
            session_unset();
            session_destroy();
            header('Location: ../login.php');
            exit();
        } else {
            $error = "Failed to delete account";
        }
    } else {
        $full_name = sanitize($_POST['full_name']);
        $email = sanitize($_POST['email']);
        $phone = sanitize($_POST['phone']);
        $profile_picture = $user['profile_picture'];

        // Handle profile photo upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['profile_picture']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array(strtolower($filetype), $allowed)) {
                $upload_path = '../assets/uploads/';
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                $new_filename = uniqid() . '.' . $filetype;
                $upload_file = $upload_path . $new_filename;

                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_file)) {
                    // Update database with new photo
                    $profile_picture = '../assets/uploads/' . $new_filename;
                }
            }
        }

        // Update user information
        $update_query = "UPDATE users SET full_name = '$full_name', email = '$email', phone = '$phone', profile_picture = '$profile_picture' WHERE id = $user_id";
        if ($db->query($update_query)) {
            header('Location: profile.php');
            exit();
        } else {
            $error = "Profile update failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ML Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

<nav class="bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl font-bold text-white">ML Website</h1>
            </div>
            <div class="flex items-center space-x-6">
                <a href="dashboard.php" class="text-gray-400 hover:text-white">Dashboard</a>
                <a href="profile.php" class="text-white border-b-2 border-blue-500">Profile</a>
            </div>
            <div class="flex items-center">
                <a href="../logout.php" class="text-gray-400 hover:text-white">Logout</a>
            </div>
        </div>
    </div>
</nav>

<main class="flex-1 flex flex-col items-center justify-center p-6">
    <section class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center mb-8">Profile</h2>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-500 text-white px-4 py-3 rounded mb-6 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">
            <div class="text-center">
                <?php if ($user['profile_picture']): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="w-32 h-32 rounded-full mx-auto border-4 border-blue-500">
                <?php else: ?>
                    <img src="../assets/images/user.jpg" alt="Default User Icon" class="w-32 h-32 rounded-full mx-auto border-4 border-blue-500">
                <?php endif; ?>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2" for="full_name">Full Name</label>
                <input class="w-full p-3 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2" for="email">Email</label>
                <input class="w-full p-3 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2" for="phone">Phone</label>
                <input class="w-full p-3 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" type="tel" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2" for="profile_picture">Profile Picture</label>
                <input class="w-full p-3 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" type="file" name="profile_picture">
            </div>
            
            <div class="flex justify-between items-center">
                <button class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">
                    Update Profile
                </button>
                <button type="button" class="bg-red-600 hover:bg-red-700 text-white py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" onclick="openModal()">
                    Delete Account
                </button>
            </div>
        </form>
    </section>
</main>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-60 hidden">
    <div class="bg-gray-700 p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold text-white mb-4">Confirm Delete</h2>
        <p class="text-gray-300 mb-4">Are you sure you want to delete your account? This action cannot be undone.</p>
        <div class="flex justify-end">
            <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md mr-2" onclick="closeModal()">
                Cancel
            </button>
            <form method="POST" action="">
                <button class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md focus:outline-none" type="submit" name="delete_account">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

</body>
</html>