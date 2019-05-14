@extends('gv.master')
@section('content')
<!-- page content -->
  <!-- top tiles -->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Hướng dẫn nhập điểm:</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        - <b style="">Giảng viên nhập điểm vào các cột điểm</b><br>
        - Sau khi nhập điểm, Giảng viên <b>LƯU ĐIỂM</b> lại trước khi <b>IN BẢNG ĐIỂM</b> và ký để nộp về phòng Đạo tạo
      </form>
    </div>
  </div>
</div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Danh sách Sinh viên lớp học phần: <b><u>{!! $lophp['tenlop'] !!}</u></b> </h2>
       <!--  @if(strtotime($currentDate)>=strtotime($dotnhapdiem['ngaybatdau']) && strtotime($dotnhapdiem['ngayketthuc'])>=strtotime($currentDate))
          @if($lophp['sent']==1)
            <button type="submit" class="btn btn-danger" style="float:right;" disabled>Đã gửi điểm đến Phòng Đào tạo</button>
          @else
            <button type="submit" class="btn btn-success" style="float:right;" onclick="sendPoint('{!! $lophp['id'] !!}')">Gửi điểm đến Phòng Đào tạo</button>
          @endif
        @endif -->
        <ul class="nav navbar-right panel_toolbox">
                      
                      <li class="">
                        <a href="#" onclick="reload()" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><button type="submit" class="btn btn-success" style="float:right;">LƯU ĐIỂM</button></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><button type="submit" class="btn btn-success" style="float:right;">IN BẢNG ĐIỂM</button></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="{!! URL::route('gv.bangDiemgiuaky',$lophp['id']) !!}">Bảng điểm giữa kỳ</a>
                          </li>
                          <li><a href="{!! URL::route('gv.bangDiemcuoiky',$lophp['id']) !!}">Bảng điểm cuối kỳ</a>
                          </li>
                        </ul>
                      </li>
                      
                    </ul>
        <!-- <a href="{!! URL::route('gv.bangDiemgiuaky',$lophp['id']) !!}"><button type="submit" class="btn btn-success" style="float:right;">IN BẢNG ĐIỂM GIỮA KỲ</button></a>  -->
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <table  class="table table-striped jambo_table bulk_action">
          <thead>
          <tr>
            <th align="center">STT</th>
            <th>Mã Sinh viên</th>
            <th>Họ đệm</th>
            <th>Tên</th>
            <th>Lớp SH</th>
              <?php
                $trongso_nhapdiem = explode(",", $dotnhapdiem['trongso']);
                $i=count($trongso_nhapdiem);
              ?>
            @foreach($trongso as $item_ts)
                <th align="center">{!! $item_ts->tentrongso !!}</th>
              
                  <!-- <th align="center"><input type="checkbox" name="others" class="{!! $item_ts->matrongso !!}_cb" onclick="enable_text(this.checked)" /> {!! $item_ts->tentrongso !!}</th> -->
            @endforeach
            <th>Điểm TB</th>
            <th>Điểm chữ</th>

          </tr>
          </thead>

          <tbody>
          <?php $stt=1; ?>
            <?php
            /*if (count($results) > 0 && sizeof($results) > 0){
            for($i=0; $i<count($results); $i++) {
                $stt = $i+1; lstoan*/
                ?>
            @foreach($dssvlhp as $item)
              <tr class="even pointer">
                <td align="center" class=" ">{!! $stt++ !!}</td>
                <td class=" ">{!! $item->masv !!}</td>
                <td class=" ">{!! $item->hodem !!}</td>
                <td class=" ">{!! $item->ten !!}</td>
                <td align="center" class=" ">{!! $item->tenlop !!}</td>
                <?php $diem_item = explode(",", $item->diem_phu); ?>

                @foreach($trongso as $item_ts)
                    <?php 
                      $ts = $item_ts->id - 1;
                    ?>
                    <td align="center" class=" ">
                      @if(in_array($item_ts->matrongso,$trongso_nhapdiem))
                        <input type="text" value="{!! $diem_item[$ts] !!}" class="{!! $item_ts->matrongso !!} form-control" name="{!! $item->masv !!}-{!! $item_ts->matrongso !!} {!! $item_ts->matrongso !!} diem-hoc-phan" size="5" onkeypress="return Validate(event);" maxlength="3" onchange="myFunction('{!! $item->masv !!}','{!! $item_ts->matrongso !!}',this.value)">
                      @else
                        <input type="text" readonly value="{!! $diem_item[$ts] !!}" disabled="disabled" class="{!! $item_ts->matrongso !!} form-control" name="{!! $item->masv !!}-{!! $item_ts->matrongso !!} {!! $item_ts->matrongso !!} diem-hoc-phan" size="5" onkeypress="return Validate(event);" maxlength="3" onchange="myFunction('{!! $item->masv !!}','{!! $item_ts->matrongso !!}',this.value)">
                      @endif
                    </td>


                @endforeach
                  <?php $ts=0; ?>
                <td class=" "><span class="diemthang10">{!! $item->diemt10 !!}</span></td>
                <td class=" ">{!! $item->diemchu !!}</td>
              </tr>
             @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
<script type="text/javascript">


  function reload(){
    location.reload();
  }
   

  function Validate(event) {
     
     
        var regex = new RegExp("^[0-9-,.?]");
        var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }


    } 
    /*$('.chuyen_can_cb').click(function() {
        $('.chuyen_can').attr("disabled", !this.checked);
    });
    $('.bai_tap_cb').click(function() {
        $('.bai_tap').attr("disabled", !this.checked);
    });
    $('.giua_ky_cb').click(function() {
        $('.giua_ky').attr("disabled", !this.checked);
    });
    $('.cuoi_ky_cb').click(function() {
        $('.cuoi_ky').attr("disabled", !this.checked);
    });
    $('.do_an_cb').click(function() {
        $('.do_an').attr("disabled", !this.checked);
    });*/

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

    function myFunction(_masv,_trongso,_value) {
       
        if (_value < 0 || _value > 10) {
            alert("Điểm không chính xác");
            location.reload();
        }
        else {

            var url = "{{ url('save_diem_lophocphan') }}";
            var token = '{{ csrf_token() }}';
            var idlophp = '{!! $lophp['id'] !!}';

            //var a = parseFloat(document.getElementById('diem-hoc-phan').value);

            $.post(url, {
                masv: _masv,
                trongso: _trongso,
                diem: _value,
                idlophp: idlophp,
                _token: token
            }, function (data) {

            });
        }


        /*var idlophp = "{!! $lophp['id'] !!}";
        $.ajax({
            type: "GET",
            url: "{{ url('save_diem_lophocphan') }}",
            data:{'masv':masv,'trongso':trongso,'diem':value,'idlophp':idlophp},
            success: function (data) {
                alert("OK");
            }
        });*/
    }



</script>

  <!-- /top tiles -->
<!-- /page content -->
@stop