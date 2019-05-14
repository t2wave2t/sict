@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Chi tiết sinh viên <b>{!! $info_sv->masv !!} - {!! $info_sv->hodem !!} {!! $info_sv->ten !!}</b></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table  class=" table table-striped jambo_table bulk_action">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Lớp học phần</th>
                        <th>Thời gian vắng</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $stt=1; ?>
                    @foreach($chitiet_vang as $item)
                        <tr class="even pointer">
                            <td class=" ">{!! $stt++ !!}</td>
                            <td class=" ">{!! $item->tenlop !!} <br></td>
                            <td class=" ">{!! $item->ngaynghi !!} </td>
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