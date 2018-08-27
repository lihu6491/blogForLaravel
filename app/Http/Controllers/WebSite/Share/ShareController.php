<?php

namespace App\Http\Controllers\Website\Share;

use  App\Http\Controllers\Controller;
use  App\Service\Share\ShareQueryService;
use  Illuminate\Http\Request;
use  App\Service\Share\ShareService;


class ShareController extends Controller
{


    public function __construct()
    {

    }

    public  function index(Request $request)
    {
        $params = $request->all();
        $ShareList = ShareService::getAll();

        return view('website.share.index',['ShareList'=>$ShareList]);
    }
}