# Stock-Apps

Stock-Apps is a website-based application designed to help users manage and monitor stock of goods. This application allows users to record, update and view stock information in real-time, thus facilitating the inventory management process and ensuring that the availability of goods is always well monitored.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)
- [Configuration](#configuration)
- [Running Tests](#running-tests)
- [Contributing](#contributing)
- [License](#license)

## Installation

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel
- MySQL
- Laragon

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/username/stock-apps.git
    cd stock-apps
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Copy `.env.example` to `.env` and configure your environment variables:
    ```bash
    cp .env.example .env
    ```

4. Generate application key:
    ```bash
    php artisan key:generate
    ```

5. Set up the database:
    - Create a database in MySQL.
    - Update the `.env` file with your database credentials.
    - Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

6. Serve the application:
    ```bash
    php artisan serve
    ```

## Usage

1. Buka browser dan akses [http://localhost:8000](http://localhost:8000).
2. Login pada halaman.
3. Mulai kelola stok barang dengan fitur yang tersedia.

## Features

- Pencatatan stok barang masuk dan keluar
- Pemantauan stok barang secara real-time
- Laporan stok barang
- Notifikasi stok barang rendah

## Configuration

Konfigurasi aplikasi dapat dilakukan melalui file `.env`. Pastikan untuk mengatur kredensial database dan pengaturan lainnya sesuai kebutuhan.

## Running Tests

Untuk menjalankan tes, gunakan perintah berikut:

```bash
php artisan test
```

## Contributing

- Fork repository ini.
- Buat branch baru untuk fitur atau perbaikan Anda (git checkout -b feature/AmazingFeature).
- Commit perubahan Anda (git commit -m 'Add some AmazingFeature').
- Push ke branch (git push origin feature/AmazingFeature).
- Buka pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
