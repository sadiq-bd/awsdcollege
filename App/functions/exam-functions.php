<?php

function getGradeLetter(int $mark) {
    if ($mark >= 80) {
        $grade = 'a+';
    } elseif ($mark >= 70) {
        $grade = 'a';
    } elseif ($mark >= 60) {
        $grade = 'a-';
    } elseif ($mark >= 50) {
        $grade = 'b';
    } elseif ($mark >= 40) {
        $grade = 'c';
    } elseif ($mark >= 33) {
        $grade = 'd';
    } else {
        $grade = 'f';
    }

    return strtoupper($grade);
}


function getGradePoint(int $mark) {
    if ($mark >= 80) {
        $grade = 5;
    } elseif ($mark >= 70) {
        $grade = 4;
    } elseif ($mark >= 60) {
        $grade = 3.5;
    } elseif ($mark >= 50) {
        $grade = 3;
    } elseif ($mark >= 40) {
        $grade = 2;
    } elseif ($mark >= 33) {
        $grade = 1;
    } else {
        $grade = 0;
    }

    return $grade;
}


