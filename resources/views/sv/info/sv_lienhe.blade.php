@extends('sv.sv_master')
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
                    @foreach($tt_gv as $item)
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i>Giảng viên</i></h4>
                                    <div class="left col-xs-7">
                                        <h2>{!! $item['chucdanh'] !!}.{!! $item['hodem'] !!} {!! $item['ten'] !!} </h2>
                                        <p><strong>Học phần: </strong>  </p>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-building"></i> Địa chỉ: </li>
                                            <li><i class="fa fa-phone"></i> Phone #: {!! $item['phone'] !!}</li>
                                        </ul>
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                        <img src="{{ url('public/gv/images/user.png') }}" alt="" class="img-circle img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                        <button type="button" class="btn btn-primary btn-xs">
                                            <i class="fa fa-link"> </i> Website
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    <!-- /top tiles -->

    <!-- /page content -->
@stop