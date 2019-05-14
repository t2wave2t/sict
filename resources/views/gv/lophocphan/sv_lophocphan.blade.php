@extends('gv.master')
@section('content')
<!-- page content -->
  <!-- top tiles -->

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Danh sách Sinh viên lớp học phần: <b><u>{!! $lophp['tenlop'] !!}</u></b> </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <table  class=" table table-striped jambo_table bulk_action">
          <thead>
          <tr>
            <th>STT</th>
            <th>Thông tin SV</th>
            <th>Điểm danh</th>
          </tr>
          </thead>

          <tbody>
          <?php $stt=1; ?>
            <?php
            /*if (count($results) > 0 && sizeof($results) > 0){
            for($i=0; $i<count($results); $i++) {
                $stt = $i+1;*/
                ?>
            @foreach($dssvlhp as $item)
              <tr class="even pointer">
                <td class=" ">{!! $stt++ !!}</td>

                <td class=" ">
                  {!! $item->masv !!} <br>
                  <b>{!! $item->hodem !!} {!! $item->ten !!}</b> <br>
                  Lớp SH: {!! $item->tenlop !!} <br>
                  Lần nghỉ:
                  <div class="{!! $item->masv !!}-solannghi">
                    @if( $item->lannghi >=3 )
                      <b><code> {!! $item->lannghi !!} </code></b>
                    @elseif( $item->lannghi == 0 ) 0
                    @else <b> {!! $item->lannghi !!}</b>
                    @endif
                  </div>
                </td>

                <td class=" " align="center">
                  <div class="x_content">
                    @if($item->ngay ==0)
                      <a href="javascript:;" style="display: none;" class="{!! $item->masv !!}-vang-btn vang-btn btn-xs btn btn-danger" role="button" data-id="{!! $item->masv !!}" >
                          Vắng
                      </a>
                      <a href="javascript:;" class="{!! $item->masv !!}-co-mat-btn co-mat-btn btn-xs btn btn-success" role="button" data-id="{!! $item->masv !!}" >
                          Có mặt
                      </a>
                    @else
                      <a href="javascript:;" class="{!! $item->masv !!}-vang-btn vang-btn btn-xs btn btn-danger" role="button" data-id="{!! $item->masv !!}" >
                          Vắng
                      </a>
                      <a href="javascript:;" style="display: none;" class="{!! $item->masv !!}-co-mat-btn co-mat-btn btn-xs btn btn-success" role="button" data-id="{!! $item->masv !!}" >
                          Có mặt
                      </a>
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
  <script type="text/javascript">
      $('.co-mat-btn').click(function () {
          // lấy id
          idHocSinh = $(this).data('id');
          var idlophp = "{!! $lophp['id'] !!}";
          solannghi = parseInt($('.' + idHocSinh + '-solannghi').text());
          solannghi = solannghi + 1;

          // gọi ajax làm gì đó
              $.ajax({
                  type: "GET",
                  url: "{{ url('save_check_vatmat') }}",
                  data:{'masv':idHocSinh,'idlop':idlophp},
                  success: function (data) {
                      $('.' + idHocSinh + '-vang-btn').show();
                      $('.' + idHocSinh + '-co-mat-btn').hide();
                      if(solannghi >= 3)
                          $('.' + idHocSinh + '-solannghi').text(solannghi).css({color:"red"});
                      else
                          $('.' + idHocSinh + '-solannghi').text(solannghi);
                  }
              });
              // sau khi gọi ajax thành công thì ẩn nút đó đi và show nút còn lại
      });

      $('.vang-btn').click(function () {
          // lấy id
          idHocSinh = $(this).data('id');
          var idlophp = "{!! $lophp['id'] !!}";
          solannghi = parseInt($('.' + idHocSinh + '-solannghi').text());
          solannghi = solannghi - 1;

          // gọi ajax làm gì đó

          $.ajax({
              type: "GET",
              url: "{{ url('save_check_comat') }}",
              data:{'masv':idHocSinh,'idlop':idlophp},
              success: function (data) {
                  $('.' + idHocSinh + '-vang-btn').hide();
                  $('.' + idHocSinh + '-co-mat-btn').show();
                  if(solannghi >= 3)
                      $('.' + idHocSinh + '-solannghi').text(solannghi).css({color:"red"});
                  else
                      $('.' + idHocSinh + '-solannghi').text(solannghi);
              }
          });
          // sau khi gọi ajax thành công thì ẩn nút đó đi và show nút còn lại
      });
  </script>

  <!-- /top tiles -->
<!-- /page content -->
@stop