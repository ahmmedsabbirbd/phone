<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
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
    public function allPhones (Request $request):array {
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

    // POST
    public function createPhone (Request $request):JsonResponse {
        $brand = $request->input('brand');
        $model = $request->input('model');
        $storage = $request->input('storage');
        $color = $request->input('color');

        return response()->json([
            'brand'=> $brand,
            'model'=> $model,
            'storage'=> $storage,
            'color'=> $color,
        ]);
    }
}
