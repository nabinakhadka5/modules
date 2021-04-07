<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index(){
        try {

            $data['common'] = Helpers::titleAction([__('user::layer.home.title')]);
            return view('user::home.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
