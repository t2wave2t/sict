<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LophocphanModels;
use App\NamhocModels;
use App\SVlophocphanModels;
use App\DiemdanhModels;
use App\GiangvienModels;
use Illuminate\Support\Facades\DB;

class SinhvienController extends Controller
{
    public function getSinhvien()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->get()->toArray();
        $ds_lophp = LophocphanModels::select('id','tenlop','soluong','tuan','phong','thu','tiet','ghichu')->orderBy('tenlop')->get()->toArray();
        return view('gv.lophocphan.diem_lophocphan',compact('ds_lophp','namhoc','tt_gv'));
    }

    public function getNhapdiem($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $lophp = LophocphanModels::select('id','tenlop')->where('id',$id)->first();

        /*$sql = "Select table_svlophocphan.masv,table_sinhvien.hodem,table_sinhvien.ten,table_lopsh.tenlop
                               from table_svlophocphan
                               join table_sinhvien on table_svlophocphan.masv = table_sinhvien.masv
                               join table_lopsh on table_lopsh.id = table_sinhvien.lopsh_id where idlop = $id";
         $results = DB::select(DB::raw($sql));*/
        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];

        $dssvlhp = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_svlophocphan.masv','=','table_sinhvien.masv')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->where('table_svlophocphan.idlop',$id)
            ->orderBy('table_svlophocphan.masv')
            ->select('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_lopsh.tenlop')
            ->get();



        /* $dssvvang = DiemdanhModels::select('masv','idlop','ngaynghi')
                     ->where(['ngaynghi',$currentDate])
                     ->get()->toArray();*/


        return view('gv.lophocphan.sv_diem_lophocphan',compact('lophp','dssvlhp','tt_gv'));
    }
}
