<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('user::layer.blog.title')]);
            return view('user::blog.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function show($id){
        try {
            $data['common'] = Helpers::titleAction(['Name of post']);
            return view('user::blog.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
