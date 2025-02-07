<?php

namespace App\Tools;

class FileTools
{

    public static function uploadImage($destinationPath, $file, $oldFileName = null)
    {
        $errors = [];
        $fileName = null;

        if (isset($file["tmp_name"]) && $file["tmp_name"] != '') {
            $checkImage = getimagesize($file["tmp_name"]);
            if ($checkImage !== false) {
                $fileName = StringTools::slugify(basename($file["name"]));
                $fileName = uniqid() . '-' . $fileName;

                $fullDestinationPath = _ROOTPATH_ . $destinationPath;
                if (!is_dir($fullDestinationPath)) {
                    mkdir($fullDestinationPath, 0777, true);
                }

                if (move_uploaded_file($file["tmp_name"], _ROOTPATH_.$destinationPath . $fileName)) {
                    if ($oldFileName) {
                        unlink($destinationPath . $oldFileName);
                    }
                } else {
                    $errors['file'] = 'The file was not upload';
                }
            } else {
                $errors['file'] = 'The file must be an image';
            }
        }
        return ['fileName' => $fileName ?? null, 'errors' => $errors];
    }

}