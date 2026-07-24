<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            
            <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">แผนก (Departments)</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">จัดการข้อมูลแผนกภายในองค์กร</p>
                </div>
                
                <div class="flex gap-2">
                    <button class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center">
                        <i class="bi bi-plus-lg mr-2 text-lg"></i> เพิ่มแผนกใหม่
                    </button>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach($data['departments'] as $dept): ?>
                <div class="bg-white dark:bg-darkcard rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                        <button class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:text-primary flex items-center justify-center transition-colors"><i class="bi bi-pencil"></i></button>
                    </div>
                    
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center text-2xl mb-4">
                        <i class="bi bi-building"></i>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1"><?php echo $dept->name; ?></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4"><?php echo $dept->description; ?></p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs text-gray-600 dark:text-gray-300 font-bold">
                                <?php echo substr($dept->head, 0, 1); ?>
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-300"><?php echo $dept->head; ?></span>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 text-xs font-medium px-2.5 py-1 rounded-lg flex items-center">
                            <i class="bi bi-people mr-1"></i> <?php echo $dept->count; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </main>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
