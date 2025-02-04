<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

// Get user data
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = $db->query($user_query);
$user = $user_result->fetch_assoc();

// Get latest news
$news_query = "SELECT * FROM news ORDER BY created_at DESC LIMIT 3";
$news_result = $db->query($news_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ML Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

    <!-- Navigation Bar (Kept Unchanged) -->
    <nav class="bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-xl font-bold text-white">ML Website</h1>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="dashboard.php" class="border-blue-500 text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="profile.php" class="border-transparent text-gray-300 hover:border-gray-500 hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Profile
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="../logout.php" class="text-gray-300 hover:text-white">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner Section -->
    <div class="relative bg-blue-600 py-12 sm:py-16 lg:py-24">
        <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('your-image-path.jpg');"></div>
        <div class="relative text-center text-white">
            <h1 class="text-4xl sm:text-5xl font-bold">Welcome to Your Machine Learning Dashboard</h1>
            <p class="mt-4 text-lg sm:text-xl">Explore the world of Machine Learning and AI.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="bg-gray-800 overflow-hidden shadow rounded-lg mb-8 p-6">
            <h2 class="text-2xl font-bold text-gray-100">Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
        </div>

        <!-- Quotes Section -->
        <div class="mb-8">
            <h3 class="text-xl font-medium text-gray-100 mb-4">Inspiration for Machine Learning</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"The best way to predict the future is to create it."</p>
                    <p class="mt-4 text-sm text-gray-400">- Alan Kay</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"Machine learning is the last invention that humanity will ever need to make."</p>
                    <p class="mt-4 text-sm text-gray-400">- Mark Zuckerberg</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"AI is probably the most important thing humanity has ever worked on."</p>
                    <p class="mt-4 text-sm text-gray-400">- Sundar Pichai</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"Artificial intelligence is the science of making machines do things that would require intelligence if done by men."</p>
                    <p class="mt-4 text-sm text-gray-400">- John McCarthy</p>
                </div>
                <!-- Card 5 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"The future is already here – it’s just not very evenly distributed."</p>
                    <p class="mt-4 text-sm text-gray-400">- William Gibson</p>
                </div>
                <!-- Card 6 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <p class="text-lg font-semibold text-gray-100">"Data is the new oil."</p>
                    <p class="mt-4 text-sm text-gray-400">- Clive Humby</p>
                </div>
            </div>
        </div>

        <!-- Latest News Section -->
        <div class="bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-100 mb-4">Latest News</h3>
                <div class="space-y-4">
                    <?php while ($news = $news_result->fetch_assoc()): ?>
                        <div class="border-b pb-4">
                            <h4 class="text-md font-semibold text-gray-100"><?php echo htmlspecialchars($news['title']); ?></h4>
                            <p class="text-gray-400 text-sm mt-1"><?php echo htmlspecialchars(substr($news['content'], 0, 150)) . '...'; ?></p>
                            <span class="text-gray-500 text-xs"><?php echo date('F j, Y', strtotime($news['created_at'])); ?></span>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

        <!-- Additional Details Section -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg mt-8">
            <h3 class="text-xl font-medium text-gray-100 mb-4">What is Machine Learning?</h3>
            <p class="text-lg text-gray-300">Machine Learning is a subset of Artificial Intelligence that focuses on building systems that learn from data, improve over time, and make data-driven decisions without being explicitly programmed. It uses algorithms and statistical models to find patterns in data and predict future outcomes.</p>
            <p class="mt-4 text-lg text-gray-300">Machine Learning has wide applications in various domains such as finance, healthcare, marketing, and more. It is revolutionizing industries by making systems smarter and more efficient through the power of data and algorithms.</p>
        </div>
    </div>
</body>
</html>
