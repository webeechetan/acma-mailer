<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\UtmData;

class CommonController extends Controller
{
    protected function saveUtmData(Request $request, $table)
    {
        $utm_data = new UtmData();
        $utm_data->table_id     = $table['id'];
        $utm_data->table_name   = $table['table'];
        $utm_data->utm_source   = $request->input('utm_source');
        $utm_data->utm_medium   = ($request->input('utm_medium')!= null)?$request->input('utm_medium'):'';
        $utm_data->utm_campaign = ($request->input('utm_campaign')!= null)?$request->input('utm_campaign'):'';
        $utm_data->utm_term     = ($request->input('utm_term')!= null)?$request->input('utm_term'):'';
        $utm_data->utm_content  = ($request->input('utm_content')!= null)?$request->input('utm_content'):'';
        try {
            $utm_data->save();
        } catch (\Throwable $e) {
            Log::error('UTM Error - '.$e->getMessage());
        }
    }
}
