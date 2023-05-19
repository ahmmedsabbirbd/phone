<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse as HttpFoundationJsonResponse;

class SessionController extends Controller
{
    public function saveSession(Request $request): JsonResponse
    {
        $gender = $request->query('gender');
        $request->session()->put('gender', $gender, 'x');

        return response()->json([
            'gender'=> $gender,
        ]);
    }
    
    public function getSession(Request $request): JsonResponse
    { 
       $gender = $request->session()->get('gender');

        return response()->json([
            'gender'=> $gender,
        ]);
    }
    
    public function pullSession(Request $request): JsonResponse
    { 
       $gender = $request->session()->pull('gender');

        return response()->json([
            'gender'=> $gender,
            'removed'=> true,
        ]);
    }
    
    public function forgetSession(Request $request): JsonResponse
    { 
       $gender = $request->session()->forget('gender');

        return response()->json([
            'gender'=> $gender,
            'removed'=> true,
        ]);
    }
    
    public function flashSession(Request $request): JsonResponse
    { 
       $gender = $request->session()->forget('gender');

        return response()->json([
            'gender'=> $gender,
            'all-removed'=> true,
        ]);
    }
}
