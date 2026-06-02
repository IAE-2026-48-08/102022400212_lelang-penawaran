# Sistem Lelang Service Penawaran

## Fitur Utama

* **RESTful API Standar Kontrak:** Menyediakan 3 *endpoint* utama (Collection, Resource, Action) dengan format *response wrapper* JSON yang konsisten.
* **Header Authentication:** Semua *endpoint* dilindungi menggunakan API Key khusus (`X-IAE-KEY`).
* **Interactive API Documentation:** Dilengkapi dengan Swagger UI (OpenAPI 3.0) menggunakan PHP Attributes terbaru.
* **GraphQL Implementation:** Mendukung kueri GraphQL yang dinamis beserta antarmuka GraphQL Playground untuk pengujian.
* **Dockerized Environment:** Berjalan secara terisolasi menggunakan Docker dan SQLite untuk kemudahan pengujian.

---

## Library & Teknologi

| Komponen | Teknologi / Library |
| :--- | :--- |
| **Framework** | Laravel 11 (PHP 8.2) |
| **Database** | SQLite (Bawaan) |
| **API Documentation** | `darkaonline/l5-swagger` |
| **GraphQL Engine** | `nuwave/lighthouse` |
| **GraphQL UI** | `mll-lab/laravel-graphql-playground` |

---

## Syarat Sistem

* **Docker Engine / Docker Desktop** (Berjalan di latar belakang)
* **Terminal / Windows PowerShell**
* **Git** (Opsional, untuk proses *clone*)

---

## Instalasi Lokal

**1. Clone repository dan masuk ke direktori proyek:**
```powershell
git clone <https://github.com/IAE-2026-48-08/102022400212_lelang-penawaran.git>
cd 102022400212_Penawaran-Service

```

**2. Build dan jalankan container Docker:**

```powershell
docker compose up --build -d

```

**3. Install dependensi PHP via Composer:**

```powershell
docker compose run app composer install

```

**4. Generate Application Key:**

```powershell
docker compose run app php artisan key:generate

```

**5. Siapkan Database SQLite:**

```powershell
# Khusus pengguna Windows PowerShell:
New-Item database/database.sqlite -ItemType File

```

**6. Jalankan Migrasi Database:**

```powershell
docker compose run app php artisan migrate

```

> **Info:** Setelah seluruh proses selesai, API sudah siap digunakan di `http://localhost:8000`.

---

## Dokumentasi & Penggunaan API

### Autentikasi

Seluruh *endpoint* REST maupun GraphQL dilindungi. Anda **wajib** menyertakan *header* berikut pada setiap *request*:

* **Key:** `X-IAE-KEY`
* **Value:** `102022400212`

### Swagger UI (REST API)

Akses antarmuka dokumentasi Swagger untuk menguji *endpoint* REST secara langsung.

* **URL:** `http://localhost:8000/api/documentation`

**Endpoint REST yang tersedia:**

1. `GET /api/v1/bids` (Melihat daftar semua penawaran)
2. `GET /api/v1/bids/{id}` (Melihat detail penawaran spesifik)
3. `POST /api/v1/bids` (Mengajukan penawaran baru dengan *payload* `item_id` dan `bid_amount`)

### GraphQL Playground

Akses antarmuka Playground untuk melakukan kueri data penawaran secara dinamis.

* **URL:** `http://localhost:8000/graphql-playground`

**Cara Pengujian:**

1. Klik tombol **HTTP HEADERS** di pojok kiri bawah Playground.
2. Masukkan header keamanan:
```json
{
  "X-IAE-KEY": "102022400212"
}

```


3. Gunakan kueri berikut di panel kiri untuk mengambil data lelang:
```graphql
query {
  bids {
    id
    item_id
    bid_amount
    status
  }
}

```


4. Tekan tombol **Play** untuk melihat hasilnya.
