<?php

function getStudentImageUrl(string $file) {
    return rtrim(CONFIG['base_url'], '/') . 
        '/' . 
        trim(trim(CONFIG['dirs']['images']['students']), '/') . 
        '/' . 
        ltrim($file, '/');
}


