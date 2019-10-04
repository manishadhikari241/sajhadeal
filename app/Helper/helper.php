<?php
function seperator($depth)
{
    $space = '';
    for ($i = 1; $i < $depth; $i++) {
        $space .= '-';
    }
    return $space;
}
