<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AboutController extends Controller
{
    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('user::layer.about.title')]);
            return view('user::about.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
