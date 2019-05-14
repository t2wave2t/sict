@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách sinh viên lớp <b>{!! $lop->tenlop !!}</b></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table  class=" table table-striped jambo_table bulk_action">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Họ đệm</th>
                        <th>Tên</th>
                        <th>Số lần nghỉ</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $stt=1; ?>
                    @foreach($ds_sv as $item)
                        <tr class="even pointer">
                            <td class=" ">{!! $stt++ !!}</td>
                            <td class=" ">{!! $item->masv !!} <br></td>
                            <td class=" ">{!! $item->hodem !!} </td>
                            <td class=" ">{!! $item->ten !!}</td>
                            <td class=" ">{!! $item->lannghi !!}</td>
                            <td class=" "><i class="fa fa-info  fa-fw"></i><a href="{!! URL::route('ad.getDiemdanhSV',$item->masv) !!}">Chi tiết</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


        <!-- /top tiles -->

    <!-- /page content -->
@stop