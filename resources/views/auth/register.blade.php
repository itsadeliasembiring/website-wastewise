<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WasteWise - Login</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <div class="grid lg:grid-cols-2 gap-8 w-full max-w-6xl px-4">
            <!-- Left Column with Image and Brand -->
            <div class="flex flex-col justify-center items-center bg-[#A3D1C6] bg-opacity-50 rounded-3xl p-8 order-2 lg:order-1">
                <div class="text-center mb-6">
                    <h1 class="text-[#3D8D7A] text-4xl font-bold mb-1">WasteWise</h1>
                    <p class="text-emerald-700 italic">"Ubah Sampah Jadi Berkah"</p>
                </div>
                <div class="w-full max-w-sm">
                    <img src="{{ asset('Assets/maskot.png') }}"  alt="WasteWise Mascot" class="w-full h-auto">
                </div>
            </div>
            
            <!-- Right Column with Login Form -->
            <div class="flex flex-col justify-center bg-white p-8 shadow-lg rounded-3xl order-1 lg:order-2">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Halo, WasteWarriors!</h2>
                </div>
                
                <form  class="space-y-6">
                    @csrf
                     <!-- Nama Field -->
                     <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input id="nama" type="text" name="nama" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Nama Lengkap">
                    </div>
                    <!-- Jenis Kelamin Field -->
                    <div>
                        <label for="jenis-kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select id="jenis-kelamin" name="jenis-kelamin" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir Field -->
                    <div>
                        <label for="tanggal-lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input id="tanggal-lahir" type="date" name="tanggal-lahir" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition">
                    </div>
                     <!-- Alamat Lengkap Field -->
                     <div>
                        <label for="alamat-lengkap" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <input id="alamat-lengkap" type="text" name="alamat-lengkap" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Alamat Lengkap">
                    </div>
                    <!-- Nomor Telepon Field -->
                    <div>
                        <label for="nomor-telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input id="nomor-telepon" type="text" name="nomor-telepon" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Nomor Telepon">
                    </div>
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Email">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="konfirmasi-password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="konfirmasi-password" type="konfirmasi-password" name="konfirmasi-password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#3D8D7A] focus:border-[#3D8D7A] transition"
                            placeholder="Konfirmasi Password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" 
                                class="h-4 w-4 rounded border-gray-300 text-[#3D8D7A] focus:ring-[#3D8D7A]">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Saya telah membaca Kebijakan privasi.</label>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                            class="w-full bg-[#3D8D7A] hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                            Register
                        </button>
                    </div>
                </form>
                
                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">
                        Sudah memiliki akun? 
                        <a href="{{ route('login') }}" class="text-[#3D8D7A] hover:text-[#3D8D7A] font-medium">
                            Login sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>