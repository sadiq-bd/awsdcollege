<?php

function map(array $arr, callable $func) {
    foreach ($arr as $key => $value) {
        $return = call_user_func_array($func, [$value, $key]);
        if (is_string($return)) {
            echo $return;
        }
    }
}

