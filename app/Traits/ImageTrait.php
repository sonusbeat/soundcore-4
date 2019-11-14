<?php

namespace App\Traits;

trait ImageTrait
{
    /**
     * Remove spaces and replace them with dashes,
     * then lowercase characters
     *
     * @param string $filename  Example: james.jpg, alice.png, brian.gif
     * @param string $extension Example: .jpg, .png, .gif, .bmp
     * @return string
     */
    public static function filenameTraitment($filename = '', $extension = '.jpg')
    {
        $withoutExtension = strtolower(str_replace(".{$extension}", '', $filename));
        $withoutSpaces = str_replace(' ', '-', $withoutExtension);
        $lowercase = strtolower($withoutSpaces);

        return $lowercase . '-' . date('Ymdims') . '.' . $extension;
    }
}
