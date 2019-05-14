@extends('gv.master')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách lớp sinh hoạt

                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">

                    </p>
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="7%">STT</th>
                            <th width="20%">Lớp sinh hoạt</th>
                            <th>Ghi chú</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $stt=1; ?>
                        @foreach($lopsh as $item)
                            <tr class="even pointer">
                                <td class=" " align="center">{!! $stt++ !!}</td>
                                <td class=" ">{!! $item['tenlop'] !!}</td>
                                <td class=" ">{!! $item['ghichu'] !!}</td>
                                <td class=" last"><a href="{!! URL::route('gv.getDSSVLSH',$item['id']) !!}" name="dslhp"><span class="fa fa-group"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- /top tiles -->
    </div>
    <!-- /page content -->
@stop