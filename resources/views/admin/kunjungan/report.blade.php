<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Laporan Rekap Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        /* [MODIFIED] Menambahkan style untuk transisi modal */
        .modal { transition: opacity 0.25s ease; }
        .modal-content { transition: transform 0.25s ease, opacity 0.25s ease; }
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
                        class="text-sm font-medium {{ request()->routeIs('admin.kunjungan.index') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-800' }}">
                        <span class="pb-1 {{ request()->routeIs('admin.kunjungan.index') ? 'border-b-2 border-blue-600' : '' }}">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.kunjungan.report') }}" 
                        class="text-sm font-bold {{ request()->routeIs('admin.kunjungan.report') ? 'text-gray-900' : 'text-gray-500 hover:text-gray-800' }}">
                        <span class="pb-1 {{ request()->routeIs('admin.kunjungan.report') ? 'border-b-2 border-blue-600' : '' }}">Laporan Tamu</span>
                    </a>
                    <a href="{{ route('admin.user.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800">
                        <span class="pb-1">Daftar Admin</span>
                    </a>
                    {{-- [MODIFIED] Tombol Logout diubah untuk memanggil modal --}}
                    <a href="#" id="logout-button-desktop" class="text-sm font-medium text-gray-500 hover:text-gray-800">
                        <span class="pb-1">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                     {{ request()->routeIs('admin.kunjungan.index') ? 'bg-blue-50 border-l-4 border-blue-600 text-blue-700' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-200' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.kunjungan.report') }}" 
               class="block rounded-md px-3 py-2 text-base font-medium 
                     {{ request()->routeIs('admin.kunjungan.report') ? 'bg-blue-50 border-l-4 border-blue-600 text-blue-700' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-200' }}">
                Laporan Tamu
            </a>
            <a href="{{ route('admin.user.index') }}"
               class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">
                Daftar Admin
            </a>
            {{-- [MODIFIED] Tombol Logout diubah untuk memanggil modal --}}
            <a href="#" id="logout-button-mobile"
               class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">
                Logout
            </a>
        </div>
    </div>
</nav>
<div class="w-full px-4 sm:px-8">
    <div class="py-8">
        <div class="mb-4">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">Laporan Rekap Tamu</h2>
            <p class="mt-2 text-sm text-gray-600">Filter dan cetak laporan kunjungan tamu.</p>
        </div>
        
        <div class="bg-white p-4 sm:p-6 rounded-lg shadow-md mb-6">
            <form method="GET" action="{{ route('admin.kunjungan.report') }}" id="filter-form">
                <label class="block font-semibold text-gray-700 mb-3">Filter Laporan</label>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-3">
                    <div class="flex-1">
                        <select name="filter_type" id="filter_type" class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="harian" {{ ($filterType ?? 'harian') == 'harian' ? 'selected' : '' }}>Harian</option>
                            <option value="bulanan" {{ ($filterType ?? '') == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                        </select>
                    </div>
                    <div class="flex-1" id="date-filter">
                        <input type="date" name="date" class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $date ?? now()->format('Y-m-d') }}">
                    </div>
                    <div class="flex-1 hidden" id="month-filter">
                        <input type="month" name="month" class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ $month ?? now()->format('Y-m') }}">
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
                    <button type="submit" formaction="{{ route('admin.kunjungan.cetak_pdf') }}" formtarget="_blank" class="px-4 h-9 flex items-center justify-center font-semibold rounded-lg shadow-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm2 0v1h6V4H7zm5 6H8v-1h4v1zm-1 2H8v-1h3v1z" clip-rule="evenodd" /></svg>
                        Cetak PDF
                    </button>
                </div>
            </form>
        </div>

        <div class="shadow-lg rounded-lg overflow-x-auto bg-white">
            <div class="p-4 border-b">
                <h3 class="font-bold text-lg">Laporan untuk periode: {{ $period }}</h3>
                <p class="text-sm text-gray-600">Total Kunjungan: {{ $kunjungans->count() }}</p>
            </div>
            <table class="w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama & Alamat</th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">Jam</th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">Keperluan</th>
                        <th class="px-2 py-3 sm:p-3 border-b-2 border-gray-200 bg-gray-200 text-left text-[11px] sm:text-xs font-semibold text-gray-700 uppercase tracking-wider">No. Kendaraan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kunjungans as $kunjungan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-3 sm:p-3 border-b border-gray-200 bg-white text-xs sm:text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d/m/Y') }}</p>
                        </td>
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 px-5 border-b border-gray-200 bg-white">
                            <p class="text-gray-600 whitespace-no-wrap">Tidak ada data kunjungan untuk periode yang dipilih.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="logout-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden opacity-0 z-[60]">
    <div class="modal-content bg-white rounded-lg shadow-xl w-full max-w-sm p-6 text-center transform scale-95 opacity-0">
        <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Logout</h3>
        <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari sesi ini?</p>
        <div class="flex justify-center gap-4">
            <button id="cancel-logout-button" class="py-2 px-6 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300">Batal</button>
            <button id="confirm-logout-button" class="py-2 px-6 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700">Ya, Logout</button>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const filterTypeSelect = document.getElementById('filter_type');
    const dateFilter = document.getElementById('date-filter');
    const monthFilter = document.getElementById('month-filter');

    function toggleFilterInputs() {
        if (filterTypeSelect.value === 'harian') {
            dateFilter.classList.remove('hidden');
            monthFilter.classList.add('hidden');
        } else {
            dateFilter.classList.add('hidden');
            monthFilter.classList.remove('hidden');
        }
    }

    filterTypeSelect.addEventListener('change', toggleFilterInputs);
    toggleFilterInputs();

    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const openIcon = mobileMenuButton.querySelector('svg:first-child');
    const closeIcon = mobileMenuButton.querySelector('svg:last-child');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });

    const logoutModal = document.getElementById('logout-modal');
    const logoutModalContent = logoutModal.querySelector('.modal-content');
    const logoutButtonDesktop = document.getElementById('logout-button-desktop');
    const logoutButtonMobile = document.getElementById('logout-button-mobile');
    const cancelLogoutButton = document.getElementById('cancel-logout-button');
    const confirmLogoutButton = document.getElementById('confirm-logout-button');
    const logoutForm = document.getElementById('logout-form');

    const openLogoutModal = (e) => {
        e.preventDefault();
        logoutModal.classList.remove('hidden');
        setTimeout(() => {
            logoutModal.classList.remove('opacity-0');
            logoutModalContent.classList.remove('scale-95', 'opacity-0');
            logoutModalContent.classList.add('scale-100');
        }, 10);
    };
    
    const closeLogoutModal = () => {
        logoutModalContent.classList.add('scale-95', 'opacity-0');
        logoutModal.classList.add('opacity-0');
        setTimeout(() => logoutModal.classList.add('hidden'), 250);
    };

    if (logoutButtonDesktop) logoutButtonDesktop.addEventListener('click', openLogoutModal);
    if (logoutButtonMobile) logoutButtonMobile.addEventListener('click', openLogoutModal);
    
    if (cancelLogoutButton) cancelLogoutButton.addEventListener('click', closeLogoutModal);
    if (confirmLogoutButton) confirmLogoutButton.addEventListener('click', () => {
        logoutForm.submit();
    });

    if (logoutModal) logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) {
            closeLogoutModal();
        }
    });
});
</script>

</body>
</html>