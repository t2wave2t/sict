@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách sinh viên lớp {!! $lop->tenlop !!}</h2>

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
                        <th>Số TCĐK</th>
                        <th>Số ĐK Mới</th>
                        <th>Điểm TB4</th>
                        <th>Điểm TB10</th>
                        <th>Số TCTL Học kỳ</th>
                        <th>Điểm TL4</th>
                        <th>Điểm TL10</th>
                        <th>Số TCTL</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt=1; ?>
                    @foreach($ds_sv as $item)
                        <tr>
                            <td scope="row">{!! $stt++ !!}</td>
                            <td>{!! $item->masv !!}</td>
                            <td>{!! $item->hodem !!}</td>
                            <td>{!! $item->ten !!}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>   
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