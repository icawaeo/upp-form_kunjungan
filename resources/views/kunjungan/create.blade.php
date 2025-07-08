<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #E0F2F1; /* Warna latar belakang hijau mint */
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
            background-color: #00A99D;
            color: white;
            padding: 0.75rem 1.5rem;
            margin-bottom: 1 rem;
            border-radius: 0.5rem;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }
        .file-input-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #D1D5DB;
            border-radius: 0.5rem;
        }
        .file-input-button {
            background-color: #F3F4F6;
            padding: 0.75rem;
            border-right: 1px solid #D1D5DB;
            cursor: pointer;
        }
        .file-input-text {
            padding: 0.75rem;
            flex-grow: 1;
            color: #6B7280;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md mx-4 sm:mx-0">
        <div class="mb-8">
            <img src="img/logo-pln.png" alt="Logo PLN" class="w-10 mt-5 mb-4">
            <h1 class="text-2xl font-bold">Selamat Datang di <br> PT PLN (Persero) UPP SULUT</h1>
            <p class="text-gray-600">Silakan isi formulir dibawah ini!</p>
        </div>

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
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" required>
            </div>
            <div>
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3" class="form-textarea" required></textarea>
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
                <input type="text" id="keperluan" name="keperluan" class="form-input" required>
            </div>
            <div>
                <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                <input type="text" id="nomor_kendaraan" name="nomor_kendaraan" class="form-input" required>
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
        })
    </script>
</body>
</html>