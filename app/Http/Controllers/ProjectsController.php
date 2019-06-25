<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class ProjectsController extends Controller
{
    public function store( Request $request ){
        // dd( $request->user() );
        // dd( $request->all() );

        // dd($request->thumbnail);
        // dd($request->thumbnail->extension());

        $request->user()->projects()->create([
            'name'      => $request->name,
            'thumbnail'  => $this->thumb($request)
        ]);

    }

    public function thumb($request)
    {
        if ( $request->hasFile('thumbnail') )
        {
            $thumb = $request->thumbnail;
            $name  = $thumb->hashName();
            $thumb->storeAs('public/thumbs/original', $name);

            $path = storage_path('app/public/thumbs/cropped/' . $name);
            Image::make($thumb)->resize(60,60)->save($path);

            return $name;
        }
    }
}
