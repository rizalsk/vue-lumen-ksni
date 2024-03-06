# Lumen 10 - Backend

---

This is a Lumen App based on [Lumen Framework](https://lumen.laravel.com/docs/10.x).

## Prerequisites

1. PHP 8.1 - 8.3
1. MySQL, Postgre, SQLite
1. [Composer](http://getcomposer.org)
## Getting Started

1. Clone project kedalam local dir.

	```
	git clone http://
	```

1. Masuk ke dalam directory Backend.

	```
	cd rz-backend

1. Hapus init `.git` dari direktori.

	```
	rm -rf !$/.git
	```

1. Install composer dependencies.

	```
	composer install
	```
	

1. Membuat file database sqlite didalam folder `/database`, jika menggunakan sqlite:
    ```
	touch database/data.sqlite
	```

1. membuat file konfigurasi `.env` (copas dari `.env.example`):
    ```
	cp .env.example .env
	```

	```

    ##SQLite
    DB_DATABASE=data.sqlite

    ##atau

	##MySQL
    DB_DRIVER=mysql
	DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
		
	```

1. Generate key baru untuk aplikasi.
	```
	php artisan key:generate
	```

1. Migrasi database dan seeder table.
	```
	php artisan migrate:fresh --seed
	```

1. Jalankan local server.
   
	```
	php -S localhost:8000 -t public
	```
    atau
	```
	php artisan serve --port=8000
	```
