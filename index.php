<?php
session_start();
require_once __DIR__ . '/data.php';

?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop - Lab3 Cart</title>
    <link rel="stylesheet" href="./style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Cửa hàng mẫu</h1>
        <a href="cart.php" class="btn btn-outline-dark datlai" ><i class="fa-solid fa-bag-shopping"></i> (<?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'],'qty')) : 0 ?>)</a>
    </div>

    <div class="categories-grid" id="categories-grid">
   
        <?php foreach ($products as $id => $p): ?>
           <div class="category-card minigame-card card-enter" style="animation-delay: 0ms">
            <div class="category-card-image">
              <img loading="lazy" src="<?= htmlspecialchars($p['img']) ?>" alt="<?= htmlspecialchars($p['ten']) ?>" style="max-height: 95%; object-fit: contain">
              <span class="category-badge" style="color: white">Mã SP: <?= htmlspecialchars($p['ma_sp']) ?></span>
            </div>
            <div class="category-card-body">
              <h3 class="category-card-title"><?= htmlspecialchars($p['ten']) ?></h3>
              <div class="category-card-price">
                <span class="price-label">Giá:</span>
                <span class="price-value"><?= number_format($p['gia']) ?>₫<span class="badge" style="font-size: 10px">⚡ -10%</span></span>
              </div>
              <div class="category-card-meta"><span class="meta-item sold"> Đã bán 39.972 </span></div>
              <div class="category-card-rating"><span class="stars">★★★★★</span><span class="rating-value">5</span></div>
            </div>
             <form method="post" action="add.php" class="mt-auto">
                            <input type="hidden" name="ma" value="<?= $id ?>">
                            <div class="d-flex gap-2 align-items-center">
                                <input type="hidden" name="qty" class="form-control" value="1" min="1" style="width:85px">
                                <button class="category-card-action" type="submit" style="border: none"><span class="btn-explore">ADD Cart Item →</span></button>
                            </div>
                        </form>
            
          </div>
        <?php endforeach; ?>
     </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
