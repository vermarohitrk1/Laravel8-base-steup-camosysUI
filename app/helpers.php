<?php
if (! function_exists('responder')) {
    /**
     * Return Json response
     * 
     * @param   mixed   $key
     * @param   mixed   $value
     * @return  mixed
     */
    function responder($status, $title, $message, $callback = null, $notify = true, $notifyType = null, $callbackTime = "onconfirm") {
        $response = array(
                "status" => $status,
                "title" => $title,
                "message" => $message
            );
        if (!empty($callback)) {
            $response["callback"] = $callback;
        }
        if (!$notify) {
            $response["notify"] = false;
        }
        if (isset($notifyType)) {
            $response["notifyType"] = $notifyType;
        }
        if ($callbackTime == "instant") {
            $response["callbackTime"] = $callbackTime;
        }
        return $response;     
    }
}

if (! function_exists('slugify')) {
 function slugify($text)
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

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
}
