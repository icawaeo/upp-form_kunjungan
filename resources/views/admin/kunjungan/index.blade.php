<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Kunjungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Daftar Kunjungan Tamu</h2>
        </div>

        <form method="GET" action="{{ route('admin.kunjungan.index') }}" class="my-4 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative">
                    <input placeholder="Filter nama..." name="nama_lengkap"
                           class="appearance-none rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                           value="{{ request('nama_lengkap') }}" />
                </div>
                <div class="relative">
                    <input type="date" name="tanggal"
                           class="appearance-none rounded-r sm:rounded-r-none border border-gray-400 border-b block pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
                           value="{{ request('tanggal') }}" />
                </div>
            </div>
            <div class="block relative">
                <button type="submit"
                    class="ml-2 py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Cari
                </button>
                <a href="{{ route('admin.kunjungan.index') }}"
                    class="ml-2 py-2 px-4 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-75">
                    Reset
                </a>
            </div>
        </form>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama & Alamat Pengunjung
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal & Jam Kunjungan
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Keperluan
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                No. Kendaraan
                            </th>
                             <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kunjungans as $kunjungan)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $kunjungan->nama_lengkap }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">{{ $kunjungan->alamat }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ \Carbon\Carbon::parse($kunjungan->tanggal)->format('d M Y') }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">Datang: {{ $kunjungan->jam_datang }}</p>
                                <p class="text-gray-600 whitespace-no-wrap">Kembali: {{ $kunjungan->jam_kembali }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $kunjungan->keperluan }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $kunjungan->nomor_kendaraan }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <a href="{{ asset($kunjungan->foto) }}" target="_blank">
                                    <img src="{{ asset($kunjungan->foto) }}" alt="Foto Tamu" class="w-20 h-20 object-cover rounded">
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 px-5 border-b border-gray-200 bg-white text-sm">
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
        </div>
    </div>
</div>

</body>
</html>