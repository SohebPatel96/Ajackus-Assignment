<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarbonRequest;
use App\models\CarbonFootPrint;
use Illuminate\Support\Facades\Cache;

class CarbonController extends Controller
{
    public function index(CarbonRequest $request)
    {
        $queryParameters = http_build_query($request->all());
        $url = env('API_URL') . '?' . $queryParameters;

        //check if the url is already cached
        if (Cache::has($url)) {
            $carbonFootPrint = Cache::get($url);
            return response()->json(['success' => true, 'carbonFootPrint' => $carbonFootPrint . '. Value retreived from cache']);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);

        if (curl_error($ch)) {
            return response()->json(['success' => false, 'message' => 'Request Error:' . curl_error($ch)]);
        }

        $result = json_decode($response);
        $carbonFootPrint = $result->carbonFootprint;

        //insert record into the database
        $carbonFootPrintModel = new CarbonFootPrint;
        $carbonFootPrintModel->create(array(
            'activity_type' => $request->activityType,
            'activity' => $request->activity,
            'country' => $request->country,
            'mode' => $request->mode,
            'carbon_foot_print' => $carbonFootPrint,
        ));

        Cache::add($url, $carbonFootPrint, (24 * 60 * 60)); //save the value in cache for 24 hours
        return response()->json(['success' => true, 'carbonFootPrint' => $carbonFootPrint]);
    }
}
