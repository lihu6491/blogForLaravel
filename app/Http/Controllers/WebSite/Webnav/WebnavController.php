<?php

namespace App\Http\Controllers\Website\Webnav;

use  App\Http\Controllers\Controller;
use  Illuminate\Http\Request;
use  App\Service\Webnav\WebNavService;

class WebnavController extends Controller
{


    public function __construct()
    {

    }

    public  function index(Request $request)
    {
        $params = $request->all();
        $NavList = WebNavService::getAll();
        $NavList = WebNavService::procList($NavList);

        return view('website.webnav.index',['NavList'=>$NavList]);
    }
}