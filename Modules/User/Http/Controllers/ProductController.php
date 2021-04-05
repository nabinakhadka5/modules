<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
   public function index(){
       try {
           $data['common'] = Helpers::titleAction([__('user::layer.product.title')]);
           return view('user::product.index', compact('data'));
       } catch (\Exception $e){
           abort('500');
       }
   }

    public function show($id){
        try {
            $data['common'] = Helpers::titleAction([__('user::layer.product.title')]);
            return view('user::product.show', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
