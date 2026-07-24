<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            
            <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">ข้อมูลพนักงาน</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">จัดการข้อมูลพนักงานในองค์กรทั้งหมด</p>
                </div>
                
                <div class="flex gap-2">
                    <button class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                        <i class="bi bi-person-plus-fill mr-2 text-lg"></i> เพิ่มพนักงานใหม่
                    </button>
                </div>
            </div>

            <!-- Toolbar -->
            <div class="bg-white dark:bg-darkcard rounded-2xl p-4 shadow-sm border border-gray-100 dark:border-gray-800 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="bi bi-search"></i>
                    </div>
                    <input type="text" class="w-full bg-gray-50 dark:bg-darkbg border border-gray-200 dark:border-gray-700 rounded-lg pl-10 p-2.5 text-sm text-gray-700 dark:text-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none" placeholder="ค้นหาชื่อ, รหัส, แผนก...">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <select class="bg-gray-50 dark:bg-darkbg border border-gray-200 dark:border-gray-700 rounded-lg p-2.5 text-sm text-gray-700 dark:text-gray-300 outline-none flex-1 md:flex-none">
                        <option value="">ทุกแผนก</option>
                        <option value="IT">IT</option>
                        <option value="HR">HR</option>
                    </select>
                </div>
            </div>

            <!-- Employee Grid / Table -->
            <div class="bg-white dark:bg-darkcard rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800/50 dark:text-gray-300 border-b border-gray-100 dark:border-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-4">โปรไฟล์</th>
                                <th scope="col" class="px-6 py-4">รหัสพนักงาน</th>
                                <th scope="col" class="px-6 py-4">ตำแหน่ง</th>
                                <th scope="col" class="px-6 py-4">แผนก</th>
                                <th scope="col" class="px-6 py-4">สถานะ</th>
                                <th scope="col" class="px-6 py-4 text-right">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['employees'] as $emp): ?>
                            <tr class="bg-white dark:bg-darkcard border-b dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                            <?php echo substr($emp->first_name, 0, 1) . substr($emp->last_name, 0, 1); ?>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white"><?php echo $emp->first_name . ' ' . $emp->last_name; ?></div>
                                            <div class="text-xs text-gray-500"><?php echo $emp->email; ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium"><?php echo $emp->employee_code; ?></td>
                                <td class="px-6 py-4"><?php echo $emp->position; ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 rounded-lg">
                                        <?php echo $emp->department; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1 text-green-500 font-medium text-xs">
                                        <span class="w-2 h-2 rounded-full bg-green-500"></span> Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-primary transition-colors p-2"><i class="bi bi-pencil-square"></i></button>
                                    <button class="text-gray-400 hover:text-red-500 transition-colors p-2"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
