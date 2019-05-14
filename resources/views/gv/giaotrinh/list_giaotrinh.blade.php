@extends('gv.master')
@section('content')
<!-- page content -->
  <!-- top tiles -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Danh sách Giáo trình</u></b> </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table  class=" table table-striped jambo_table bulk_action">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Giáo trình</th>
                    <th>Học phần Áp dụng</th>
                    <th>Mô tả</th>
                    <th>Link</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php $stt=1; ?>
                @if($ds_giaotrinh == NULL || $ds_giaotrinh=="")
                    <tr><td colspan="5">Chưa có giáo trình</td></tr>
                @else
                    @foreach($ds_giaotrinh as $item)
                        <tr class="even pointer">
                            <td class=" ">{!! $stt++ !!}</td>
                            <td class=" ">{!! $item['tengiaotrinh'] !!} <br></td>
                            <td class=" ">{!! $item['hocphan'] !!} </td>
                            <td class=" ">{!! $item['mota'] !!}</td>
                            <td class=" ">{!! $item['link'] !!}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa?')" href="{!! URL::route('gv.getGTDelete',$item['id']) !!}"> Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('gv.getGTEdit',$item["id"]) !!}">Sửa</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
  <!-- /top tiles -->
<!-- /page content -->
@stop