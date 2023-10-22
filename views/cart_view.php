<?php
if (count($cart_items) <= 0) {
    echo '<h1 style="margin:auto">Chưa có phòng nào danh sách yêu thích!</h1>';
} else {
    echo '
    <h1 style="text-align:center">Danh sách yêu thích</h1>                
    <table class="table cart-table">
        <thead>
            <th>STT</th>
            <th>Phòng</th>
            <th>Số lượng</th>
            <th>Giá (VND)</th>
            <th>Chức năng</th>
        </thead>
    <tbody>';

    $count = 1;
    $quantity = 0;
    $price = 0;
    foreach ($cart_items as $item) {
        $product = $this->model->getProducts($item->get_product_id());
        $product_thumbnail = $product->get_product_thumnail();
        $product_name = $product->get_product_name();
        $product_price = $product->get_product_price();
        echo '
        <tr>
            <td>' . $count . '</td>
            <td>
                <img src="../img/' . $product_thumbnail . '" width="50">
                <a href="details.php?product_id=' . $item->get_product_id() . '">' . $product_name . '</a>
            </td>
            <td>' . $item->get_product_quantity() . '</td>
            <td class="">' . number_format($product_price, 0, ",", ".") . 'đ</td>
            <td>
            <a href="remove_item.php?user_id=' . $item->get_user_id() . '&product_id=' . $item->get_product_id() . '">Xoá</a>
            </td>
        </tr>
        ';
        $count++;
        $quantity += $item->get_product_quantity();
        $price += $product_price * $quantity;
    }
    echo '
            <tr>
                <td></td>
                <td></td>
                <td>
                    <span id="total-product-quantity" style="font-weight: 500;">' . "Tổng tiền" . '</span>
                </td>
                <td id="total-product-price" style="font-weight: 500; color: red;">' . number_format($price, 0, ",", ".") . 'đ</td>
            </tr>
            
        </tbody>
    </table>
    ';
    echo'
    <form action="purchase.php" method="POST">
    <input type="hidden" name="userid" value="'.$_SESSION["userid"].'" />
    <button type="submit" class="btn btn-primary">
        Đặt Phòng
    </button>
    </form>
    ';
}

// include "../src/components/footer.php";
?>
