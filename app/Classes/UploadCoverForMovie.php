<?php

namespace App\Classes;

use App\Classes\Abstracts\HubRepositories;
use Illuminate\Support\Facades\Validator;
use App\Images;
use Image;
use File;

class UploadCoverForMovie extends HubRepositories
{
    const WIDTH_PICTURE = 250;
    const HEIGHT_PICTURE = 350;
    public $imagesPath = '';

    public function process($request)
    {
        $validator = Validator::make($request->all(), [
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }
        $paths = [
            'image_path' => public_path('/uploads/images/covers/')
        ];
        foreach ($paths as $key => $path) {
            if (!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
        }
        $this->imagesPath = $paths['image_path'];
        if ($file = $request->file('cover')) {
            $image = Image::make($file);
            $imageName = $file->getClientOriginalName();
            $image->save($this->imagesPath . $imageName);
            $image->resize(self::WIDTH_PICTURE, self::HEIGHT_PICTURE);
            $lastInsert = [];
            foreach ($this->movieRepository->getAll() as $movie) {
                $lastInsert[] = $movie;
            }
            $id = $lastInsert[count($lastInsert) - 1]->id;
            $this->movieRepository->update(['cover' => $imageName], $id);
        }
    }
}
