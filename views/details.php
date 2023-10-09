<?php
include '../modules/session.php';
Session::init();
?>

<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>web-ban-giay</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="../styles/vendors/font-awesome/css/font-awesome.min.css">
    </head>

    <body>
        <div class="container-fluid container1">
            <div id="header">
                <header>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header bg-secondary">
                                <div class="menu w-100 h-100">
                                    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index:10">
                                        <a class="navbar-brand" href="index.php">SHOP</a>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav mr-auto">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="adidas.php">Adidas <span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="nike.php">Nike <span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="jordan.php">Jordan <span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="yeezy.php">Yeezy <span class="sr-only">(current)</span></a>
                                                </li>
                                            </ul>
                                            <form class="form-inline my-2 my-lg-0">
                                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                                <btn class="block btn"><i class="fa fa-search" aria-hidden="true"></i></btn>
                                            </form>
                                            <ul class="ml-3 navbar-nav">
                                                <?php
                                                if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                                    Session::destroy();
                                                }
                                                ?>
                                                <li class="nav-item active" style="padding-top: 5px;">
                                                    <a class="nav-link" href="cart_invoke.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item active ">
                                                    <a class="mr-2 nav-link" href="?action=logout"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo Session::checkSign() ?> <span class="sr-only">(current)</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <main class="content dynamic-container row">
                <?php
                if (isset($_GET['product_id'])) {
                    require_once "../controllers/detail_controller.php";
                    $controller = new DetailController();
                    $controller->product_detail_invoke($_GET['product_id']);
                }
                ?>
            </main>
            <div id="footer" style="margin-top: 100px;">
                <footer class="container-fluid" style="background-color: #53d2dc;">
                    <div class="row">
                        <div class="col-md-3">
                            <h1>DBHD</h1>
                            <p>Mang trong mình khát khao định hình lại thị trường nhà trọ truyền thống thông qua việc nâng cao tiêu
                                chuẩn các căn hộ và ứng dụng chuyển đổi số. Từ đó xây dựng hệ sinh thái căn hộ cho thuê trải dài
                                trên toàn lãnh thổ Việt Nam, mang lại môi trường sống hạnh phúc, tiện nghi cho cộng đồng những người
                                đi thuê nhà.</p>
                        </div>
                        <div class="col-md-3">
                            <h1>Về chúng tôi</h1>
                            <p><a>Về chúng tôi</a></p>
                            <p><a>Toà nhà</a></p>
                            <p><a>Tin tức</a></p>
                        </div>
                        <div class="col-md-3">
                            <h1>Chính sách</h1>
                            <p><a>Hợp tác</a></p>
                            <p><a>Liên hệ</a></p>
                        </div>
                        <div class="col-md-3">
                            <h1>Liên hệ</h1>
                            <p>Email: <a>nhom9dhh11c12@gmail.com</a></p>
                            <p>Số điện thoại: <a>0368966992</a></p>
                            <p>Địa chỉ : 41A Đ. Phú Diễn, Phú Diễn, Bắc Từ Liêm, Hà Nội, Việt Nam</p>
                        </div>
                    </div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.655069674606!2d105.76220289999999!3d21.0464832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c3ce577141%3A0xb1a1ac92701777bc!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUw6BpIG5ndXnDqm4gdsOgIE3DtGkgdHLGsOG7nW5nIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1694837264947!5m2!1svi!2s" width="100%" height="200" style="border:0; padding: 0px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    </body>