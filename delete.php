<?php
session_start();

if (!isset($_GET['ma'])) {
    header('Location: cart.php');
    exit;
}
$ma = $_GET['ma'];

if (!isset($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

foreach ($_SESSION['cart'] as $k => $item) {
    if ($item['ma_sp'] === $ma) {
        unset($_SESSION['cart'][$k]);
        break;
    }
}
if (isset($_SESSION['cart'])) $_SESSION['cart'] = array_values($_SESSION['cart']);

header('Location: cart.php');
exit;
