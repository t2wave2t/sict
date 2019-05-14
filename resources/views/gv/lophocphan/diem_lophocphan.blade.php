@extends('gv.master')
@section('content')
<!-- page content -->
<div class="right_col" role="main" style="min-height:auto !important;">
  <!-- top tiles -->

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Danh sách lớp học phần
          <small>
            <!-- Học kỳ -->
            <select class="học kỳ">
              @for($i=1; $i<=3;$i++)
                @if ($i==3)
                  <option value="{!! $i !!}">
                    Học kỳ hè
                  </option>
                @else
                  <option value="{!! $i !!}">
                    Học kỳ {!! $i !!}
                  </option>
                @endif
              @endfor
            </select>
            <!-- Năm học -->
            <select class="namhoc">
              @foreach ($namhoc as $item)
                <option value="{!! $item["id"] !!}">
                  Năm học {!! $item["nambatdau"] !!} - {!! $item["namketthuc"] !!}
                </option>
              @endforeach
            </select>
          </small>
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">

        </p>
        <table id="datatable-buttons" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="5%">STT</th>
              <th>Lớp học phần</th>
              <th width="5%">SL</th>
              <th width="31%">Thời khóa biểu</th>
              <th width="15%"></th>
            </tr>
          </thead>
          <tbody>
          <?php $stt=1; ?>
            @foreach($ds_lophp as $item)
              <tr class="even pointer">
                <td class=" " align="center">{!! $stt++ !!}</td>
                <td class=" ">{!! $item["tenlop"] !!}</td>
                <td class=" ">{!! $item["soluong"] !!}</td>
                <td class=" ">Tuần {!! $item["tuan"] !!} | {!! $item["phong"] !!} | {!! $item["thu"] !!} | Tiết {!! $item["tiet"] !!}</td>
                <td><a href="{!! URL::route('gv.getNhapdiem',$item["id"]) !!}" name="diem">Nhập điểm</a></td>
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