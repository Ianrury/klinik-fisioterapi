<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body class="bg-custom-bg min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-xl">CI4 Dashboard</div>
            <div class="space-x-4">
                <a href="#" class="hover:text-blue-200">Home</a>
                <a href="#" class="hover:text-blue-200">Profile</a>
                <a href="#" class="hover:text-blue-200">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-4 hidden md:block">
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">
                            Reports
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-blue-100 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Card 1</h2>
                    <p>Content for first card</p>
                </div>
                <div class="bg-green-100 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Card 2</h2>
                    <p>Content for second card</p>
                </div>
                <div class="bg-red-100 p-4 rounded shadow">
                    <h2 class="text-lg font-semibold">Card 3</h2>
                    <p>Content for third card</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-200 p-4 text-center">
        <p>&copy; 2024 CI4 Application. All rights reserved.</p>
    </footer>
</body>

</html>