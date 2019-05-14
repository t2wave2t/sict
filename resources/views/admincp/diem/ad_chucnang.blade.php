@extends('admincp.ad_master')
@section('content')
    <!-- page content -->

        <!-- top tiles -->
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Thông tin sinh viên</h2>
                                    <p>Thông tin của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <a href="{!! URL::route('ad.getDSSV',$lop->id) !!}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Xem danh sách lớp
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Điểm danh</h2>
                                    <p>Kiểm tra tình trạng vắng học của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <a href="{!! URL::route('ad.getDiemdanh',$lop->id) !!}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Xem tình trạng lớp
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Điểm sinh viên</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <a href="{!! URL::route('ad.getTonghop',$lop->id) !!}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Điểm lớp học phần
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Học vụ lớp</h2>
                                    <p>Xét học vụ sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <a href="{!! URL::route('ad.getDSdanghoc',$lop->id) !!}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Xét học vụ
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Xác nhận học tập</h2>
                                    <p>Kiểm tra tình trạng học tập của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <a href="{!! URL::route('ad.getdsxacnhanhoc',$lop->id) !!}">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Xem danh sách
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Học phí sinh viên</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Comming soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Các hoạt động</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Comming soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Nghiên cứu khoa học</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Comming soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Khen thưởng</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Comming soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                            <div class="col-sm-12">

                                <div class="left col-xs-7">
                                    <h2>Kỷ luật</h2>
                                    <p>Kiểm tra điểm cá nhân của sinh viên lớp <b> {!! $lop->tenlop !!} </b></p>
                                    <p><strong>Giáo viên chủ nhiệm: </strong> <br> {!! $lop->chucdanh !!}. {!! $lop->hodem !!} {!! $lop->ten !!}  </p>
                                </div>
                                <div class="right col-xs-5 text-center">
                                    <img src="{{ url('public/gv/images/img.jpg') }}" alt="" class="img-circle img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">

                                <div class="col-xs-12 col-sm-6 emphasis">
                                    <button type="button" class="btn btn-primary btn-xs">
                                        <i class="fa fa-user"> </i> Comming soon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


        <!-- /top tiles -->

    <!-- /page content -->
@stop