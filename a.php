<meta charset="utf-8" />
<?php
ob_start();
$db = "localhost";
$name = "root";
$pass = "zacky";
$dbname = "it_db";

$con = mysql_connect($db,$name,$pass);
mysql_select_db($dbname,$con);
mysql_query("SET NAMES UTF8");
/**
for($i = 5; $i<=79; $i++ ) {
    $ms = strlen($i) == 1? '0'.$i : $i;
    $sql = "INSERT INTO `sinhvien` VALUES (
            '1112505322$ms', 
            'e10adc3949ba59abbe56e057f20f883e', 
            'Nguyễn Đức', 'Anh', 
            '1993-10-10', '0', 
            '197318".$ms."85', '2010-06-17', 
            'Quảng Trị', 'Thôn Kim Long', '03421', 
            'Nguyễn Văn Khánh', 'Nông dân', 
            'Nguyễn Thị Thanh Thủy', 'Nông dân', 
            'Hộ nghèo', 
            '2011-09-10', null, 
            '2011', 
            '11T2', '1')";
    $rs = mysql_query($sql);
}
*/

$fp = fopen('t1.txt','r') or exit('k tim thay file');
$ms = 10;
while(!feof($fp))
{
    $str = fgets($fp);
    $a = explode('|',$str);
    $msv = trim($a[1]);
    $ten = trim($a[2]);
    $ns = trim($a[3]);
    $dc = trim($a[4]);
    /**$sql = "INSERT INTO `sinhvien` VALUES (
            '$msv', 
            'e10adc3949ba59abbe56e057f20f883e', 
            '$ten', 
            '$ns', '0', 
            '19731".$ms."565', '2010-06-17', 
            'Quảng Nam', 'Thôn Kim Long', '03421', 
            'Nguyễn Tuấn', 'Nông dân', 
            'Nguyễn Thị Mai', 'Nông dân', 
            '1', 
            '2011-09-10', null, 
            '2011', 
            '11T3', '1')";**/
    //$sql ="UPDATE sinhvien set HoTen='$ten' WHERE MaSV='$msv'";
    $sql = "INSERT INTO HocPhi VALUES('$msv','113','2500000','2500000')";
    var_dump($a);
    $rs = mysql_query($sql);
    $ms++;
}
fclose($fp);
/**
//echo $_SERVER['REQUEST_URI'];
$ng = "<b>2013-''\ds'\dsa'd\a'&*(*&@(@*3-11</b>";
echo $ng,'<br />';
echo htmlentities(addslashes($ng));
echo '<br />';
echo htmlspecialchars($ng);
//$nd = '2013-02-18';
//if($ng < $nd) echo "Đâs";
//else echo "11";
//echo date('Y-m-d',strtotime($ng));
*/