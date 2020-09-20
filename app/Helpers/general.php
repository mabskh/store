<?php


define('PAGINATION_COUNT', 15);


function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}




function uploadImage($folder,$image)  // take Two Arguments  1. folder,  2. image
{
    $image->store('/', $folder);
    $fileName = $image->hashName();
   // $path = '/images' . $folder . $fileName;
    return $fileName;
}
