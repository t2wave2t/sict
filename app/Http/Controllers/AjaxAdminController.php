<?php

namespace App\Http\Controllers;

use App\GiangvienModels;
use App\HocphanModels;
use App\LophocphanModels;
use App\SinhvienModels;
use Illuminate\Http\Request;
use App\LopsinhhoatModels;
use App\SVlophocphanModels;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\NamhocModels;
use App\HocvuModels;
use App\NganhModels;

class AjaxAdminController extends Controller
{
    public function get_ajax_create_roomtest_admincp()
    {
    	$idlop  = Input::get('idlop');
        $loaibangdiem = Input::get('loaibangdiem');
        $toidamoilop = Input::get('toidamoilop');
        $html_lhp = '';

		$lophp = LophocphanModels::select('id','tenlop','id_hocphan','sent')->where('id',$idlop)->first();

        $soluong = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_svlophocphan.masv','=','table_sinhvien.masv')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->where('table_svlophocphan.idlop',$idlop)
            ->orderBy('table_svlophocphan.masv')
            ->count();

        if($soluong%$toidamoilop==0)
        	$solop = (int)($soluong/$toidamoilop);
        else
        	$solop = (int)($soluong/$toidamoilop)+1;
        $soluongsv = 0;
        $tam=0;
        $html_lhp = '
        	<div class="x_panel">
		        <div class="x_title">
		            <h2>In danh sách thi</h2>

		            <div class="clearfix"></div>
		        </div>
		        <div class="x_content">
        			<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="'.route('ad.bangDiemgiuaky',$idlop).'" method="POST"  enctype="multipart/form-data">
	            	<input type="hidden" name="_token" value="'.csrf_token().'">
	            	<input type="hidden" name="loaibangdiem" value="'.$loaibangdiem.'">
	            	<input type="hidden" name="solop" value="'.$solop.'">
	            	';
	            	$stt=0;
        for($i=1;$i<=$solop;$i++){
        	$tam = $tam+$soluongsv;    
        	$soluongsv = ($soluong-$tam) - $toidamoilop*($solop-$i);   

        	if($soluongsv == 0) { continue;}
        	$stt++;
        	$html_lhp .= '
        	<div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ngaythi"><h3>Xuất thi '.$stt.'</h3>
                </label>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="giothi">Lớp thi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="lop-thi" name="lopthi[]" required="required" value="'.$lophp['tenlop'].'_'.$stt.'" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

        	<div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ngaythi">Ngày thi<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="ngay-thi" name="ngaythi[]"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>
        
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="giothi">Giờ thi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">               	
	                <select class="form-control" name="giothi[]">
	                    <option></option>
	                    <option>8h00</option>
	                    <option>9h30</option>
	                    <option>14h00</option>
	                    <option>15h30</option>
	                </select>                            
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phongthi">Phòng thi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                	<select class="form-control" name="phongthi[]">
	                    <option></option>
	                    <option>B202</option>
	                    <option>B203</option>
	                    <option>B204</option>
	                    <option>B205</option>
	                    <option>B305</option>
	                    <option>B306</option>
	                    <option>B402</option>
	                    <option>B403</option>
	                    <option>B404</option>
	                    <option>B405</option>
	                </select>    
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="soluongsv">Số lượng SV <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="so-luong-sv" name="soluongsv[]" required="required" value="'.$soluongsv.'" class="form-control col-md-7 col-xs-12">                  
                </div>
            </div>
            <div class="ln_solid"></div>
            ';
        }
       
        $html_lhp .= '        	
	                <div class="form-group">
	                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	                        <button type="submit" class="btn btn-success">Xuất danh sách</button>
	                        <button class="btn btn-primary" type="reset">Nhập lại</button>
	                    </div>
	                </div>
	        	</form>
	        </div>
	    </div>';
        return $html_lhp;
    }
}
