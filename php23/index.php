<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<!-- 
	Trong php đối tượng đượ định nghĩa theo cấu trúc
	- class tên lớp{}
	- trong class có cacs thuộc tính
	- ĐỊnh nghĩa đối tượng thuộc class $obj= new tênclass();


-->
<?php 
 /**
 * Đối tượng sinh viên
 */
 class SinhVien
 {
 	public $hoten,$namsinh;
 	public function __construct()
 	{
 		echo "Hàm tạo được gọi</br>";
 		$this->hoten="abc";
 		$this->namsinh=1997;
 	}
 	public function Display()
 	{
 		echo "Display SinhVien Information</br>";
 	}
 	public function __destruct()
 	{
 		echo "Hàm hủy được gọi";
 	}
 }
 $sv = new SinhVien();
 $sv->Display();
 echo "HIện ra tên sinh viên: ";
 echo $sv->hoten."</br>";
 ?>
</body>
</html>