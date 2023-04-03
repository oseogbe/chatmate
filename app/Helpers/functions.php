<?php

function generateRandomString($length = 12) {
    $characters = 'CD8TUPQRSV9ABxyzEFGHMNO0uvw1WXYZdefghi2jklm3nIJKLop4qrst56abc7';
    $randomString = substr(str_shuffle($characters), 0, $length);
    return $randomString;
}
