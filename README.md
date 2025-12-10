# 🌾 Web Pertanian - Agricultural E-Commerce Platform

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.x-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> Platform e-commerce untuk produk pertanian dengan fitur marketplace, forum diskusi, dan sistem pembayaran terintegrasi.

**🌐 Live Demo:** [https://jopel.my.id](https://jopel.my.id)

---

## ✨ Features

### 🛒 Marketplace
- Product listing dengan kategori (Pupuk, Bibit, Pestisida, dll)
- Search & filter produk
- Product reviews & ratings
- Shopping cart & checkout
- Order management

### 💳 Payment Gateway
- Integrasi Midtrans
- Multiple payment methods (Bank Transfer, E-wallet, Credit Card)
- Real-time payment status via webhook
- Order invoice & payment confirmation

### 👥 User Management
- Authentication (Login/Register)
- Google OAuth integration
- User profiles dengan alamat Indonesia (API wilayah)
- Role-based access (Petani/Tengkulak)

### 💬 Forum Discussion
- Create threads dengan kategori
- Reply & like system
- Upload images di thread
- Mark solved untuk Q&A

### 📝 Visit Request
- Request kunjungan ke petani
- Approve/reject system
- Real-time notifications

### 🔔 Notifications
- Real-time notification system
- AJAX auto-refresh
- Mark as read/unread
- Notification per user

### 🌍 API Endpoints
- Public API untuk produk & harga
- RESTful architecture
- JSON response format
- Pagination support

---

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Web server (Nginx/Apache)

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM
- Web server (Nginx/Apache)

---

## 🚀 Installation

### 1. Clone Repository
```bash
git clone https://github.com/JopelSimarmata/Website_Pertanian.git
cd Website_Pertanian
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=petanian_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
php artisan db:seed  # Optional: seed sample data
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run build
```

### 8. Run Development Server
```bash
php artisan serve
```

Access: `http://localhost:8000`

---

## 🔧 Configuration

### Midtrans Payment Gateway
Edit `.env`:
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### Google OAuth (Optional)
```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

---

## 📚 Documentation

- **[API Documentation](API_DOCUMENTATION.md)** - RESTful API endpoints
- **[Deployment Guide](DEPLOYMENT.md)** - Production deployment steps
- **[Database Schema](database/migrations/)** - Database structure

---

## 🔗 API Endpoints

Base URL: `https://jopel.my.id`

### Products
```bash
GET /api/products              # All products with pagination
GET /api/products/{id}         # Single product detail
GET /api/prices                # Product prices only
```

**Example:**
```bash
curl https://jopel.my.id/api/products
curl https://jopel.my.id/api/products/1
curl https://jopel.my.id/api/prices?category=pupuk
```

See [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for complete documentation.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 10.x
- **Frontend:** Blade Templates, TailwindCSS
- **Database:** MySQL
- **Payment:** Midtrans
- **Authentication:** Laravel Sanctum, Google OAuth
- **File Storage:** Laravel Storage
- **API:** RESTful JSON API

---

## 📱 Screenshots

[Add screenshots here]

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

---

## 👨‍💻 Author

**Jopel Simarmata**
- GitHub: [@JopelSimarmata](https://github.com/JopelSimarmata)
- Website: [jopel.my.id](https://jopel.my.id)

---

## 🙏 Acknowledgments

- [Laravel Framework](https://laravel.com) - The PHP framework
- [TailwindCSS](https://tailwindcss.com) - CSS framework
- [Midtrans](https://midtrans.com) - Payment gateway
- [emsifa/api-wilayah-indonesia](https://github.com/emsifa/api-wilayah-indonesia) - Indonesian regions API

---

**Made with ❤️ for Indonesian Farmers**

