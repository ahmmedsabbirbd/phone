<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OptionalController extends Controller
{
    
    public function optionalRoute(Request $request):string {
        $name = $request->name;
        if($name) {
            return "optional Route name {$name}";
        } else {
            return "Please provie optional name";
        }
    }
}
