@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Điểm tổng kết <b>{!! $info_sv['masv'] !!} - {!! $info_sv['hodem'] !!} {!! $info_sv['ten'] !!}</b></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p></p>

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Học kỳ</th>
                            <th class="column-title">Số TC-ĐK</th>
                            <th class="column-title">Số TC-ĐK Mới</th>
                            <th class="column-title">Điểm 4</th>
                            <th class="column-title">Điểm 10</th>
                            <th class="column-title">Điểm HB</th>
                            <th class="column-title">TC TL HK</th>
                            <th class="column-title">Xếp loại</th>
                            <th class="column-title">Điểm 4 TL</th>
                            <th class="column-title">Điểm 10 TL</th>
                            <th class="column-title">TC Tích lũy</th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $stt=1; ?>
                        @foreach($hocvu as $item)
                            <tr class="even pointer">
                                <td align="center" class=" ">{!! $stt++ !!}</td>
                                <?php $namhochocky = DB::table('table_namhoc_hocky')->select('nambatdau','namketthuc','hocky')->where('id',$item['namhoc'])->first(); ?>
                                <td class=" ">Học kỳ {!! $item['hocky'] !!}, năm {!! $namhochocky->nambatdau !!} - {!! $namhochocky->namketthuc !!}</td>
                                <td class=" ">{!! $item['sotcDK'] !!}</td>
                                <td class=" ">{!! $item['soTCMoi'] !!}</td>
                                <td class=" "><b><code>{!! $item['diemTB4'] !!}</code></b></td>
                                <td class=" ">{!! $item['diemTB10'] !!}</td>
                                <td class=" ">{!! $item['diemHB'] !!}</td>
                                <td class=" ">{!! $item['soTCTLhocki'] !!}</td>
                                <td class=" "><b><code>{!! $item['xeploai'] !!}</code></b></td>
                                <td class=" ">{!! $item['diemTL4'] !!}</td>
                                <td class=" ">{!! $item['diemTL10'] !!}</td>
                                <td class=" ">{!! $item['soTCTL'] !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Điểm học phần sinh viên <b>{!! $info_sv['masv'] !!} - {!! $info_sv['hodem'] !!} {!! $info_sv['ten'] !!}</b></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p></p>

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Tên lớp học phần </th>
                            <th class="column-title">Lần học </th>
                            <th class="column-title">Điểm CC </th>
                            <th class="column-title">Điểm Bài tập </th>
                            <th class="column-title">Điểm Giữa kỳ </th>
                            <th class="column-title">Điểm Cuối kỳ </th>
                            <th class="column-title">Điểm Đồ án </th>
                            <th class="column-title">Điểm Điểm T10 </th>
                            <th class="column-title">Điểm Điểm Chữ </th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $stt=1; ?>
                        @foreach($diem as $item)
                            <tr class="even pointer">
                                <td align="center" class=" ">{!! $stt++ !!}</td>
                                <td class=" ">{!! $item->tenhocphan !!}</td>
                                <td align="center" class=" ">{!! $item->lanhoc !!}</td>
                                <?php $diem_item = explode(",", $item->diem); ?>
                                <td align="center" class=" ">{!! $diem_item[0] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[1] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[2] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[3] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[4] !!}</td>
                                <td align="center" class=" "><b>{!! $item->diemt10 !!}</b></td>
                                <td align="center" class=" "><b>{!! $item->diemchu !!}</b></td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


        <!-- /top tiles -->

    <!-- /page content -->
@stop