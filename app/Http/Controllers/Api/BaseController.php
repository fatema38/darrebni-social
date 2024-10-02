<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function SendSuccessResponse($data,$message){
        $response['status']='success';
        $response['message']=$message;
        $response['data']=$data;
        return response()->json($response);
    }
    public function SendErrorResponse($message){
        $response['status']='fail';
        $response['message']=$message;
        return response()->json($response,404);
    }
}
