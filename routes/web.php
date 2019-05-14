<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/{social}', [
	'as' => 'login.{social}',
	'uses' => 'SocialAccountController@redirectToProvider'
]);

Route::get('callback/{social}', [
	'as' => 'login.{social}.callback',
	'uses' => 'SocialAccountController@handleProviderCallback'
]);


Route::group(['prefix'=>'gv'], function() {
    Route::get('', ['as' => 'gv.getLogin', 'uses' => 'Auth\LoginController@getLogin']);
    Route::post('', ['as'=>'gv.postLogin','uses' => 'Auth\LoginController@postLogin']);
    Route::get('logout', ['as'=>'gv.logout','uses' => 'Auth\LoginController@logout']);
    Route::get('index', ['as'=>'gv.getIndex','uses' => 'MainController@getIndex']);
    Route::get('diemdanh/', ['as'=>'gv.getLophocphan','uses' => 'LophocphanController@getLophocphan']);
    Route::get('diemdanh/{id}', ['as'=>'gv.getDSSVLHP','uses' => 'LophocphanController@getDSSVLHP']);
    Route::get('tonghop-diemdanh/', ['as'=>'gv.getTonghopDD','uses' => 'LophocphanController@getTonghopDD']);
    Route::get('sinhvien',['as'=>'gv.getSinhvien','uses' => 'LophocphanController@getSinhvien']);
    Route::get('nhapdiem/{id}',['as'=>'gv.getNhapdiem','uses' => 'LophocphanController@getNhapdiem']);
    Route::get('gvcn',['as'=>'gv.getGVCN','uses' => 'LophocphanController@getGVCN']);
    Route::get('gvcn/{id}', ['as'=>'gv.getDSSVLSH','uses' => 'LophocphanController@getDSSVLSH']);
    Route::get('lophp/', ['as'=>'gv.getDSLHP','uses' => 'LophocphanController@getDSLHP']);
    //Route::get('de-cuong-mon', ['as'=>'gv.getDecuong','uses' => 'LophocphanController@getDecuong']);
    Route::get('trong-so/{id}', ['as'=>'gv.getTrongso','uses' => 'LophocphanController@getTrongso']);
    Route::post('trong-so/{id}', ['as'=>'gv.postTrongso','uses' => 'LophocphanController@postTrongso']);
    Route::get('bao-nghi/{id}', ['as'=>'gv.baonghi','uses' => 'LophocphanController@baonghi']);
    Route::post('bao-nghi/{id}', ['as'=>'gv.postbaonghi','uses' => 'LophocphanController@postbaonghi']);
	/*
    Route::group(['prefix'=>'giao-trinh'], function() {
        Route::get('',['as'=>'gv.getDSGiaotrinh','uses' => 'LophocphanController@getDSGiaotrinh']);
        Route::get('them',['as'=>'gv.getGiaotrinh','uses' => 'LophocphanController@getGiaotrinh']);
        Route::post('them', ['as'=>'gv.postGiaotrinh','uses' => 'LophocphanController@postGiaotrinh']);
        Route::get('xoa/{id}',['as'=>'gv.getGTDelete','uses'=>'LophocphanController@getGTDelete']);
        Route::get('sua/{id}',['as'=>'gv.getGTEdit','uses'=>'LophocphanController@getGTEdit']);
        Route::post('sua/{id}',['as'=>'gv.postGTEdit','uses'=>'LophocphanController@postGTEdit']);
    });
	*/
    Route::get('bang-diem-giua-ky/{id}', ['as'=>'gv.bangDiemgiuaky','uses' => 'DiemGVController@bangDiemgiuaky']);
    Route::get('bang-diem-cuoi-ky/{id}', ['as'=>'gv.bangDiemcuoiky','uses' => 'DiemGVController@bangDiemcuoiky']);
	
    Route::get('diem/{id}', ['as'=>'gv.getdiem','uses' => 'LophocphanController@getAdDiem']);
});

Route::group(['prefix'=>'sv'], function() {
    Route::get('', ['as' => 'sv.getLoginsv', 'uses' => 'Auth\SVLoginController@getLoginsv']);
    Route::post('', ['as'=>'sv.postLoginsv','uses' => 'Auth\SVLoginController@postLoginsv']);
    Route::get('logout', ['as'=>'sv.logout','uses' => 'Auth\SVLoginController@logout']);
    Route::get('diem', ['as'=>'sv.getIndex','uses' => 'SV_MainController@getIndex']);
    Route::get('lich-hoc', ['as'=>'sv.getTKB','uses' => 'SV_MainController@getTKB']);
    Route::get('ca-nhan', ['as'=>'sv.getInfo','uses' => 'SV_MainController@getInfo']);
    Route::get('lienheGV', ['as'=>'sv.getLienhe','uses' => 'SV_MainController@getLienhe']); 
    Route::get('xac-nhan-hoc', ['as'=>'sv.xacnhanhoc','uses' => 'SV_MainController@xacnhanhoc']);
    Route::get('khoi-luong-dang-ky', ['as'=>'sv.getPhieudk','uses' => 'SV_MainController@getPhieudk']);

});

Route::group(['prefix'=>'admincp'], function() {
    Route::get('', ['as' => 'ad.getLoginAD', 'uses' => 'Auth\ADLoginController@getLoginAD']);
    Route::post('', ['as'=>'ad.postLoginAD','uses' => 'Auth\ADLoginController@postLoginAD']);
    Route::get('danh-sach-lopSH', ['as'=>'ad.getDSLop','uses' => 'HocvuController@getDSLop']);
    Route::get('danh-sach-lopHP', ['as'=>'ad.getDSLopHP','uses' => 'HocvuController@getDSLopHP']);
    Route::get('chi-tiet/{id}', ['as'=>'ad.getChitiet','uses' => 'HocvuController@getChitiet']);
    Route::get('diem-danh/{id}', ['as'=>'ad.getDiemdanh','uses' => 'HocvuController@getDiemdanh']);
    Route::get('diemdanh/{masv}', ['as'=>'ad.getDiemdanhSV','uses' => 'HocvuController@getDiemdanhSV']);
    Route::get('tuan-diem-danh', ['as'=>'ad.getTuandiemdanh','uses' => 'HocvuController@getTuandiemdanh']);
    Route::get('danh-sach-sv/{id}', ['as'=>'ad.getDSSV','uses' => 'HocvuController@getDSSV']);
    Route::get('tong-hop-diem/{id}', ['as'=>'ad.getTonghop','uses' => 'HocvuController@getTonghop']);
    Route::get('diem-sinh-vien/{masv}', ['as'=>'ad.getDiemCanhanSV','uses' => 'HocvuController@getDiemCanhanSV']);
    Route::get('lhp-diem-danh', ['as'=>'ad.getDSLopHPDiemdanh','uses' => 'HocvuController@getDSLopHPDiemdanh']);
    Route::get('phieu-dang-ky-khoi-luong/{masv}', ['as'=>'ad.getPhieu','uses' => 'HocvuController@getPhieu']);
    Route::get('phieu-dang-ky-lop-sinh-hoat/{id}', ['as'=>'ad.getAllPhieu','uses' => 'HocvuController@getAllPhieu']);
    Route::get('diem-hoc-phan/{id}', ['as'=>'ad.getDiemHocPhan','uses' => 'HocvuController@getDiemHocPhan']);
    Route::get('dot-nhap-diem', ['as'=>'ad.getDotNhapDiem','uses' => 'HocvuController@getDotNhapDiem']);
    Route::get('danh-sach-lop/{id}', ['as'=>'ad.getDSdanghoc','uses' => 'HocvuController@getDSdanghoc']);
    Route::get('hoc-vu', ['as'=>'ad.getXetKyHoc','uses' => 'HocvuController@getXetKyHoc']);
	Route::get('gvcn',['as'=>'ad.getGVCN','uses' => 'LophocphanController@getAdGVCN']);
    Route::get('gvcn/{id}', ['as'=>'ad.getDSSVLSH','uses' => 'LophocphanController@getAdDSSVLSH']);
    Route::get('chonbangdiem/{id}', ['as'=>'ad.chonbangdiem','uses' => 'DiemDTController@xuatDanhsachthi']);
    Route::get('hu/{id}', ['as'=>'ad.xuatdanhsachhu','uses' => 'DiemDTController@xuatdanhsachhu']);

    Route::get('xac-nhan-hoc/{id}', ['as'=>'ad.getdsxacnhanhoc','uses' => 'AdmincpHCController@getdsxacnhanhoc']);
    Route::get('bao-nghi', ['as'=>'ad.getbaonghi','uses' => 'AdmincpHCController@getbaonghi']);

	Route::get('them-thong-bao', ['as'=>'ad.add_cms','uses' => 'Admin\CmsController@add']);


    Route::group(['prefix'=>'lop-hoc-phan'], function() {
        Route::get('them',['as'=>'ad.getAddLHP','uses' => 'HocvuController@getAddLHP']);
        Route::post('them', ['as'=>'ad.postAddLHP','uses' => 'HocvuController@postAddLHP']);
        Route::get('xoa/{id}',['as'=>'ad.getLHPDelete','uses'=>'HocvuController@getLHPDelete']);
        Route::get('sua/{id}',['as'=>'ad.getLHPEdit','uses'=>'HocvuController@getLHPEdit']);
        Route::post('sua/{id}',['as'=>'ad.postLHPEdit','uses'=>'HocvuController@postLHPEdit']);
    });
    Route::post('danh-sach-thi/{id}', ['as'=>'ad.bangDiemgiuaky','uses' => 'DiemDTController@bangDiemgiuaky']);
    Route::get('danh-sach-hu/{id}', ['as'=>'ad.danhsachhu','uses' => 'DiemDTController@danhsachhu']);
    Route::get('bang-diem-cuoi-ky/{id}', ['as'=>'ad.bangDiemcuoiky','uses' => 'DiemDTController@bangDiemcuoiky']);
});

Route::get('save_check_vatmat', 'LophocphanController@save_check_vatmat');
Route::get('save_check_comat', 'LophocphanController@save_check_comat');
Route::post('get_ajax_hocky',['uses'=>'LophocphanController@get_ajax_hocky']);
Route::post('get_ajax_namhoc',['uses'=>'LophocphanController@get_ajax_namhoc']);

Route::post('get_ajax_hocky_admin',['uses'=>'HocvuController@get_ajax_hocky_admin']);
Route::post('get_ajax_namhoc_admin',['uses'=>'HocvuController@get_ajax_namhoc_admin']);

//nhập điểm
Route::post('save_diem_lophocphan',['uses'=>'LophocphanController@save_diem_lophocphan']);

//xác nhận học
Route::post('xac_nhan_hoc_ajax',['uses'=>'SV_MainController@xac_nhan_hoc_ajax']);

//tạo phòng thi
Route::post('get_ajax_create_roomtest_admincp',['uses'=>'AjaxAdminController@get_ajax_create_roomtest_admincp']);

Route::post('send_point',['uses'=>'AJAXController@send_point']);
/*Auth::routes();
*/




Route::get('/', 'HomeController@index');
Route::get('/thong-bao-chung/{id}/', 'HomeController@detail');
Route::get('/thong-bao-giang-vien/{id}/', 'HomeController@detail');

//1
