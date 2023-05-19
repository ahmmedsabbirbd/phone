<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;

class PhoneController extends Controller
{
    private $phones = [
        [
            'brand' => 'Apple',
            'model' => 'iPhone 12',
            'storage' => '128GB',
            'color' => 'Black'
        ],
        [
            'brand' => 'Samsung',
            'model' => 'Galaxy S21',
            'storage' => '256GB',
            'color' => 'Phantom Gray'
        ],
        [
            'brand' => 'Google',
            'model' => 'Pixel 5',
            'storage' => '128GB',
            'color' => 'Just Black'
        ],
        [
            'brand' => 'OnePlus',
            'model' => '9 Pro',
            'storage' => '256GB',
            'color' => 'Morning Mist'
        ],
        [
            'brand' => 'Xiaomi',
            'model' => 'Mi 11',
            'storage' => '128GB',
            'color' => 'Midnight Gray'
        ],
        [
            'brand' => 'Huawei',
            'model' => 'P40 Pro',
            'storage' => '256GB',
            'color' => 'Silver Frost'
        ],
        [
            'brand' => 'Sony',
            'model' => 'Xperia 1 III',
            'storage' => '256GB',
            'color' => 'Black'
        ],
        [
            'brand' => 'LG',
            'model' => 'Wing',
            'storage' => '128GB',
            'color' => 'Aurora Gray'
        ],
        [
            'brand' => 'Motorola',
            'model' => 'Edge+',
            'storage' => '256GB',
            'color' => 'Thunder Grey'
        ],
        [
            'brand' => 'Nokia',
            'model' => '8.3',
            'storage' => '64GB',
            'color' => 'Polar Night'
        ],
        [
            'brand' => 'Nokia',
            'model' => '8.3',
            'storage' => '64GB',
            'color' => 'Polar Night'
        ]
    ];


    // GET
    public function allPhones (Request $request): array | string | null | int | bool {
        $limit = $request->query('limit');
        $brand = $request->query('brand');
        
        if($limit) {
            return array_splice($this->phones, 0, $limit);
        } else {
            return $this->phones;
        }
    }

    // GET
    public function phone (Request $request):array {
        $id = $request->id;
        
        return $this->phones[$id - 1];
    }

    // GET
    public function fields (Request $request):string {
        $id = $request->id;
        $fields = $request->fields;
        $currentPhone = $this->phones[$id - 1];
        
        return $currentPhone[$fields];
    }
    
    // GET
    public function viewPhotos (Request $request):BinaryFileResponse {
        $photoPath = public_path('upload/ahmmedsabbirbd.png');
        
        return response()->file($photoPath);
    }
    
    // GET
    public function downloadPhotos (Request $request):BinaryFileResponse {
        $photoPath = public_path('upload/ahmmedsabbirbd.png');
        
        return response()->download($photoPath);
    }

    // GET
    public function cookie (Request $request) {
        $name = "cookie_1";
        $value = "kire";
        $minute = 60;
        $path = "/";
        $domain= $_SERVER['SERVER_NAME'];
        $security = false;
        $httpOnly = true;

        // get

        
        return response('hellow')->cookie(
            $name, $value, $minute, $path, $domain, $security, $httpOnly
        );
    }

    // GET
    public function myCookie (Request $request): JsonResponse {
        $cookie1 = $request->cookie('cookie_1');
        
        return response()->json([
            $cookie1
        ]);
    }
   
    // GET
    public function phoneView (Request $request) { 
        return response()->view('phones.phone');
    }

    // POST
    public function createPhone (Request $request):JsonResponse {
        $brand = $request->input('brand');
        $model = $request->input('model');
        $storage = $request->input('storage');
        $color = $request->input('color');

        $token = $request->header('token');

        // image uploaded
        $phonePhoto = $request->file('phone');
        $phoneFileSize = filesize($phonePhoto);
        $phoneFileType = filetype($phonePhoto);
        $phoneOrginalName = $phonePhoto->getClientOriginalName();
        $phoneTempName = $phonePhoto->getFilename();
        $phoneExtention = $phonePhoto->extension();
 
        $phonePhoto->storeAs('upload', $phoneOrginalName);
        $phonePhoto->move(public_path('upload'), $phoneOrginalName);

        // ip collection
        $ip = $request->ip();

        // content nagiation
        $contentnagiation = $request->getAcceptableContentTypes();

        $accepts = 'no accepts';
        if ($request->accepts(['text/html', 'application/json'])) {
            $accepts = 'accepts';
        }

        // cookie
        $testCookie = $request->cookie('test_cookie');

        return response()->json([
            'brand'=> $brand,
            'model'=> $model,
            'storage'=> $storage,
            'color'=> $color,
            'token'=>$token,
            'phone-photo' => [
                'phoneOrginalName'=> $phoneOrginalName,
                'phoneExtention'=> $phoneExtention,
                'phoneTempName'=> $phoneTempName,
                'phoneFileType'=> $phoneFileType,
                'phoneFileSize'=> $phoneFileSize,
            ],
            'uploaded'=> 'complete',
            'your-request'=> $accepts,
            'ip'=>$ip,
            'getAccetpTableContentTypes'=> $contentnagiation,
            'testCookie'=> $testCookie,
        ], 201)->header(
            'status', '201'
        );
    }
}
