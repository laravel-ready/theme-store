<?php

namespace LaravelReady\ThemeStore\Helpers;

class CommonHelpers
{
    /**
     * Format bytes into human readable format.
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function getHumanReadableSize(int $size, int $precision = 2)
    {
        $units = ['b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;

        return number_format($size / pow(1024, $power), $precision, '.', ',') . ' ' . $units[$power];
    }
}
