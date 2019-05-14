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

class HocvuController extends Controller
{
    public function getDSLop()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $dslopsh = DB::table('table_lopsh')
            ->join('table_giangvien','table_giangvien.id','=','table_lopsh.gv_id')
            ->where('trangthai',0)
            ->select('table_lopsh.id','table_lopsh.tenlop','table_giangvien.chucdanh','table_giangvien.hodem','table_giangvien.ten')
            ->orderBy('table_lopsh.tenlop')->get();

        return view('admincp.diem.ad_danhsachlop',compact('dslopsh'));
    }

    public function getChitiet($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $lop = DB::table('table_lopsh')
            ->join('table_giangvien','table_giangvien.id','=','table_lopsh.gv_id')
            ->where('trangthai',0)
            ->where('table_lopsh.id',$id)
            ->select('table_lopsh.id','table_lopsh.tenlop','table_giangvien.chucdanh','table_giangvien.hodem','table_giangvien.ten')
            ->orderBy('table_lopsh.tenlop')->first();

        return view('admincp.thongtinsinhvien.ad_chucnang',compact('lop'));
    }

    public function getDiemdanh($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $lop = DB::table('table_lopsh')
            ->join('table_giangvien','table_giangvien.id','=','table_lopsh.gv_id')
            ->where('trangthai',0)
            ->where('table_lopsh.id',$id)
            ->select('table_lopsh.id','table_lopsh.tenlop','table_giangvien.chucdanh','table_giangvien.hodem','table_giangvien.ten')
            ->orderBy('table_lopsh.tenlop')->first();

        $ds_sv = DB::table('table_sinhvien')
            ->join('table_diemdanh','table_diemdanh.masv','=','table_sinhvien.masv')
            ->join('table_lophocphan','table_lophocphan.id','=','table_diemdanh.idlop')
            ->where('lopsh_id',$id)
            ->where('namhoc',1)
            ->where('hocky',2)
            ->select('table_sinhvien.id','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_sinhvien.ngaysinh',DB::raw('COUNT(table_diemdanh.idlop) as lannghi'))
            ->groupBy('table_sinhvien.masv')
            ->orderBy('table_sinhvien.masv')->get();

        return view('admincp.diem.diemdanh.ad_diemdanh',compact('ds_sv','lop'));
    }

    public function getDiemdanhSV($masv)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();


        $chitiet_vang = DB::table('table_sinhvien')
            ->join('table_diemdanh','table_diemdanh.masv','=','table_sinhvien.masv')
            ->join('table_lophocphan','table_lophocphan.id','=','table_diemdanh.idlop')
            ->where('table_sinhvien.masv',$masv)
            ->where('namhoc',1)
            ->where('hocky',2)
            ->select('table_diemdanh.ngaynghi','table_diemdanh.idlop','table_lophocphan.tenlop')
            ->orderBy('table_sinhvien.masv')->get();
        $info_sv = SinhvienModels::select('table_sinhvien.id','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_sinhvien.ngaysinh')
            ->where('masv',$masv)->first();

        return view('admincp.diem.diemdanh.ad_chitietvang',compact('chitiet_vang','info_sv'));
    }

    public function getDSSV($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $ds_sv = SinhvienModels::select('table_sinhvien.id','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_sinhvien.ngaysinh')
            ->where('lopsh_id',$id)->orderBy('masv')->get()->toArray();

        $lop = LopsinhhoatModels::select('tenlop')->where('id',$id)->first();

        return view('admincp.diem.thongtinsv.ad_dssv',compact('ds_sv','lop'));
    }

    public function getTonghop($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $ds_sv = SinhvienModels::select('table_sinhvien.id','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_sinhvien.ngaysinh')
            ->where('lopsh_id',$id)->orderBy('ten')->get()->toArray();

        $lop = LopsinhhoatModels::select('tenlop')->where('id',$id)->first();

        return view('admincp.diem.diem.ad_tonghop',compact('ds_sv','lop'));
    }

    public function getDiemCanhanSV($masv)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $info_sv = SinhvienModels::select('table_sinhvien.id','table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_sinhvien.ngaysinh')
            ->where('masv',$masv)->first();

        $namhh = NamhocModels::select('id','nambatdau','namketthuc','hocky')->where('hienhanh',0)->get()->first();
        $diem = DB::table('table_svlophocphan')
            ->join('table_lophocphan','table_svlophocphan.idlop','=','table_lophocphan.ID')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$masv)
            ->orderBy('table_svlophocphan.namhoc','DESC')
            ->orderBy('table_svlophocphan.hocky')
            ->select('table_hocphan.tenhocphan','table_svlophocphan.lanhoc','table_svlophocphan.diem','table_svlophocphan.diemt10','table_svlophocphan.diemt4','table_svlophocphan.diemchu')
            ->get();
        $hocvu = HocvuModels::select('masv','namhoc','hocky','sotcDK','soTCMoi','diemTB4','diemTB10','diemHB','soTCTLhocki','diemTL4','diemTL10','soTCTL','xeploai')
            ->where('masv',$masv)
            ->orderBy('namhoc')->orderBy('hocky')->get()->toArray();

        return view('admincp.diem.diem.ad_diemcanhan',compact('info_sv','diem','hocvu'));
    }

    public function getDSLopHPDiemdanh()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->get()->toArray();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        $now = getdate();
        $currentDate = $now["year"]. "-" .$now["mon"] . "-" . $now["mday"];
        $today = date("D");
        if ($today =='Mon')    $today = 'Hai';
        elseif($today =='Tue') $today = 'Ba';
        elseif($today =='Wed') $today = 'Tư';
        elseif($today =='Thu') $today = 'Năm';
        elseif($today =='Fri') $today = 'Sáu';
        elseif($today =='Sat') $today = 'Bảy';
        elseif($today =='Sat') $today = 'Chủ nhật';

        $ds_lophp = DB::table('table_lophocphan')
            ->join('table_giangvien','table_giangvien.id', '=' ,'table_lophocphan.id_gv')
            ->where('table_lophocphan.hocky',$nh_hienhanh["hocky"])
            ->where('table_lophocphan.namhoc',$nh_hienhanh["id"])
            ->where('table_lophocphan.thu',$today)
            ->orderBy('tenlop')
            ->select('table_lophocphan.id','tenlop','soluong','tuan','phong','thu','tiet','table_lophocphan.ghichu','chucdanh','hodem','ten')->get();

        $isdiemdanh = DB::table('table_lophocphan')
            ->join('table_diemdanh','table_diemdanh.idlop', '=' ,'table_lophocphan.id')
            ->where('table_diemdanh.ngaynghi',$currentDate)
            ->groupBy('table_lophocphan.id')
            ->select('table_lophocphan.id')->get();


        return view('admincp.lophocphan.ad_dslopdiemdanh',compact('ds_lophp','nh_hienhanh','namhoc','isdiemdanh','today'));
    }

    public function get_ajax_hocky_admin()
    {
        $hocky  = Input::get('hocky');
        $namhoc = Input::get('namhoc');
        $page = Input::get('page');
        $stt    = 1;
        $dslhp = $this->get_lhp($hocky,$namhoc,$page);
        $html_lhp = '';
        if($page==1) {
            $now = getdate();
            $currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
            $isdiemdanh = DB::table('table_lophocphan')
                ->join('table_diemdanh', 'table_diemdanh.idlop', '=', 'table_lophocphan.id')
                ->where('table_diemdanh.ngaynghi', $currentDate)
                ->groupBy('table_lophocphan.id')
                ->select('table_lophocphan.id')->get();

            $temp = 0;
            foreach ($dslhp as $item) {
                /*$url_giuaky = action('DiemDTController@bangDiemgiuaky',$item->id);
                $url_cuoiky = action('DiemDTController@bangDiemcuoiky',$item->id);
                $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);*/
                $html_lhp .= '<tr class="even pointer">';
                $html_lhp .= '<td class=" " align="center">' . $stt++ . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tenlop . '</td>';
                $html_lhp .= '<td class=" ">' . $item->soluong . '</td>';
                $html_lhp .= '<td class=" ">' . $item->chucdanh . '. ' . $item->hodem . ' ' . $item->ten . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tuan . ' | ' . $item->phong . ' | ' . $item->thu . ' | ' . $item->tiet . '</td>';
                
                foreach ($isdiemdanh as $item_DD)
                    if ($item_DD->id == $item->id)
                        $temp = 1;
                if ($temp == 1) {
                    $html_lhp .= '<td><div class="checkbox"><label><input type="checkbox" class="flat" checked="checked"></label></div></td>';
                    $temp = 0;
                } else {
                    $html_lhp .= '<td class=" "></td>';
                }
                $html_lhp .= '</tr>';
            }
        }
        elseif ($page==2){
            foreach ($dslhp as $item) {
                //$url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
                $url_giuaky = action('DiemDTController@bangDiemgiuaky',$item->id);
                $url_xuatbangdiem = action('DiemDTController@xuatDanhsachthi',$item->id);
                $url_hu = action('DiemDTController@danhsachhu',$item->id);
                $url_cuoiky = action('DiemDTController@bangDiemcuoiky',$item->id);
                $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
                $url_diemhp = action('HocvuController@getDiemHocPhan',$item->id);
                $html_lhp .= '<tr class="even pointer">';
                $html_lhp .= '<td class=" " align="center">' . $stt++ . '</td>';
                $html_lhp .= '<td class=" "><a href="'.$url_diemhp.'">' . $item->tenlop . '</td>';
                $html_lhp .= '<td class=" ">' . $item->soluong . '</td>';
                $html_lhp .= '<td class=" ">' . $item->chucdanh . '. ' . $item->hodem . ' ' . $item->ten . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tuan . ' | ' . $item->phong . ' | ' . $item->thu . ' | ' . $item->tiet . '</td>';
                $html_lhp .= '<td class=" "><a href="'.$url_xuatbangdiem.'">Xuát bảng điểm</a</td>
                <td class=" "><a href="'.$url_hu.'">Hù</a></td>
                <td class=" "><a href="'.$url_nhapdiem.'">Nhập điểm</a></td>';
                $html_lhp .= '</tr>';
            }
        }
        return $html_lhp;
    }

    public function get_ajax_namhoc_admin()
    {
        $hocky  = Input::get('hocky');
        $namhoc = Input::get('namhoc');
        $page = Input::get('page');
        $stt    = 1;
        $dslhp = $this->get_lhp($hocky,$namhoc,$page);
        $html_lhp = '';
        if($page==1) {
            $now = getdate();
            $currentDate = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"];
            $isdiemdanh = DB::table('table_lophocphan')
                ->join('table_diemdanh', 'table_diemdanh.idlop', '=', 'table_lophocphan.id')
                ->where('table_diemdanh.ngaynghi', $currentDate)
                ->groupBy('table_lophocphan.id')
                ->select('table_lophocphan.id')->get();

            $temp = 0;
            foreach ($dslhp as $item) {
                /*$url_giuaky = action('DiemDTController@bangDiemgiuaky',$item->id);
                $url_cuoiky = action('DiemDTController@bangDiemcuoiky',$item->id);
                $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);*/
                $html_lhp .= '<tr class="even pointer">';
                $html_lhp .= '<td class=" " align="center">' . $stt++ . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tenlop . '</td>';
                $html_lhp .= '<td class=" ">' . $item->soluong . '</td>';
                $html_lhp .= '<td class=" ">' . $item->chucdanh . '. ' . $item->hodem . ' ' . $item->ten . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tuan . ' | ' . $item->phong . ' | ' . $item->thu . ' | ' . $item->tiet . '</td>';
                
                foreach ($isdiemdanh as $item_DD)
                    if ($item_DD->id == $item->id)
                        $temp = 1;
                if ($temp == 1) {
                    $html_lhp .= '<td><div class="checkbox"><label><input type="checkbox" class="flat" checked="checked"></label></div></td>';
                    $temp = 0;
                } else {
                    $html_lhp .= '<td class=" "></td>';
                }
                $html_lhp .= '</tr>';
            }
        }
        elseif ($page==2){
            foreach ($dslhp as $item) {
                //$url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
                $url_giuaky = action('DiemDTController@bangDiemgiuaky',$item->id);
                $url_xuatbangdiem = action('DiemDTController@xuatDanhsachthi',$item->id);
                $url_hu = action('DiemDTController@danhsachhu',$item->id);
                $url_cuoiky = action('DiemDTController@bangDiemcuoiky',$item->id);
                $url_nhapdiem = action('LophocphanController@getNhapdiem',$item->id);
                $url_diemhp = action('HocvuController@getDiemHocPhan',$item->id);
                $html_lhp .= '<tr class="even pointer">';
                $html_lhp .= '<td class=" " align="center">' . $stt++ . '</td>';
                $html_lhp .= '<td class=" "><a href="'.$url_diemhp.'">' . $item->tenlop . '</td>';
                $html_lhp .= '<td class=" ">' . $item->soluong . '</td>';
                $html_lhp .= '<td class=" ">' . $item->chucdanh . '. ' . $item->hodem . ' ' . $item->ten . '</td>';
                $html_lhp .= '<td class=" ">' . $item->tuan . ' | ' . $item->phong . ' | ' . $item->thu . ' | ' . $item->tiet . '</td>';
                $html_lhp .= '<td class=" "><a href="'.$url_xuatbangdiem.'">Xuất bảng điểm</a></td>
                <td class=" "><a href="'.$url_hu.'">Hù</a></td>
                <td class=" "><a href="'.$url_nhapdiem.'">Nhập điểm</a></td>';
                $html_lhp .= '</tr>';
            }
        }
        return $html_lhp;
    }

    public function get_lhp($hocky,$namhoc,$page){
        $today = date("D");
        if ($today =='Mon')    $today = 'Hai';
        elseif($today =='Tue') $today = 'Ba';
        elseif($today =='Wed') $today = 'Tư';
        elseif($today =='Thu') $today = 'Năm';
        elseif($today =='Fri') $today = 'Sáu';
        elseif($today =='Sat') $today = 'Bảy';
        elseif($today =='Sat') $today = 'Chủ nhật';

        if($page==1) {
            $ds_lophp = DB::table('table_lophocphan')
                ->join('table_giangvien', 'table_giangvien.id', '=', 'table_lophocphan.id_gv')
                ->where('table_lophocphan.hocky', $hocky)
                ->where('table_lophocphan.namhoc', $namhoc)
                ->where('table_lophocphan.thu', $today)
                ->orderBy('tenlop')
                ->select('table_lophocphan.id', 'tenlop', 'soluong', 'tuan', 'phong', 'thu', 'tiet', 'ghichu', 'chucdanh', 'hodem', 'ten')->get();
        }
        elseif($page==2)
        {
            $ds_lophp = DB::table('table_lophocphan')
                ->join('table_giangvien', 'table_giangvien.id', '=', 'table_lophocphan.id_gv')
                ->where('table_lophocphan.hocky', $hocky)
                ->where('table_lophocphan.namhoc', $namhoc)
                ->orderBy('tenlop')
                ->select('table_lophocphan.id', 'tenlop', 'soluong', 'tuan', 'phong', 'thu', 'tiet', 'ghichu', 'chucdanh', 'hodem', 'ten')->get();
        }
        return $ds_lophp;
    }

    public function getAddLHP()
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();
        $dshp = HocphanModels::select('id','tenhocphan','sotc')->get()->toArray();


        return view('admincp.lophocphan.ad_add_lophocphan');
    }

    public function getPhieu($masv)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();
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
            ->select('table_lophocphan.tenlop','table_hocphan.sotc','table_giangvien.hodem','table_giangvien.ten','table_giangvien.chucdanh','tuan','phong','thu','tiet')
            ->orderBy('table_lophocphan.tenlop')
            ->get();
        return view('admincp.lophocphan.phieukhoiluonghoctap',compact('tt_sv','khoiluong','tkb','nh_hienhanh'));
    }

    public function getAllPhieu($id)
    {
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();


        $tt_sv = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_sinhvien.masv','=','table_svlophocphan.masv')
            ->join('table_lophocphan','table_lophocphan.id','=','table_svlophocphan.idlop')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->join('nganh','nganh.id','=','table_sinhvien.nganh_id')
            ->join('khoahoc','khoahoc.id','=','table_sinhvien.khoahoc_id')
            ->where('table_lopsh.id',$id)
            ->where('table_svlophocphan.namhoc',$nh_hienhanh["id"])
            ->where('table_svlophocphan.hocky',$nh_hienhanh["hocky"])
            ->whereNull('table_lophocphan.lhp_id')
            ->groupBy('table_sinhvien.masv')
            ->select('table_sinhvien.masv','hodem','ten','ngaysinh','table_lopsh.tenlop','tennganh','khoahoc',DB::raw('SUM(table_hocphan.sotc) as sotc, COUNT(table_hocphan.id) as sohocphan'))->get();

        /*$tkb = DB::table('table_1lophocphan')
            ->join('table_giangvien','table_lophocphan.id_gv','=','table_giangvien.id')
            ->join('table_svlophocphan','table_svlophocphan.idlop','=','table_lophocphan.id')
            ->join('table_hocphan','table_hocphan.id','=','table_lophocphan.id_hocphan')
            ->where('table_svlophocphan.masv',$id)
            ->where('table_lophocphan.namhoc',$nh_hienhanh['id'])
            ->where('table_lophocphan.hocky',$nh_hienhanh['hocky'])
            ->select('table_lophocphan.tenlop','table_hocphan.sotc','table_giangvien.hodem','table_giangvien.ten','table_giangvien.chucdanh','tuan','phong','thu','tiet')
            ->orderBy('table_lophocphan.tenlop')
            ->get();*/
        return view('admincp.lophocphan.all_phieukhoiluonghoctap',compact('tt_sv','nh_hienhanh'));
    }

    public function getDSLopHP(){
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->get()->toArray();
        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        $ds_lophp = DB::table('table_lophocphan')
            ->join('table_giangvien','table_giangvien.id', '=' ,'table_lophocphan.id_gv')
            ->where('table_lophocphan.hocky',$nh_hienhanh["hocky"])
            ->where('table_lophocphan.namhoc',$nh_hienhanh["id"])
            ->orderBy('tenlop')
            ->select('table_lophocphan.id','tenlop','soluong','tuan','phong','thu','tiet','table_lophocphan.ghichu','chucdanh','hodem','ten')->get();

        return view('admincp.lophocphan.ad_dslophocphan',compact('ds_lophp','nh_hienhanh','namhoc'));
    }
    public function getDiemHocPhan($id){
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();
        $namhoc = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('trangthai',0)->get()->toArray();

        $diem_lhp = DB::table('table_svlophocphan')
            ->join('table_sinhvien','table_sinhvien.masv','=','table_svlophocphan.masv')
            ->join('table_lophocphan','table_lophocphan.id','=','table_svlophocphan.idlop')
            ->join('table_lopsh','table_lopsh.id','=','table_sinhvien.lopsh_id')
            ->where('table_svlophocphan.idlop',$id)
            ->orderBy('table_svlophocphan.masv')
            ->select('table_sinhvien.masv','hodem','ten','table_lopsh.tenlop','diem','diemt10','diemchu')->get();

        $tenlop = LophocphanModels::select('id','tenlop')->where('id',$id)->first();

        return view('admincp.diem.diem.ad_diemlophocphan',compact('diem_lhp','nh_hienhanh','namhoc','tenlop'));
    }

    public function getDSdanghoc($id){
        $user = \Illuminate\Support\Facades\Auth::user()->username;
        $level = User::select('id','level')->where('username',$user)->first();

        $nh_hienhanh = NamhocModels::select('id','nambatdau','namketthuc','hocky','trangthai')->where('hienhanh',0)->first();

        $ds_sv = DB::table('table_sinhvien')
            ->join('table_hocvu','table_sinhvien.masv','=','table_hocvu.masv')
            ->where('table_sinhvien.lopsh_id',$id)
            ->where('table_hocvu.hocky',$nh_hienhanh["hocky"])
            ->where('table_hocvu.namhoc',$nh_hienhanh["id"])
            ->groupBy('table_sinhvien.masv')
            ->orderBy('table_sinhvien.masv')
            ->select('table_sinhvien.masv','hodem','ten')->get();

        $lop = LopsinhhoatModels::select('tenlop')->where('id',$id)->first();

        return view('admincp.diem.hocvu.hocvulsh',compact('ds_sv','lop'));
    }
}
