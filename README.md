
# Langkah-langkah menjalankan Project




## Persyaratan Sistem

- PHP (>=8.2)
- Composer
- Node.js & npm
- MySQL


## 1. Backend (dashboard)

masuk ke folder "backend"

```bash
  cd backend
```

Install semua dependencies
```bash
  composer install
  npm install
```

jalankan migration database
```bash
  php artisan migrate --seed
```

buat symlink ke folder public
```bash
  php artisan storage:link
```

jalankan server
```bash
  npm run build
  php artisan ser --port=8000
```


## 1. Frontend (landing page)

masuk ke folder "frontend"

```bash
  cd frontend
```

Install semua dependencies
```bash
  npm install
```

jalankan server
```bash
  npm run dev
```

