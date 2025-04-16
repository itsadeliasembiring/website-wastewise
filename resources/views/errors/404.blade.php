@vite('resources/css/app.css')

<style>
    .img-404 {
        position: relative;
        animation: mymove 2.5s infinite;
    }

    @keyframes mymove {
        33% {
            top: 0px;
        }

        66% {
            top: 20px;
        }

        100% {
            top: 0px
        }
    }
</style>

<div class="flex flex-col bg-gray-100 justify-center align-center items-center min-w-screen min-h-screen">

    <img src="{{ asset('Assets/404.png') }}" class="img-404" style="max-width: 430px" />


    <div class="text-center mb-4">
        <span class="text-black xs:text-[18px] sm:text-[20px] xl:text-[25px] font-semibold">Maaf, halaman yang anda tuju
            tidak
            ditemukan!</span>
    </div>

    <div class="align-center items-center">
        <a href="{{ url()->previous() }}">
            <button
                class="btn text-[#fff] xs:w-[100px] sm:w-[200px] bg-[#3D8D7A] border-[#3D8D7A] hover:border-[#3D8D7A] hover:bg-[#3D8D7A]">Kembali
            </button>
        </a>
    </div>
</div>
