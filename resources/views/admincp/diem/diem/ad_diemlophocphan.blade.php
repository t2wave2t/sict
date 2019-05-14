@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->



    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Điểm lớp học phần <b>{!! $tenlop->tenlop !!}</b> </h2>
                <button type="submit" class="btn btn-success" style="float:right;" onclick="sendPoint('{!! $tenlop['id'] !!}')">Check điểm</button>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <p></p>

                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title">Mã sinh viên</th>
                            <th colspan="2" class="column-title" align="center">Họ và tên </th>
                            <th class="column-title">Lớp SH</th>
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
                        @foreach($diem_lhp as $item)
                            <tr class="even pointer">
                                <td align="center" class=" ">{!! $stt++ !!}</td>
                                <td class=" "><b>{!! $item->masv !!}</b></td>
                                <td align="left" class=" ">{!! $item->hodem !!} </td>
                                <td align="left" class=" "><b>{!! $item->ten !!}</b></td>
                                <td align="center" class=" ">{!! $item->tenlop !!}</td>
                                <?php $diem_item = explode(",", $item->diem); ?>
                                <td align="center" class=" ">{!! $diem_item[0] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[1] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[2] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[3] !!}</td>
                                <td align="center" class=" ">{!! $diem_item[4] !!}</td>
                                <td align="center" class=" "><b>{!! $item->diemt10 !!}</b></td>
                                @if($item->diemchu=='F')
                                    <td align="center" class=" "><code><b>{!! $item->diemchu !!}</b></code></td>
                                @else
                                    <td align="center" class=" "><b>{!! $item->diemchu !!}</b></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function sendPoint(_idlop)
    {
        var url = "{{ url('send_point') }}";
        var token = '{{ csrf_token() }}';

        $.post(url, {
            idlophp: _idlop,
            _token: token
        }, function (data) {
           location.reload();
        });
    }
</script>
        <!-- /top tiles -->

    <!-- /page content -->
@stop