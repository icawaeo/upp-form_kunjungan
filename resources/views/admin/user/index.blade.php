<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Open Sans', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
        .modal-content { transition: transform 0.25s ease; }
    </style>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow-md sticky top-0 z-50">
    {{-- Kode Navbar tidak berubah --}}
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
                    <a href="{{ route('admin.kunjungan.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800"><span class="pb-1">Dashboard</span></a>
                    <a href="{{ route('admin.kunjungan.report') }}" class="text-sm font-medium text-gray-500 hover:text-gray-800"><span class="pb-1">Laporan Tamu</span></a>
                    <a href="{{ route('admin.user.index') }}" class="text-sm font-bold text-gray-900"><span class="pb-1 border-b-2 border-blue-600">Daftar Admin</span></a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); if(confirm('Anda yakin ingin logout?')) { document.getElementById('logout-form-desktop').submit(); }"
                        class="text-sm font-medium text-gray-500 hover:text-gray-800"><span class="pb-1">Logout</span></a>
                    <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button id="mobile-menu-button" type="button" class="bg-gray-200 inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-200 focus:ring-white">
                    <span class="sr-only">Buka menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('admin.kunjungan.index') }}" class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('admin.kunjungan.report') }}" class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">Laporan Tamu</a>
            <a href="{{ route('admin.user.index') }}" class="block rounded-md px-3 py-2 text-base font-medium bg-blue-50 border-l-4 border-blue-600 text-blue-700">Daftar Admin</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); if(confirm('Anda yakin ingin logout?')) { document.getElementById('logout-form-mobile').submit(); }" class="block rounded-md px-3 py-2 text-base font-medium border-l-4 border-transparent text-gray-600 hover:bg-gray-200">Logout</a>
            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>
    </div>
</nav>

<div class="w-full px-4 sm:px-8">
    <div class="py-8">
        
        {{-- [MODIFIED] Bagian ini diubah untuk mengatur posisi tombol --}}
        {{-- highlight-start --}}
        <div class="mb-4">
            <h2 class="text-2xl font-bold leading-tight text-gray-800">Daftar Admin</h2>
            <p class="mt-2 text-sm text-gray-600">Daftar semua admin yang terdaftar.</p>
        </div>
        
        <div class="flex justify-end mb-4">
            <button id="add-user-button" class="py-2 px-4 text-sm bg-[#133e74] text-white font-semibold rounded-lg shadow-md hover:bg-[#0a2342] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                + Tambah Admin
            </button>
        </div>
        {{-- highlight-end --}}

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->has('error'))
             <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ $errors->first('error') }}</p>
            </div>
        @endif


        <div class="shadow-lg rounded-lg overflow-x-auto bg-white">
            <table class="w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}</p></td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm"><p class="text-gray-900 whitespace-no-wrap">{{ $user->email }}</p></td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm whitespace-nowrap">
                            <div class="flex items-center space-x-4">
                                <button class="edit-user-button text-indigo-600 hover:text-indigo-900" data-id="{{ $user->id }}">Edit</button>
                                @if(auth()->id() !== $user->id)
                                <form action="{{ route('admin.user.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-10 px-5 border-b"><p>Tidak ada data admin.</p></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="user-modal" class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden opacity-0 z-50">
    <div class="modal-content bg-white rounded-lg shadow-xl w-full max-w-md p-6 transform -translate-y-10">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modal-title" class="text-xl font-bold">Tambah Admin Baru</h3>
            <button id="close-modal-button" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <form id="user-form" method="POST">
            @csrf
            <div id="modal-method"></div>
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                    <p id="password-hint" class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm">
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" id="cancel-button" class="bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if(mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        const modal = document.getElementById('user-modal');
        const modalContent = modal.querySelector('.modal-content');
        const addUserButton = document.getElementById('add-user-button');
        const closeModalButton = document.getElementById('close-modal-button');
        const cancelButton = document.getElementById('cancel-button');
        const editUserButtons = document.querySelectorAll('.edit-user-button');
        const form = document.getElementById('user-form');
        const modalTitle = document.getElementById('modal-title');
        const modalMethod = document.getElementById('modal-method');
        const passwordInput = document.getElementById('password');
        const passwordHint = document.getElementById('password-hint');
        const openModal = () => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('-translate-y-10');
            }, 10);
        };
        const closeModal = () => {
            modalContent.classList.add('-translate-y-10');
            modal.classList.add('opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 250);
        };
        const setupAddForm = () => {
            form.action = "{{ route('admin.user.store') }}";
            modalTitle.textContent = 'Tambah Admin Baru';
            modalMethod.innerHTML = '';
            form.reset();
            passwordInput.setAttribute('required', 'required');
            passwordHint.classList.add('hidden');
            openModal();
        };
        const setupEditForm = (user) => {
            form.action = `/admin/user/${user.id}`;
            modalTitle.textContent = 'Edit Admin';
            modalMethod.innerHTML = `<input type="hidden" name="_method" value="PUT">`;
            form.querySelector('#name').value = user.name;
            form.querySelector('#email').value = user.email;
            passwordInput.removeAttribute('required');
            passwordHint.classList.remove('hidden');
            openModal();
        };
        addUserButton.addEventListener('click', setupAddForm);
        editUserButtons.forEach(button => {
            button.addEventListener('click', async () => {
                const userId = button.dataset.id;
                try {
                    const response = await fetch(`/admin/user/${userId}/edit`);
                    if (!response.ok) throw new Error('Gagal mengambil data user');
                    const user = await response.json();
                    setupEditForm(user);
                } catch (error) {
                    console.error(error);
                    alert(error.message);
                }
            });
        });
        closeModalButton.addEventListener('click', closeModal);
        cancelButton.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal();
            }
        });
    });
</script>

</body>
</html>