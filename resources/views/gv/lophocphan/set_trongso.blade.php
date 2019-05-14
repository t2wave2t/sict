@extends('gv.master')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Trọng số lớp học phần</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        @include('gv.blocks.error')
                        <form id="settrongso" name="settrongso" action="" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                          <input type="hidden" name="_token" value="{!! csrf_token() !!}" >
                            @foreach($ts_lhp as $item_ts)
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{!! $item_ts->matrongso !!}">{!! $item_ts->tentrongso !!}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="{!! $item_ts->matrongso !!}" name="{!! $item_ts->matrongso !!}"  value="{!! $item_ts->trongso !!}"  class="form-control col-md-7 col-xs-12" >
                                </div>
                              </div>
                            @endforeach

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="reset">Nhập lại</button>
                                    <button type="submit" onclick="checkvalue()" class="btn btn-success">Cập nhập</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- /top tiles -->
    </div>
    <!-- /page content -->
    <script>
        function checkvalue() {
            var chuyencan  = $('#chuyen_can').val();
            var baitap     = $('#bai_tap').val();
            var giuaky     = $('#giua_ky').val();
            var cuoiky     = $('#cuoi_ky').val();
            var doan       = $('#do_an').val();
            var tongtrongso = parseFloat(chuyencan) + parseFloat(baitap) + parseFloat(giuaky) + parseFloat(cuoiky) +parseFloat(doan);

            if (tongtrongso == 1)
            {
                alert("Xác nhận thay đổi?");
                return true;
            }
            else if (tongtrongso != 1)
            {
                alert("Tổng Trọng số của lớp học phần phải bằng 1");
                return false;
            }

        }
    </script>
@stop