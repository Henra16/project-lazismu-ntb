# 🕌 Lazismu NTB — Sistem Manajemen Zakat & Donasi

Platform digital Lembaga Amil Zakat Infak dan Shadaqah Muhammadiyah (LAZISMU) wilayah Nusa Tenggara Barat.

## ⚙️ Tech Stack

- **Framework**: Laravel 12 + Filament 5 (Admin Panel)
- **PHP**: ^8.2
- **Database**: SQLite (development) / MySQL (production)
- **Payment Gateway**: Midtrans
- **Frontend**: Vite + TailwindCSS

---

## 🛠️ Setup Lokal (Development)

```bash
# 1. Clone & install dependencies
composer install
npm install

# 2. Salin file environment
cp .env.example .env

# 3. Generate app key
php artisan key:generate

# 4. Jalankan migrasi
php artisan migrate --seed

# 5. Buat storage link
php artisan storage:link

# 6. Build assets
npm run dev

# 7. Jalankan server
php artisan serve
```

---

## 🚀 Deploy ke Production

### Checklist Wajib Sebelum Deploy

- [ ] Set `APP_ENV=production` di `.env`
- [ ] Set `APP_DEBUG=false` di `.env`
- [ ] Set `APP_URL=https://domain-anda.com` di `.env`
- [ ] Konfigurasi database MySQL di `.env`
- [ ] Set `LOG_LEVEL=error` di `.env`
- [ ] Set `MIDTRANS_IS_PRODUCTION=true` di `.env`

### Commands Production

```bash
# Install dependencies (tanpa devDependencies)
composer install --no-dev --optimize-autoloader

# Build frontend assets
npm run build

# Jalankan migrasi
php artisan migrate --force

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Storage link
php artisan storage:link
```

### Konfigurasi `.env` Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=user_db
DB_PASSWORD=password_aman

LOG_LEVEL=error

MIDTRANS_SERVER_KEY=Mid-server-xxx   # Ganti ke key production
MIDTRANS_CLIENT_KEY=Mid-client-xxx   # Ganti ke key production
MIDTRANS_IS_PRODUCTION=true
```

---

## 🔒 Keamanan

- **Jangan pernah** mengekspos file debug di root project
- **Selalu** pastikan `APP_DEBUG=false` di production
- **Webhook Midtrans** sudah dilindungi signature validation (aktif otomatis di production)
- File `.env` sudah dikecualikan dari `.gitignore`

---

## 💳 Rekomendasi Payment Gateway

Jika ingin mengganti Midtrans, pertimbangkan:

| Gateway | QRIS | Virtual Account | Catatan |
|---------|------|-----------------|---------|
| **Tripay** | 0.5% | Rp 1.500–3.500 | Fee paling murah, mudah diintegrasikan |
| **Duitku** | 0.5% | Rp 2.500/trx | Support e-Wallet |
| **Toyyibpay** | 0.5% | 1% (min Rp 1.000) | Khusus lembaga amil zakat/Islam |

---

## 📄 License

Proyek ini dikembangkan untuk LAZISMU NTB. Seluruh hak cipta dilindungi.
