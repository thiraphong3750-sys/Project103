<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            
            <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">ประวัติการลงเวลา</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">ดูประวัติการเข้า-ออกงานของคุณย้อนหลัง</p>
                </div>
                
                <div class="flex gap-2">
                    <button class="bg-white dark:bg-darkcard border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                        <i class="bi bi-file-earmark-pdf text-red-500 mr-2 text-lg"></i> Export PDF
                    </button>
                    <button class="bg-white dark:bg-darkcard border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                        <i class="bi bi-file-earmark-excel text-green-500 mr-2 text-lg"></i> Export Excel
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-darkcard rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 dark:border-gray-800 mb-6">
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">ตั้งแต่เดือน</label>
                        <input type="month" class="w-full bg-gray-50 dark:bg-darkbg border border-gray-200 dark:border-gray-700 rounded-lg p-2.5 text-sm text-gray-700 dark:text-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">สถานะ</label>
                        <select class="w-full bg-gray-50 dark:bg-darkbg border border-gray-200 dark:border-gray-700 rounded-lg p-2.5 text-sm text-gray-700 dark:text-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                            <option value="">ทั้งหมด</option>
                            <option value="Present">ตรงเวลา</option>
                            <option value="Late">สาย</option>
                            <option value="Leave">ลา</option>
                        </select>
                    </div>
                    <div class="md:col-span-2 flex items-end">
                        <button type="button" class="bg-primary hover:bg-secondary text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors shadow-md w-full md:w-auto">
                            <i class="bi bi-search mr-2"></i> ค้นหา
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div class="bg-white dark:bg-darkcard rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-300 border-b border-gray-100 dark:border-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-4">วันที่</th>
                                <th scope="col" class="px-6 py-4">เวลาเข้า</th>
                                <th scope="col" class="px-6 py-4">เวลาออก</th>
                                <th scope="col" class="px-6 py-4">ชั่วโมงทำงาน</th>
                                <th scope="col" class="px-6 py-4">OT</th>
                                <th scope="col" class="px-6 py-4">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($data['history'])): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    ไม่มีประวัติการลงเวลา
                                </td>
                            </tr>
                            <?php else: ?>
                                <?php foreach($data['history'] as $record): ?>
                                <tr class="bg-white dark:bg-darkcard border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        <?php echo date('d/m/Y', strtotime($record->date)); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $record->check_in_time ? date('H:i', strtotime($record->check_in_time)) : '-'; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $record->check_out_time ? date('H:i', strtotime($record->check_out_time)) : '-'; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $record->working_hours > 0 ? $record->working_hours . ' ชม.' : '-'; ?>
                                    </td>
                                    <td class="px-6 py-4 text-green-600 dark:text-green-400 font-medium">
                                        <?php echo $record->ot_hours > 0 ? $record->ot_hours . ' ชม.' : '-'; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($record->status == 'Present'): ?>
                                            <span class="px-2.5 py-1 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-full border border-green-200 dark:border-green-800">ตรงเวลา</span>
                                        <?php elseif($record->status == 'Late'): ?>
                                            <span class="px-2.5 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full border border-yellow-200 dark:border-yellow-800">สาย</span>
                                        <?php elseif($record->status == 'Leave'): ?>
                                            <span class="px-2.5 py-1 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 rounded-full border border-blue-200 dark:border-blue-800">ลา</span>
                                        <?php else: ?>
                                            <span class="px-2.5 py-1 text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 rounded-full border border-red-200 dark:border-red-800">ขาด</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Mockup -->
                <div class="p-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between text-sm">
                    <span class="text-gray-500 dark:text-gray-400">แสดง 1 ถึง 10 จาก 50 รายการ</span>
                    <div class="flex gap-1">
                        <button class="px-3 py-1 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-500">ก่อนหน้า</button>
                        <button class="px-3 py-1 border border-primary bg-primary text-white rounded shadow-sm">1</button>
                        <button class="px-3 py-1 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-500">2</button>
                        <button class="px-3 py-1 border border-gray-200 dark:border-gray-700 rounded hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-500">ถัดไป</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
