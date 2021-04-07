<?php

namespace Modules\User\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('user::layer.contact.title')]);
            return view('user::contact.index', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }
}
