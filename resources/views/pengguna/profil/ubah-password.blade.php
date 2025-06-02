<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Ubah Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

           <!-- Header -->
           <header class="bg-white shadow-sm sticky top-0 z-50">
            <x-header.pengguna/>
        </header>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex">

        <!-- Sidebar -->
        <div class="w-72 pr-6">
            <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="h-20 w-20 rounded-full overflow-hidden mb-3">
                        <img src="{{ asset('Assets/adudu.jpeg') }}" class="h-full w-full object-cover" alt="Profile picture">
                    </div>
                    <h2 class="font-bold text-lg">Abdul Dudul</h2>
                    <p class="text-sm text-gray-500">adudu2020@gmail.com</p>
                    <p class="text-sm text-gray-500">927 Poin</p>
                </div>
                <div class="border-t border-gray-200 pt-3 flex flex-col gap-5 text-sm font-medium">
                    <a href="#" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="#" class="flex items-center text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                    <a href="#" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar Akun
                    </a>
                </div>
            </div>
        </div>

        <!-- Password Change Form -->
        <div class="flex-1">
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-2xl font-semibold text-teal-600 mb-4">Ubah Password</h2>
                <div class="border-t border-gray-200 pt-8">
                    <div class="max-w-lg">
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-500 mb-3">Password</h3>
                            
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <div class="relative">
                                    <input type="password" id="current-password" value="password123" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm" placeholder="Password saat ini">
                                    <button type="button" onclick="togglePasswordVisibility('current-password', 'eye-icon-current')" class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <!-- Eye Icon (Closed by default) -->
                                        <svg id="eye-icon-current" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="new-password" value="newpassword123" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm" placeholder="Password baru">
                                    <button type="button" onclick="togglePasswordVisibility('new-password', 'eye-icon-new')" class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <!-- Eye Icon (Closed by default) -->
                                        <svg id="eye-icon-new" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password" value="newpassword123" class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm" placeholder="Konfirmasi password baru">
                                    <button type="button" onclick="togglePasswordVisibility('confirm-password', 'eye-icon-confirm')" class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <!-- Eye Icon (Closed by default) -->
                                        <svg id="eye-icon-confirm" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="flex justify-center mt-10">
                                <button class="bg-teal-600 text-white px-7 py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors w-full max-w-xs">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script for toggling password visibility -->
    <script>
        // Initialize all eye icons to show closed eye
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state for all password fields
            const passwordFields = ['current-password', 'new-password', 'confirm-password'];
            passwordFields.forEach(id => {
                const eyeIconId = 'eye-icon-' + id.split('-')[0];
                updateEyeIcon(eyeIconId, false);
            });
        });

        function togglePasswordVisibility(inputId, eyeIconId) {
            const passwordInput = document.getElementById(inputId);
            const isVisible = passwordInput.type === "text";
            
            // Toggle password visibility
            passwordInput.type = isVisible ? "password" : "text";
            
            // Update eye icon
            updateEyeIcon(eyeIconId, !isVisible);
        }
        
        function updateEyeIcon(eyeIconId, isOpen) {
            const eyeIcon = document.getElementById(eyeIconId);
            const openPaths = eyeIcon.querySelectorAll(".eye-open");
            const closedPath = eyeIcon.querySelector(".eye-closed");
            
            if (isOpen) {
                // Show open eye
                openPaths.forEach(path => path.classList.remove("hidden"));
                closedPath.classList.add("hidden");
            } else {
                // Show closed eye
                openPaths.forEach(path => path.classList.add("hidden"));
                closedPath.classList.remove("hidden");
            }
        }
    </script>

</body>
</html>