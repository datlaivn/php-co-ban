<?php
session_start();
require_once __DIR__ . '/data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma = $_POST['ma'] ?? '';
    $qty = max(1, (int)($_POST['qty'] ?? 1));
    
    $product = $products[$ma];
    if ($product === null) {
        header('Location: index.php');
        exit;
    }

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] === $ma) {
            $item['qty'] += $qty;
            $found = true;
            break;
        }
    }
    unset($item);

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $ma,
            'ma_sp' => $product['ma_sp'],
            'ten' => $product['ten'],
            'gia' => $product['gia'],
            'img' => $product['img'] ?? '',
            'type' => $product['type'] ?? '',
            'qty' => $qty
        ];
    }

    header('Location: cart.php');
    exit;
}

header('Location: index.php');
exit;
