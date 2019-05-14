<?php

namespace App\Http\Controllers;

use App\GiangvienModels;
use App\LophocphanModels;
use Illuminate\Http\Request;
use App\SVlophocphanModels;
use App\SinhvienModels;
use App\HocvuModels;
use App\User;
use App\NamhocModels;
use App\XacnhanhocModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SV_MainController extends Controller
{
    public function getIndex()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        if($user != NULL || $user != "")
        {
            $level = User::select('id','level')->where('username',$user)->first();

            $tt_sv = SinhvienModels::select('id','hodem','ten')->where('masv',$user)->first();


            $diem2 = SVlophocphanModels::select('diem','diemt4','diemt10','diemchu','lanhoc')->where('masv',$user)->get()->toArray();
            $namhh = NamhocModels::select('id','nambatdau','namketthuc','hocky')->where('hienhanh',0)->get()->first();
            $diem = DB::table('table_svlophocphan')
                ->join('table_hocphan','table_hocphan.id','=','table_svlophocphan.hocphan_id')
                ->where('table_svlophocphan.masv',$user)
                ->orderBy('table_svlophocphan.namhoc')
                ->orderBy('table_svlophocphan.hocky')
                ->select('table_hocphan.tenhocphan','table_svlophocphan.lanhoc','table_svlophocphan.diem','table_svlophocphan.diemt10','table_svlophocphan.diemt4','table_svlophocphan.diemchu','table_svlophocphan.namhoc','table_svlophocphan.hocky')
                ->get();

            $hocvu = HocvuModels::select('masv','namhoc','hocky','sotcDK','soTCMoi','diemTB4','diemTB10','diemHB','soTCTLhocki','diemTL4','diemTL10','soTCTL','xeploai')->where('masv',$user)
                ->orderBy('namhoc')->orderBy('hocky')->get()->toArray();
            return view('sv.diem.sv_diem',compact('tt_sv','diem','hocvu'));
        }
        else
            return view('sv.login');
       /* $user = \Illuminate\Support\Facades\Auth::user()->username;
        if($user != NULL || $user != "")
        {
            $level = User::select('id','level')->where('username',$user)->first();
            $tt_sv = SinhvienModels::select('id','hodem','ten')->where('masv',$user)->first();
            $namhoc = NamhocModels::select('id','hocky','nambatdau','namketthuc')->where('hienhanh',0)->first();

            $lophocphan = DB::table('table_lophocphan')
                ->join('table_giangvien','table_lophocphan.id_gv','=','table_giangvien.id')
                ->join('table_svlophocphan','table_svlophocphan.idlop','=','table_lophocphan.id')
                ->where('table_svlophocphan.masv',$user)
                ->where('table_lophocphan.namhoc',$namhoc['id'])
                ->where('table_lophocphan.hocky',$namhoc['hocky'])
                ->select('table_lophocphan.tenlop','table_giangvien.chucdanh','table_giangvien.hodem','table_giangvien.ten','table_lophocphan.tuan','table_lophocphan.thu','table_lophocphan.tiet','table_lophocphan.phong')
                ->orderBy('table_lophocphan.tenlop')
                ->get();

            return view('sv.diem.sv_tkb',compact('lophocphan','tt_sv','namhoc'));
        }
        else
            return view('sv.login');*/
    }
    public function getInfo()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        if($user != NULL || $user != "")
        {
            $level = User::select('id','level')->where('username',$user)->first();

            $tt_sv = SinhvienModels::select('id','hodem','ten')->where('masv',$user)->first();


            $diem2 = SVlophocphanModels::select('diem','diemt4','diemt10','diemchu','lanhoc')->where('masv',$user)->get()->toArray();
            $diem = DB::table('table_svlophocphan')
                ->join('table_lophocphan','table_svlophocphan.idlop','=','table_lophocphan.ID')
                ->where('table_svlophocphan.masv',$user)
                ->select('table_lophocphan.tenlop','table_svlophocphan.lanhoc','table_svlophocphan.diem','table_svlophocphan.diemt10','table_svlophocphan.diemt4','table_svlophocphan.diemchu')
                ->get();
            return view('sv.diem.sv_diem',compact('tt_sv','diem'));
        }
        else
            return view('sv.login');
    }

    public function getLienhe()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        if($user != NULL || $user != "")
        {
            $level = User::select('id','level')->where('username',$user)->first();

            $tt_sv = SinhvienModels::select('id','hodem','ten')->where('masv',$user)->first();

            $tt_gv = GiangvienModels::select('hodem','ten','phone','chucdanh')->orderBy('chucdanh')->get()->toArray();

            return view('sv.info.sv_lienhe',compact('tt_sv','tt_gv'));
        }
        else
            return view('sv.login');
    }

    public function getTKB()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        if($user != NULL || $user != "")
        {
            $level = User::select('id','level')->where('username',$user)->first();
            $tt_sv = SinhvienModels::select('id','hodem','ten')->where('masv',$user)->first();
            $namhoc = NamhocModels::select('id','hocky','nambatdau','namketthuc')->where('hienhanh',0)->first();

            $lophocphan = DB::table('table_lophocphan')
                ->join('table_giangvien','table_lophocphan.id_gv','=','table_giangvien.id')
                ->join('table_svlophocphan','table_svlophocphan.idlop','=','table_lophocphan.id')
                ->where('table_svlophocphan.masv',$user)
                ->where('table_lophocphan.namhoc',$namhoc['id'])
                ->where('table_lophocphan.hocky',$namhoc['hocky'])
                ->select('table_lophocphan.tenlop','table_giangvien.chucdanh','table_giangvien.hodem','table_giangvien.ten','table_lophocphan.tuan','table_lophocphan.thu','table_lophocphan.tiet','table_lophocphan.phong')
                ->orderBy('table_lophocphan.tenlop')
                ->get();

            return view('sv.diem.sv_tkb',compact('lophocphan','tt_sv','namhoc'));
        }
        else
            return view('sv.login');
    }

    public function getPhieudk()
    {
        $masv = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$masv)->first();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        $tt_sv = DB::table('table_sinhvien')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->join('nganh','nganh.id','=','table_sinhvien.nganh_id')
            ->join('khoahoc','khoahoc.id','=','table_sinhvien.khoahoc_id')
            ->where('table_sinhvien.masv',$masv)
            ->select('masv','hodem','ten','ngaysinh','tenlop','tennganh','khoahoc')->first();

        $khoiluong = DB::table('table_svlophocphan')
            ->join('table_lophocphan','table_lophocphan.id','=','table_svlophocphan.idlop')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$masv)
            ->where('table_svlophocphan.namhoc',$nh_hienhanh["id"])
            ->where('table_svlophocphan.hocky',$nh_hienhanh["hocky"])
            ->whereNull('table_lophocphan.lhp_id')
            ->select(DB::raw('SUM(table_hocphan.sotc) as sotc, COUNT(table_hocphan.id) as sohocphan'))->first();

        $tkb = DB::table('table_lophocphan')
            ->join('table_giangvien','table_lophocphan.id_gv','=','table_giangvien.id')
            ->join('table_svlophocphan','table_svlophocphan.idlop','=','table_lophocphan.id')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$masv)
            ->where('table_lophocphan.namhoc',$nh_hienhanh['id'])
            ->where('table_lophocphan.hocky',$nh_hienhanh['hocky'])
            ->whereNull('table_lophocphan.lhp_id')
            ->select('table_lophocphan.tenlop','table_hocphan.sotc','table_giangvien.hodem','table_giangvien.ten','table_giangvien.chucdanh','tuan','phong','thu','tiet')
            ->orderBy('table_lophocphan.tenlop')
            ->get();
        return view('sv.lophocphan.sv_phieukhoiluonghoctap',compact('tt_sv','khoiluong','tkb','nh_hienhanh'));
    }

    public function xacnhanhoc(){
        $masv = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$masv)->first();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        
        $tt_sv = SinhvienModels::select('id','masv','hodem','ten')->where('masv',$masv)->first();

        $xacnhan = DB::table('xacnhanhoctap')
                    ->where('masv',$masv)
                    ->where('namhoc',$nh_hienhanh["id"])
                    ->where('hocky',$nh_hienhanh["hocky"])
                    ->count();

        $khoiluong = DB::table('table_svlophocphan')
            ->join('table_lophocphan','table_lophocphan.id','=','table_svlophocphan.idlop')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$masv)
            ->where('table_svlophocphan.namhoc',$nh_hienhanh["id"])
            ->where('table_svlophocphan.hocky',$nh_hienhanh["hocky"])
            ->whereNull('table_lophocphan.lhp_id')
            ->select(DB::raw('SUM(table_hocphan.sotc) as sotc, COUNT(table_hocphan.id) as sohocphan'))->first();

        $tkb = DB::table('table_lophocphan')
            ->join('table_giangvien','table_lophocphan.id_gv','=','table_giangvien.id')
            ->join('table_svlophocphan','table_svlophocphan.idlop','=','table_lophocphan.id')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$masv)
            ->where('table_lophocphan.namhoc',$nh_hienhanh['id'])
            ->where('table_lophocphan.hocky',$nh_hienhanh['hocky'])
            ->whereNull('table_lophocphan.lhp_id')
            ->select('table_lophocphan.tenlop','table_hocphan.sotc','table_giangvien.hodem','table_giangvien.ten','table_giangvien.chucdanh','tuan','phong','thu','tiet')
            ->orderBy('table_lophocphan.tenlop')
            ->get();

        return view('sv.lophocphan.sv_xacnhanhoc',compact('tt_sv','khoiluong','tkb','nh_hienhanh','xacnhan'));
    }

    public function xac_nhan_hoc_ajax()
    {
        $masv  = Input::get('masv');
        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        DB::table('xacnhanhoctap')->insert(['masv' => $masv, 'namhoc' => $nh_hienhanh['id'], 'hocky' => $nh_hienhanh['hocky'], 'thoigian' => $currentDate]);
        $html_lhp = '<button type="submit" class="btn btn-danger" disabled="">Đã xác nhận</button>
                     <a href="'.route('sv.getPhieudk').'"><button type="submit" class="btn btn-success">In phiếu</button></a>';
        return $html_lhp;
    }
}
