<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\LophocphanModels;
use App\NamhocModels;
use App\SVlophocphanModels;
use App\DiemdanhModels;
use App\Http\Controllers\Auth;
use App\User;
use App\GiangvienModels;
use App\LopsinhhoatModels;
use App\TrongsoLHPModels;
use App\TrongsoModels;
use App\GiaotrinhModels;
use App\DotnhapdiemModels;
use App\HocphanModels;
use Illuminate\Support\Facades\Input;


class DiemGVController extends Controller
{
    public function bangDiemgiuaky($id)
    {
    	$user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $lophp = LophocphanModels::select('id','tenlop','id_hocphan','sent')->where('id',$id)->first();
        $sotc = HocphanModels::select('sotc')->where('id',$lophp['id_hocphan'])->first();

        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        $currentDate2 = $now["mday"]. "-" .$now["mon"] . "-" . $now["year"];

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $dotnhapdiem = DotnhapdiemModels::select('id','tendot','idlop','trongso','ngaybatdau','ngayketthuc')->where('namhoc',$nh_hienhanh['id'])
            ->where('hocky',$nh_hienhanh['hocky'])
            ->first();

        /*$sql = "Select table_svlophocphan.masv,table_sinhvien.hodem,table_sinhvien.ten,table_lopsh.tenlop
                               from table_svlophocphan
                               join table_sinhvien on table_svlophocphan.masv = table_sinhvien.masv
                               join table_lopsh on table_lopsh.id = table_sinhvien.lopsh_id where idlop = $id";
         $results = DB::select(DB::raw($sql));*/


        $dssvlhp = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_svlophocphan.masv','=','table_sinhvien.masv')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->where('table_svlophocphan.idlop',$id)
            ->orderBy('table_svlophocphan.masv')
            ->select('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.ngaysinh','table_lopsh.tenlop','table_svlophocphan.diem','table_svlophocphan.diem_phu','table_svlophocphan.diemchu','table_svlophocphan.diemt10')
            ->get();

        $trongso = DB::table('table_trongso_lhp')
            ->join('table_trongso','table_trongso.id','=','table_trongso_lhp.id_trongso')
            ->where('table_trongso_lhp.id_lhp',$id)
            ->orderBy('table_trongso.trongso')
            ->select('table_trongso.matrongso','table_trongso.trongso','tentrongso','table_trongso.id')
            ->get();

    	return view('gv.lophocphan.bangdiemgiuaky',compact('dssvlhp','lophp','currentDate2','nh_hienhanh','sotc','trongso'));
    }

    public function bangDiemcuoiky($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $lophp = LophocphanModels::select('id','tenlop','id_hocphan','sent')->where('id',$id)->first();
        $sotc = HocphanModels::select('sotc')->where('id',$lophp['id_hocphan'])->first();

        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        $currentDate2 = $now["mday"]. "-" .$now["mon"] . "-" . $now["year"];

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $dotnhapdiem = DotnhapdiemModels::select('id','tendot','idlop','trongso','ngaybatdau','ngayketthuc')->where('namhoc',$nh_hienhanh['id'])
            ->where('hocky',$nh_hienhanh['hocky'])
            ->first();

        /*$sql = "Select table_svlophocphan.masv,table_sinhvien.hodem,table_sinhvien.ten,table_lopsh.tenlop
                               from table_svlophocphan
                               join table_sinhvien on table_svlophocphan.masv = table_sinhvien.masv
                               join table_lopsh on table_lopsh.id = table_sinhvien.lopsh_id where idlop = $id";
         $results = DB::select(DB::raw($sql));*/


        $dssvlhp = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_svlophocphan.masv','=','table_sinhvien.masv')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->where('table_svlophocphan.idlop',$id)
            ->orderBy('table_svlophocphan.masv')
            ->select('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.ngaysinh','table_lopsh.tenlop','table_svlophocphan.diem','table_svlophocphan.diem_phu','table_svlophocphan.diemchu','table_svlophocphan.diemt10')
            ->get();

        $trongso = DB::table('table_trongso_lhp')
            ->join('table_trongso','table_trongso.id','=','table_trongso_lhp.id_trongso')
            ->where('table_trongso_lhp.id_lhp',$id)
            ->orderBy('table_trongso.trongso')
            ->select('table_trongso.matrongso','table_trongso.trongso','tentrongso','table_trongso.id')
            ->get();

        return view('gv.lophocphan.bangdiemcuoiky',compact('dssvlhp','lophp','currentDate2','nh_hienhanh','sotc','trongso'));
    }
}
