<?php

namespace SEO\Services;


class Helper
{
    public static function fileSize($url)
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

            return $size;
        } catch (\Exception $e) {
            return false;
        }
    }


    public static function shorten($text, $str = 10) {
        if (strlen($text) > $str) {
            if (function_exists("mb_substr")) $text = mb_substr($text, 0, $str, "UTF-8").'..';
            else $text = substr($text, 0, $str).'..';
        }
        return $text;
    }
    public static function generate_keyword($keywords_data){
        $keywords_data = explode(' ',$keywords_data);
        return implode(',',$keywords_data);
    }
}