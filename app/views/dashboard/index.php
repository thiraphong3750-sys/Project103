<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">พนักงานทั้งหมด</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?php echo $data['total_employees']; ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xl">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">เข้างานวันนี้</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?php echo $data['present_today']; ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-green-500/10 flex items-center justify-center text-green-500 text-xl">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">มาสาย</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?php echo $data['late_today']; ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-yellow-500/10 flex items-center justify-center text-yellow-500 text-xl">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 flex items-center justify-between hover:-translate-y-1 transition-transform duration-300">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">ลางาน</p>
                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white"><?php echo $data['on_leave']; ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-500 text-xl">
                        <i class="bi bi-calendar-minus-fill"></i>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Main Chart -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">ภาพรวมการเข้างาน (สัปดาห์นี้)</h3>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">สถานะวันนี้</h3>
                    </div>
                    <div class="relative h-64 w-full flex items-center justify-center">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table Mockup -->
            <div class="bg-white dark:bg-darkcard rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">ลงเวลาล่าสุด</h3>
                    <a href="<?php echo URLROOT; ?>/attendance/history" class="text-sm text-primary hover:text-secondary font-medium">ดูทั้งหมด</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-4">พนักงาน</th>
                                <th scope="col" class="px-6 py-4">แผนก</th>
                                <th scope="col" class="px-6 py-4">เวลาเข้า</th>
                                <th scope="col" class="px-6 py-4">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-darkcard border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">JD</div>
                                    <span class="font-medium text-gray-900 dark:text-white">John Doe</span>
                                </td>
                                <td class="px-6 py-4">IT</td>
                                <td class="px-6 py-4">08:45 AM</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-full">ตรงเวลา</span>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-darkcard hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">SJ</div>
                                    <span class="font-medium text-gray-900 dark:text-white">Sarah Jenkins</span>
                                </td>
                                <td class="px-6 py-4">HR</td>
                                <td class="px-6 py-4">09:15 AM</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full">สาย</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Theme Colors
    const primaryColor = '#5B2D90';
    const secondaryColor = '#6C63FF';
    
    // Main Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: 'Present',
                data: [145, 142, 140, 148, 120],
                backgroundColor: primaryColor,
                borderRadius: 4
            }, {
                label: 'Late',
                data: [5, 8, 10, 2, 15],
                backgroundColor: '#F59E0B',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [2, 4], color: '#e5e7eb' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Donut Chart
    const ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['ตรงเวลา', 'สาย', 'ลา/ขาด'],
            datasets: [{
                data: [<?php echo $data['present_today'] - $data['late_today']; ?>, <?php echo $data['late_today']; ?>, <?php echo $data['absent_today'] + $data['on_leave']; ?>],
                backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
