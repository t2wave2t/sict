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
use App\BaonghiModel;
use Illuminate\Support\Facades\Input;

class LophocphanController extends Controller
{
       public function getLophocphan()
    {
        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->orderBy('hienhanh')->get()->toArray();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $ds_lophp = DB::table('table_lophocphan')
            ->join('table_giangvien','table_giangvien.id', '=' ,'table_lophocphan.id_gv')
            ->where('table_giangvien.username',$user)
            ->where('table_lophocphan.hocky',$nh_hienhanh["hocky"])
            ->where('table_lophocphan.namhoc',$nh_hienhanh["id"])
            ->orderBy('tenlop')
            ->select('table_lophocphan.id','tenlop','soluong','tuan','phong','thu','tiet','ghichu')->get();

        /*$a = LophocphanModels::select('id','tenlop','soluong','tuan','phong','thu','tiet','ghichu','id_gv')
            ->where('id_gv',$id_gv->id)->orderBy('tenl1op')->get()->toArray();*/

        return view('gv.lophocphan.lophocphan',compact('ds_lophp','namhoc','tt_gv','level','nh_hienhanh'));
    }

    public function getDSSVLHP($id)
    {
        $lophp = LophocphanModels::select('id','tenlop','tuan')->where('id',$id)->first();

       /*$sql = "Select table_svlophocphan.masv,table_sinhvien.hodem,table_sinhvien.ten,table_lopsh.tenlop
                              from table_svlophocphan 
                              join table_sinhvien on table_svlophocphan.masv = table_sinhvien.masv
                              join table_lopsh on table_lopsh.id = table_sinhvien.lopsh_id where idlop = $id";
        $results = DB::select(DB::raw($sql));*/
        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];

        //$ds_tuan = explode("->", $lophp->tuan);
        //$tong_tuan = (double)$ds_tuan[1]-(double)$ds_tuan[0];



        /*$dssvlhp = DB::table(DB::raw('(SELECT table_svlophocphan.masv,table_sinhvien.hodem,table_sinhvien.ten,table_lopsh.tenlop,
                SUM( IF ( table_diemdanh.ngaynghi = "'.$currentDate.'", 1, 0 ) ) AS ngay 
            FROM
                table_svlophocphan
                INNER JOIN table_sinhvien ON table_svlophocphan.masv = table_sinhvien.masv
                INNER JOIN table_lopsh ON table_lopsh.id = table_sinhvien.lopsh_id
                LEFT JOIN table_diemdanh ON table_diemdanh.masv = table_sinhvien.masv 
            WHERE
                table_svlophocphan.idlop = "'.$id.'"
            GROUP BY
                table_svlophocphan.masv,
                table_sinhvien.hodem,
                table_sinhvien.ten,
                table_lopsh.tenlop 
            ORDER BY
                table_sinhvien.ten ASC) AS a'))
            ->groupBy('a.masv','a.hodem','a.ten','a.tenlop')
            ->orderByRaw('a.ten ASC','a.hodem ASC','a.masv ASC')
            ->select('a.*',DB::raw('COUNT(a.masv)-1 as lannghi'))
        ->get();*/
        $dssvlhp = DB::table('table_svlophocphan')
            ->leftjoin(DB::raw('(select masv,COUNT(masv) as lannghi from table_diemdanh where idlop = "'.$id.'" GROUP BY masv) as a'),'a.masv','=','table_svlophocphan.masv')
            ->join('table_sinhvien','table_svlophocphan.masv','=','table_sinhvien.masv')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->leftjoin('table_diemdanh','table_diemdanh.masv','=','table_sinhvien.masv')
            ->where('table_svlophocphan.idlop',$id)
            ->groupBy('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_lopsh.tenlop')
            ->orderByRaw('table_sinhvien.ten ASC','table_sinhvien.hodem ASC','table_svlophocphan.masv ASC')
            ->select('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_lopsh.tenlop',
                    'a.lannghi',
                DB::raw('SUM(IF(table_diemdanh.ngaynghi="'.$currentDate.'",IF(table_diemdanh.idlop="'.$id.'",1,0),0)) as ngay'))
            ->get();

       /* $dssvvang = DiemdanhModels::select('masv','idlop','ngaynghi')
                    ->where(['ngaynghi',$currentDate])
                    ->get()->toArray();*/
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        return view('gv.lophocphan.sv_lophocphan',compact('lophp','dssvlhp','tt_gv'));
        //return view('gv.lophocphan.gv_diemdanh',compact('lophp','dssvlhp','tt_gv'));
    }

    public function save_check_vatmat()
    {
        $masv = $_GET['masv']; 
        $idlop = $_GET['idlop'];
        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        DB::table('table_diemdanh')->insert(
            ['masv' => $masv, 'idlop' => $idlop, 'ngaynghi' => $currentDate, 'ghichu' => '', 'trangthai' => '0']
        );

    }

    public function save_check_comat()
    {
        $masv = $_GET['masv'];
        $idlop = $_GET['idlop'];
        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        DB::table('table_diemdanh')->where(['masv' => $masv,'idlop' => $idlop,'ngaynghi' =>$currentDate])->delete();

    }

    public function getTonghopDD(){
        
    }

    public function getGVCN()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $lopsh = LopsinhhoatModels::select('id','tenlop','ghichu')->where('gv_id',$tt_gv->id)->get()->toArray();
        return view('gv.chunhiem.lopchunhiem',compact('lopsh','tt_gv'));
    }

    public function getDSSVLSH($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $lopsh = LopsinhhoatModels::select('id','tenlop','ghichu')->where('gv_id',$tt_gv->id)->first();
        $dssvlsh = DB::table('table_sinhvien')
            ->leftjoin('table_diemdanh','table_diemdanh.masv','=','table_sinhvien.masv')
            ->where('table_sinhvien.lopsh_id',$id)
            ->groupBy('table_sinhvien.masv','table_sinhvien.hodem','table_sinhvien.ten')
            ->orderByRaw('table_sinhvien.ten ASC','table_sinhvien.hodem ASC','table_sinhvien.masv ASC')
            ->select('table_sinhvien.masv','table_sinhvien.hodem','table_sinhvien.ten',
                DB::raw('COUNT(table_diemdanh.ngaynghi) as songaynghi'))
            ->get();
        return view('gv.chunhiem.sv_lopsinhhoat',compact('lopsh','dssvlsh','tt_gv'));
    }

    public function getDSLHP()
    {
        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->get()->toArray();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $ds_lophp = DB::table('table_lophocphan')
            ->join('table_giangvien','table_giangvien.id', '=' ,'table_lophocphan.id_gv')
            ->where('table_giangvien.username',$user)
            ->where('table_lophocphan.hocky',$nh_hienhanh["hocky"])
            ->where('table_lophocphan.namhoc',$nh_hienhanh["id"])
            ->whereNull('table_lophocphan.lhp_id')
            ->orderBy('tenlop')
            ->select('table_lophocphan.id','tenlop','soluong','tuan','phong','thu','tiet','ghichu')->get();

        /*$a = LophocphanModels::select('id','tenlop','soluong','tuan','phong','thu','tiet','ghichu','id_gv')
            ->where('id_gv',$id_gv->id)->orderBy('tenl1op')->get()->toArray();*/
        return view('gv.lophocphan.ds_lophocphan',compact('ds_lophp','namhoc','tt_gv','level','nh_hienhanh'));
    }

    public function get_lhp($hocky,$namhoc,$id_gv){
        $ds_lophp = DB::table('table_lophocphan')
            ->where('table_lophocphan.id_gv',$id_gv)
            ->where('table_lophocphan.hocky',$hocky)
            ->where('table_lophocphan.namhoc',$namhoc)
            ->orderBy('tenlop')
            ->select('table_lophocphan.id','tenlop','soluong','tuan','phong','thu','tiet','ghichu')->get();
        return $ds_lophp;
    }

    public function get_ajax_hocky()
    {
        $hocky  = Input::get('hocky');
        $namhoc = Input::get('namhoc');
        $id_gv  = Input::get('id_gv');
        $page  = Input::get('page');
        $stt    = 1;
        $dslhp = $this->get_lhp($hocky,$namhoc,$id_gv);
        $html_lhp = '';
        foreach($dslhp as $item)
        {
            $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
            $url_diemdanh = action('LophocphanController@getDSSVLHP',$item->id);
            $html_lhp.= '<tr class="even pointer">';
            $html_lhp.= '<td class=" " align="center">'.$stt++.'</td>';
            $html_lhp.= '<td class=" ">'.$item->tenlop.'</td>';
            $html_lhp.= '<td class=" ">'.$item->soluong.'</td>';
            $html_lhp.= '<td class=" ">Tuần'.$item->tuan.' <br />Phòng '.$item->phong.'<br /> Thứ '.$item->thu.'<br> Tiết '.$item->tiet.'</td>';
            if ($page == 1) {
                $html_lhp .= '<td class=" "><code><a href="' . $url_nhapdiem . '" name="diem">Nhập điểm</a></code></td>';

            } else if ($page == 2){
                $html_lhp .= '<td class=" "><a href="' . $url_diemdanh . '" name="diem">Điểm danh</a></td>';
            }
            $html_lhp.= '</tr>';
        }
        return $html_lhp;
    }

    public function get_ajax_namhoc()
    {
        $hocky  = Input::get('hocky');
        $namhoc = Input::get('namhoc');
        $id_gv  = Input::get('id_gv');
        $page  = Input::get('page');
        $stt    = 1;
        $dslhp = $this->get_lhp($hocky,$namhoc,$id_gv);
        $html_lhp = '';
        foreach($dslhp as $item)
        {
            $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
            $url_diemdanh = action('LophocphanController@getDSSVLHP',$item->id);
            $html_lhp.= '<tr class="even pointer">';
            $html_lhp.= '<td class=" " align="center">'.$stt++.'</td>';
            $html_lhp.= '<td class=" ">'.$item->tenlop.'</td>';
            $html_lhp.= '<td class=" ">'.$item->soluong.'</td>';
            $html_lhp.= '<td class=" ">Tuần'.$item->tuan.' <br />Phòng '.$item->phong.'<br /> Thứ '.$item->thu.'<br> Tiết '.$item->tiet.'</td>';
            if ($page == 1) {
                $html_lhp .= '<td class=" "><code><a href="' . $url_nhapdiem . '" name="diem">Nhập điểm</a></code></td>';

            } else if ($page == 2){
                $html_lhp .= '<td class=" "><a href="' . $url_diemdanh . '" name="diem">Điểm danh</a></td>';
            }
            $html_lhp.= '</tr>';
        }
        return $html_lhp;
    }

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
        $lophp = LophocphanModels::select('id','tenlop','sent','namhoc','hocky')->where('id',$id)->first();

        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $dotnhapdiem = DotnhapdiemModels::select('id','tendot','idlop','trongso','ngaybatdau','ngayketthuc')->where('namhoc',$lophp['namhoc'])
            ->where('hocky',$lophp['hocky'])
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
            ->select('table_svlophocphan.masv','table_sinhvien.hodem','table_sinhvien.ten','table_lopsh.tenlop','table_svlophocphan.diem','table_svlophocphan.diem_phu','table_svlophocphan.diemchu','table_svlophocphan.diemt10')
            ->get();

        $trongso = DB::table('table_trongso_lhp')
            ->join('table_trongso','table_trongso.id','=','table_trongso_lhp.id_trongso')
            ->where('table_trongso_lhp.id_lhp',$id)
            ->orderBy('table_trongso.trongso')
            ->select('table_trongso.matrongso','table_trongso.trongso','tentrongso','table_trongso.id')
            ->get();

        /* $dssvvang = DiemdanhModels::select('masv','idlop','ngaynghi')
                     ->where(['ngaynghi',$currentDate])
                     ->get()->toArray();*/


        return view('gv.lophocphan.sv_diem_lophocphan',compact('lophp','dssvlhp','tt_gv','trongso','dotnhapdiem','currentDate'));
    }

    public function getTrongso($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        //$ts_lhp = TrongsoLHPModels::select('id','id_trongso','trongso')->where('id_lhp',$id)->get()->toArray();
        //$trongso = TrongsoModels::select('id','tentrongso','matrongso')->get()->toArray();
        $ts_lhp = DB::table('table_trongso')
            ->leftjoin(DB::raw('(select * from table_trongso_lhp where id_lhp=40) as b'),'table_trongso.ID','=','b.id_trongso')
            ->select('table_trongso.tentrongso','table_trongso.matrongso','b.id_trongso','b.trongso')->get();
		//$datanewstype = NewsTypeModel::select('id','type_name')->get()->toArray();
        return view('gv.lophocphan.set_trongso',compact('tt_gv','ts_lhp'));
    }

    public function postTrongso(Request $request,$id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        //$ts_lhp = TrongsoLHPModels::select('id','id_trongso','trongso')->where('id_lhp',$id)->get()->toArray();
        //$trongso = TrongsoModels::select('id','tentrongso','matrongso')->get()->toArray();
        $chuyencan 	= $request->chuyen_can;
        $baitap 	= $request->bai_tap;
        $giuaky 	= $request->giua_ky;
        $cuoiky 	= $request->cuoi_ky;
        $doan 	    = $request->do_an;
        if (($chuyencan+$baitap+$giuaky+$cuoiky+$doan)==1)
        {
            $update_cc = DB::update('update table_trongso_lhp set trongso = ? where id_lhp =? and id_trongso = ?',[$chuyencan,$id,1]);
            $update_cc = DB::update('update table_trongso_lhp set trongso = ? where id_lhp =? and id_trongso = ?',[$baitap,$id,2]);
            $update_cc = DB::update('update table_trongso_lhp set trongso = ? where id_lhp =? and id_trongso = ?',[$giuaky,$id,3]);
            $update_cc = DB::update('update table_trongso_lhp set trongso = ? where id_lhp =? and id_trongso = ?',[$cuoiky,$id,4]);
            $update_cc = DB::update('update table_trongso_lhp set trongso = ? where id_lhp =? and id_trongso = ?',[$doan,$id,5]);
        }
        else
        {
            return redirect()->route('gv.getTrongso',$id)-> with(['flash_level'=>'unsuccess','flash_message'=>'Thay đổi không thành công!']);
        }

        $ts_lhp = DB::table('table_trongso')
            ->leftjoin(DB::raw('(select * from table_trongso_lhp where id_lhp=40) as b'),'table_trongso.ID','=','b.id_trongso')
            ->select('table_trongso.tentrongso','table_trongso.matrongso','b.id_trongso','b.trongso')->get();
        //$datanewstype = NewsTypeModel::select('id','type_name')->get()->toArray();
        return view('gv.lophocphan.set_trongso',compact('tt_gv','ts_lhp'));
    }
    public function getDSGiaotrinh()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();
        $ds_giaotrinh = GiaotrinhModels::select('id','tengiaotrinh','hocphan','mota','link','created_at')
            ->where('id_gv',$tt_gv['id'])
            ->where('trangthai',0)->get()->toArray();

        return view('gv.giaotrinh.list_giaotrinh',compact('tt_gv','ds_giaotrinh'));
    }

    public function getGiaotrinh()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        return view('gv.giaotrinh.add_giaotrinh',compact('tt_gv'));
    }

    
    public function postGiaotrinh(Request $Request)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $giaotrinh = new GiaotrinhModels;
        $giaotrinh->tengiaotrinh = $Request->giaotrinh;
        $giaotrinh->hocphan = $Request->hocphan;
        $giaotrinh->mota = $Request->mota;
        $giaotrinh->id_gv = $tt_gv['id'];
        if($Request->hasFile('files')){
            $file = $Request->file('files');
            $destinationPath = base_path() . '/public/upload/gv/giaotrinh/';

            $fileName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName2 = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $giaotrinh->link = $fileName2;
            $file->move($destinationPath, $fileName.'.'.$extension);
        }
        $giaotrinh->save();
        return redirect()->route('gv.getDSGiaotrinh')-> with(['flash_level'=>'success','flash_message'=>'Tạo mới thành công!']);

    }

    public function getGTDelete($id) {
        $giaotrinh = GiaotrinhModels::find($id);
        $giaotrinh->delete($id);
        return redirect()->route('gv.getDSGiaotrinh')-> with(['flash_level'=>'success','flash_message'=>'Xóa Giáo trình này thành công!']);
    }

    public function getGTEdit($id) {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $giaotrinh = GiaotrinhModels::findOrFail($id)->toArray();
        return view('gv.giaotrinh.edit_giaotrinh',compact('id','giaotrinh','tt_gv'));
    }

    public function postGTEdit(Request $Request,$id) {
        $giaotrinh = GiaotrinhModels::find($id);
        $giaotrinh->tengiaotrinh = $Request->giaotrinh;
        $giaotrinh->hocphan = $Request->hocphan;
        $giaotrinh->mota = $Request->mota;
        if($Request->hasFile('files')){
            $file = $Request->file('files');
            $destinationPath = base_path() . '/public/upload/gv/giaotrinh/';

            $fileName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName2 = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $giaotrinh->link = $fileName2;
            $file->move($destinationPath, $fileName.'.'.$extension);
        }

        $giaotrinh->save();
        return redirect()->route('gv.getDSGiaotrinh')-> with(['flash_level'=>'success','flash_message'=>'Chỉnh sửa thành công!']);
    }

    public function getDecuong($id) {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $giaotrinh = GiaotrinhModels::findOrFail($id)->toArray();
        return view('gv.giaotrinh.edit_giaotrinh',compact('id','giaotrinh','tt_gv'));
    }

    public function save_diem_lophocphan()
    {
        
       /* $masv = $_GET['masv'];
        $trongso = $_GET['trongso'];
        $diem = $_GET['diem'];
        $idlophp = $_GET['idlophp'];*/

        $masv       = Input::get('masv');
        $trongso    = Input::get('trongso');
        $diem       = Input::get('diem');
        $idlophp    = Input::get('idlophp');
        
        $diem = str_replace(",",".",$diem);

        $tt_diem = SVlophocphanModels::select('diem_phu','diem')
            ->where('masv',$masv)
            ->where('idlop',$idlophp)
            ->first();

        $ts_lhp = TrongsoLHPModels::select('id','trongso','id_trongso')
            ->where('id_lhp',$idlophp)
            ->orderBy('id_trongso')
            ->get()->toArray();

        $diem_item = explode(",", $tt_diem->diem_phu);

        if($trongso == "chuyen_can") {
            $diem_item[0]=$diem;
            $diem = implode(",",$diem_item);
            DB::update(
                'update table_svlophocphan set diem_phu = ? where masv = ? and idlop = ?', [$diem, $masv, $idlophp]
            );
        }
        if($trongso == "bai_tap") {
            $diem_item[1]=$diem;
            $diem = implode(",",$diem_item);
            DB::update(
                'update table_svlophocphan set diem_phu = ? where masv = ? and idlop = ?', [$diem, $masv, $idlophp]
            );
        }
        if($trongso == "giua_ky") {
            $diem_item[2]=$diem;
            $diem = implode(",",$diem_item);
            DB::update(
                'update table_svlophocphan set diem_phu = ? where masv = ? and idlop = ?', [$diem, $masv, $idlophp]
            );
        }
        if($trongso == "cuoi_ky") {
            $diem_item[3]=$diem;
            $diem = implode(",",$diem_item);
            DB::update(
                'update table_svlophocphan set diem_phu = ? where masv = ? and idlop = ?', [$diem, $masv, $idlophp]
            );
        }
        if($trongso == "do_an") {
            $diem_item[4]=$diem;
            $diem = implode(",",$diem_item);
            DB::update(
                'update table_svlophocphan set diem_phu = ? where masv = ? and idlop = ?', [$diem, $masv, $idlophp]
            );
        }

        $sent = LophocphanModels::select('sent')->where('id',$idlophp)->first();
        if ($sent->sent == 0){
            $tt_diem = SVlophocphanModels::select('diem_phu')
                ->where('masv',$masv)
                ->where('idlop',$idlophp)
                ->first();



            $diem_it = explode(",", $tt_diem->diem_phu);
            $dt10=0;
            $stt_ts=0;
            foreach($ts_lhp as $item_ts){
                $dt10=round((double)$dt10 + (double)$item_ts['trongso'] * (double)$diem_it[(double)($item_ts["id_trongso"]-1)],1);
                //echo $item_ts['trongso'].'-'.(double)($item_ts["id_trongso"]-1).'-'.(double)$diem_it[(double)($item_ts["id_trongso"]-1)].'<br>';
                $stt_ts++;
                
            }

            if($dt10<4){$dc = 'F'; $dtl = 0;}
            elseif($dt10<5.5 && $dt10>=4){$dc = 'D'; $dtl = 1;}
            elseif($dt10<7 && $dt10>=5.5){$dc = 'C'; $dtl = 2;}
            elseif($dt10<8.5 && $dt10>=7){$dc = 'B'; $dtl = 3;}
            elseif($dt10<=10 && $dt10>=8.5){$dc = 'A'; $dtl = 4;}
            DB::update(
                'update table_svlophocphan set diemt10 = ?, diemchu =? ,diemt4=? where masv = ? and idlop = ?', [$dt10,$dc,$dtl ,$masv, $idlophp]
            );
        }

        return 1;//view('gv.lophocphan.sv_diem_lophocphan',compact('dt10','dc','dtl'));

    }

    public function baonghi($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        $baonghi = DB::table('baonghi')
                    ->join('table_lophocphan','table_lophocphan.id','=','baonghi.idlop')
                    ->where('table_lophocphan.id',$id)
                    ->select('tenlop','noidung','hocbu','baonghi.trangthai','baonghi.phong')->orderBy('baonghi.id','DESC')->get();

        $lophp = LophocphanModels::select('id','tenlop','phong','thu','tiet')->where('id',$id)->first();

        return view('gv.lophocphan.baonghi',compact('tt_gv','lophp','baonghi'));
    }

    public function postbaonghi($id, Request $Request)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $tt_gv = GiangvienModels::select('id','hodem','ten')->where('username',$user)->first();

        $baonghi = new BaonghiModel;
        $baonghi->noidung = $Request->noidung;
        $baonghi->idlop = $id;
        $baonghi->hocbu = $Request->thoigiadaybu;
        $baonghi->id_gv = $tt_gv['id'];
        $baonghi->trangthai = 1;
        $baonghi->save();
        return redirect()->route('gv.baonghi',$id)-> with(['flash_level'=>'success','flash_message'=>'Đã báo nghỉ!']);
    }

    
}
