<?php

function uploadFile ($file, $destPath)
{
    $filename = '';
    if ($file) {
        $filename = date('mdYHis') . uniqid(). '.' .$file->getClientOriginalExtension();

        $file->move($destPath, $filename);
    }

    return $filename;
}
