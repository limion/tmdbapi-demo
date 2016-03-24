<?php

namespace TmdbDemo;

/**
 * Helper class for encoding/decoding API data
 *
 * @author vlad.holovko@gmail.com
 */
class ApiFormatter {
    
    public static function encode($data)
    {
        return json_encode($data);
    }
    
    public static function decode($data, $assoc = true)
    {
        return json_decode($data, $assoc);
    }
    
}
