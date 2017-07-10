<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * @param $image - request->file
     * @return string
     */
    public static function saveImage($image) {
        $filename = rand(11111, 99999) . 'image.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);

        return '/images/' . $filename;
    }
}
