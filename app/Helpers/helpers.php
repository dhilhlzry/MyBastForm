<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('user')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string $path
     * @return string
     */
    function user()
    {
        return Auth::user();
    }
}