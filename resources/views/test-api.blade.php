<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - Web Pertanian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .code-block {
            background: #1e293b;
            color: #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .code-header {
            background: #0f172a;
            padding: 8px 16px;
            border-bottom: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .code-content {
            padding: 16px;
            overflow-x: auto;
            max-height: 500px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            line-height: 1.6;
        }
        
        .method-badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .method-get {
            background: #10b981;
            color: white;
        }
        
        .endpoint-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .endpoint-card:hover {
            border-color: #10b981;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }
        
        .btn-test {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }
        
        .btn-test:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        
        .btn-copy {
            background: #64748b;
            transition: all 0.2s ease;
        }
        
        .btn-copy:hover {
            background: #475569;
        }
        
        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #10b981;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-right: 10px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .status-success {
            color: #10b981;
        }
        
        .status-error {
            color: #ef4444;
        }
        
        .tab-button {
            padding: 12px 24px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }
        
        .tab-button.active {
            border-bottom-color: #10b981;
            color: #10b981;
            font-weight: 600;
        }
        
        .tab-button:hover {
            background: #f9fafb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 text-white py-6 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold flex items-center">
                        <i class="fas fa-seedling mr-3"></i>
                        Web Pertanian API Documentation
                    </h1>
                    <p class="text-emerald-100 mt-2">RESTful API for Agricultural Products & Prices</p>
                </div>
                <a href="/" class="bg-white text-emerald-600 px-6 py-2 rounded-lg font-semibold hover:bg-emerald-50 transition duration-200">
                    <i class="fas fa-home mr-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Info Bar -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-wrap items-center gap-6">
                <div class="flex items-center">
                    <i class="fas fa-server text-emerald-600 mr-2"></i>
                    <span class="text-sm text-gray-600">Base URL:</span>
                    <code class="ml-2 px-3 py-1 bg-gray-100 rounded text-sm font-mono text-emerald-700">{{ url('/') }}</code>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-emerald-600 mr-2"></i>
                    <span class="text-sm text-gray-600">Auth:</span>
                    <span class="ml-2 px-3 py-1 bg-emerald-100 text-emerald-700 rounded text-sm font-semibold">Public (No Auth Required)</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-code text-emerald-600 mr-2"></i>
                    <span class="text-sm text-gray-600">Format:</span>
                    <span class="ml-2 px-3 py-1 bg-blue-100 text-blue-700 rounded text-sm font-semibold">JSON</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Products API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/products</code>
                    </div>
                    <p class="text-gray-600">Mengambil daftar semua produk dengan pagination dan filter</p>
                </div>
                <i class="fas fa-box-open text-3xl text-emerald-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-sliders-h mr-2 text-emerald-600"></i>
                    Query Parameters
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                    <div class="flex items-center">
                        <code class="text-sm bg-gray-100 px-2 py-1 rounded mr-2">category</code>
                        <span class="text-sm text-gray-600">Filter by category</span>
                    </div>
                    <div class="flex items-center">
                        <code class="text-sm bg-gray-100 px-2 py-1 rounded mr-2">seller_id</code>
                        <span class="text-sm text-gray-600">Filter by seller</span>
                    </div>
                    <div class="flex items-center">
                        <code class="text-sm bg-gray-100 px-2 py-1 rounded mr-2">search</code>
                        <span class="text-sm text-gray-600">Search by name</span>
                    </div>
                    <div class="flex items-center">
                        <code class="text-sm bg-gray-100 px-2 py-1 rounded mr-2">per_page</code>
                        <span class="text-sm text-gray-600">Items per page (default: 20)</span>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testProducts()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-play mr-2"></i>Test All Products
                    </button>
                    <button onclick="testProductsWithFilter()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-filter mr-2"></i>Test with Filter (pupuk)
                    </button>
                    <button onclick="copyToClipboard('{{ url('/') }}/api/products')" class="btn-copy text-white px-4 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-copy mr-2"></i>Copy URL
                    </button>
                </div>
            </div>
            
            <div id="products-result" class="mt-4"></div>
        </div>

        <!-- Single Product API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/products/{id}</code>
                    </div>
                    <p class="text-gray-600">Mengambil detail produk tertentu beserta reviews</p>
                </div>
                <i class="fas fa-info-circle text-3xl text-blue-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex items-center gap-3 mb-4">
                    <label class="text-sm font-medium text-gray-700">Product ID:</label>
                    <input type="number" id="product-id" placeholder="Enter Product ID" value="1" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testSingleProduct()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-search mr-2"></i>Get Product Detail
                    </button>
                    <button onclick="copyToClipboard('{{ url('/') }}/api/products/1')" class="btn-copy text-white px-4 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-copy mr-2"></i>Copy URL
                    </button>
                </div>
            </div>
            
            <div id="single-product-result" class="mt-4"></div>
        </div>

        <!-- Prices API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/prices</code>
                    </div>
                    <p class="text-gray-600">Mengambil daftar harga produk saja (lightweight endpoint)</p>
                </div>
                <i class="fas fa-tag text-3xl text-yellow-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex flex-wrap gap-3">
                    <button onclick="testPrices()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-dollar-sign mr-2"></i>Get All Prices
                    </button>
                    <button onclick="testPricesWithCategory()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-filter mr-2"></i>Filter by Category (pupuk)
                    </button>
                    <button onclick="copyToClipboard('{{ url('/') }}/api/prices')" class="btn-copy text-white px-4 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-copy mr-2"></i>Copy URL
                    </button>
                </div>
            </div>
            
            <div id="prices-result" class="mt-4"></div>
        </div>

        <!-- Search API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/products?search={query}</code>
                    </div>
                    <p class="text-gray-600">Mencari produk berdasarkan kata kunci</p>
                </div>
                <i class="fas fa-search text-3xl text-purple-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex items-center gap-3 mb-4">
                    <label class="text-sm font-medium text-gray-700">Search Query:</label>
                    <input type="text" id="search-query" placeholder="Enter search keyword" value="organik" 
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testSearch()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-search mr-2"></i>Search Products
                    </button>
                </div>
            </div>
            
            <div id="search-result" class="mt-4"></div>
        </div>

        <!-- Indonesian Regions API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/provinces</code>
                    </div>
                    <p class="text-gray-600">API wilayah Indonesia (Provinsi, Kota, Kecamatan)</p>
                </div>
                <i class="fas fa-map-marked-alt text-3xl text-red-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex flex-wrap gap-3">
                    <button onclick="testProvinces()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-map mr-2"></i>Get Provinces
                    </button>
                    <button onclick="testRegencies()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-city mr-2"></i>Get Regencies (Aceh)
                    </button>
                </div>
            </div>
            
            <div id="regions-result" class="mt-4"></div>
        </div>

        <!-- Categories API -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge method-get">GET</span>
                        <code class="text-lg font-mono text-gray-800">/api/categories</code>
                    </div>
                    <p class="text-gray-600">Mengambil daftar semua kategori produk</p>
                </div>
                <i class="fas fa-list text-3xl text-indigo-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex flex-wrap gap-3">
                    <button onclick="testCategories()" class="btn-test text-white px-6 py-2 rounded-lg font-medium flex items-center">
                        <i class="fas fa-list mr-2"></i>Get Categories
                    </button>
                </div>
            </div>
            
            <div id="categories-result" class="mt-4"></div>
        </div>

        <!-- POST: Create Product -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card border-l-4 border-l-blue-500">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge bg-blue-600 text-white">POST</span>
                        <code class="text-lg font-mono text-gray-800">/api/products</code>
                    </div>
                    <p class="text-gray-600">Membuat produk baru (for testing)</p>
                </div>
                <i class="fas fa-plus-circle text-3xl text-blue-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <h4 class="font-semibold text-gray-700 mb-3">Request Body:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                    <input type="text" id="create-name" placeholder="Product Name" value="Pupuk Test API" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <input type="number" id="create-price" placeholder="Price" value="50000" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <input type="number" id="create-stock" placeholder="Stock" value="100" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <input type="text" id="create-unit" placeholder="Unit (kg, liter)" value="kg" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <input type="number" id="create-category" placeholder="Category ID" value="1" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <textarea id="create-description" placeholder="Description (optional)" rows="1"
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">Produk test dari API</textarea>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testCreateProduct()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium flex items-center transition">
                        <i class="fas fa-plus mr-2"></i>Create Product
                    </button>
                </div>
            </div>
            
            <div id="create-result" class="mt-4"></div>
        </div>

        <!-- PUT: Update Product -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card border-l-4 border-l-orange-500">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge bg-orange-600 text-white">PUT</span>
                        <code class="text-lg font-mono text-gray-800">/api/products/{id}</code>
                    </div>
                    <p class="text-gray-600">Mengupdate produk yang sudah ada</p>
                </div>
                <i class="fas fa-edit text-3xl text-orange-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <h4 class="font-semibold text-gray-700 mb-3">Update Product:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                    <input type="number" id="update-id" placeholder="Product ID to Update" value="1" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                    <input type="text" id="update-name" placeholder="New Name (optional)" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                    <input type="number" id="update-price" placeholder="New Price (optional)" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                    <input type="number" id="update-stock" placeholder="New Stock (optional)" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500">
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testUpdateProduct()" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium flex items-center transition">
                        <i class="fas fa-edit mr-2"></i>Update Product
                    </button>
                </div>
            </div>
            
            <div id="update-result" class="mt-4"></div>
        </div>

        <!-- DELETE: Delete Product -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 endpoint-card border-l-4 border-l-red-500">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="method-badge bg-red-600 text-white">DELETE</span>
                        <code class="text-lg font-mono text-gray-800">/api/products/{id}</code>
                    </div>
                    <p class="text-gray-600">Menghapus produk (for testing)</p>
                </div>
                <i class="fas fa-trash-alt text-3xl text-red-500"></i>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex items-center gap-3 mb-4">
                    <label class="text-sm font-medium text-gray-700">Product ID to Delete:</label>
                    <input type="number" id="delete-id" placeholder="Product ID" value="999" 
                           class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <button onclick="testDeleteProduct()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-medium flex items-center transition">
                        <i class="fas fa-trash mr-2"></i>Delete Product
                    </button>
                </div>
            </div>
            
            <div id="delete-result" class="mt-4"></div>
        </div>

    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm">&copy; 2025 Web Pertanian. All rights reserved.</p>
                </div>
                <div class="flex gap-6">
                    <a href="/" class="hover:text-emerald-400 transition duration-200">
                        <i class="fas fa-home mr-1"></i>Home
                    </a>
                    <a href="/marketplace" class="hover:text-emerald-400 transition duration-200">
                        <i class="fas fa-store mr-1"></i>Marketplace
                    </a>
                    <a href="https://github.com/JopelSimarmata/Website_Pertanian" target="_blank" class="hover:text-emerald-400 transition duration-200">
                        <i class="fab fa-github mr-1"></i>GitHub
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const baseUrl = '{{ url('/') }}';

        function showLoading(elementId) {
            document.getElementById(elementId).innerHTML = `
                <div class="flex items-center justify-center py-8">
                    <div class="loading-spinner"></div>
                    <span class="text-gray-600 font-medium">Loading...</span>
                </div>
            `;
        }

        function showError(elementId, error) {
            document.getElementById(elementId).innerHTML = `
                <div class="code-block mt-4">
                    <div class="code-header">
                        <span class="status-error flex items-center">
                            <i class="fas fa-times-circle mr-2"></i>
                            Error Response
                        </span>
                    </div>
                    <div class="code-content status-error">
                        ${error}
                    </div>
                </div>
            `;
        }

        function showResult(elementId, data, status = 200) {
            const jsonString = JSON.stringify(data, null, 2);
            const statusClass = status >= 200 && status < 300 ? 'status-success' : 'status-error';
            const statusIcon = status >= 200 && status < 300 ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            document.getElementById(elementId).innerHTML = `
                <div class="code-block mt-4">
                    <div class="code-header">
                        <span class="${statusClass} flex items-center">
                            <i class="fas ${statusIcon} mr-2"></i>
                            Response (Status: ${status})
                        </span>
                        <button onclick="copyResponse('${elementId}-json')" class="text-xs px-3 py-1 bg-gray-700 hover:bg-gray-600 rounded text-white transition duration-200">
                            <i class="fas fa-copy mr-1"></i>Copy
                        </button>
                    </div>
                    <div class="code-content" id="${elementId}-json">
                        ${escapeHtml(jsonString)}
                    </div>
                </div>
            `;
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                showNotification('URL copied to clipboard!');
            });
        }

        function copyResponse(elementId) {
            const text = document.getElementById(elementId).textContent;
            navigator.clipboard.writeText(text).then(() => {
                showNotification('Response copied to clipboard!');
            });
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-emerald-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center';
            notification.innerHTML = `
                <i class="fas fa-check-circle mr-2"></i>
                ${message}
            `;
            document.body.appendChild(notification);
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        async function testProducts() {
            const resultId = 'products-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/products`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testProductsWithFilter() {
            const resultId = 'products-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/products?category=pupuk&per_page=5`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testSingleProduct() {
            const resultId = 'single-product-result';
            const productId = document.getElementById('product-id').value;
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/products/${productId}`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testPrices() {
            const resultId = 'prices-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/prices`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testPricesWithCategory() {
            const resultId = 'prices-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/prices?category=pupuk`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testSearch() {
            const resultId = 'search-result';
            const searchQuery = document.getElementById('search-query').value;
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/products?search=${encodeURIComponent(searchQuery)}&per_page=10`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testProvinces() {
            const resultId = 'regions-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/provinces`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testRegencies() {
            const resultId = 'regions-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/regencies/11`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testCategories() {
            const resultId = 'categories-result';
            showLoading(resultId);
            try {
                const response = await fetch(`${baseUrl}/api/categories`);
                const data = await response.json();
                showResult(resultId, data, response.status);
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testCreateProduct() {
            const resultId = 'create-result';
            showLoading(resultId);
            
            const productData = {
                name: document.getElementById('create-name').value,
                price: document.getElementById('create-price').value,
                stock: document.getElementById('create-stock').value,
                unit: document.getElementById('create-unit').value,
                category_id: document.getElementById('create-category').value,
                description: document.getElementById('create-description').value
            };

            try {
                const response = await fetch(`${baseUrl}/api/products`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(productData)
                });
                const data = await response.json();
                showResult(resultId, data, response.status);
                
                if (data.success) {
                    showToast('Product created successfully! ID: ' + data.data.id, 'success');
                }
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testUpdateProduct() {
            const resultId = 'update-result';
            const productId = document.getElementById('update-id').value;
            
            if (!productId) {
                showError(resultId, 'Please enter Product ID');
                return;
            }

            showLoading(resultId);
            
            const updateData = {
                name: document.getElementById('update-name').value,
                price: document.getElementById('update-price').value,
                stock: document.getElementById('update-stock').value
            };

            // Remove empty fields (for partial update)
            Object.keys(updateData).forEach(key => {
                if (!updateData[key]) delete updateData[key];
            });

            try {
                const response = await fetch(`${baseUrl}/api/products/${productId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(updateData)
                });
                const data = await response.json();
                showResult(resultId, data, response.status);
                
                if (data.success) {
                    showToast('Product updated successfully!', 'success');
                }
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        async function testDeleteProduct() {
            const resultId = 'delete-result';
            const productId = document.getElementById('delete-id').value;
            
            if (!productId) {
                showError(resultId, 'Please enter Product ID');
                return;
            }

            if (!confirm(`Are you sure you want to delete product ID ${productId}?`)) {
                return;
            }

            showLoading(resultId);

            try {
                const response = await fetch(`${baseUrl}/api/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                showResult(resultId, data, response.status);
                
                if (data.success) {
                    showToast('Product deleted successfully!', 'success');
                }
            } catch (error) {
                showError(resultId, error.message);
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} transition-opacity duration-300`;
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-2"></i>
                ${message}
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
</body>
</html>
