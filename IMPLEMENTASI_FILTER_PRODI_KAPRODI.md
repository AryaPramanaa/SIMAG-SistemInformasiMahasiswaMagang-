# Implementasi Filter Prodi untuk Kaprodi

## Deskripsi
Implementasi ini memastikan bahwa kaprodi hanya dapat melihat dan mengelola data pengajuan PKL mahasiswa yang berasal dari program studi yang sama dengan prodi yang mereka kelola.

## Perubahan yang Dilakukan

### 1. Modifikasi Controller pengajuanPKLKapordiController
- **File**: `app/Http/Controllers/pengajuanPKLKapordiController.php`
- **Perubahan**:
  - Menambahkan validasi user yang sedang login
  - Memfilter data berdasarkan prodi kaprodi yang sedang login
  - Menambahkan validasi prodi di semua method (index, show, edit, update, destroy)

### 2. Modifikasi Controller RekapMahasiswaPKLKaprodiController
- **File**: `app/Http/Controllers/RekapMahasiswaPKLKaprodiController.php`
- **Perubahan**:
  - Menambahkan filter berdasarkan prodi kaprodi yang sedang login
  - Memastikan hanya data mahasiswa dari prodi yang sama yang ditampilkan

### 3. Modifikasi Controller PembimbingAkademikController
- **File**: `app/Http/Controllers/PembimbingAkademikController.php`
- **Perubahan**:
  - Menambahkan filter pembimbing akademik berdasarkan prodi kaprodi
  - Validasi bahwa kaprodi hanya dapat mengelola pembimbing akademik untuk prodi mereka
  - Membatasi mahasiswa yang dapat di-assign hanya dari prodi yang sama

### 4. Modifikasi Middleware CheckRole
- **File**: `app/Http/Middleware/CheckRole.php`
- **Perubahan**:
  - Menambahkan validasi khusus untuk role kaprodi
  - Memastikan user kaprodi memiliki data prodi yang valid

### 5. Update Routes
- **File**: `routes/web.php`
- **Perubahan**:
  - Menambahkan middleware `role:kaprodi` untuk semua route kaprodi
  - Memastikan hanya user dengan role kaprodi yang dapat mengakses halaman kaprodi

### 6. Update View Dashboard Kaprodi
- **File**: `resources/views/backend/dashboard/kaprodi.blade.php`
- **Perubahan**:
  - Menampilkan nama prodi di sidebar user info
  - Memberikan informasi visual tentang prodi yang dikelola

### 7. Update View Index Pengajuan PKL
- **File**: `resources/views/backend/kaprodi/pengajuanPKLkaprodi/index.blade.php`
- **Perubahan**:
  - Menambahkan informasi prodi di header halaman
  - Menambahkan kolom Program Studi di tabel
  - Menambahkan pesan error untuk menampilkan error session

## Cara Kerja

### 1. Autentikasi dan Validasi
```php
// Ambil user yang sedang login
$user = Auth::user();
$prodi = $user->prodi;

// Validasi bahwa user memiliki data prodi
if (!$prodi) {
    return redirect()->back()->with('error', 'Data prodi tidak ditemukan untuk akun ini.');
}
```

### 2. Filter Data Berdasarkan Prodi
```php
// Query dengan filter berdasarkan prodi kaprodi
$query = pengajuanPKL::with(['mahasiswa.prodi', 'perusahaan'])
    ->whereHas('mahasiswa.prodi', function($q) use ($prodi) {
        $q->where('nama_prodi', $prodi->nama_prodi);
    });
```

### 3. Validasi Akses
```php
// Validasi bahwa pembimbing akademik sesuai dengan prodi kaprodi
if ($pembimbingAkademik->prodi->nama_prodi !== $prodi->nama_prodi) {
    return redirect()->back()->with('error', 'Anda tidak memiliki akses ke pembimbing akademik ini.');
}
```

## Keamanan

### 1. Middleware Protection
- Semua route kaprodi dilindungi dengan middleware `role:kaprodi`
- Validasi tambahan untuk memastikan user memiliki data prodi

### 2. Data Isolation
- Kaprodi hanya dapat melihat data dari prodi mereka sendiri
- Tidak ada kemungkinan akses cross-prodi

### 3. Input Validation
- Validasi bahwa prodi_id yang dipilih sesuai dengan prodi kaprodi
- Mencegah manipulasi data melalui form input

## Testing

### 1. Test Case 1: Kaprodi Login
- Login sebagai kaprodi dengan prodi tertentu
- Pastikan hanya data mahasiswa dari prodi tersebut yang ditampilkan

### 2. Test Case 2: Akses Cross-Prodi
- Coba akses data mahasiswa dari prodi lain
- Pastikan akses ditolak dengan pesan error yang sesuai

### 3. Test Case 3: Pembimbing Akademik
- Pastikan kaprodi hanya dapat mengelola pembimbing akademik untuk prodi mereka
- Pastikan hanya mahasiswa dari prodi yang sama yang dapat di-assign

## Dependencies

### 1. Model Relationships
- `User` → `Prodi` (hasOne)
- `Mahasiswa` → `Prodi` (belongsTo)
- `PembimbingAkademik` → `Prodi` (belongsTo)

### 2. Database Requirements
- Tabel `users` harus memiliki kolom `role`
- Tabel `prodis` harus memiliki kolom `user_id` untuk relasi dengan user kaprodi
- Tabel `mahasiswas` harus memiliki kolom `prodi_id`

## Error Handling

### 1. Prodi Not Found
```php
if (!$prodi) {
    return redirect()->back()->with('error', 'Data prodi tidak ditemukan untuk akun ini.');
}
```

### 2. Unauthorized Access
```php
if ($pembimbingAkademik->prodi->nama_prodi !== $prodi->nama_prodi) {
    return redirect()->back()->with('error', 'Anda tidak memiliki akses ke pembimbing akademik ini.');
}
```

### 3. Invalid Prodi Selection
```php
if ($selectedProdi->nama_prodi !== $prodi->nama_prodi) {
    return redirect()->back()->with('error', 'Anda hanya dapat menambahkan pembimbing akademik untuk prodi Anda sendiri.');
}
```

## Kesimpulan

Implementasi ini berhasil memastikan bahwa:
1. Kaprodi hanya dapat melihat data mahasiswa dari prodi mereka sendiri
2. Keamanan data terjaga dengan baik melalui multiple layer validation
3. User experience tetap baik dengan pesan error yang informatif
4. Sistem dapat diandalkan untuk mencegah akses yang tidak sah 