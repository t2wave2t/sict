<?php

namespace App\Http\Controllers;
namespace Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class AJAXController extends Controller
{
    function send_point()
    {
        $idlophp = Input::get('idlophp');

        $mytime = Carbon\Carbon::now();
	

         DB::update(
            'update table_lophocphan set sent = 1,thoigiannhapdiem=? where id = ?',[$mytime->toDateTimeString()],[$idlophp]
        );


        DB::update(
            'update table_svlophocphan set diem = diem_phu where idlop = ?', [$idlophp]
        );
      
        return 1;
    }
}
