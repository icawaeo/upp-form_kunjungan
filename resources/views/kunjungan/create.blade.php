<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kunjungan Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e0f2f1;
            font-family: 'Open Sans', sans-serif;
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
        /* [MODIFIED] Gaya untuk border input yang error */
        .input-error {
            border-color: #EF4444; /* Warna merah */
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md mx-4 sm:mx-0 mt-5 mb-8">
        <div class="p-4 rounded-lg mb-8" style="background-color: #093e46; background-image: url('{{ asset('img/cover-header.jpg') }}'); background-size: cover; background-position: center;">
            <div class="flex justify-between items-center bg-[#093e46] rounded-lg p-5">
                <img src="{{ asset('img/logo-pln.png') }}" alt="Logo PLN" class="w-10 sm:w-20 h-auto flex-shrink-0 mr-3">
                <div>
                    <h1 style="color: #d6dde6;" class="leading-tight">
                        <span class="block text-[13px] font-regular">Selamat Datang di</span>
                        <span class="block text-[15px] sm:text-[20px] font-bold">PT PLN (Persero) UPP SULUT</span>
                        <span class="block text-[10px] font-normal">Jl. Bethesda No. 32, Ranotana, Kec. Sario, Kota Manado, Sulawesi Utara</span>
                    </h1>
                </div>
            </div>
        </div>
        <h2 class="text-xl font-bold mb-3">Form Kunjungan Tamu</h2>
        <p class="text-gray-700 text-xs sm:text-sm font-light mb-6">Silakan isi formulir dibawah ini!</p>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi Kesalahan!</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="kunjungan-form" action="{{ route('kunjungan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf
            <div>
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="text" id="tanggal" name="tanggal" class="form-input bg-gray-200" required readonly>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="tanggal-error">Kolom tanggal wajib diisi.</p>
            </div>
            <div>
                <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" placeholder="Masukkan nama Anda" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="nama_lengkap-error">Kolom nama lengkap wajib diisi.</p>
            </div>
            <div>
                <label for="instansi" class="form-label">Instansi <span class="text-red-500">*</span></label>
                <input type="text" id="instansi" name="instansi" class="form-input" placeholder="Masukkan nama instansi/perusahaan" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="instansi-error">Kolom instansi wajib diisi.</p>
            </div>
            <div>
                <label for="alamat" class="form-label">Alamat <span class="text-red-500">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="form-textarea" placeholder="Masukkan alamat Anda" required></textarea>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="alamat-error">Kolom alamat wajib diisi.</p>
            </div>
            <div>
                <label for="jam_datang" class="form-label">Jam Datang <span class="text-red-500">*</span></label>
                <input type="time" id="jam_datang" name="jam_datang" class="form-input" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="jam_datang-error">Kolom jam datang wajib diisi.</p>
            </div>
            {{-- <div>
                <label for="jam_kembali" class="form-label">Jam Kembali</label>
                <input type="time" id="jam_kembali" name="jam_kembali" class="form-input" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="jam_kembali-error">Kolom jam kembali wajib diisi.</p>
            </div> --}}
            <div>
                <label for="keperluan" class="form-label">Keperluan <span class="text-red-500">*</span></label>
                <input type="text" id="keperluan" name="keperluan" class="form-input" placeholder="Jelaskan keperluan Anda" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="keperluan-error">Kolom keperluan wajib diisi.</p>
            </div>
            <div>
                <label for="nomor_kendaraan" class="form-label">Nomor Kendaraan</label>
                <input type="text" id="nomor_kendaraan" name="nomor_kendaraan" class="form-input" placeholder="Contoh: DB 1234 AB">
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="nomor_kendaraan-error">Kolom nomor kendaraan wajib diisi.</p>
            </div>
            <div>
                <label for="foto" class="form-label">Upload Foto Anda <span class="text-red-500">*</span></label>
                <div class="file-input-wrapper">
                    <label for="foto-upload" class="file-input-button">Unggah Foto</label>
                    <span id="file-chosen" class="file-input-text">Belum ada file dipilih</span>
                </div>
                <input type="file" id="foto-upload" name="foto" class="hidden" accept="image/*" capture="camera" required>
                <p class="text-red-500 text-xs mt-1 hidden error-message" id="foto-upload-error">Anda harus mengunggah foto.</p>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script>
        const form = document.getElementById('kunjungan-form');
        const fotoUpload = document.getElementById('foto-upload');
        const fileChosen = document.getElementById('file-chosen');
        
        fotoUpload.addEventListener('change', function(){
            if (this.files.length > 0) {
                fileChosen.textContent = this.files[0].name;
                document.getElementById('foto-upload-error').classList.add('hidden');
                document.querySelector('.file-input-wrapper').classList.remove('input-error');
            }
        });

        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            form.querySelectorAll('.error-message').forEach(el => el.classList.add('hidden'));
            form.querySelectorAll('.form-input, .form-textarea, .file-input-wrapper').forEach(el => el.classList.remove('input-error'));

            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                const isFile = field.type === 'file';
                const errorElement = document.getElementById(field.id + '-error');

                if ((isFile && field.files.length === 0) || (!isFile && !field.value.trim())) {
                    isValid = false;
                    if (errorElement) {
                        errorElement.classList.remove('hidden');
                    }
                    const fieldWrapper = isFile ? field.previousElementSibling : field;
                    fieldWrapper.classList.add('input-error');
                }
            });

            if (!isValid) {
                event.preventDefault(); 
                const firstError = form.querySelector('.input-error');
                if(firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
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