<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">ตั้งค่าระบบ (System Settings)</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">ปรับแต่งการทำงานของระบบลงเวลา</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Navigation/Tabs -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-darkcard rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                        <ul class="flex flex-col">
                            <li>
                                <a href="#" class="flex items-center px-6 py-4 bg-primary/5 text-primary border-r-4 border-primary font-medium transition-colors">
                                    <i class="bi bi-clock-history mr-3 text-lg"></i> เวลาทำงาน
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-6 py-4 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <i class="bi bi-building mr-3 text-lg"></i> ข้อมูลองค์กร
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center px-6 py-4 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                    <i class="bi bi-shield-lock mr-3 text-lg"></i> ความปลอดภัย
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-darkcard rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-gray-800 pb-4">ตั้งค่าเวลาทำงาน (Working Hours)</h3>
                        
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">เวลาเข้างาน (Start Time)</label>
                                    <input type="time" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none" value="<?php echo $data['settings']['work_start_time']; ?>">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">เวลาเลิกงาน (End Time)</label>
                                    <input type="time" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none" value="<?php echo $data['settings']['work_end_time']; ?>">
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">สายเมื่อเลยเวลา (Late Threshold)</label>
                                    <input type="time" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none" value="<?php echo $data['settings']['late_threshold']; ?>">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">เริ่มนับ OT (OT Start Time)</label>
                                    <input type="time" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 outline-none" value="<?php echo $data['settings']['ot_start_time']; ?>">
                                </div>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-darkcard border border-gray-300 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none transition-colors">
                                    ยกเลิก
                                </button>
                                <button type="button" class="px-5 py-2.5 text-sm font-medium text-white bg-primary hover:bg-secondary rounded-lg shadow-md focus:outline-none transition-colors">
                                    บันทึกการตั้งค่า
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
