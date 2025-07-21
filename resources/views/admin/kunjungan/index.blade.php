<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Kunjungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0">
                <a href="{{ route('admin.kunjungan.index') }}" class="flex items-center space-x-3">
                    <img class="h-12 w-auto" src="{{ asset('img/logo-pln.png') }}" alt="Logo PLN">
                    
                    <div>
                        <span class="block text-base font-bold text-gray-800 leading-tight">Admin</span>
                        <span class="block text-sm font-semibold leading-tight" style="color: #0A2342;">PT PLN (Persero) UPP SULUT</span>
                        <span class="hidden sm:block text-xs text-gray-500 leading-tight">Jl. Bethesda No. 32, Ranotana, Kec. Sario, Kota Manado</span>
                    </div>
                </a>
            </div>
            
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-6">
                    
                    <a href="{{ route('admin.kunjungan.index') }}" 
                    class="text-sm font-bold {{ request()->routeIs('admin.kunjungan.index') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-800' }}">
                    <span class="pb-1 {{ request()->routeIs('admin.kunjungan.index') ? 'border-b-2 border-blue-600' : '' }}">
                        Dashboard
                    </span>
                    </a>

                    <a href="{{ route('admin.kunjungan.report') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800">
                        <span class="pb-1">Laporan Tamu</span>
                    </a>
                    
                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-800">
                        <span class="pb-1">Logout</span>
                    </a>

                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button" class="bg-gray-200 inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-200 focus:ring-white">
                    <span class="sr-only">Buka menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            
            <a href="{{ route('admin.kunjungan.index') }}" 
            class="block rounded-md px-3 py-2 text-base font-medium 
                    {{ request()->routeIs('admin.kunjungan.index') 
                        ? 'bg-blue-50 border-l-4 border-blue-600 text-blue-700' 
                        : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-200' }}">
                Dashboard
            </a>

            <a href="{{ route('admin.kunjungan.report') }}" 
            class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">
                Laporan Tamu
            </a>
            
            <a href="#" 
            class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">
                Logout
            </a>

        </div>
    </div>
</nav>

<div class="w-full px-4 sm:px-8">
    <div class="py-8">
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">Overview</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="rounded-xl p-6 shadow-lg text-white transform hover:-translate-y-1 transition-transform duration-300" style="background: linear-gradient(90deg, rgb(15, 157, 150) 0%, rgb(4, 133, 126) 100%);">
                    <p class="font-semibold text-gray-100">Total Tamu</p>
                    <p class="text-4xl font-bold mt-1">{{ $visitorCount }}</p>
                    <p class="text-sm font-medium text-gray-200 mt-1">{{ $displayDate }}</p>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">Detail Kunjungan Tamu</h2>
            <p class="mt-2 text-sm text-gray-600">Menampilkan daftar kunjungan untuk tanggal {{ $displayDate }}.</p>
        </div>
        
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
            <form method="GET" action="{{ route('admin.kunjungan.index') }}">
                <label class="block font-semibold text-gray-700 mb-3">Filter Data</label>
                
                <div class="flex flex-row gap-4 mb-3"> 
                    <div class="flex-1">
                        <input placeholder="Cari nama..." name="nama_lengkap"
                            class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                            value="{{ request('nama_lengkap') }}" />
                    </div>
                    <div class="flex-1">
                        <input type="date" name="tanggal"
                            class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"
                            value="{{ request('tanggal', now()->format('Y-m-d')) }}" />
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="px-4 h-9 flex items-center justify-center font-semibold rounded-lg shadow-md text-white bg-[#0a2342] hover:bg-[#093e46] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Cari
                    </button>
                    <a href="{{ route('admin.kunjungan.index') }}"
                    class="h-9 px-4 flex items-center bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 text-sm whitespace-nowrap">
                        Reset Filter
                    </a>
                </div>
            </form>
        </div>
        
        <div class="flex justify-end mb-6">
            <a href="{{ route('kunjungan.create') }}" class="py-2 px-4 bg-[#133e74] text-white font-semibold rounded-lg shadow-md hover:bg-[#0a2342] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                + Tambah Kunjungan
            </a>
       </div>
        
        <div class="shadow-lg rounded-lg overflow-x-auto bg-white">
            <table class="w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Nama & Alamat
                        </th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Jam
                        </th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Keperluan
                        </th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            No. Kendaraan
                        </th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-center text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Foto
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kunjungans as $kunjungan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-xs sm:text-sm">
                            <p class="text-gray-900 font-bold whitespace-no-wrap">{{ $kunjungan->nama_lengkap }}</p>
                            <p class="text-gray-600">{{ $kunjungan->alamat }}</p>
                        </td>
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-xs sm:text-sm sm:whitespace-nowrap">
                            <p class="text-gray-800">Datang: {{ \Carbon\Carbon::parse($kunjungan->jam_datang)->format('H:i') }}</p>
                            <p class="text-gray-800">Pulang: {{ \Carbon\Carbon::parse($kunjungan->jam_kembali)->format('H:i') }}</p>
                        </td>
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-xs sm:text-sm">
                            <p class="text-gray-900">{{ $kunjungan->keperluan }}</p>
                        </td>
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-xs sm:text-sm sm:whitespace-nowrap">
                            <p class="text-gray-900">{{ $kunjungan->nomor_kendaraan }}</p>
                        </td>
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-sm text-center">
                            <button type="button" class="photo-modal-trigger mx-auto">
                                <img src="{{ asset($kunjungan->foto) }}" alt="Foto Tamu" class="w-10 h-10 object-cover rounded-md transition-transform duration-300 hover:scale-110" data-full-src="{{ asset($kunjungan->foto) }}">
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 px-5 border-b border-gray-200 bg-white">
                            <p class="text-gray-600 whitespace-no-wrap">Tidak ada data kunjungan untuk tanggal yang dipilih.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex justify-center items-center p-4">
    <div class="relative bg-white p-4 rounded-lg shadow-lg max-w-xs w-full">
        <button id="closeImageModal" class="absolute -top-3 -right-3 bg-white text-black h-8 w-8 rounded-full flex items-center justify-center text-2xl font-bold leading-none">&times;</button>
        <img id="modalImage" src="" alt="Foto Kunjungan" class="object-contain w-full max-h-[85vh]">
    </div>
</div>

<footer class="bg-white shadow-inner mt-10 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} PT PLN (Persero) UPP SULUT. All rights reserved.
        </p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const closeImageModalBtn = document.getElementById('closeImageModal');
        const photoTriggers = document.querySelectorAll('.photo-modal-trigger');

        const openModal = (fullSrc) => {
            modalImage.setAttribute('src', fullSrc);
            imageModal.classList.remove('hidden');
        };

        const closeModal = () => {
            imageModal.classList.add('hidden');
            modalImage.setAttribute('src', ''); 
        };

        photoTriggers.forEach(trigger => {
            trigger.addEventListener('click', function () {
                const fullSrc = this.querySelector('img').dataset.fullSrc;
                openModal(fullSrc);
            });
        });
        closeImageModalBtn.addEventListener('click', closeModal);
        imageModal.addEventListener('click', (event) => (event.target === imageModal) && closeModal());
    });

    // #### SCRIPT BARU UNTUK NAVBAR ####
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const openIcon = mobileMenuButton.querySelector('svg:first-child');
    const closeIcon = mobileMenuButton.querySelector('svg:last-child');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>

</body>
</html>