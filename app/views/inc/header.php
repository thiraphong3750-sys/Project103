<!DOCTYPE html>
<html lang="th" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <!-- Google Fonts: Prompt -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Prompt', 'sans-serif'],
                    },
                    colors: {
                        primary: '#5B2D90',
                        secondary: '#6C63FF',
                        lightbg: '#F8F9FA',
                        darkbg: '#121212',
                        darkcard: '#1E1E1E'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Prompt', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .dark .glass-effect {
            background: rgba(30, 30, 30, 0.7);
        }
    </style>
</head>
<body class="bg-lightbg dark:bg-darkbg text-gray-800 dark:text-gray-200 antialiased transition-colors duration-300">
