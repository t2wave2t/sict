@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách lớp sinh hoạt</h2>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Lớp</th>
                        <th>Giáo viên chủ nhiệm</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt=1; ?>
                    @foreach($dslopsh as $item)
                        <tr>
                            <th scope="row">{!! $stt++ !!}</th>
                            <td>{!! $item->tenlop !!}</td>
                            <td>{!! $item->chucdanh !!}. {!! $item->hodem !!} {!! $item->ten !!}</td>
                            <td><i class="fa fa-info  fa-fw"></i><a href="{!! URL::route('ad.getChitiet',$item->id) !!}">Chi tiết</a></td>
                            <td><i class="fa fa-info  fa-fw"></i><a href="{!! URL::route('ad.getAllPhieu',$item->id) !!}">In phiếu</a></td>
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