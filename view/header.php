<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự án mẫu</title>
    <link rel="stylesheet" href="view/css/style.css">
</head>
<body>
    <div class="boxcenter">
      <div class="row mb header">
       <h1>MOBILE SHOP</h1>
      </div>
      <div class="row mb menu">
        <ul>
            <li><a href="index.php">Trang Chủ</a></li>
            <li><a href="index.php?act=gioithieu">Giới Thiệu</a></li>
            <li><a href="index.php?act=lienhe">Liên Hệ</a></li>
            <li><a href="index.php?act=gopy">Góp Ý</a></li>
            <li><a href="index.php?act=hoidap">Hỏi Đáp</a></li>

            <form action="index.php?act=sanpham" method="post" class="search">
                   <input type="text" name="kyw" >
                   <input type="submit" name="timkiem" value="Tìm Kiếm">
            </form>
        </ul>
        
      </div>