<?php

namespace App\Traits;

trait ImageTrait
{
    /**
     * Remove spaces and replace them with dashes,
     * then lowercase characters
     *
     * @param string $filename Example: james.jpg, alice.png, brian.gif
     * @param string $extension Example: .jpg, .png, .gif, .bmp
     * @param string $date Notice: must be this format date('Ymdims')
     * @param string $sizeName Example: large, medium, thumbnail
     * @return string
     */
    public static function filenameTraitment($filename = '', $extension = '.jpg', $date = '', $sizeName = '')
    {
        $withoutExtension = strtolower(str_replace(".{$extension}", '', $filename));
        $withoutSpaces = str_replace(' ', '-', $withoutExtension);
        $lowercase = strtolower($withoutSpaces);

        $imageName  = $lowercase . '-' . $date;

        if ($sizeName !== ''):
            $imageName .= "-{$sizeName}";
        endif;

        $imageName .= '.' . $extension;

        return $imageName;
    }

    /**
     * Remove spaces and replace them with dashes,
     * then lowercase characters
     *
     * @param string $filename Example: james.jpg, alice.png, brian.gif
     * @param string $extension Example: .jpg, .png, .gif, .bmp
     * @param string $date Notice: must be this format date('Ymdims')
     * @return string
     */
    public static function removeExtension($filename = '', $extension = '.jpg', $date = '')
    {
        $withoutExtension = strtolower(str_replace(".{$extension}", '', $filename));
        $withoutSpaces = str_replace(' ', '-', $withoutExtension);
        $lowercase = strtolower($withoutSpaces);

        return $lowercase . '-' . $date;
    }
}
