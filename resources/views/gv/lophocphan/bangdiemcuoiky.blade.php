<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .title{
                font-size: 20px;
                padding-top:50px;
            }
            table {
                border-collapse: collapse;
            }
            #table3 td{
              font-size: 14px;
            }

             #table2 th, td{
              font-size: 16px;
            }

            #table1 td {
                
                font-size: 14px;
                border: 1px solid black;
            }

            #table1 th{
                
                font-size: 10px;
                border: 1px solid black;
            }

            #table1 td.name{
              border-left-style: none;
            }

            #table4{
              margin-top:40px;
            }
            #table4 th, td{
                
                font-size: 13px;
                
            }          
        </style>
    </head>
<body>
<?php
function convert_number_to_words($number) {
 
$hyphen      = ' ';
$conjunction = '  ';
$separator   = ' ';
$negative    = 'âm ';
$decimal     = ' phẩy ';
$dictionary  = array(
0                   => 'Không',
1                   => 'Một',
2                   => 'Hai',
3                   => 'Ba',
4                   => 'Bốn',
5                   => 'Năm',
6                   => 'Sáu',
7                   => 'Bảy',
8                   => 'Tám',
9                   => 'Chín',
10                  => 'Mười',
11                  => 'Mười một',
12                  => 'Mười hai',
13                  => 'Mười ba',
14                  => 'Mười bốn',
15                  => 'Mười năm',
16                  => 'Mười sáu',
17                  => 'Mười bảy',
18                  => 'Mười tám',
19                  => 'Mười chín',
20                  => 'Hai mươi',
30                  => 'Ba mươi',
40                  => 'Bốn mươi',
50                  => 'Năm mươi',
60                  => 'Sáu mươi',
70                  => 'Bảy mươi',
80                  => 'Tám mươi',
90                  => 'Chín mươi',
100                 => 'trăm',
1000                => 'ngàn',
1000000             => 'triệu',
1000000000          => 'tỷ',
1000000000000       => 'nghìn tỷ',
1000000000000000    => 'ngàn triệu triệu',
1000000000000000000 => 'tỷ tỷ'
);
 
if (!is_numeric($number)) {
return false;
}
 
if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
// overflow
trigger_error(
'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
E_USER_WARNING
);
return false;
}
 
if ($number < 0) {
return $negative . convert_number_to_words(abs($number));
}
 
$string = $fraction = null;
 
if (strpos($number, '.') !== false) {
list($number, $fraction) = explode('.', $number);
}
 
switch (true) {
case $number < 21:
$string = $dictionary[$number];
break;
case $number < 100:
$tens   = ((int) ($number / 10)) * 10;
$units  = $number % 10;
$string = $dictionary[$tens];
if ($units) {
$string .= $hyphen . $dictionary[$units];
}
break;
case $number < 1000:
$hundreds  = $number / 100;
$remainder = $number % 100;
$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
if ($remainder) {
$string .= $conjunction . convert_number_to_words($remainder);
}
break;
default:
$baseUnit = pow(1000, floor(log($number, 1000)));
$numBaseUnits = (int) ($number / $baseUnit);
$remainder = $number % $baseUnit;
$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
if ($remainder) {
$string .= $remainder < 100 ? $conjunction : $separator;
$string .= convert_number_to_words($remainder);
}
break;
}
 
if (null !== $fraction && is_numeric($fraction)) {
$string .= $decimal;
$words = array();
foreach (str_split((string) $fraction) as $number) {
$words[] = $dictionary[$number];
}
$string .= implode(' ', $words);
}
 
return $string;
}
?>
    <table width="100%" id="table3" >
        <tr>
            <td align="center" width="55%">ĐẠI HỌC ĐÀ NẴNG</td>
            <td align="center" width="45%"><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></td>
            
        </tr>
        <tr>
            <td align="center"><b>KHOA CÔNG NGHỆ THÔNG TIN VÀ TRUYỀN THÔNG</b></td>
            <td align="center"><b>Độc lập - Tự do - Hạnh phúc</b></td>
            
        </tr>
        <tr>
            <td align="center">-----------------***-----------------</td>
            <td align="center">      -------------***-------------</td>
        </tr>
        <tr>
            <td align="center" colspan="2" height="100"><span class="title"><b>DANH SÁCH SINH VIÊN DỰ THI KẾT THÚC HỌC KỲ</b></span></td>
        </tr>

    </table>
    <table width="100%" id="table2">
        <tr>
          <td width="50%">
            <b>Học kỳ {!! $nh_hienhanh["hocky"] !!} Năm học {!! $nh_hienhanh["nambatdau"] !!}-{!! $nh_hienhanh["namketthuc"] !!}</b>
          </td>
          
          <td width="50%">Ngày thi: </td>
        </tr>
        <tr>
          <td>
            Tên lớp học phần: <b>{!! $lophp["tenlop"] !!}</b>
          </td>
           
          <td>Giờ thi: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phòng thi:</td>
        </tr>
        <tr>
          <td>
            Số tín chỉ: <b>{!! $sotc["sotc"] !!}</b>
          </td>
           
          <td>Khoa CNTT-TT:         </td>
        </tr>
    </table>
    <table width="100%" id="table1">
      <thead>
        <tr>
          <th rowspan="3" width="5%">STT</th>
          <th colspan="5" width="50%">THÔNG TIN SINH VIÊN</th>
          <th colspan="2" width="50%">ĐIỂM</th>
          <th colspan="5" width="40%">THI KẾT THÚC</th>
          <th rowspan="3" width="6%">GHI CHÚ</th>
        </tr>
        <tr>
          <th rowspan="2" width="9%">SỐ THẺ</th>
          <th rowspan="2" colspan="2">HỌ VÀ TÊN</th>
          <th rowspan="2" width="10%">NGÀY SINH</th>
          <th rowspan="2" width="5%">LỚP SH</th>
          <th rowspan="2" width="4%">CHUYÊN CẦN (10%)</th>
          <th rowspan="2" width="4%">BT/TH/TL (20%)</th>
          <th rowspan="2" width="5%">MÃ ĐỀ THI</th>
          <th rowspan="2" width="5%">SỐ TỜ GIẤY THI</th>
          <th rowspan="2" width="8%">CHỮ KÝ SINH VIÊN DỰ THI</th>
          <th colspan="2" width="5%">ĐIỂM KẾT THÚC</th>
        </tr>
        <tr>
          <th width="5%">SỐ</th>
          <th width="8%">CHỮ</th>
        </tr>
      </thead>
        <?php $stt=1; ?>
        @foreach($dssvlhp as $item)
          <tr class="content">
            <td align="center">{!! $stt++ !!}</td>
            <td align="center">{!! $item->masv !!}</td>
            <td>{!! $item->hodem !!}</td>
            <td class="name" >{!! $item->ten !!}</td>
            <td align="center">{!! date('d/m/Y', strtotime($item->ngaysinh)); !!}</td>
            <td align="center">{!! $item->tenlop !!}</td>
            <?php $diem_item = explode(",",$item->diem_phu); ?>
            <td align="center">{!! $diem_item[0] !!}</td>
            <td align="center">{!! $diem_item[1] !!}</td>
            <td></td>
            <td></td>
            <td></td>
            <td align="center">{!! $diem_item[3] !!}</td>
            <td align="center"><span style="font-size: 7px;"><?php echo convert_number_to_words($diem_item[3]); ?><span></td>            
            <td></td>
          </tr>
          @endforeach
    </table>
    <span>* <i>Số lượng sinh viên dự thi: .....</i></span>
    <table width="100%" id="table4">
      <tr>
        <th align="center">CÁC CÁN BỘ CHẤM THI</th>
        <th align="center">KHOA (BỘ MÔN) DUYỆT</th>
        <th align="center">CÁC CÁN BỘ COI THI</th>
      </tr>
      <tr>
        <td align="center"><i>Ký và ghi rõ họ và tên</i></td>
        <td align="center"><i>Ký và ghi rõ họ và tên</i></td>
        <td align="center"><i>Ký và ghi rõ họ và tên</i></td>
      </tr>
    </table>
<script type="text/javascript">
  window.print();
</script>
</body>
</html>
