<?php
// Koneksi database sederhana menggunakan file JSON
// Path disesuaikan untuk admin/page/k-dapur/daftar-kdapur.php
$dataFile = __DIR__ . '/../../../user/produk_kdapur.json';

// Buat folder data jika belum ada
$dataDir = dirname($dataFile);
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Inisialisasi file data jika belum ada
if (!file_exists($dataFile)) {
    $initialData = [];
    file_put_contents($dataFile, json_encode($initialData));
}

// Fungsi untuk membaca data produk
function readProduk() {
    global $dataFile;
    if (!file_exists($dataFile)) {
        return [];
    }
    $data = file_get_contents($dataFile);
    return json_decode($data, true) ?: [];
}

// Fungsi untuk menyimpan data produk
function saveProduk($data) {
    global $dataFile;
    return file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}

// Fungsi untuk mencari produk berdasarkan ID
function findProdukById($produkData, $id) {
    foreach ($produkData as $index => $produk) {
        if ($produk['id'] == $id) {
            return ['index' => $index, 'data' => $produk];
        }
    }
    return null;
}

// Fungsi untuk validasi input
function validateInput($nama, $harga, $deskripsi) {
    $errors = [];
    
    if (empty(trim($nama))) {
        $errors[] = "Nama produk tidak boleh kosong";
    } elseif (strlen($nama) > 100) {
        $errors[] = "Nama produk tidak boleh lebih dari 100 karakter";
    }
    
    if (!is_numeric($harga) || $harga <= 0) {
        $errors[] = "Harga harus berupa angka positif";
    } elseif ($harga > 999999999) {
        $errors[] = "Harga terlalu besar";
    }
    
    if (strlen($deskripsi) > 500) {
        $errors[] = "Deskripsi tidak boleh lebih dari 500 karakter";
    }
    
    return $errors;
}

// Initialize variables
$message = '';
$messageType = 'success';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produkData = readProduk();
    
    if (isset($_POST['action'])) {
        $nama = trim($_POST['nama'] ?? '');
        $harga = (int)($_POST['harga'] ?? 0);
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        
        // Validasi input untuk tambah dan edit
        if ($_POST['action'] === 'tambah' || $_POST['action'] === 'edit') {
            $errors = validateInput($nama, $harga, $deskripsi);
            
            if (!empty($errors)) {
                $message = implode('<br>', $errors);
                $messageType = 'error';
            }
        }
        
        // Jika tidak ada error, proses action
        if (empty($errors ?? [])) {
            switch ($_POST['action']) {
                case 'tambah':
                    $newId = empty($produkData) ? 1 : max(array_column($produkData, 'id')) + 1;
                    $newProduk = [
                        'id' => $newId,
                        'nama' => $nama,
                        'harga' => $harga,
                        'deskripsi' => $deskripsi,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $produkData[] = $newProduk;
                    
                    if (saveProduk($produkData)) {
                        $message = "✅ Produk '$nama' berhasil ditambahkan!";
                        $messageType = 'success';
                    } else {
                        $message = "❌ Gagal menyimpan produk. Coba lagi.";
                        $messageType = 'error';
                    }
                    break;
                    
                case 'edit':
                    $id = (int)$_POST['id'];
                    $found = findProdukById($produkData, $id);
                    
                    if ($found) {
                        $produkData[$found['index']] = [
                            'id' => $id,
                            'nama' => $nama,
                            'harga' => $harga,
                            'deskripsi' => $deskripsi,
                            'created_at' => $found['data']['created_at'] ?? date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        
                        if (saveProduk($produkData)) {
                            $message = "✅ Produk '$nama' berhasil diupdate!";
                            $messageType = 'success';
                        } else {
                            $message = "❌ Gagal mengupdate produk. Coba lagi.";
                            $messageType = 'error';
                        }
                    } else {
                        $message = "❌ Produk tidak ditemukan!";
                        $messageType = 'error';
                    }
                    break;
                    
                case 'hapus':
                    $id = (int)$_POST['id'];
                    $found = findProdukById($produkData, $id);
                    
                    if ($found) {
                        $namaDeleted = $found['data']['nama'];
                        unset($produkData[$found['index']]);
                        $produkData = array_values($produkData); // Reset index
                        
                        if (saveProduk($produkData)) {
                            $message = "✅ Produk '$namaDeleted' berhasil dihapus!";
                            $messageType = 'success';
                        } else {
                            $message = "❌ Gagal menghapus produk. Coba lagi.";
                            $messageType = 'error';
                        }
                    } else {
                        $message = "❌ Produk tidak ditemukan!";
                        $messageType = 'error';
                    }
                    break;
            }
        }
    }
}

// Ambil data produk terbaru
$produkList = readProduk();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Produk K-Dapur</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #e53935, #d32f2f);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .content {
            padding: 30px;
        }
        
        .form-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }
        
        .form-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e53935;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background: #e53935;
            color: white;
        }
        
        .btn-primary:hover {
            background: #d32f2f;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
            margin-left: 10px;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .btn-edit {
            background: #28a745;
            color: white;
            margin-left: 10px;
        }
        
        .btn-edit:hover {
            background: #218838;
        }
        
        .btn-edit:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-danger {
            background: #dc3545;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .btn-danger:hover {
            background: #c82333;
        }
        
        .btn-clear {
            background: #ffc107;
            color: #212529;
            margin-left: 10px;
        }
        
        .btn-clear:hover {
            background: #e0a800;
        }
        
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .produk-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
        }
        
        .produk-card:hover {
            border-color: #e53935;
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(229, 57, 53, 0.15);
        }
        
        .produk-card.selected {
            border-color: #28a745;
            background: #f8fff9;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
        }
        
        .produk-nama {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .produk-harga {
            font-size: 20px;
            font-weight: 700;
            color: #e53935;
            margin-bottom: 10px;
        }
        
        .produk-deskripsi {
            color: #666;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        .produk-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .produk-meta {
            font-size: 12px;
            color: #999;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid;
            animation: slideDown 0.5s ease;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .no-produk {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }
        
        .no-produk h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .selected-indicator {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .char-counter {
            font-size: 12px;
            color: #666;
            text-align: right;
            margin-top: 5px;
        }
        
        .char-counter.warning {
            color: #e67e22;
        }
        
        .char-counter.danger {
            color: #e74c3c;
        }
        
        .selection-info {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: #0c5aa6;
            font-size: 14px;
        }
        
        .form-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .produk-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                margin: 0 10px;
            }
            
            .form-buttons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍳 Admin K-Dapur</h1>
            <p>Kelola produk dapur dengan mudah</p>
        </div>
        
        <div class="content">
            <?php if (!empty($message)): ?>
                <div class="message <?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <!-- Form Tambah/Edit Produk -->
            <div class="form-section">
                <h2 class="form-title">➕ Tambah / ✏️ Edit Produk</h2>
                
                <div class="selection-info" id="selectionInfo" style="display: none;">
                    <strong>📌 Produk Dipilih:</strong> <span id="selectedProductName">-</span>
                    <br>Klik tombol "Edit Produk" untuk menyimpan perubahan, atau "Clear" untuk kosongkan form.
                </div>
                
                <form method="POST" id="produkForm">
                    <input type="hidden" name="action" value="tambah" id="formAction">
                    <input type="hidden" name="id" value="" id="formId">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input type="text" id="nama" name="nama" 
                                   placeholder="Contoh: Pisau Dapur Premium" 
                                   maxlength="100" required>
                            <div class="char-counter" id="namaCounter">0/100</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="harga">Harga (Rp)</label>
                            <input type="number" id="harga" name="harga" 
                                   placeholder="50000" min="1" max="999999999" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea id="deskripsi" name="deskripsi" 
                                  placeholder="Deskripsikan produk secara singkat..." 
                                  maxlength="500"></textarea>
                        <div class="char-counter" id="deskripsiCounter">0/500</div>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            ➕ Tambah Produk
                        </button>
                        
                        <button type="button" class="btn btn-edit" id="editBtn" disabled 
                                onclick="switchToEditMode()">
                            ✏️ Edit Produk
                        </button>
                        
                        <button type="button" class="btn btn-clear" onclick="clearForm()">
                            🔄 Clear Form
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Daftar Produk -->
            <div class="form-section">
                <h2 class="form-title">📦 Daftar Produk (<?= count($produkList) ?>) - Klik untuk Select</h2>
                
                <?php if (empty($produkList)): ?>
                    <div class="no-produk">
                        <h3>Belum ada produk</h3>
                        <p>Silakan tambahkan produk pertama Anda menggunakan form di atas</p>
                    </div>
                <?php else: ?>
                    <div class="produk-grid">
                        <?php foreach ($produkList as $produk): ?>
                            <div class="produk-card" onclick="selectProduct(<?= htmlspecialchars(json_encode($produk)) ?>)" 
                                 data-product-id="<?= $produk['id'] ?>">
                                
                                <div class="produk-nama"><?= htmlspecialchars($produk['nama']) ?></div>
                                <div class="produk-harga">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>
                                <div class="produk-deskripsi"><?= htmlspecialchars($produk['deskripsi']) ?></div>
                                
                                <?php if (isset($produk['updated_at'])): ?>
                                    <div class="produk-meta">
                                        Terakhir diupdate: <?= date('d/m/Y H:i', strtotime($produk['updated_at'])) ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="produk-actions" onclick="event.stopPropagation()">
                                    <form method="POST" style="display: inline;" 
                                          onsubmit="return confirmDelete('<?= htmlspecialchars($produk['nama']) ?>')">
                                        <input type="hidden" name="action" value="hapus">
                                        <input type="hidden" name="id" value="<?= $produk['id'] ?>">
                                        <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div style="text-align: center; padding: 20px;">
                <a href="../../user/k-dapur.php" class="btn btn-secondary" target="_blank">
                    👁️ Lihat Halaman User
                </a>
            </div>
        </div>
    </div>

    <script>
        let selectedProduct = null;
        
        // Select product function
        function selectProduct(product) {
            // Remove previous selection
            document.querySelectorAll('.produk-card').forEach(card => {
                card.classList.remove('selected');
                const indicator = card.querySelector('.selected-indicator');
                if (indicator) indicator.remove();
            });
            
            // Add selection to clicked card
            const clickedCard = document.querySelector(`[data-product-id="${product.id}"]`);
            clickedCard.classList.add('selected');
            
            // Add selection indicator
            const indicator = document.createElement('div');
            indicator.className = 'selected-indicator';
            indicator.innerHTML = '✓';
            clickedCard.appendChild(indicator);
            
            // Fill form with product data
            document.getElementById('nama').value = product.nama;
            document.getElementById('harga').value = product.harga;
            document.getElementById('deskripsi').value = product.deskripsi;
            document.getElementById('formId').value = product.id;
            
            // Update counters
            updateCharCounter(document.getElementById('nama'), document.getElementById('namaCounter'), 100);
            updateCharCounter(document.getElementById('deskripsi'), document.getElementById('deskripsiCounter'), 500);
            
            // Show selection info
            document.getElementById('selectionInfo').style.display = 'block';
            document.getElementById('selectedProductName').textContent = product.nama;
            
            // Enable edit button
            document.getElementById('editBtn').disabled = false;
            
            // Store selected product
            selectedProduct = product;
            
            console.log('Product selected:', product.nama);
        }
        
        // Switch to edit mode
        function switchToEditMode() {
            if (!selectedProduct) return;
            
            document.getElementById('formAction').value = 'edit';
            document.getElementById('submitBtn').innerHTML = '💾 Update Produk';
            document.getElementById('submitBtn').className = 'btn btn-edit';
            document.getElementById('editBtn').style.display = 'none';
            
            console.log('Switched to edit mode for:', selectedProduct.nama);
        }
        
        // Clear form
        function clearForm() {
            document.getElementById('nama').value = '';
            document.getElementById('harga').value = '';
            document.getElementById('deskripsi').value = '';
            document.getElementById('formId').value = '';
            document.getElementById('formAction').value = 'tambah';
            
            // Reset button states
            document.getElementById('submitBtn').innerHTML = '➕ Tambah Produk';
            document.getElementById('submitBtn').className = 'btn btn-primary';
            document.getElementById('editBtn').style.display = 'inline-block';
            document.getElementById('editBtn').disabled = true;
            
            // Hide selection info
            document.getElementById('selectionInfo').style.display = 'none';
            
            // Clear selection
            document.querySelectorAll('.produk-card').forEach(card => {
                card.classList.remove('selected');
                const indicator = card.querySelector('.selected-indicator');
                if (indicator) indicator.remove();
            });
            
            // Update counters
            updateCharCounter(document.getElementById('nama'), document.getElementById('namaCounter'), 100);
            updateCharCounter(document.getElementById('deskripsi'), document.getElementById('deskripsiCounter'), 500);
            
            selectedProduct = null;
            console.log('Form cleared');
        }
        
        // Character counter function
        function updateCharCounter(input, counter, maxLength) {
            const currentLength = input.value.length;
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength > maxLength * 0.9) {
                counter.className = 'char-counter danger';
            } else if (currentLength > maxLength * 0.7) {
                counter.className = 'char-counter warning';
            } else {
                counter.className = 'char-counter';
            }
        }
        
        // Delete confirmation
        function confirmDelete(productName) {
            return confirm(`Yakin ingin menghapus produk "${productName}"?\n\nTindakan ini tidak dapat dibatalkan!`);
        }
        
        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Character counters
            const namaInput = document.getElementById('nama');
            const deskripsiInput = document.getElementById('deskripsi');
            const namaCounter = document.getElementById('namaCounter');
            const deskripsiCounter = document.getElementById('deskripsiCounter');
            
            if (namaInput && namaCounter) {
                updateCharCounter(namaInput, namaCounter, 100);
                namaInput.addEventListener('input', () => updateCharCounter(namaInput, namaCounter, 100));
            }
            
            if (deskripsiInput && deskripsiCounter) {
                updateCharCounter(deskripsiInput, deskripsiCounter, 500);
                deskripsiInput.addEventListener('input', () => updateCharCounter(deskripsiInput, deskripsiCounter, 500));
            }
            
            // Form validation
            const produkForm = document.getElementById('produkForm');
            if (produkForm) {
                produkForm.addEventListener('submit', function(e) {
                    const submitBtn = document.getElementById('submitBtn');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '⏳ Memproses...';
                        
                        // Re-enable after 3 seconds
                        setTimeout(() => {
                            if (submitBtn) {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalText;
                            }
                        }, 3000);
                    }
                });
            }
            
            // Auto-hide messages
            const message = document.querySelector('.message');
            if (message) {
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        if (message.parentNode) {
                            message.parentNode.removeChild(message);
                        }
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>