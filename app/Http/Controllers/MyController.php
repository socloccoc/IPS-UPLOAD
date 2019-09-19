<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\StoreImport;
use App\IpInfomation;
use App\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\DomCrawler\Crawler;

class MyController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        try {
            if (!$request->hasFile('file')) {
                return redirect('/importView')->with('error_message', 'File không được để trống');
            }
            $file = $request->file('file');
            $fileContent = explode("\n", file_get_contents($file->getRealPath()));
            if (count($fileContent) == 0) {
                return redirect('/importView')->with('error_message', 'File không có dữ liệu');
            }
            $data = [];
            foreach ($fileContent as $item) {
//                $ipInfo = explode('|', $item);
//                if ($this->checkIpExist($ipInfo)) {
//                    continue;
//                }
                $data[] = [
                    'ip_address' => trim($item),
//                    'user'       => isset($ipInfo[1]) ? trim($ipInfo[1]) : '',
//                    'password'   => isset($ipInfo[2]) ? trim($ipInfo[2]) : '',
//                    'country'    => isset($ipInfo[3]) ? trim($ipInfo[3]) : '',
                    'locale'     => strtoupper(trim($this->get_string_between($item, '(', ')'))),
//                    'note'       => isset($ipInfo[4]) ? trim($ipInfo[4]) : '',
//                    'code'       => isset($ipInfo[5]) ? trim($ipInfo[5]) : '',
//                    'city'       => isset($ipInfo[6]) ? trim($ipInfo[6]) : '',
                    'status'     => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $ips = IpInfomation::insert($data);
            if ($ips) {
                return redirect('/importView')->with('message', 'Import Ips thàn công !');
            }
        } catch (\Exception $ex) {
            return redirect('/importView')->with('error_message', 'Import thất bại !');
        }
    }

    public function checkIpExist($ipInfo)
    {
        $ip = IpInfomation::where('ip_address', trim($ipInfo[0]))
            ->where('user', trim($ipInfo[1]))
            ->where('password', trim($ipInfo[2]))
            ->where('country', trim($ipInfo[3]))
            ->where('code', trim($ipInfo[5]))
            ->where('city', trim($ipInfo[6]))
            ->where('status', 1)
            ->first();
        if ($ip) {
            return true;
        }
        return false;
    }

    public function cleanText($content)
    {
        $content = preg_replace('/\s+/', '', $content);
        return $content;
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
}