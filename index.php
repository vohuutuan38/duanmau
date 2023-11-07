<?php
session_start();
include "model/pdo.php";
include "model/danhmuc.php";
include "model/sanpham.php";
include "model/taikhoan.php";
include "model/cart.php";
include "view/header.php";
include "test.php";

if(!isset($_SESSION['mycart'])) $_SESSION['mycart'] =[];

$spnew=loadall_sanpham_home();
$dsdm=loadall_danhmuc();
$dstop10=loadall_sanpham_top10();

if((isset($_GET['act']))&&($_GET['act']!="")){
    $act=$_GET['act'];
    switch ($act) {
        
        case 'sanpham':
            //SP
            if(isset($_POST['kyw'])&&($_POST['kyw']!="")){
               $kyw=$_POST['kyw'];
            }else{
                $kyw="";
            }
            //DM
            if(isset($_GET['iddm'])&&($_GET['iddm']>0)){
                $iddm=$_GET['iddm'];
               
            }else{
                $iddm=0;
            }
            $dssp=loadall_sanpham($kyw,$iddm);
            $tendm=load_ten_dm($iddm);
            include "view/sanpham.php";
            break;
        case 'sanphamct':
            
            if(isset($_GET['idsp'])&&($_GET['idsp']>0)){
                $id=$_GET['idsp'];
                $onesp=loadone_sanpham($id);
                extract($onesp);
                $sp_cung_loai=load_sanpham_cungloai($id,$iddm);
                include "view/sanphamct.php";
            }else{
                include "view/home.php";
            }
           
            break;
        case 'dangky':
            if(isset($_POST['dangky'])&&($_POST['dangky'])){
                $email=$_POST['email'];
                $user=$_POST['user'];
                $pass=$_POST['pass'];
                insert_taikhoan($email,$user,$pass);
                $thongbao= "đã đăng ký thành công. Vui lòng đăng nhập để thực hiện chức năng bình luận hoặc đặt hàng";
            }
            include "view/taikhoan/dangky.php";
            break;    
        case 'dangnhap':
                if(isset($_POST['dangnhap'])&&($_POST['dangnhap'])){
                    $user=$_POST['user'];
                    $pass=$_POST['pass'];
                    $checkuser=checkuser($user,$pass);
                    if(is_array($checkuser)){
                    $_SESSION['user']=$checkuser;
                    // $thongbao= "bạn đã đăng nhập thành công"; 
                    header('Location: index.php');
                    
                    }else{
                    $thongbao= "tài khoản không tồn tại. Vui lòng kiểm tra hoặc đăng ký";
                    }
                }
                include "view/taikhoan/dangky.php";
                break;
        case 'edit_taikhoan':
                if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                    $user=$_POST['user'];
                    $pass=$_POST['pass'];
                    $email=$_POST['email'];
                    $address=$_POST['address'];
                    $tel=$_POST['tel'];
                    $id=$_POST['id'];
                    
                    update_taikhoan($id,$user,$pass,$email,$address,$tel);
                    $_SESSION['user']=checkuser($user,$pass);
                    header('Location: index.php?act=edit_taikhoan');
                    
                }
                include "view/taikhoan/edit_taikhoan.php";
                break;  
        case 'quenmk':
                if(isset($_POST['guiemail'])&&($_POST['guiemail'])){
                   
                    $email=$_POST['email09'];
                    $checkemail=checkemail($email);
                    if(is_array($checkemail)){
                       $thongbao="Mật khẩu của bạn là: ".$checkemail['pass'];
                    }else{
                        $thongbao="Email này không tồn tại";
                    }    
                }    
                include "view/taikhoan/quenmk.php";
                    break;                             
        case 'thoat':
            session_unset();
            header('Location: index.php');
            break;
        case 'addtocart':
            if(isset($_POST['addtocart'])&&($_POST['addtocart'])){
               $id=$_POST['id'];
               $name=$_POST['name'];
               $img=$_POST['img'];
               $price=$_POST['price'];
               $soluong=1;
               $ttien=$soluong*$price;
               $spadd=[$id,$name,$img,$price,$soluong,$ttien];
               array_push($_SESSION['mycart'],$spadd);
              
            }
           include "view/cart/viewcart.php";
            break;  
        case 'delcart':
            if(isset($_GET['idcart'])){
                array_splice($_SESSION['mycart'],$_GET['idcart'],1);/** tham số 1 là mảng cần xóa ,2 là vị trí xóa */
            }else{
                $_SESSION['mycart']=[];  
            }
            header('Location: index.php?act=viewcart');
            break;  
        case 'viewcart':
            include "view/cart/viewcart.php";
            break; 
        case 'bill':
            include "view/cart/bill.php";
            break; 
        case 'billcomfirm':
            if(isset($_POST['dongydathang'])&&($_POST['dongydathang'])){
               $name =$_POST['name']; 
               $email =$_POST['email']; 
               $address =$_POST['address']; 
               $tel =$_POST['tel']; 
               $pttt =$_POST['pttt'];
               $ngaydathang=date('h:i:sa d/m/Y');
               $tongdonhang=tongdonhang();  

               $idbill=insert_bill($name,$email,$address,$tel,$pttt,$ngaydathang,$tongdonhang);

               // insert into cart: $session['mycart'] & idbill
            }
            include "view/cart/billcomfirm.php";
            break;
        case 'mybill':
            include "view/cart/mybill.php";
            break;          
        case 'gioithieu':
            include "view/gioithieu.php";
            break;    
        case 'lienhe':
            include "view/lienhe.php";
            break;
        default:
            include "view/home.php";
            break;
    }
}else{
    include "view/home.php";
}

include "view/footer.php";

?>