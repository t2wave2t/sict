@extends('gv.master')
@section('content')
    <!-- page content -->
        <!-- top tiles -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <h2>Danh sách lớp học phần
                        <small>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Học kỳ -->
                            <select class="noidung hocky" name="selecthocky">
                                @for($hocky=1; $hocky<=3;$hocky++)
                                    @if ($hocky==3)
                                        <option value="{!! $hocky !!}">
                                            Học kỳ hè
                                        </option>
                                    @else
                                        <option value="{!! $hocky !!}">
                                            Học kỳ {!! $hocky !!}
                                        </option>
                                    @endif
                                @endfor
                            </select>
                            <!-- Năm học -->
                            <select class="noidung namhoc" name="selectnamhoc">
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
                <!-- đoạn cần ajax -->
                <div class="x_content">

                    <p class="text-muted font-13 m-b-30"></p>
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
                                <td class=" ">Tuần {!! $item->tuan !!} <br /> Phòng {!! $item->phong !!} <br /> Thứ {!! $item->thu !!} <br> Tiết {!! $item->tiet !!}</td>
                                <td class=" ">
                                    <!-- <a href="{!! URL::route('gv.getTrongso',$item->id) !!}" name="trongso">Trọng số</a> <br />-->
                                    <code><a href="{!! URL::route('gv.getNhapdiem',$item->id) !!}" name="diem">Nhập điểm</a></code>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- đoạn cần ajax -->
            </div>
        </div>


        <!-- /top tiles -->
    <script type="text/javascript">

        function loadModelsSelectHocky(_hocky,_namhoc,_id_gv)
        {
            var url = "{{ url('get_ajax_hocky') }}";
            var token = '{{ csrf_token() }}';

            $.post(url,{namhoc:_namhoc, hocky:_hocky,id_gv:_id_gv,page: 1, _token:token},function(data){
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
              $.post(url,{namhoc:_namhoc, hocky:_hocky,id_gv:_id_gv,page: 1, _token:token},function(data){
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
    <!-- /page content -->
@stop