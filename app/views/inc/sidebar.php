<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 bg-white dark:bg-darkcard w-64 shadow-xl z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col" id="sidebar">
    <div class="flex items-center justify-center h-20 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center shadow-lg shadow-primary/30">
                <i class="bi bi-fingerprint text-xl"></i>
            </div>
            <h1 class="text-lg font-bold text-gray-800 dark:text-white"><?php echo SITENAME; ?></h1>
        </div>
    </div>
    
    <div class="overflow-y-auto overflow-x-hidden flex-grow py-6 px-4">
        <ul class="space-y-2 text-sm font-medium">
            <li>
                <a href="<?php echo URLROOT; ?>/dashboard" class="flex items-center p-3 text-primary bg-primary/10 rounded-xl hover:bg-primary/20 dark:hover:bg-primary/20 transition-colors group">
                    <i class="bi bi-grid-1x2-fill text-lg"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/attendance/check" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-clock-history text-lg"></i>
                    <span class="ml-3">ลงเวลาเข้า-ออก</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/attendance/history" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-card-checklist text-lg"></i>
                    <span class="ml-3">ประวัติลงเวลา</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/leave" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-calendar2-check text-lg"></i>
                    <span class="ml-3">คำขอลางาน</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/reports" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-graph-up text-lg"></i>
                    <span class="ml-3">รายงาน</span>
                </a>
            </li>
            
            <?php if(isset($_SESSION['user_role']) && in_array($_SESSION['user_role'], ['Super Admin', 'Admin', 'HR'])): ?>
            <li class="pt-4 pb-2">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</span>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/employees" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-people text-lg"></i>
                    <span class="ml-3">พนักงาน</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/departments" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-building text-lg"></i>
                    <span class="ml-3">แผนก</span>
                </a>
            </li>
            <li>
                <a href="<?php echo URLROOT; ?>/settings" class="flex items-center p-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <i class="bi bi-gear text-lg"></i>
                    <span class="ml-3">ตั้งค่าระบบ</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    
    <div class="p-4 border-t border-gray-100 dark:border-gray-800">
        <a href="<?php echo URLROOT; ?>/users/logout" class="flex items-center p-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">
            <i class="bi bi-box-arrow-right text-lg"></i>
            <span class="ml-3 font-medium">Logout</span>
        </a>
    </div>
</aside>

<!-- Overlay for mobile sidebar -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity" onclick="toggleSidebar()"></div>
