<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cart.php');
    exit;
}

$mas = $_POST['ma_sp'] ?? [];
$qs = $_POST['qty'] ?? [];

if (!isset($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

$newCart = [];
for ($i = 0; $i < count($mas); $i++) {
    $ma = $mas[$i];
    $qty = max(0, (int)$qs[$i]);
    foreach ($_SESSION['cart'] as $item) {
        if ($item['ma_sp'] === $ma) {
            if ($qty > 0) {
                $item['qty'] = $qty;
                $newCart[] = $item;
            }
            break;
        }
    }
}

$_SESSION['cart'] = $newCart;

header('Location: cart.php');
exit;
