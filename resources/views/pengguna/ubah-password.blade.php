<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Ubah Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        // Pass Laravel routes to JavaScript
        window.routes = {
            updatePassword: '{{ route("pengguna.update-password") }}'
        };
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-teal-600">WasteWise</h1>
                <nav class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-teal-600">Dashboard</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600">Profil</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 py-10 flex">

        <!-- Sidebar -->
        <div class="w-72 pr-6">
            <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="h-20 w-20 rounded-full overflow-hidden mb-3">
                        @if(isset($pengguna->foto) && $pengguna->foto)
                            <img src="{{ asset('storage/' . $pengguna->foto) }}" class="h-full w-full object-cover" alt="Profile picture">
                        @else
                            <div class="h-full w-full bg-gray-300 flex items-center justify-center">
                                <svg class="h-10 w-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <h2 class="font-bold text-lg">{{ $pengguna->nama_lengkap ?? 'Nama Pengguna' }}</h2>
                    <p class="text-sm text-gray-500">{{ $pengguna->akun->email ?? 'email@example.com' }}</p>
                    <p class="text-sm text-gray-500">{{ $pengguna->total_poin ?? 0 }} Poin</p>
                </div>
                <div class="border-t border-gray-200 pt-3 flex flex-col gap-5 text-sm font-medium">
                    <a href="{{ route('ubah-profil') }}" class="flex items-center text-gray-700 hover:text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="{{ route('pengguna.ubah-password') }}" class="flex items-center text-teal-600">
                        <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ubah Password
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-700 hover:text-teal-600 w-full text-left">
                            <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Password Change Form -->
        <div class="flex-1">
            <div class="bg-white rounded-lg p-8 shadow-sm">
                <h2 class="text-2xl font-semibold text-teal-600 mb-4">Ubah Password</h2>
                
                <!-- Laravel Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-400 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-400 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Alert Messages for AJAX -->
                <div id="alert-container" class="mb-6 hidden">
                    <div id="alert-message" class="p-4 rounded-md"></div>
                </div>

                <!-- Display validation errors -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-400 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="border-t border-gray-200 pt-8">
                    <div class="max-w-lg">
                        <form id="changePasswordForm" class="mb-8">
                            @csrf
                            <h3 class="text-xl font-semibold text-gray-500 mb-3">Password</h3>
                            
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <div class="relative">
                                    <input type="password" id="current-password" name="current_password" 
                                           class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('current_password') border-red-500 @enderror" 
                                           placeholder="Password saat ini" required>
                                    <button type="button" onclick="togglePasswordVisibility('current-password', 'eye-icon-current')" 
                                            class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <svg id="eye-icon-current" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-red-500 text-sm mt-1 hidden" id="current-password-error"></div>
                                @error('current_password')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="new-password" name="new_password" 
                                           class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('new_password') border-red-500 @enderror" 
                                           placeholder="Password baru" required>
                                    <button type="button" onclick="togglePasswordVisibility('new-password', 'eye-icon-new')" 
                                            class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <svg id="eye-icon-new" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-red-500 text-sm mt-1 hidden" id="new-password-error"></div>
                                @error('new_password')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                                <div class="text-xs text-gray-500 mt-1">Password minimal 6 karakter</div>
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <input type="password" id="confirm-password" name="new_password_confirmation" 
                                           class="w-full border border-gray-300 rounded-md py-3 px-4 text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('new_password_confirmation') border-red-500 @enderror" 
                                           placeholder="Konfirmasi password baru" required>
                                    <button type="button" onclick="togglePasswordVisibility('confirm-password', 'eye-icon-confirm')" 
                                            class="absolute inset-y-0 right-0 flex items-center px-4">
                                        <svg id="eye-icon-confirm" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" class="hidden eye-open"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" class="eye-closed"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="text-red-500 text-sm mt-1 hidden" id="confirm-password-error"></div>
                                @error('new_password_confirmation')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="flex justify-center mt-10">
                                <button type="submit" id="submitBtn" 
                                        class="bg-teal-600 text-white px-7 py-3 rounded-lg font-medium hover:bg-teal-700 transition-colors w-full max-w-xs disabled:bg-gray-400 disabled:cursor-not-allowed">
                                    <span id="submitText">Simpan Perubahan</span>
                                    <span id="loadingText" class="hidden">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Menyimpan...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script for toggling password visibility and form handling -->
    <script>
        // Set CSRF token for all AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Initialize all eye icons to show closed eye
        document.addEventListener('DOMContentLoaded', function() {
            const passwordFields = ['current-password', 'new-password', 'confirm-password'];
            passwordFields.forEach(id => {
                const fieldName = id.split('-')[0];
                const eyeIconId = 'eye-icon-' + fieldName;
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
            if (!eyeIcon) return;
            
            const openPaths = eyeIcon.querySelectorAll(".eye-open");
            const closedPath = eyeIcon.querySelector(".eye-closed");
            
            if (isOpen) {
                // Show open eye
                openPaths.forEach(path => path.classList.remove("hidden"));
                if (closedPath) closedPath.classList.add("hidden");
            } else {
                // Show closed eye
                openPaths.forEach(path => path.classList.add("hidden"));
                if (closedPath) closedPath.classList.remove("hidden");
            }
        }

        // Form validation and submission
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            clearErrors();
            
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Client-side validation
            let hasErrors = false;
            
            if (currentPassword.length < 1) {
                showFieldError('current-password', 'Password saat ini tidak boleh kosong');
                hasErrors = true;
            }
            
            if (newPassword.length < 6) {
                showFieldError('new-password', 'Password baru minimal 6 karakter');
                hasErrors = true;
            }
            
            if (newPassword !== confirmPassword) {
                showFieldError('confirm-password', 'Konfirmasi password tidak cocok');
                hasErrors = true;
            }
            
            if (currentPassword === newPassword && currentPassword.length > 0) {
                showFieldError('new-password', 'Password baru harus berbeda dengan password saat ini');
                hasErrors = true;
            }
            
            if (hasErrors) {
                return;
            }
            
            // Show loading state
            setLoading(true);
            
            // Prepare form data
            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('current_password', currentPassword);
            formData.append('new_password', newPassword);
            formData.append('new_password_confirmation', confirmPassword);
            
            // Use the route from window.routes (passed from Laravel)
            const updatePasswordUrl = window.routes.updatePassword;
            
            // Submit form via AJAX
            fetch(updatePasswordUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(async response => {
                const data = await response.json();
                setLoading(false);
                
                if (response.ok && data.success) {
                    showAlert('success', data.message);
                    // Reset form
                    document.getElementById('changePasswordForm').reset();
                } else {
                    if (data.errors) {
                        // Handle validation errors
                        Object.keys(data.errors).forEach(field => {
                            const fieldId = field.replace('_', '-');
                            showFieldError(fieldId, data.errors[field][0]);
                        });
                    }
                    showAlert('error', data.message || 'Terjadi kesalahan saat mengubah password');
                }
            })
            .catch(error => {
                setLoading(false);
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
            });
        });
        
        function setLoading(loading) {
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingText = document.getElementById('loadingText');
            
            if (loading) {
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
            } else {
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            }
        }
        
        function showAlert(type, message) {
            const alertContainer = document.getElementById('alert-container');
            const alertMessage = document.getElementById('alert-message');
            
            alertContainer.classList.remove('hidden');
            alertMessage.textContent = message;
            
            // Remove previous classes
            alertMessage.classList.remove('bg-green-100', 'text-green-700', 'border-green-400', 'bg-red-100', 'text-red-700', 'border-red-400');
            
            if (type === 'success') {
                alertMessage.classList.add('bg-green-100', 'text-green-700', 'border', 'border-green-400');
            } else {
                alertMessage.classList.add('bg-red-100', 'text-red-700', 'border', 'border-red-400');
            }
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alertContainer.classList.add('hidden');
            }, 5000);
            
            // Scroll to top to show alert
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
        
        function showFieldError(fieldId, message) {
            const errorElement = document.getElementById(fieldId + '-error');
            const inputElement = document.getElementById(fieldId);
            
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
            }
            
            if (inputElement) {
                inputElement.classList.add('border-red-500');
                inputElement.classList.remove('border-gray-300');
            }
        }
        
        function clearErrors() {
            // Clear all error messages
            const errorElements = document.querySelectorAll('[id$="-error"]');
            errorElements.forEach(element => {
                element.classList.add('hidden');
                element.textContent = '';
            });
            
            // Clear error styling from inputs
            const inputElements = document.querySelectorAll('input[type="password"]');
            inputElements.forEach(element => {
                element.classList.remove('border-red-500');
                element.classList.add('border-gray-300');
            });
        }

        // Clear individual field errors on input
        document.querySelectorAll('input[type="password"]').forEach(input => {
            input.addEventListener('input', function() {
                const fieldId = this.id;
                const errorElement = document.getElementById(fieldId + '-error');
                
                if (errorElement && !errorElement.classList.contains('hidden')) {
                    errorElement.classList.add('hidden');
                    errorElement.textContent = '';
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });
        });
    </script>

</body>
</html>