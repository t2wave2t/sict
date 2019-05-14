@extends('admincp.ad_master')
@section('content')
<!-- page content -->
  <!-- top tiles -->

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>In danh sách thi</h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <form class="form-horizontal form-label-left">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tenlop">Tên lớp học phần <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="ten-lop" readonly value="{!! $lophp['tenlop'] !!}" class="form-control col-md-7 col-xs-12">                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Số lượng">Số lượng SV<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="ten-lop" readonly value="{!! $soluong !!}" class="form-control col-md-7 col-xs-12">                       
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <p>
                        Cuối kỳ:
                        <input type="radio" class="flat" name="loaibangdiem" id="loaibangdiemCK" value="1" checked="" required /> Giữa kỳ:
                        <input type="radio" class="flat" name="loaibangdiem" id="loaibangdiemGK" value="2" />
                        </p>
                    </div>                
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hocphan">Tối đa mỗi lớp:
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" id="toidamoilop" class="toidamoilop" name="toidamoilop" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                    <button type="button" class="btn btn-success taolop">Tạo lớp</button>
                </div>
                 <!-- editor -->
            </form>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 lophocphan">
    
            
            
        
</div>


<script type="text/javascript">
      function createRoomtest(_loaibangdiem,_toidamoilop,_idlop)
      {
          var url   = "{{ url('get_ajax_create_roomtest_admincp') }}";
          var token = '{{ csrf_token() }}';
          $.post(url,{idlop:_idlop, loaibangdiem:_loaibangdiem, toidamoilop:_toidamoilop, _token:token},function(data){
              $('.lophocphan').html(data);
          });
      }

      $(document).ready(function(){
          $('.toidamoilop').change(function(){
              $idlop  = "{!! $lophp['id'] !!}";
              var radios = document.getElementsByName('loaibangdiem');
              for (var i = 0, length = radios.length; i < length; i++)
                {
                 if (radios[i].checked)
                 {
                  // do whatever you want with the checked radio
                  $loaibangdiem = radios[i].value;
                  

                  // only one radio can be logically checked, don't check the rest
                  break;
                 }
                }
              $toidamoilop = $('.toidamoilop').val();
              createRoomtest($loaibangdiem,$toidamoilop,$idlop);
          });
      });
</script>

  <!-- /top tiles -->
<!-- /page content -->
@stop