@extends('gv.master')
@section('content')
<!-- page content -->
  <!-- top tiles -->

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Danh sách lớp học phần
          <small>
            <!-- Học kỳ -->
            <select class="hocky">
              @if ($nh_hienhanh["hocky"]==1)
                  <option value="1">Học kỳ 1</option>
                  <option value="2">Học kỳ 2</option>
                  <option value="3">Học kỳ hè</option>
              @elseif ($nh_hienhanh["hocky"]==2)
                  <option value="2">Học kỳ 2</option>
                  <option value="1">Học kỳ 1</option>
                  <option value="3">Học kỳ hè</option>
              @elseif ($nh_hienhanh["hocky"]==3)
                  <option value="3">Học kỳ hè</option>
                  <option value="1">Học kỳ 1</option>
                  <option value="2">Học kỳ 2</option>
              @endif
            </select>
            <!-- Năm học -->
            <select class="namhoc">
              @foreach ($namhoc as $item)
                <option value="{!! $item['id'] !!}">
                  Năm học {!! $item['nambatdau'] !!} - {!! $item['namketthuc'] !!}
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
            <th>STT</th>
            <th>Lớp học phần</th>
            <th>Số lượng SV</th>
            <th>Thời khóa biểu</th>
            <th></th>
          </tr>
          </thead>

          <tbody class="lophocphan">
          <?php $stt=1; ?>
            @foreach($ds_lophp as $item)
              <tr class="even pointer">
                <td class=" " align="center">{!! $stt++ !!}</td>
                <td class=" ">{!! $item->tenlop !!}</td>
                <td class=" ">{!! $item->soluong !!}</td>
                <td class=" ">{!! $item->tuan !!} | {!! $item->phong !!} | {!! $item->thu !!} | {!! $item->tiet !!}</td>
                <td class=" last">
                    <a href="{!! URL::route('gv.getDSSVLHP',$item->id) !!}" name="dslhp">Điểm danh lớp</a> |
                    <a href="{!! URL::route('gv.baonghi',$item->id) !!}" name="baonhi">Báo nghỉ</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
      
      function loadModelsSelectHocky(_hocky,_namhoc,_id_gv)
      {
          var url = "{{ url('get_ajax_hocky') }}";
          var token = '{{ csrf_token() }}';
          $.post(url,{namhoc:_namhoc, hocky:_hocky,id_gv:_id_gv,page: 2, _token:token},function(data){
              $('.lophocphan').html(data);
          });
      }

      $(document).ready(function(){
          $('.hocky').change(function(){
              $hocky = $(this).val();
              $namhoc = $('.namhoc').val();
              $id_gv = "{!! $tt_gv['id'] !!}";
              loadModelsSelectHocky($hocky,$namhoc,$id_gv);
          });
      });

      function loadModelsSelectNamhoc(_hocky,_namhoc,_id_gv)
      {
          var url = "{{ url('get_ajax_namhoc') }}";
          var token = '{{ csrf_token() }}';
          $.post(url,{namhoc:_namhoc, hocky:_hocky,id_gv:_id_gv,page: 2, _token:token},function(data){
              $('.lophocphan').html(data);
          });
      }

      $(document).ready(function(){
          $('.namhoc').change(function(){
              $hocky = $('.hocky').val();
              $namhoc = $(this).val();
              $id_gv = "{!! $tt_gv['id'] !!}";
              loadModelsSelectNamhoc($hocky,$namhoc,$id_gv);
          });
      });
  </script>

  <!-- /top tiles -->
<!-- /page content -->
@stop