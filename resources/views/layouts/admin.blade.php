
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Add any other head elements or stylesheets here -->
</head>
<body>
    <div id="admin-wrapper">
        <!-- Sidebar -->
        <aside id="admin-sidebar">
            <nav>
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                    <li><a href="{{ route('job_batches.index') }}">Job Batches</a></li>
                    <li><a href="{{ route('failed_jobs.index') }}">Failed Jobs</a></li>
                    <!-- Add more links as needed -->
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div id="admin-content">
            <header>
                <h1>@yield('header')</h1>
                <!-- You can add a logout button or user info here -->
            </header>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <!-- Add any other scripts here -->
</body>
</html>
