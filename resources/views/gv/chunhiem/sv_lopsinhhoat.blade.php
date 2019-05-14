@extends('gv.master')
@section('content')
<!-- page content -->
<div class="right_col" role="main" style="min-height:5000px">
  <!-- top tiles -->

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Danh sách Sinh viên lớp học phần: <b><u>{!! $lopsh['tenlop'] !!}</u></b> </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table  id="datatable-fixed-header" class="table table-striped table-bordered">
          <thead>
          <tr>
            <th width="7%">STT</th>
            <th>Thông tin SV</th>
            <th width="7%">Vắng</th>
          </tr>
          </thead>

          <tbody>
          <?php $stt=1; ?>
            <?php
            /*if (count($results) > 0 && sizeof($results) > 0){
            for($i=0; $i<count($results); $i++) {
                $stt = $i+1;*/
                ?>
            @foreach($dssvlsh as $item)
              <tr class="even pointer">
                <td class=" " align="center">{!! $stt++ !!}</td>
                <td class=" ">
                  {!! $item->masv !!} <br>
                  <b>{!! $item->hodem !!} {!! $item->ten !!}</b> <br>
                </td>

                <td class=" " align="center">
                    <div class="{!! $item->masv !!}-solannghi">
                        @if( $item->songaynghi >=3 )
                            <b><code> {!! $item->songaynghi !!} </code></b>
                        @elseif( $item->songaynghi == 0 ) 0
                        @else <b> {!! $item->songaynghi !!}</b>
                        @endif
                    </div>
                </td>
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