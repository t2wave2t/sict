@extends('sv.sv_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Thời khóa biểu Học kỳ {!! $namhoc->hocky !!}, năm học {!! $namhoc->nambatdau !!} - {!! $namhoc->namketthuc !!}
                    </h2>
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
                                <th class="column-title">Giáo viên</th>
                                <th class="column-title">Tuần</th>
                                <th class="column-title">Phòng</th>
                                <th class="column-title">Thứ</th>
                                <th class="column-title">Tiết</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $stt=1; ?>
                                @foreach($lophocphan as $item)
                                    <tr class="even pointer">
                                        <td align="center" class=" ">{!! $stt++ !!}</td>
                                        <td class=" ">{!! $item->tenlop !!}</td>
                                        <td align="left" class=" ">{!! $item->chucdanh !!}. {!! $item->hodem !!} {!! $item->ten !!}</td>
                                        <td align="left" class=" "><b>{!! $item->tuan !!}</b></td>
                                        <td align="left" class=" "><b>{!! $item->phong !!}</b></td>
                                        <td align="left" class=" "><b>{!! $item->thu !!}</b></td>
                                        <td align="left" class=" "><b>{!! $item->tiet !!}</b></td>
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