<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Log;
use App\Chat;

class ChatController extends BaseController
{
    public function index(){
        return response()->json(Chat::get());
    }

    public function store(Request $request){
        Log::info($request);
        return response()->json(Chat::create($request->all()));
    }
}
