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

1. Open the browser and access [http://localhost:8000](http://localhost:8000).
2. Login on the page.
3. Start managing stock with the available features.

## Features

- Recording of incoming and outgoing stock
- Real-time stock monitoring
- Stock report
- Low stock notification
  
## Configuration

Application configuration can be done via files `.env`. Make sure to set database credentials and other settings as needed.

## Running Tests

To run the test, use the following command:

```bash
php artisan test
```

## Contributing

- Fork this repository.
- Create a new branch for your feature or fix (git checkout -b feature/AmazingFeature).
- Commit your changes (git commit -m 'Add some AmazingFeature').
- Push to branch (git push origin feature/AmazingFeature).
- Open a pull request.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
