<?php 
namespace App\Helpers;
use DB;
class Helper
{    
    function slugify($text,$tblname)
    {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, '-');

    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);

    // lowercase
    $text = strtolower($text);

    if (empty($slug)) {
        return 'n-a';
    }

    if(DB::table($tblname)->Where('slug', 'like', '%' . $slug . '%')->count() > 0){
        $end =array();
        foreach(DB::table($tblname)->Where('slug', 'like', '%' . $slug . '%')->pluck('slug')->toArray() as $slugs){
            $array = explode('-',$slugs);
            $end[] = end($array);
        }
        $max = array_filter($end, 'is_numeric');
        if(!empty($max)){
            $ifExist = max($max) + 1;
            $slug .= '-'.$ifExist;
        }else{
            $slug .= '-1';
        }
        }
    return $slug;

    }
}