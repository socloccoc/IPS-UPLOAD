<?php

namespace App\Http\Controllers\Api;

use App\IpInfomation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Matrix\Exception;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use File;

class IpApiController extends BaseApiController
{
    public function getIpByLocale($locale)
    {
        try {
            $ip = IpInfomation::where('locale', strtoupper($locale))->where('status', 1)->first();
            if (!$ip) {
                return $this->sendError('Ip đã được sử dụng hết', Response::HTTP_NOT_FOUND);
            }

            $ipUpdate = IpInfomation::where('id', $ip['id'])->limit(1)->update(['status' => 0]);

            if ($ipUpdate) {
                $ipInfo = $ip['ip_address'].'|'.$ip['user'].'|'.$ip['password'].'|'.$ip['note'].'|'.$ip['code'].'|'.$ip['city'];
                return $this->sendResponse($ipInfo, Response::HTTP_OK);
            }
        }catch(\Exception $ex){
            return $this->sendError($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        }

    }

}