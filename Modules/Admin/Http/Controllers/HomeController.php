<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(){
        try {
            // $data['common'] = Helpers::titleAction([__('user::layer.home.title')]);
            return view('admin::home.index');
        } catch (\Exception $e){
            abort('500');
        }
    }
}
