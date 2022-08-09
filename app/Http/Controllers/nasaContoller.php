<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class nasaContoller extends Controller
{
    public function nasaFilter(Request $request)
    {
        if ($request->isMethod('post')) {
            $psotData = $request->all();
            $responseData =  $this->callApi($psotData['start'], $psotData['end']);
            if (sizeof($responseData) > 0) {
                $tmpArr = [];
                $tmpMax = [];
                $tmpMin  = [];
                $chart = [];
                $avgArr = [];
                foreach ($responseData['near_earth_objects'] as $key => $value) {
                    foreach ($value as $key2 => $astroid) {
                    $avgArr[] = $astroid['estimated_diameter']['kilometers']['estimated_diameter_max'];
                
                        $tmpArr[] = $astroid;
                        $tmpMin[] = end($astroid['close_approach_data'])['miss_distance']['kilometers'];
                        $tmpMax[] = end($astroid['close_approach_data'])['relative_velocity']['kilometers_per_hour'];
                    }
                    $chart['labels'][] = $key;
                    $chart['data'][] = count($value);
                }
                $max = max($tmpMax);
                $min = min($tmpMin);
                $response['fastestAstroid'] = [
                    'id'=>$tmpArr[array_search($max,$tmpArr)]['id'],
                    'speed'=>end($tmpArr[array_search($max,$tmpArr)]['close_approach_data'])['relative_velocity']['kilometers_per_hour']
                ];
                $response['closestAstroid'] = [
                    'id'=>$tmpArr[array_search($min,$tmpArr)]['id'],
                    'distance'=>end($tmpArr[array_search($min,$tmpArr)]['close_approach_data'])['miss_distance']['kilometers']
                ];
                $avgTotal = array_sum($avgArr)/count($avgArr);
                $response['chart'] = $chart;
                $response['average'] = $avgTotal;
                $response['msg'] = "success";
                $response['status'] = 1;
            } else {
                $response = [];
                $response['msg'] = "failed to load api";
                $response['status'] = 0;
            }
        } else {
            $response = [];
            $response['msg'] = "request type is wrong";
            $response['status'] = 0;
        }
        echo json_encode($response);
        exit();
    }
    private function callApi($start, $end)
    {
        $start = date('Y-m-d', strtotime($start));
        $end = date('Y-m-d', strtotime($end));
        // $start = '2022-07-01';
        // $end = '2022-07-08';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.nasa.gov/neo/rest/v1/feed?start_date=$start&end_date=$end&api_key=4dpfI5n6gONHtz0wkGFOMbOqLJXX1a2jk38ysGd3",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['near_earth_objects'])) return $response;
        else $response = [];
        return $response;
    }
}
