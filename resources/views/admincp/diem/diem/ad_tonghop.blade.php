@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách điểm sinh viên lớp {!! $lop->tenlop !!}</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table table-striped jambo_table bulk_action">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã sinh viên</th>
                        <th>Họ đệm</th>
                        <th>Tên</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt=1; ?>
                    @foreach($ds_sv as $item)
                        <tr>
                            <th scope="row">{!! $stt++ !!}</th>
                            <td>{!! $item['masv'] !!}</td>
                            <td>{!! $item['hodem'] !!}</td>
                            <td>{!! $item['ten'] !!}</td>
                            <td><i class="fa fa-info  fa-fw"></i><a href="{!! URL::route('ad.getDiemCanhanSV',$item['masv']) !!}">Chi tiết</a></td>
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