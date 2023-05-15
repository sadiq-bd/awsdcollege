<?php

function rawFileUpload(array $fileOpts, callable $onSuccess = null, callable $onFailure = null) {

    $fileName = isset($fileOpts['name']) ? $fileOpts['name'] : '';
    $validExt = isset($fileOpts['valid-extensions']) ? $fileOpts['valid-extensions'] : [];
    $maxSize = isset($fileOpts['max-file-size']) ? $fileOpts['max-file-size'] : 1;
    $fileData = isset($fileOpts['file-data']) ? $fileOpts['file-data'] : '';
    $uploadName = isset($fileOpts['upload-name']) ? $fileOpts['upload-name'] : '';
    $uploadDir = isset($fileOpts['upload-dir']) ? $fileOpts['upload-dir'] : '';


    $fileExt = pathinfo(filter_var($fileName), PATHINFO_EXTENSION);
    if (in_array($fileExt, $validExt)) {
        $fileData = base64_decode($fileData);
        if (strlen($fileData) < 1024 * 1024 * $maxSize) {   

            $file = $uploadName . '.' . $fileExt;
            $fileWithDir = rtrim($uploadDir, '/') . '/' . ltrim($file, '/');

            touch($fileWithDir);

            if (file_put_contents($fileWithDir, $fileData)) {
                if (is_callable($onSuccess)) {
                    call_user_func_array($onSuccess, [
                        $file
                    ]);
                }
            }    
                        
            return true;

        } else {

            if (is_callable($onFailure)) {
                call_user_func_array($onFailure, [
                    'file-size-exceed',
                    'File Size Exceed (max ' . $maxSize . 'MB)'
                ]);
            }
        }
    } else {

        if (is_callable($onFailure)) {
            call_user_func_array($onFailure, [
                'invalid-file-extension',
                'Invalid file file format'
            ]);
        }

    }

    return false;

}

