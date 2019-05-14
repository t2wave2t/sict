@extends('admincp.ad_master')
@section('content')
<!-- page content -->
  <!-- top tiles -->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thêm lớp học phần</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            @include('admincp.blocks.error')
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{!! route('ad.getAddLHP') !!}" method="POST"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="giaotrinh">Tên lớp học phần <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="giao-trinh" name="giaotrinh" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Học phần
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Giảng viên
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Tuần
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Phòng
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Thứ
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Tiết
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="hocphan" name="hocphan" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <!-- editor -->

                <div class="form-group">
                    <label for="mota" class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="resizable_textarea form-control" placeholder="Mô tả về giáo trình" name="mota"></textarea>
                    </div>
                </div>

                <!-- end editor -->

                <div class="form-group">
                    <label for="files" class="control-label col-md-3 col-sm-3 col-xs-12">Files <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="files" class="form-control col-md-7 col-xs-12" type="file" name="files" required="required">
                    </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Upload</button>
                        <button class="btn btn-primary" type="reset">Nhập lại</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
  <!-- /top tiles -->
<!-- /page content -->
@stop