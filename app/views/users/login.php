<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Abstract Background shapes -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-primary opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-secondary opacity-20 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md z-10">
        <!-- Login Card -->
        <div class="bg-white dark:bg-darkcard rounded-2xl shadow-xl overflow-hidden glass-effect">
            <div class="p-8 md:p-10">
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-primary text-white rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary/30">
                        <i class="bi bi-fingerprint text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo SITENAME; ?></h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Sign in to your account</p>
                </div>

                <?php flash('login_error'); ?>

                <form action="<?php echo URLROOT; ?>/users/login" method="POST">
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

                    <div class="mb-5">
                        <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="bi bi-person"></i>
                            </div>
                            <input type="text" name="username" id="username" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-3 transition-colors <?php echo (!empty($data['username_err'])) ? 'border-red-500 focus:ring-red-500' : ''; ?>" placeholder="Enter your username" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
                        </div>
                        <span class="text-xs text-red-500 mt-1 block"><?php echo isset($data['username_err']) ? $data['username_err'] : ''; ?></span>
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="bi bi-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" class="bg-gray-50 dark:bg-darkbg border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary focus:border-primary block w-full pl-10 p-3 transition-colors <?php echo (!empty($data['password_err'])) ? 'border-red-500 focus:ring-red-500' : ''; ?>" placeholder="••••••••">
                        </div>
                        <span class="text-xs text-red-500 mt-1 block"><?php echo isset($data['password_err']) ? $data['password_err'] : ''; ?></span>
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember" class="w-4 h-4 text-primary bg-gray-100 border-gray-300 rounded focus:ring-primary dark:focus:ring-primary dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">Remember me</label>
                        </div>
                        <a href="#" class="text-sm font-medium text-primary hover:text-secondary dark:text-secondary dark:hover:text-primary transition-colors">Forgot password?</a>
                    </div>

                    <button type="submit" class="w-full text-white bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-primary/50 font-medium rounded-lg text-sm px-5 py-3 text-center transition-all transform hover:scale-[1.02] shadow-lg shadow-primary/30">
                        Sign In
                    </button>
                </form>
            </div>
            <!-- Toggle Theme Button in Corner -->
            <button onclick="toggleTheme()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors bg-white/50 dark:bg-black/50 p-2 rounded-full backdrop-blur-sm">
                <i class="bi bi-moon-stars hidden dark:block"></i>
                <i class="bi bi-sun block dark:hidden"></i>
            </button>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
