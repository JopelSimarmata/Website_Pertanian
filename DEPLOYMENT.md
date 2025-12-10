# 🚀 Deployment Guide - Web Pertanian

Website sudah live di: **https://jopel.my.id**

---

## 📋 Checklist Deployment Production

### ✅ Yang Sudah Dikonfigurasi:

- [x] Domain: jopel.my.id
- [x] APP_URL di .env: https://jopel.my.id
- [x] API Endpoints: /api/products, /api/prices
- [x] Database connection
- [x] File storage (public/storage)
- [x] Midtrans payment gateway

### 🔧 Yang Perlu Dicek di Server:

1. **Environment Production**
   ```bash
   # Edit .env di server
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **PHP Configuration**
   ```ini
   # /etc/php/8.x/fpm/php.ini atau php.ini
   upload_max_filesize = 20M
   post_max_size = 25M
   max_execution_time = 300
   memory_limit = 256M
   ```

3. **Nginx Configuration**
   ```nginx
   # /etc/nginx/sites-available/jopel.my.id
   client_max_body_size 20M;
   
   # SSL sudah aktif (https)
   listen 443 ssl http2;
   ssl_certificate /path/to/cert.pem;
   ssl_certificate_key /path/to/key.pem;
   ```

4. **Laravel Optimization**
   ```bash
   # Jalankan di server production
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   
   # Set permissions
   chmod -R 755 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

5. **Storage Link**
   ```bash
   # Pastikan storage link sudah dibuat
   php artisan storage:link
   ```

---

## 🔗 API Endpoints (Live)

Base URL: `https://jopel.my.id`

### 1. Get All Products
```bash
curl https://jopel.my.id/api/products
```

### 2. Get Single Product
```bash
curl https://jopel.my.id/api/products/1
```

### 3. Get Prices
```bash
curl https://jopel.my.id/api/prices
```

### 4. Test API Page
```
https://jopel.my.id/test-api
```

---

## 🔐 Security Checklist

- [ ] `APP_DEBUG=false` di production
- [ ] `APP_ENV=production` 
- [ ] Ganti semua API keys (Midtrans, Google, dll) ke production keys
- [ ] HTTPS sudah aktif (SSL certificate)
- [ ] CSRF protection aktif
- [ ] Rate limiting untuk API (optional)
- [ ] Backup database regular

---

## 💳 Midtrans Configuration

Pastikan di server production sudah menggunakan production keys:

```env
# .env di server
MIDTRANS_SERVER_KEY=your_production_server_key
MIDTRANS_CLIENT_KEY=your_production_client_key
MIDTRANS_IS_PRODUCTION=true
```

**Webhook URL untuk Midtrans:**
```
https://jopel.my.id/payment/notification
```

Daftarkan URL ini di Midtrans Dashboard → Settings → Configuration

---

## 📊 Monitoring

### Check Logs
```bash
# Error logs
tail -f storage/logs/laravel.log

# Nginx error logs
tail -f /var/log/nginx/error.log

# PHP-FPM logs
tail -f /var/log/php8.x-fpm.log
```

### Performance Check
```bash
# Test response time
curl -w "@curl-format.txt" -o /dev/null -s https://jopel.my.id/api/products
```

---

## 🔄 Update Code di Server

```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev

# 3. Run migrations
php artisan migrate --force

# 4. Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# 5. Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Restart services
sudo systemctl restart php8.x-fpm
sudo systemctl restart nginx
```

---

## 🐛 Troubleshooting

### Issue: API returns 404
**Solution:**
```bash
# Clear route cache
php artisan route:clear
php artisan route:cache

# Check routes
php artisan route:list | grep api
```

### Issue: Upload file gagal
**Solution:**
```bash
# Check PHP limits
php -i | grep upload_max_filesize
php -i | grep post_max_size

# Check nginx
grep client_max_body_size /etc/nginx/nginx.conf

# Set permissions
chmod -R 775 storage/app/public
```

### Issue: 500 Internal Server Error
**Solution:**
```bash
# Check error logs
tail -100 storage/logs/laravel.log

# Enable debug temporarily
APP_DEBUG=true php artisan serve

# Check permissions
ls -la storage bootstrap/cache
```

### Issue: Payment webhook tidak update status
**Solution:**
1. Check webhook URL di Midtrans Dashboard
2. Pastikan URL: `https://jopel.my.id/payment/notification`
3. Check logs: `tail -f storage/logs/laravel.log`
4. Test webhook manual dengan Postman

---

## 📱 Mobile Upload Fix

Jika upload foto dari mobile tidak berfungsi:

1. **Check accept attribute di input file:**
   ```html
   <input type="file" accept="image/*" capture="environment">
   ```

2. **Check PHP limits:**
   ```ini
   upload_max_filesize = 20M
   post_max_size = 25M
   ```

3. **Check form enctype:**
   ```html
   <form enctype="multipart/form-data">
   ```

---

## 🎯 Next Steps

1. **Setup Backup Automation**
   ```bash
   # Cron job untuk backup database
   0 2 * * * mysqldump -u root petanian_db > /backups/db_$(date +\%Y\%m\%d).sql
   ```

2. **Setup Monitoring**
   - Install Laravel Telescope (development)
   - Setup error tracking (Sentry/Bugsnag)
   - Setup uptime monitoring (UptimeRobot)

3. **Performance Optimization**
   - Enable OPcache
   - Use Redis for cache/sessions
   - Enable HTTP/2
   - Use CDN untuk static assets

---

## 📞 Support & Maintenance

**Domain:** jopel.my.id  
**Hosting:** [Your hosting provider]  
**Database:** MySQL  
**PHP Version:** 8.x  
**Laravel Version:** 10.x

**API Documentation:** [API_DOCUMENTATION.md](./API_DOCUMENTATION.md)

---

## 🔑 Important Files

- `.env` - Environment configuration (jangan di-commit!)
- `config/midtrans.php` - Midtrans configuration
- `routes/web.php` - All routes including API
- `app/Http/Controllers/ProductController.php` - API endpoints
- `public/.htaccess` - URL rewriting
- `storage/logs/laravel.log` - Application logs

---

## ✨ Features Live

- ✅ Product listing & detail
- ✅ Shopping cart & checkout
- ✅ Payment gateway (Midtrans)
- ✅ Forum discussion
- ✅ Visit requests
- ✅ Notifications
- ✅ User profiles with Indonesian address API
- ✅ Product reviews
- ✅ **Public API for products & prices**

---

Last Updated: December 11, 2025
