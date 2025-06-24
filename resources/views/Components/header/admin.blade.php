<!-- Navbar -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="flex-1 align-middle">
            <!-- Logo-->
            <div class="flex items-center">
                <img src="{{ asset('assets/logo-wastewise.svg') }}" class="h-12 w-12 bg-green-100 rounded-full" alt="Logo">
                <div class="ml-3">
                    <h1 class="text-[#3D8D7A] font-bold text-lg">WasteWise</h1>
                    <p class="text-xs text-gray-500">"Ubah Sampah Jadi Berkah"</p>
                </div>
            </div>
        </div>
        
        <!-- Menu profile -->
        <div class="dropdown dropdown-end xs:hidden sm:block">
            <!-- Avatar -->
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="{{ asset('assets/adudu.jpeg') }}" />
                </div>
            </label>
            <!-- Menu Account-->
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow rounded-box w-52 bg-white text-black">
                @auth
                    <p class="disabled !text-black text-[14px] text-center font-semibold">
                        {{ Auth::user()->email }}
                    </p>
                    <p class="disabled text-[#808080] text-[14px] text-center">
                       @if(Auth::user()->id_level == 1)
                           Admin
                       @elseif(Auth::user()->id_level == 3)
                           Pengguna
                       @else
                           User
                       @endif
                    </p>
                    <div class="divider my-1"></div>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left text-red-600 hover:bg-red-50">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar Mobile -->
<div id="containerSidebar sm:hidden" class="z-40 top-0">
    <div class="navbar-menu relative z-40">
        <nav id="sidebar" class="fixed top-0 left-0 bottom-0 flex w-4/5 -translate-x-full flex-col overflow-y-auto bg-[#FFFFFF] pt-6 pb-8 overflow-x-hidden">
            <div class="grid mb-2 justify-center align-center items-center justify-items-center">
                <!-- Avatar -->
                <div class="avatar">
                    <div class="w-20 rounded-full">
                        <img src="{{ asset('assets/adudu.jpeg') }}" />
                    </div>
                </div>

                @auth
                    <div>
                        <p class="text-[#000] text-[16px] font-semibold mt-1 px-4 text-center">
                            @if(Auth::user()->id_level == 1)
                                Admin
                            @elseif(Auth::user()->id_level == 3)
                                Pengguna
                            @else
                                User
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray text-[16px]">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm bg-red-500 border-none text-white hover:bg-red-300 mt-2">
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-sm bg-blue-500 border-none text-white hover:bg-blue-300 mt-2">
                            Login
                        </a>
                    </div>
                @endauth
                
                <hr class="solid">
            </div>
        </nav>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- SweetAlert untuk pesan sukses --}}
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>
@endif

{{-- SweetAlert untuk pesan error --}}
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    </script>
@endif
