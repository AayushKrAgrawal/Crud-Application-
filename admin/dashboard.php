<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isAdmin()) {
    header('Location: ../login.php');
    exit();
}

// Get users count
$users_query = "SELECT COUNT(*) as count FROM users WHERE role = 'user'";
$users_result = $db->query($users_query);
$users_count = $users_result->fetch_assoc()['count'];

// Get news count
$news_query = "SELECT COUNT(*) as count FROM news";
$news_result = $db->query($news_query);
$news_count = $news_result->fetch_assoc()['count'];

// Get notices count
$notices_query = "SELECT COUNT(*) as count FROM notices";
$notices_result = $db->query($notices_query);
$notices_count = $notices_result->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ML Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Sidebar -->
    <div class="flex h-screen">
        <div class="w-64 bg-gray-800 p-6">
            <h1 class="text-2xl font-bold text-white">Admin Panel</h1>
            <ul class="mt-6 space-y-4">
                <li><a href="index.php" class="text-gray-400 hover:text-white">Dashboard</a></li>
                <li><a href="manage-users.php" class="text-gray-400 hover:text-white">Manage Users</a></li>
                <li><a href="manage-MLCourses.php" class="text-gray-400 hover:text-white">Manage MLCourses</a></li>
                <li><a href="manage-Articles.php" class="text-gray-400 hover:text-white">Manage Articles</a></li>
                <li><a href="manage-Others.php" class="text-gray-400 hover:text-white">Manage Others</a></li>
                <li><a href="../logout.php" class="text-gray-400 hover:text-white">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-semibold text-white">Admin Dashboard</h2>
                <div>
                    <button class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-lg">Settings</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Users Card -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 rounded-xl shadow-lg hover:scale-105 transform transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-white rounded-full p-3">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 text-white">
                            <h3 class="text-3xl font-semibold"><?php echo $users_count; ?></h3>
                            <p class="text-sm">Total Users</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="manage-users.php" class="text-blue-200 hover:text-blue-100">Manage Users</a>
                    </div>
                </div>

                <!-- News Card -->
                <div class="bg-gradient-to-r from-green-500 to-green-700 p-6 rounded-xl shadow-lg hover:scale-105 transform transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-white rounded-full p-3">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2" />
                            </svg>
                        </div>
                        <div class="ml-5 text-white">
                            <h3 class="text-3xl font-semibold"><?php echo $news_count; ?></h3>
                            <p class="text-sm">Total News</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="manage-news.php" class="text-green-200 hover:text-green-100">Manage ML Courses</a>
                    </div>
                </div>

                <!-- Notices Card -->
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 p-6 rounded-xl shadow-lg hover:scale-105 transform transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-white rounded-full p-3">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="ml-5 text-white">
                            <h3 class="text-3xl font-semibold"><?php echo $notices_count; ?></h3>
                            <p class="text-sm">Total Notices</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="manage-notices.php" class="text-yellow-200 hover:text-yellow-100">Manage Articles</a>
                    </div>
                </div>

                <!-- Courses Card (Static for now) -->
                <div class="bg-gradient-to-r from-red-500 to-red-700 p-6 rounded-xl shadow-lg hover:scale-105 transform transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-white rounded-full p-3">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9M12 4h9M5 20h7M5 4h7M5 4v16M12 4v16" />
                            </svg>
                        </div>
                        <div class="ml-5 text-white">
                            <h3 class="text-3xl font-semibold">0</h3>
                            <p class="text-sm">Total Courses</p>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <a href="manage-courses.php" class="text-red-200 hover:text-red-100">Manage Others</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
