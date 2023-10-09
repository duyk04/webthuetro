<?php
include '../src/components/header.php';
include 'product.php';

?>
<?php
require_once ".././modules/db_module.php";
$product = new product();
$link = null;
taoKetNoi($link);
$sql = "SELECT * FROM tbl_product";
$result = chayTruyVanTraVeDL($link, $sql);
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>web-ban-giay</title>
  <link rel="stylesheet" type="text/css" href="../styles/style_sang.css">
</head>
<?php
?>
<div class="row">
  <div class="col-sm-12 ">
    <div>
      
        <h5 style=" padding-top : 10px">Bộ Lọc Phòng</h5>
        <hr>
        <form action="" class="formsort" method="GET"> 
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
    </div>
    <div class="row">

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

        while ($rows =  mysqli_fetch_assoc($result)) : ?>
          <div class="col-12 col-sm-6 col-md-3 " style="padding-bottom: 20px">
            <div class="card">
              <a href="details.php?product_id=<?= $rows['product_id'] ?>"><img src="../img/<?php echo $rows['product_thumnail'] ?>" class="card-img-top" alt="..." height="220px"></a>
              <div class="card-body">
                <a href="details.php?product_id=<?= $rows['product_id'] ?>">
                  <h5 class="card-title"><?php echo $rows['product_name'] ?></h5>
                </a>
                <p class="price"><?php echo $rows['product_price'] . " " . "VNĐ" ?> </p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif ?>
    </div>

    <?php
    include '../src/components/footer.php';
    ?>