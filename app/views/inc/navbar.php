<!-- Top Navbar -->
<nav class="bg-white dark:bg-darkcard border-b border-gray-100 dark:border-gray-800 h-20 px-6 flex items-center justify-between sticky top-0 z-30 transition-colors duration-300">
    <div class="flex items-center">
        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar()" class="md:hidden text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white mr-4 transition-colors">
            <i class="bi bi-list text-2xl"></i>
        </button>
        <h2 class="text-xl font-bold text-gray-800 dark:text-white hidden sm:block"><?php echo isset($data['title']) ? $data['title'] : 'Dashboard'; ?></h2>
    </div>

    <div class="flex items-center gap-4">
        <!-- Theme Toggle -->
        <button onclick="toggleTheme()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
            <i class="bi bi-moon-stars hidden dark:block"></i>
            <i class="bi bi-sun block dark:hidden"></i>
        </button>

        <!-- Notifications -->
        <button class="relative w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
            <i class="bi bi-bell"></i>
            <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-darkcard"></span>
        </button>

        <!-- Profile Dropdown -->
        <div class="relative ml-2">
            <button onclick="toggleDropdown()" class="flex items-center gap-3 focus:outline-none">
                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center overflow-hidden border-2 border-primary/30">
                    <?php if(isset($_SESSION['employee_photo']) && !empty($_SESSION['employee_photo'])): ?>
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $_SESSION['employee_photo']; ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                        <i class="bi bi-person-fill text-primary text-xl"></i>
                    <?php endif; ?>
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white leading-tight"><?php echo isset($_SESSION['employee_name']) ? $_SESSION['employee_name'] : $_SESSION['user_username']; ?></p>
                    <p class="text-xs text-gray-500 dark:text-gray-400"><?php echo $_SESSION['user_role']; ?></p>
                </div>
                <i class="bi bi-chevron-down text-gray-500 text-xs hidden md:block"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="profileDropdown" class="hidden absolute right-0 mt-3 w-48 bg-white dark:bg-darkcard rounded-xl shadow-lg border border-gray-100 dark:border-gray-800 py-1 overflow-hidden z-50">
                <a href="<?php echo URLROOT; ?>/profile" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i class="bi bi-person mr-2"></i> My Profile
                </a>
                <a href="<?php echo URLROOT; ?>/settings" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i class="bi bi-gear mr-2"></i> Settings
                </a>
                <div class="border-t border-gray-100 dark:border-gray-800 my-1"></div>
                <a href="<?php echo URLROOT; ?>/users/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    function toggleDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    window.addEventListener('click', function(e) {
        if (!document.querySelector('.relative.ml-2').contains(e.target)) {
            document.getElementById('profileDropdown').classList.add('hidden');
        }
    });
</script>
