<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 11/30/17
 * Time: 5:27 PM
 */

namespace App\Controllers;


use App\Facades\Image;

class ImagerController
{
    public function store($username = '')
    {
        $uploaded_images = array();

        foreach ($_FILES as $file) {
            $i_random = rand(200, 100000000);

            $name_tail = $username . DIRECTORY_SEPARATOR . $i_random;

            $name = imagesPath() . DIRECTORY_SEPARATOR . $name_tail;
            $tn_name = thumbnailsPath() . DIRECTORY_SEPARATOR . $name_tail;

            $this->createDirectories($name, $tn_name);

            $img = Image::make($file['tmp_name'])
                ->fit(600, 450, function ($constraint) {
                    $constraint->upsize();
                });

            $img->save($name . ".jpg", 70);


            $img->fit(240, 180, function ($constraint) {
                $constraint->upsize();
            })
                ->save($tn_name . ".jpg", 90);

            $uploaded_images[] = $name_tail;
        }

        // headers to tell that result is JSON
        header('Content-type: application/json');
        echo json_encode($uploaded_images);
        exit;
    }

    private function createDirectories($name, $tn_name)
    {
        foreach (func_get_args() as $path) {
            $path_dir = substr($path, 0, strrpos($path, "/"));

            if (!file_exists($path_dir)) {
                mkdir($path_dir);
            }
        }
    }
}