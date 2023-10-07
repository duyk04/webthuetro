<?php
include '../inc/header1.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<div class="grid_2">

</div>
<div class="grid_12">
    <div class="box round first grid">
        <?php
        require_once "../../modules/db_module.php";
        $link = null;
        taoKetNoi($link);
        $sql = "SELECT * FROM tbl_product";
        $result = chayTruyVanTraVeDL($link, $sql);
        if (!isset($_GET['product_id']) || $_GET['product_id'] == null) {
        } else {
            $product_id = $_GET['product_id'];
            $sql = "SELECT COUNT(product_id) AS count from tbl_product where product_id ='$product_id'";
            $check = chayTruyVanTraVeDL($link, $sql);
            $rows = mysqli_fetch_assoc($check);
            if ($rows['count'] <= 0) {
                $_SESSION['status'] = "Xóa phòng thất bại";
                header("refresh:2,url= 'index.php'");
            } else {
                $sql = "DELETE FROM tbl_product WHERE product_id='$product_id'";
                $checkNum = chayTruyVanTraVeDL($link, $sql);
                chayTruyVanKhongTraVeDL($link, $sql);
                $_SESSION['status'] = "Xóa phòng thành công";
                header("refresh:2,url= 'index.php'");
            }
        }
        ?>
        <h1 style="text-align: center;">Quản lí phòng</h1>
        <div class="col-md-12">
            <?php if (isset($_SESSION['status'])) : ?>
                <?php if ($_SESSION['status'] == "Xóa phòng thành công") : ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['status']; ?>
                    </div>
                <?php endif; ?>
                <?php if ($_SESSION['status'] == "Xóa phòng thất bại") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['status']; ?>
                    </div>
                <?php endif; ?>
                <?php unset($_SESSION['status']); ?>
            <?php endif ?>
        </div>
        <a href="create.php" class="btn btn-success">Thêm </a>
        <form class="search-product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (isset($_GET['product_name']) ? '?product_name=' . htmlspecialchars($_GET['product_name']) : ''); ?>" method="GET">
            <input type="text" name="product_name" placeholder="Tìm kiếm sản phẩm">
            <button type="submit">Tìm</button>
        </form>
        <form action="" class="formsort" method="GET">
            <h5 style=" padding-top : 10px">Bộ Lọc Phòng</h5>
            <hr>
            <input type="radio" name="Options" id="option" value="DESC"> &nbsp Giá cao tới thấp &nbsp&nbsp&nbsp
            <input type="radio" name="Options" id="option" value="ASC"> &nbsp Giá thấp tới cao &nbsp&nbsp
            <select name="selectname">
                <option value=" " selected="selected">Khu vực</option>
                <option value="5">Ba Đình</option>
                <option value="6">Từ Liêm</option>
                <option value="7">Hà Đông</option>
                <option value="8">Hai Bà Trưng</option>
            </select>
            <input type="submit" value="Lọc" style="padding : 0px 10px">
            <hr>
        </form>
        <table class="table">
            <thead class="thead-dark">
                <th>Id</th>
                <th>Tên phòng</th>
                <th>Giá phòng</th>
                <th>Ảnh</th>
                <th>Ngày bắt đầu ở được</th>
                <th>Địa chỉ cụ thể</th>
                <th>Khu vực</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </thead>
            <?php


            if ($result) :
                if (isset($_GET['product_name'])) {
                    // Handle the product_name form submission and construct the SQL query accordingly
                    $name = $_GET["product_name"];
                    $sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$name%'";
                } elseif (isset($_GET["Options"]) && in_array($_GET["Options"], ["ASC", "DESC"])) {
                    // Handle the sorting form submission and construct the SQL query accordingly
                    $price_sort = $_GET["Options"];
                    $sql = "SELECT * FROM tbl_product ORDER BY product_price $price_sort";
                } elseif (isset($_GET["selectname"]) && !empty($_GET["selectname"])) {
                    // Handle the location form submission and construct the SQL query accordingly
                    $location = $_GET["selectname"];
                    $sql = "SELECT * FROM tbl_product WHERE category_id = '$location'";
                } else {
                    // Default SQL query if no form is submitted
                    $sql = "SELECT * FROM tbl_product";
                }

                // Execute the SQL query
                $result = mysqli_query($link, $sql);


                while ($rows = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <th><?= $rows['product_id'] ?></th>
                        <th><?= $rows['product_name'] ?></th>
                        <th><?= $rows['product_price'] ?></th>
                        <th><img src="../../img/<?= $rows['product_thumnail'] ?>" width="150px" style="height: 150px;"></th>
                        <th><?= $rows['product_maintenance'] ?></th>
                        <th><?= $rows['product_producer'] ?></th>

                        <th><?= $rows['category_id'] ?></th>
                        <th><a onclick="return confirm('Bạn có muốn sửa phòng này?')" href="update.php?product_id=<?= $rows['product_id'] ?>" class="btn btn-primary">Sửa</a></th>
                        <th><a href="?product_id=<?= $rows['product_id'] ?>" class="btn btn-danger delete-btn" onclick="return confirm('Bạn có muốn xóa phòng này?')">Xóa </a></th>
                    </tr>
                <?php endwhile; ?>
            <?php endif ?>
        </table>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

<?php include '../inc/footer.php'; ?>