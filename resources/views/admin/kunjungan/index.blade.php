<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Kunjungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="w-full px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight text-gray-800">Daftar Kunjungan Tamu</h2>
            <div class="my-5">
                 <p class="text-sm text-gray-600">Guest</p>
                 <p class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::now()->format('d M, Y') }}</p>
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            
            <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                <form method="GET" action="{{ route('admin.kunjungan.index') }}">
                    <label class="block font-semibold text-gray-700 mb-3">Filter berdasarkan:</label>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-3">
                        <div class="flex-1">
                            <input placeholder="Nama pengunjung..." name="nama_lengkap"
                                   class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                   value="{{ request('nama_lengkap') }}" />
                        </div>
                        <div class="flex-1">
                            <input type="date" name="tanggal"
                                   class="appearance-none rounded-lg border border-gray-300 block px-4 py-2 w-full bg-white text-sm text-gray-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200"
                                   value="{{ request('tanggal') }}" />
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="p-2 w-10 h-10 flex items-center justify-center bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <a href="{{ route('admin.kunjungan.index') }}"
                           class="h-10 px-4 flex items-center bg-gray-200 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75 text-sm whitespace-nowrap">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="flex justify-end mb-4">
                 <a href="{{ route('kunjungan.create') }}" class="py-2 px-4 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">
                    + Buat Kunjungan
                </a>
            </div>

            <div class="shadow-lg rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama & Alamat
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Tanggal & Jam
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Keperluan
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                No. Kendaraan
                            </th>
                             <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kunjungans as $kunjungan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-xs">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $kunjungan->nama_lengkap }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">{{ $kunjungan->alamat }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-xs">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d M Y') }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">Datang: {{ $kunjungan->jam_datang }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">Kembali: {{ $kunjungan->jam_kembali }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-xs">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $kunjungan->keperluan }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-xs">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $kunjungan->nomor_kendaraan }}</p>
                            </td>
                            <td class="px-5 py-4 border-b border-gray-200 bg-white text-xs">
                                <a href="{{ asset($kunjungan->foto) }}" target="_blank">
                                    <img src="{{ asset($kunjungan->foto) }}" alt="Foto Tamu" class="w-16 h-16 object-cover rounded-md transition-transform duration-300 hover:scale-110">
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 px-5 border-b border-gray-200 bg-white">
                                <p class="text-gray-900 whitespace-no-wrap">Data tidak ditemukan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                 <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                     {{ $kunjungans->links() }}
                </div>
            </div>
        </div> </div>
</div>

</body>
</html>