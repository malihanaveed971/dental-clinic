<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>Dentist Clinic</title>
</head>
<body class="min-h-screen text-body">
    <nav class="navbar navbar-light bg-white/80 backdrop-blur shadow-sm p-4 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <span class="h-10 w-10 rounded-xl bg-blue-50 flex items-center justify-center font-bold text-blue-700">DC</span>
                <span class="text-xl font-bold text-purple-700">My Dento Clinic</span>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="/" class="text-gray-600 hover:text-blue-700 font-medium">Book</a>
                <a href="/dentists" class="text-gray-600 hover:text-blue-700 font-medium">Dentists</a>
                <a href="/appointments" class="text-gray-600 hover:text-blue-700 font-medium">Appointments</a>
                <a href="/patients" class="text-gray-600 hover:text-blue-700 font-medium">Patients</a>
                <a href="/billing" class="text-gray-600 hover:text-blue-700 font-medium">Billing</a>
            </div>

            <div class="md:hidden">
                <a href="/appointments" class="text-gray-600 hover:text-blue-700 font-medium">Appointments</a>
            </div>
        </div>
    </nav>

    <main class="mt-4 container">
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 bg-white/70 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
            <div class="text-sm text-gray-600">
                <span class="font-semibold text-gray-900">My Dento Clinic</span> • Book appointments, meet our dentists, and manage your visits.
            </div>
            <div class="flex items-center gap-4 text-sm">
                <a href="/dentists" class="text-gray-600 hover:text-blue-700 font-medium">Dentists</a>
                <a href="/appointments" class="text-gray-600 hover:text-blue-700 font-medium">Appointments</a>
                <a href="/billing" class="text-gray-600 hover:text-blue-700 font-medium">Billing</a>
            </div>
        </div>
    </footer>
</body>
</html>