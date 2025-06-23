<!-- Navbar -->
<nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex-1 align-middle">
            <!-- Logo-->
            <!-- <div class="flex items-center">
                    <img src="{{ asset('Assets/logo-wastewise.svg') }}" class="h-12 w-12 bg-green-100 rounded-full" alt="Logo">
                    <div class="ml-3">
                        <h1 class="text-green-600 font-bold text-lg">WasteWise</h1>
                        <p class="text-xs text-gray-500">"Ubah Sampah Jadi Berkah"</p>
                    </div>
            </div> -->
        </div>
        
        <!-- Menu profile -->
        <div class="dropdown dropdowns-end xs:hidden sm:block">
            <!-- Avatar -->
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="{{ asset('Assets/adudu.jpeg') }}" />
                </div>
            </label>
            <!-- Menu Account-->
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow rounded-box w-52 bg-white text-black">
                {{-- Dummy user data --}}
                <p class="disabled !text-black text-[14px] text-center">
                    Adelia
                </p>
                <p class="disabled text-[#808080] text-[14px] text-center">
                adminwastewise@gmail.com
                </p>
                <li class="logout"><a href="{{ route('landing-page') }}">Logout</a></li>
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
                        <img src="{{ asset('Assets/adudu.jpeg') }}" />
                    </div>
                </div>

                <div>
                    <p class="text-[#000] text-[16px] font-semibold mt-1 px-4 text-center">Adelia</p>
                </div>
                <div>
                    <p class="text-gray text-[16px]">adminwastewise@gmail.com</p>
                </div>
                <div>
                    <button class="btn btn-sm bg-red-500 border-none text-white hover:bg-red-300 mt-2">
                        <a href="#">Logout</a>
                    </button>
                </div>
                
                <hr class="solid">
            </div>
        </nav>
    </div>
</div>

<script type="text/javascript">
    // Simulasi logout
    document.querySelectorAll('.logout a').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            alert('Logout berhasil!');
        });
    });
</script>