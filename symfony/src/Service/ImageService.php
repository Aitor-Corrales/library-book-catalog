<?php

namespace App\Service;

class ImageService
{
    //In order to make array associative and avoid iterating over it
    const ALLOWED_EXTENSIONS = ['jpg' => true];

    /**
     * @param string $imageFullName
     * @return bool
     * Determines whether an image name has an allowed extension or not
     */
    public function imageHasAllowedExtension(string $imageFullName): bool
    {
        $hasAllowedExtension = false;
        if ($dotPosition = strrpos($imageFullName, '.'))
            $hasAllowedExtension = isset(self::ALLOWED_EXTENSIONS[substr($imageFullName, $dotPosition + 1)]);
        return $hasAllowedExtension;
    }

}