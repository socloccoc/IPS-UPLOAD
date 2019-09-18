<?php

namespace App\Http\Controllers;

use App\IpInfomation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function ipManager()
    {
        $ips = DB::table('ip_infomations')
            ->where('status', 1)
            ->select('country', 'locale', DB::raw('count(*) as total'))
            ->groupBy('locale', 'country')
            ->get();
        return view('ip.index', compact('ips'));
    }

    public function deleteIpByLocale($locale){
        $ips = DB::table('ip_infomations')
            ->where('status', 1)
            ->where('locale', $locale)
            ->update(['status' => 0]);
        if($ips){
            return redirect('/ip-manager')->with('message', 'Xóa Ip thành công !');
        }
    }


}