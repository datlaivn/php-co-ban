<?php
session_start();
require_once __DIR__ . '/data.php';

$cart = $_SESSION['cart'] ?? [];

function cart_total($cart) {
    $sum = 0;
    foreach ($cart as $c) $sum += $c['gia'] * $c['qty'];
    return $sum;
}

?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng - Lab3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4">Giỏ hàng</h1>
        <div>
            <a href="index.php" class="btn btn-outline-secondary">Tiếp tục mua</a>
            <a href="clear.php" class="btn btn-danger" onclick="return confirm('Xóa toàn bộ giỏ hàng?')">Xóa giỏ</a>
        </div>
    </div>

    <?php if (empty($cart)): ?>
        <div class="alert alert-info">Giỏ hàng trống.</div>
    <?php else: ?>
        <form method="post" action="update.php">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Mã</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $item): ?>
                        <tr>
                            <td style="width:100px">
                                <?php if (!empty($item['img'])): ?>
                                    <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['ten']) ?>" style="height:64px;object-fit:cover">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['ma_sp']) ?></td>
                            <td><?= htmlspecialchars($item['ten']) ?></td>
                            <td><?= htmlspecialchars($item['type'] ?? '') ?></td>
                            <td><?= number_format($item['gia']) ?> ₫</td>
                            <td style="max-width:120px">
                                <input type="hidden" name="ma_sp[]" value="<?= htmlspecialchars($item['ma_sp']) ?>">
                                <input type="number" name="qty[]" class="form-control" min="0" value="<?= (int)$item['qty'] ?>">
                            </td>
                            <td><?= number_format($item['gia'] * $item['qty']) ?> ₫</td>
                            <td>
                                <a href="delete.php?ma=<?= urlencode($item['ma_sp']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa mục này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="fs-5">Tổng: <strong><?= number_format(cart_total($cart)) ?> ₫</strong></div>
                <div>
                    <button type="submit" class="btn btn-primary">Cập nhật số lượng</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
