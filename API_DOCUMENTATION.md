# API Documentation - Web Pertanian

## Base URL
```
https://jopel.my.id (production)
http://localhost (development)
```

---

## 📦 Product API Endpoints

### 1. Get All Products (dengan filter & pagination)

**Endpoint:** `GET /api/products`

**Query Parameters:**
- `category` (optional) - Filter by category slug or name
- `seller_id` (optional) - Filter by seller ID
- `search` (optional) - Search by product name
- `per_page` (optional) - Items per page (default: 20)
- `page` (optional) - Page number

**Example Request:**
```bash
# Get all products
curl https://jopel.my.id/api/products

# Filter by category
curl https://jopel.my.id/api/products?category=pupuk

# Search and paginate
curl https://jopel.my.id/api/products?search=organik&per_page=10&page=1

# Filter by seller
curl https://jopel.my.id/api/products?seller_id=5
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Pupuk Organik Premium",
      "description": "Pupuk organik berkualitas tinggi",
      "price": 50000,
      "stock": 100,
      "unit": "kg",
      "category": {
        "id": 1,
        "name": "Pupuk",
        "slug": "pupuk"
      },
      "seller": {
        "id": 3,
        "name": "Pak Budi"
      },
      "images": [
        "http://localhost/storage/products/image1.jpg",
        "http://localhost/storage/products/image2.jpg"
      ],
      "created_at": "2025-12-10T10:00:00.000000Z",
      "updated_at": "2025-12-10T10:00:00.000000Z"
    }
  ],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 20,
    "total": 87
  }
}
```

---

### 2. Get Single Product (detail lengkap + reviews)

**Endpoint:** `GET /api/products/{id}`

**Example Request:**
```bash
curl https://jopel.my.id/api/products/1
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Pupuk Organik Premium",
    "description": "Pupuk organik berkualitas tinggi untuk tanaman",
    "price": 50000,
    "stock": 100,
    "unit": "kg",
    "category": {
      "id": 1,
      "name": "Pupuk",
      "slug": "pupuk"
    },
    "seller": {
      "id": 3,
      "name": "Pak Budi",
      "email": "budi@example.com"
    },
    "images": [
      "http://localhost/storage/products/image1.jpg"
    ],
    "reviews": [
      {
        "id": 1,
        "rating": 5,
        "comment": "Produk bagus sekali!",
        "user": "John Doe",
        "created_at": "2025-12-10T10:00:00.000000Z"
      }
    ],
    "created_at": "2025-12-10T10:00:00.000000Z",
    "updated_at": "2025-12-10T10:00:00.000000Z"
  }
}
```

**Error Response (Product not found):**
```json
{
  "success": false,
  "message": "Product not found"
}
```

---

### 3. Get Product Prices Only (lightweight)

**Endpoint:** `GET /api/prices`

**Query Parameters:**
- `category` (optional) - Filter by category slug or name

**Example Request:**
```bash
# Get all prices
curl https://jopel.my.id/api/prices

# Filter by category
curl https://jopel.my.id/api/prices?category=pupuk
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Pupuk Organik Premium",
      "price": 50000,
      "unit": "kg",
      "category": "Pupuk"
    },
    {
      "id": 2,
      "name": "Bibit Padi Unggul",
      "price": 75000,
      "unit": "kg",
      "category": "Bibit"
    },
    {
      "id": 3,
      "name": "Pestisida Organik",
      "price": 120000,
      "unit": "liter",
      "category": "Pestisida"
    }
  ]
}
```

---

## 🔐 Authentication

API endpoints di atas adalah **PUBLIC** dan tidak memerlukan authentication.

Jika ingin menambahkan authentication di masa depan, tambahkan header:
```bash
Authorization: Bearer {token}
```

---

## 📝 Usage Examples

### JavaScript (Fetch)

```javascript
// Get all products
fetch('https://jopel.my.id/api/products')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Array of products
  });

// Get product by ID
fetch('https://jopel.my.id/api/products/1')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Single product
  });

// Get prices with filter
fetch('https://jopel.my.id/api/prices?category=pupuk')
  .then(response => response.json())
  .then(data => {
    console.log(data.data); // Array of prices
  });
```

### PHP (cURL)

```php
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://jopel.my.id/api/products");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data['data']);
?>
```

### Python (requests)

```python
import requests

# Get all products
response = requests.get('https://jopel.my.id/api/products')
products = response.json()['data']

# Get prices by category
response = requests.get('https://jopel.my.id/api/prices', params={'category': 'pupuk'})
prices = response.json()['data']
```

---

## ⚡ Performance Tips

1. **Use pagination** untuk dataset besar:
   ```
   /api/products?per_page=50&page=1
   ```

2. **Use /api/prices** jika hanya butuh harga (lebih ringan):
   ```
   /api/prices?category=pupuk
   ```

3. **Cache response** di aplikasi client untuk mengurangi request

---

## 🎯 Use Cases

### 1. Price Comparison App
```javascript
// Ambil semua harga produk
fetch('/api/prices')
  .then(res => res.json())
  .then(data => {
    const prices = data.data;
    // Bandingkan harga antar produk
  });
```

### 2. Mobile App Integration
```javascript
// Fetch products dengan pagination
const page = 1;
fetch(`/api/products?per_page=20&page=${page}`)
  .then(res => res.json())
  .then(data => {
    // Display di mobile app
  });
```

### 3. Dashboard Analytics
```javascript
// Get all products dan analisa stok
fetch('/api/products')
  .then(res => res.json())
  .then(data => {
    const lowStock = data.data.filter(p => p.stock < 10);
    console.log('Low stock products:', lowStock);
  });
```

---

## 📊 Response Format

Semua response menggunakan format JSON dengan struktur:

**Success:**
```json
{
  "success": true,
  "data": [...],
  "meta": {...}  // Only for paginated endpoints
}
```

**Error:**
```json
{
  "success": false,
  "message": "Error description"
}
```

---

## 🔄 Rate Limiting

Saat ini tidak ada rate limiting. Jika perlu, dapat ditambahkan dengan Laravel throttle middleware.

---

## 📞 Support

Untuk pertanyaan atau issue, hubungi:
- Email: support@webpertanian.com
- GitHub: https://github.com/JopelSimarmata/Website_Pertanian
