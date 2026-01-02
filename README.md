# Sistem Manajemen Inventaris dan Aset

Aplikasi manajemen inventaris dan aset tetap yang komprehensif, dibangun dengan Laravel 12 dan Filament v4. Aplikasi ini dirancang untuk mengelola barang persediaan (inventory) dan aset tetap dengan pelacakan stok real-time dan audit trail yang lengkap.

## Fitur Utama

### Manajemen Inventaris
- **Pelacakan Stok Real-time**: Stok barang diperbarui secara otomatis saat terjadi transaksi
- **Identifikasi Unik**: Setiap barang diidentifikasi dengan nama yang unik
- **Kategori Fleksibel**: Dukungan kategori bertipe aset, inventaris, keduanya, atau lainnya
- **Multi-Satuan**: Dukungan berbagai satuan ukuran (pcs, kg, meter, dll)
- **Validasi Stok**: Mencegah stok negatif dengan validasi otomatis

### Manajemen Aset Tetap
- **Register Aset**: Pencatatan aset tetap perusahaan
- **Pelacakan Pembelian**: Harga, tanggal pembelian, dan kondisi aset
- **Kategorisasi**: Pengelompokan aset berdasarkan kategori

### Gerak Barang (Stock Movement)
- **Barang Masuk**: Pencatatan barang yang masuk ke gudang
- **Barang Keluar**: Pencatatan barang yang keluar dari gudang
- **Audit Trail**: Riwayat lengkap setiap transaksi
- **Lampiran**: Dukungan upload dokumen/bukti transaksi

### Keamanan & Otorisasi
- **Role-Based Access Control**: Menggunakan Spatie Shield
- **Policy-Based Authorization**: Kebijakan akses per model
- **User Responsibility**: Setiap transaksi terhubung dengan pengguna

## Teknologi

- **PHP**: 8.3.6
- **Laravel**: 12.x
- **Filament**: 4.x (Admin Panel)
- **Livewire**: 3.x
- **Tailwind CSS**: 4.x
- **MySQL**: Database

## Struktur Database

### Tabel Utama

#### Master Data
- `users` - Pengguna aplikasi
- `categories` - Kategori barang dan aset
- `units` - Satuan ukuran barang
- `items` - Data barang/inventaris
- `assets` - Data aset tetap

#### Transaksi
- `stock_movements` - Header transaksi barang masuk/keluar
- `stock_movement_items` - Detail item dalam setiap transaksi

### Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    %% Master Data Tables
    User ||--o{ StockMovement : creates
    Category ||--o{ Item : categorizes
    Category ||--o{ Asset : categorizes
    Unit ||--o{ Item : measures

    %% Transaction Tables
    StockMovement ||--o{ StockMovementItem : contains
    Item ||--o{ StockMovementItem : "tracked in"

    %% User Table
    User {
        bigint id PK
        string name
        string email
        timestamp email_verified_at
        string password
        remember_token
        timestamps
    }

    %% Category Table
    Category {
        bigint id PK
        string name
        enum type[asset, inventory, both, other]
        timestamps
    }

    %% Unit Table
    Unit {
        bigint id PK
        string name
        timestamps
    }

    %% Item Table
    Item {
        bigint id PK
        string name UK
        string stock
        bigint unit_id FK
        bigint category_id FK
        text description
        timestamps
    }

    %% Asset Table
    Asset {
        bigint id PK
        string name
        bigint category_id FK
        decimal purchase_price
        date purchase_date
        string condition
        text notes
        timestamps
    }

    %% StockMovement Table
    StockMovement {
        bigint id PK
        date movement_date
        enum type[in, out]
        string source
        text notes
        bigint created_by FK
        json attachments
        timestamps
    }

    %% StockMovementItem Table
    StockMovementItem {
        bigint id PK
        bigint stock_movement_id FK
        bigint item_id FK
        decimal quantity
        timestamps
    }
```

### Relasi
```
Category (1) → (N) Item
Category (1) → (N) Asset
Unit (1) → (N) Item
User (1) → (N) StockMovement
StockMovement (1) → (N) StockMovementItem
Item (1) → (N) StockMovementItem
```

## Resource Filament

### Data Master
1. **Kategori** (`/admin/kategori`)
   - Manajemen kategori barang dan aset
   - Tipe: aset, inventaris, keduanya, atau lainnya

2. **Barang** (`/admin/barang`)
   - Manajemen data barang inventaris
   - CRUD lengkap dengan formulir dan tabel
   - Menampilkan level stok saat ini

3. **Aset Tetap** (`/admin/aset-tetap`)
   - Manajemen aset tetap perusahaan
   - Pelacakan detail pembelian dan kondisi

### Sirkulasi Barang
4. **Barang Masuk** (`/admin/barang-masuk`)
   - Pencatatan barang masuk
   - Filter menampilkan hanya transaksi tipe 'in'

5. **Barang Keluar** (`/admin/barang-keluar`)
   - Pencatatan barang keluar
   - Filter menampilkan hanya transaksi tipe 'out'

### Manajemen Pengguna
6. **Akun Pengguna** (`/admin/akun-pengguna`)
   - Manajemen akun pengguna
   - Integrasi dengan role-based permissions

## Instalasi

1. Clone repository
```bash
git clone <repository-url>
cd barang
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database di `.env`
```
DB_DATABASE=barang
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migration & seeder
```bash
php artisan migrate --seed
```

6. Build assets
```bash
npm run build
```

7. Start development server
```bash
php artisan serve
```

## Penggunaan

### Login
Akses aplikasi di `/admin` dan gunakan kredensial dari seeder.

### Menambah Barang
1. Buka menu **Barang** di sidebar
2. Klik tombol **Tambah**
3. Isi nama barang, pilih kategori dan satuan
4. Stok awal dapat diisi langsung

### Mencatat Barang Masuk
1. Buka menu **Barang Masuk**
2. Klik **Tambah Barang Masuk**
3. Pilih tanggal, sumber, dan catatan
4. Tambah item dan jumlahnya
5. Upload lampiran jika diperlukan
6. Stok barang akan diperbarui otomatis

### Mencatat Barang Keluar
1. Buka menu **Barang Keluar**
2. Klik **Tambah Barang Keluar**
3. Pilih tanggal, tujuan, dan catatan
4. Tambah item dan jumlahnya
5. Upload lampiran jika diperlukan
6. Stok barang akan berkurang otomatis

## Observers

Aplikasi menggunakan observers untuk automasi bisnis:

### StockMovementItemObserver
- Menyesuaikan stok barang saat item transaksi dibuat
- Menyesuaikan stok saat item transaksi diubah
- Menyesuaikan stok saat item transaksi dihapus
- Mencegah stok negatif
- Menggunakan quiet updates untuk menghindari loop observer

### StockMovementObserver
- Membersihkan data saat header transaksi dihapus
- Menangani logika bisnis kustom

## Kontribusi

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## Lisensi

Aplikasi ini adalah software proprietary. Hak cipta dilindungi undang-undang.

## Dukungan

Untuk pertanyaan dan dukungan, hubungi tim pengembang.
