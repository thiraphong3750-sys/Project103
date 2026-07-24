    <!-- Footer -->
    <footer class="mt-auto py-4 text-center text-sm text-gray-500 dark:text-gray-400">
        &copy; <?php echo date('Y'); ?> <?php echo SITENAME; ?>. All rights reserved. <br>
        <span class="text-xs">Version 1.0.0</span>
    </footer>

    <!-- Main Script for Theme Toggle etc. -->
    <script>
        // Check local storage for dark mode preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }

        // Toggle Dark Mode function
        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    </script>
</body>
</html>
