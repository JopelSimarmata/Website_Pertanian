# 🔗 Quick Links - Web Pertanian

## 🌐 Production URLs

### Main Website
- **Homepage:** https://jopel.my.id
- **Marketplace:** https://jopel.my.id/marketplace
- **Forum:** https://jopel.my.id/forum
- **Login:** https://jopel.my.id/login
- **Register:** https://jopel.my.id/register

### API Endpoints (Public)
- **All Products:** https://jopel.my.id/api/products
- **Single Product:** https://jopel.my.id/api/products/{id}
- **Prices Only:** https://jopel.my.id/api/prices
- **Provinces:** https://jopel.my.id/api/provinces
- **Regencies:** https://jopel.my.id/api/regencies/{province_id}
- **Districts:** https://jopel.my.id/api/districts/{regency_id}

### Test & Development
- **API Test Page:** https://jopel.my.id/test-api

### Webhooks (Midtrans)
- **Payment Notification:** https://jopel.my.id/payment/notification
- **Payment Callback:** https://jopel.my.id/payment/callback

---

## 📱 Quick Test Commands

### Test API dengan cURL

```bash
# Get all products
curl https://jopel.my.id/api/products

# Get product by ID
curl https://jopel.my.id/api/products/1

# Get prices with category filter
curl https://jopel.my.id/api/prices?category=pupuk

# Get products with pagination
curl https://jopel.my.id/api/products?per_page=10&page=1

# Search products
curl https://jopel.my.id/api/products?search=organik
```

### Test dengan JavaScript (Browser Console)

```javascript
// Test get all products
fetch('https://jopel.my.id/api/products')
  .then(r => r.json())
  .then(d => console.log(d));

// Test get single product
fetch('https://jopel.my.id/api/products/1')
  .then(r => r.json())
  .then(d => console.log(d));

// Test get prices
fetch('https://jopel.my.id/api/prices')
  .then(r => r.json())
  .then(d => console.log(d));
```

---

## 🔐 Admin Access

### Dashboard
- **URL:** https://jopel.my.id/dashboard
- **Requirement:** Login sebagai Petani (role: petani)

### Profile
- **URL:** https://jopel.my.id/profile
- **Requirement:** Login required

### Notifications
- **URL:** https://jopel.my.id/notifications
- **Requirement:** Login required

---

## 💳 Payment URLs

### User Actions
- **Create Payment:** https://jopel.my.id/payments/create?request_id={id}
- **Payment Success:** https://jopel.my.id/payment/success?order={invoice}
- **Order Detail:** https://jopel.my.id/orders/{invoice_number}

---

## 🛠️ Development URLs (Local)

### Main Website
- **Homepage:** http://localhost:8000
- **Marketplace:** http://localhost:8000/marketplace
- **API Test:** http://localhost:8000/test-api

### API Endpoints
- **Products:** http://localhost:8000/api/products
- **Prices:** http://localhost:8000/api/prices

---

## 📊 Monitoring & Logs

### Server Logs
```bash
# Laravel application logs
tail -f /var/www/html/storage/logs/laravel.log

# Nginx access logs
tail -f /var/log/nginx/access.log

# Nginx error logs
tail -f /var/log/nginx/error.log

# PHP-FPM logs
tail -f /var/log/php8.x-fpm.log
```

### Performance Check
```bash
# Check response time
curl -w "\nTime: %{time_total}s\n" https://jopel.my.id/api/products

# Check with detailed timing
curl -w "@curl-format.txt" -o /dev/null -s https://jopel.my.id/api/products
```

---

## 🔄 Deployment Commands

### Update Code
```bash
cd /var/www/html
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
sudo systemctl restart php8.x-fpm nginx
```

### Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

### Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## 🎯 External Services

### Midtrans Dashboard
- **URL:** https://dashboard.midtrans.com
- **Webhook Setup:** Settings → Configuration → Payment Notification URL
- **Set to:** `https://jopel.my.id/payment/notification`

### Google Cloud Console (OAuth)
- **URL:** https://console.cloud.google.com
- **Credentials:** APIs & Services → Credentials
- **Authorized redirect URI:** `https://jopel.my.id/auth/google/callback`

---

## 📞 Support

**Repository:** https://github.com/JopelSimarmata/Website_Pertanian  
**Website:** https://jopel.my.id  
**API Docs:** [API_DOCUMENTATION.md](./API_DOCUMENTATION.md)  
**Deployment Guide:** [DEPLOYMENT.md](./DEPLOYMENT.md)

---

Last Updated: December 11, 2025
