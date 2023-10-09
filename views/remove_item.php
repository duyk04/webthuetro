<?php
if (isset($_GET['user_id']) &&isset($_GET['product_id'])) {
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
    
    // Gọi phương thức để xoá sản phẩm từ giỏ hàng
    $cartController = new Cart_Model();
    $cartController->removeCartItem($user_id, $product_id);
    
    // Sau khi xoá sản phẩm, chuyển người dùng trở lại trang giỏ hàng hoặc trang danh sách yêu thích
    header("Location:cart.php");
    exit();
}