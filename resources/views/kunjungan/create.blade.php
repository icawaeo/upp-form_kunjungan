<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #e0f2f1;
        }
        .form-container {
            background-color: #FFFFFF;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .form-input, .form-textarea {
            border-radius: 0.5rem;
            border: 1px solid #D1D5DB;
            padding: 0.75rem;
            width: 100%;
        }
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }
        .btn-submit {
            background-color: #0a2342;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }
        .file-input-wrapper {
            display: grid;
            grid-template-columns: auto 1fr;
            align-items: center;
            border: 1px solid #D1D5DB;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .file-input-button {
            background-color: #F3F4F6;
            padding: 0.75rem;
            border-right: 1px solid #D1D5DB;
            cursor: pointer;
            white-space: nowrap; 
        }
        .file-input-text {
            padding: 0.75rem;
            flex-grow: 1;
            color: #6B7280;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md mx-4 sm:mx-0 mt-5 mb-8">
        <div class="p-4 rounded-lg mb-8" style="background-color: #093e46; background-image: url('{{ asset('img/cover-header.jpg') }}'); background-size: cover; background-position: center;">
            <div class="flex justify-between items-center bg-[#093e46] rounded-lg p-2">
            <img src="{{ asset('img/logo-pln.png') }}" alt="Logo PLN" class="w-10 sm:w-20 h-auto flex-shrink-0 mr-3">
            <div>
                <h1 style="color: #d6dde6;">
                    <span class="block text-base font-medium">Selamat Datang di</span>
                    <span class="block text-xl sm:text-3xl font-bold">PT PLN (Persero) UPP SULUT</span>
                </h1>
                <p class="text-[#d1d1d1] text-xs sm:text-sm font-light">Silakan isi formulir dibawah ini!</p>
            </div>
            </div>
        </div>

        <h2 class="text-xl font-bold">Form Kunjungan Tamu</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('kunjungan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-input" required>
            </div>
            <div>
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" placeholder="Masukkan nama Anda" required>
            </div>
            <div>
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" class="form-textarea" placeholder="Masukkan alamat Anda" required></textarea>
            </div>
            <div>
                <label for="jam_datang" class="form-label">Jam Datang</label>
                <input type="time" id="jam_datang" name="jam_datang" class="form-input" required>
            </div>
            <div>
                <label for="jam_kembali" class="form-label">Jam Kembali</label>
                <input type="time" id="jam_kembali" name="jam_kembali" class="form-input" required>
            </div>
            <div>
                <label for="keperluan" class="form-label">Keperluan</label>
                <input type="text" id="keperluan" name="keperluan" class="form-input" placeholder="Jelaskan keperluan Anda" required>
            </div>
            <div>
                <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                <input type="text" id="nomor_kendaraan" name="nomor_kendaraan" class="form-input" placeholder="Contoh: DB 1234 AB" required>
            </div>
            <div>
                <label for="foto" class="form-label">Upload Foto Anda</label>
                <div class="file-input-wrapper">
                    <label for="foto-upload" class="file-input-button">Unggah Foto</label>
                    <span id="file-chosen" class="file-input-text">Belum ada file dipilih</span>
                </div>
                <input type="file" id="foto-upload" name="foto" class="hidden" accept="image/*" capture="camera" required>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script>
        const fotoUpload = document.getElementById('foto-upload');
        const fileChosen = document.getElementById('file-chosen');

        fotoUpload.addEventListener('change', function(){
            fileChosen.textContent = this.files[0].name
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); 
            const dd = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;
            document.getElementById('tanggal').value = formattedDate;
        });
    </script>
</body>
</html>