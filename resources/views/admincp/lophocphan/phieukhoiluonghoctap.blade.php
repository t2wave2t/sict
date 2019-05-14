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
                font-size: 22px;
                padding-top:50px;
            }
        </style>
    </head>
<body>
<?php

?>
    <table width="100%">
        <tr>
            <td align="center" width="40%">ĐẠI HỌC ĐÀ NẴNG</td>
            <td align="center" width="60%">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
        </tr>
        <tr>
            <td align="center"><u>KHOA CNTT & TT</u></td>
            <td align="center"><u>Độc lập - Tự do - Hạnh phúc</u></td>
        </tr>
        <tr>
            <td align="center" colspan="2" height="100"><span class="title"><b>PHIẾU ĐĂNG KÝ KHỐI LƯỢNG HỌC TẬP</b></span><br>(Học kỳ {!! $nh_hienhanh["hocky"] !!} Năm học {!! $nh_hienhanh["nambatdau"] !!}-{!! $nh_hienhanh["namketthuc"] !!})</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td colspan="2"><b>I. Thông tin sinh viên</b></td>
        </tr>
        <tr>
            <td>Họ và tên: <b>{!! $tt_sv->hodem !!} {!! $tt_sv->ten !!}</b></td>
            <td>Số thẻ sinh viên: <b>{!! $tt_sv->masv !!}</b></td>
        </tr>
        <tr>
            <td width="50%">Khóa học: {!! $tt_sv->khoahoc !!}</td>
            <td width="50%">Lớp sinh hoạt:  {!! $tt_sv->tenlop !!}</td>
        </tr>
        <tr>
            <td>Ngành: {!! $tt_sv->tennganh !!}</td>
            <td>Ngày sinh:  {!! $tt_sv->ngaysinh !!}</td>
        </tr>
        <tr>
            <td colspan="2"><b>II. Đăng ký học tập</b></td>
        </tr>
        <tr>
            <td colspan="2">Số lượng học phần đăng ký: <b>{!! $khoiluong->sohocphan !!}</b> học phần</td>
        </tr>
        <tr>
            <td colspan="2">Khối lượng học tập đăng ký: <b>{!! $khoiluong->sotc !!}</b> tín chỉ</td>
        </tr>
        <tr>
            <td colspan="2"><b>III. Thời khóa biểu</b></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php $stt = 1; ?>
                <table border="1" width="100%">
                    <tr>
                        <th>STT</th>
                        <th>Tên lớp học phần</th>
                        <th>Số TC</th>
                        <th>Giảng viên</th>
                        <th>Thời khóa biểu</th>
                    </tr>
                    @foreach($tkb as $item)
                        <tr>
                            <td align="center">{!! $stt++ !!}</td>
                            <td align="left">{!! $item->tenlop !!}</td>
                            <td align="center">{!! $item->sotc !!}</td>
                            <td align="left" width="30%">{!! $item->chucdanh !!}. {!! $item->hodem !!} {!! $item->ten !!}</td>
                            <td align="center">{!! $item->tuan !!} | {!! $item->phong !!} | {!! $item->thu !!} | {!! $item->tiet !!}</td>
                        </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><b>IV. Lưu ý</b></td>
        </tr>
        <tr>
            <td colspan="2">
                a) Phiếu này dùng để xác nhận kết quả đăng ký khối lượng học tập của sinh viên trong từng kỳ học.<br>
                b) Sinh viên phải thông qua cố vấn học tập (giảng viên chủ nhiệm) về kết quả đăng ký khối lượng học tập của mình.<br>
                c) Phiếu này được lưu trữ tại Văn phòng Khoa Công nghệ Thông tin và Truyền thông.
            </td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <?php
                $now = getdate();
                $currentDate = " ngày ".$now["mday"]. " tháng " .$now["mon"] . " năm " . $now["year"];
            ?>
            <td align="center"><i>Đà Nẵng, {!! $currentDate !!}</i></td>
        </tr>
        <tr>
            <td align="center"><b>CỐ VẤN HỌC TẬP</b></td>
            <td align="center"><b>SINH VIÊN ĐĂNG KÝ</b></td>
        </tr>
        <tr>
            <td align="center"><b>(GIẢNG VIÊN CHỦ NHIỆM)</b></td>
            <td align="center"><i>(ký và ghi rõ họ tên)</i></td>
        </tr>
        <tr>
            <td align="center"><i>(ký và ghi rõ họ tên)</i></td>
            <td></td>
        </tr>
    </table>
</body>
</html>
