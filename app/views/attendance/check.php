<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex h-screen bg-lightbg dark:bg-darkbg overflow-hidden">
    <?php require APPROOT . '/views/inc/sidebar.php'; ?>

    <div class="flex-1 flex flex-col min-w-0 md:ml-64 transition-all duration-300">
        <?php require APPROOT . '/views/inc/navbar.php'; ?>

        <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
            
            <div class="max-w-4xl mx-auto">
                <!-- Clock and Date -->
                <div class="text-center mb-8">
                    <h2 class="text-5xl md:text-6xl font-bold text-primary dark:text-secondary mb-2 drop-shadow-md" id="realtimeClock">00:00:00</h2>
                    <p class="text-lg text-gray-500 dark:text-gray-400" id="currentDate">Loading Date...</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white dark:bg-darkcard rounded-3xl shadow-lg border border-gray-100 dark:border-gray-800 p-6 md:p-10 mb-8 relative overflow-hidden">
                    <!-- Decorative Element -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-10">
                        
                        <!-- Employee Info -->
                        <div class="flex flex-col items-center md:items-start text-center md:text-left">
                            <div class="w-32 h-32 rounded-full border-4 border-primary/20 p-1 mb-4">
                                <?php if(isset($data['employee']->profile_image) && !empty($data['employee']->profile_image)): ?>
                                    <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['employee']->profile_image; ?>" class="w-full h-full rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full rounded-full bg-primary/10 flex items-center justify-center text-primary text-5xl">
                                        <i class="bi bi-person"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo $_SESSION['employee_name']; ?></h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-1">รหัส: <span class="font-medium text-gray-700 dark:text-gray-300"><?php echo $data['employee']->employee_code; ?></span></p>
                            <p class="text-gray-500 dark:text-gray-400">แผนก: <span class="font-medium text-gray-700 dark:text-gray-300">IT</span></p>
                            
                            <!-- Location Status -->
                            <div class="mt-4 flex items-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-darkbg px-4 py-2 rounded-lg">
                                <i class="bi bi-geo-alt-fill text-red-500 mr-2"></i>
                                <span id="locationStatus">กำลังค้นหาตำแหน่ง...</span>
                            </div>
                        </div>

                        <!-- Action Area -->
                        <div class="flex flex-col items-center justify-center space-y-6">
                            
                            <!-- Camera Preview (Mockup) -->
                            <div class="w-full max-w-sm aspect-video bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden relative border-2 border-dashed border-gray-300 dark:border-gray-700 flex items-center justify-center">
                                <div class="text-center text-gray-400">
                                    <i class="bi bi-camera text-4xl mb-2 block"></i>
                                    <span class="text-sm">กล้องพร้อมใช้งาน</span>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <?php 
                                $hasCheckedIn = $data['today_record'] ? true : false;
                                $hasCheckedOut = ($hasCheckedIn && $data['today_record']->check_out_time) ? true : false;
                            ?>

                            <div class="w-full max-w-sm space-y-4">
                                <?php if(!$hasCheckedIn): ?>
                                    <button id="btnCheckIn" onclick="handleAttendance('checkin')" class="w-full py-4 bg-green-500 hover:bg-green-600 text-white rounded-xl font-bold text-lg transition-transform transform hover:scale-[1.02] shadow-lg shadow-green-500/30 flex items-center justify-center">
                                        <i class="bi bi-box-arrow-in-right text-2xl mr-2"></i> CHECK IN
                                    </button>
                                <?php elseif(!$hasCheckedOut): ?>
                                    <div class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 p-3 rounded-lg text-center mb-4 border border-green-200 dark:border-green-800">
                                        <i class="bi bi-check-circle-fill mr-1"></i> เข้างานแล้วเวลา <?php echo date('H:i', strtotime($data['today_record']->check_in_time)); ?>
                                    </div>
                                    <button id="btnCheckOut" onclick="handleAttendance('checkout')" class="w-full py-4 bg-red-500 hover:bg-red-600 text-white rounded-xl font-bold text-lg transition-transform transform hover:scale-[1.02] shadow-lg shadow-red-500/30 flex items-center justify-center">
                                        <i class="bi bi-box-arrow-left text-2xl mr-2"></i> CHECK OUT
                                    </button>
                                <?php else: ?>
                                    <div class="bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 p-4 rounded-xl text-center border border-blue-200 dark:border-blue-800">
                                        <i class="bi bi-check-all text-3xl block mb-2"></i>
                                        <p class="font-bold">ลงเวลาครบถ้วนแล้วสำหรับวันนี้</p>
                                        <p class="text-sm mt-1">เข้า: <?php echo date('H:i', strtotime($data['today_record']->check_in_time)); ?> | ออก: <?php echo date('H:i', strtotime($data['today_record']->check_out_time)); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Notification Area -->
                <div id="alertBox" class="hidden rounded-xl p-4 mb-4 text-sm font-medium flex items-center justify-center shadow-sm transition-all">
                    <!-- Alert content will be injected here -->
                </div>

            </div>

        </main>
    </div>
</div>

<script>
    // Realtime Clock
    function updateClock() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('th-TH');
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const dateStr = now.toLocaleDateString('th-TH', dateOptions);
        
        document.getElementById('realtimeClock').innerText = timeStr;
        document.getElementById('currentDate').innerText = dateStr;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Geolocation
    let currentLat = null;
    let currentLng = null;

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            currentLat = position.coords.latitude;
            currentLng = position.coords.longitude;
            document.getElementById('locationStatus').innerHTML = `พิกัด: ${currentLat.toFixed(5)}, ${currentLng.toFixed(5)}`;
            document.getElementById('locationStatus').classList.remove('text-red-500');
            document.getElementById('locationStatus').classList.add('text-green-500');
        }, function(error) {
            document.getElementById('locationStatus').innerHTML = "ไม่สามารถระบุตำแหน่งได้";
        });
    } else {
        document.getElementById('locationStatus').innerHTML = "เบราว์เซอร์ไม่รองรับ GPS";
    }

    // Handle Attendance AJAX
    function handleAttendance(action) {
        // Mock processing state
        const btn = event.currentTarget;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split animate-spin mr-2"></i> กำลังบันทึก...';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('action', action);
        formData.append('latitude', currentLat || 0);
        formData.append('longitude', currentLng || 0);

        fetch('<?php echo URLROOT; ?>/attendance/submit_check', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const alertBox = document.getElementById('alertBox');
            alertBox.classList.remove('hidden', 'bg-green-100', 'text-green-800', 'bg-red-100', 'text-red-800', 'dark:bg-green-900/30', 'dark:text-green-400', 'dark:bg-red-900/30', 'dark:text-red-400');
            
            if(data.success) {
                alertBox.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900/30', 'dark:text-green-400');
                alertBox.innerHTML = `<i class="bi bi-check-circle-fill text-xl mr-2"></i> ${data.message} (${data.time})`;
                
                // Reload after short delay to show updated UI
                setTimeout(() => { window.location.reload(); }, 1500);
            } else {
                alertBox.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900/30', 'dark:text-red-400');
                alertBox.innerHTML = `<i class="bi bi-exclamation-circle-fill text-xl mr-2"></i> ${data.message}`;
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
