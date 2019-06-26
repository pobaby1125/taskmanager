<?php
    
namespace App\Repositories;
use Image;

class ProjectsRepository
{
    public function create($request)
    {
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

            // 添加压缩文件
            // $path = storage_path('app/public/thumbs/cropped/' . $name);
            // Image::make($thumb)->resize(260,90)->save($path);

            return $name;
        }
    }

}
