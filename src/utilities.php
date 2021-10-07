 <?php
/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Utilities file
 */
 require __DIR__ . "/config.php";

function GoogleAnalytics($pagename = "")
{
    if ($_SERVER["SERVER_NAME"] != "localhost")
    {
        if ($pagename != "")
            $pagename = ",{'page_path': '$pagename'}";

        $result .= '<script async src="https://www.googletagmanager.com/gtag/js?id=' . GA_CODE . '"></script>';
        $result .= "<script>";
        $result .= "     window.dataLayer = window.dataLayer || [];";
        $result .= "     function gtag(){dataLayer.push(arguments);}";
        $result .= "     gtag('js', new Date());";
        $result .= "     gtag('config', '" . GA_CODE . "'$pagename);";
        $result .= "</script>";
    }
    return $result;
}
function MetaHeaders($title = "", $description = "")
{
    $url   = "https://www.example.com/";
    $image = "https://www.example.com/img/thumbnail.png";
    $keywords = "keyword 1, keword 2, keyword 3";
    $twitter = "@twitter";
    $color = "#002352";

    $result = "<meta charset=\"UTF-8\">";
    $result .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    
        
    if ($description != "")
        $result .= "<meta name=\"description\" content=\"$description\">";
    
    $result .= "<meta name=\"url\" content=\"$url\">";
    $result .= "<meta name=\"theme-color\" content=\"$color\">";
    $result .= "<meta property=\"og:type\" content=\"website\">";
    $result .= "<meta property=\"og:url\" content=\"$url\">";
        
    if ($title != "")
        $result .= "<meta property=\"og:title\" content=\"$title\">";
        
    if ($description != "")
        $result .= "<meta property=\"og:description\" content=\"$description\">";
        
    $result .= "<meta property=\"og:image\" content=\"$image\">";
    
    $result .= "<meta name=\"twitter:card\" content=\"summary\">";

    if ($twitter != "")
    {
        $result .= "<meta name=\"twitter:site\" content=\"$twitter\">";
        $result .= "<meta name=\"twitter:creator\" content=\"$twitter\">";
    }
            
    $result .= "<meta property=\"twitter:url\" content=\"$url\">";
        
    if ($title != "")
        $result .= "<meta property=\"twitter:title\" content=\"$title\">";
        
    if ($description != "")
        $result .= "<meta property=\"twitter:description\" content=\"$description\">";
        
    $result .= "<meta property=\"twitter:image\" content=\"$image\">";
    $result .= "<meta name=\"keywords\" content=\"$keywords\" />";
    
    return $result;
}

function DateFormat($date = "now", $format = "datetime", $zone = -5)
{
    $now = time();
    $today = strtotime(gmdate("Y-m-d 00:00:00", $now + (3600 * $zone)));

    if ($format == "unix")
    {
        if ($date == "now")
            return $now;
        else if ($date == "today")
            return $today;
        else if ( gettype($date) == "string" )
            return strtotime($date);
        
        return $date;
    }
    else
    {
        $unix = $date == "now"   ?  $now : $date;
        $unix = $date == "today" ?  $today : $unix;

        $format = $format == "date"     ? "Y-m-d"       : $format;  
        $format = $format == "datetime" ? "Y-m-d H:i:s" : $format;

        return gmdate($format, $unix + (3600 * $zone));
    }
}

function reCAPTCHA_V2()
{
    /*
        <head>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        </head>

        <div class="g-recaptcha d-inline-block" data-callback="recaptchaCallback" data-sitekey="<?php echo PK_reCAPTCHA_v2; ?>"></div>
        <script>
            function recaptchaCallback() {
                $('#button-id').removeAttr('disabled');
            };
        </script>
    */

    $captcha = $_POST["g-recaptcha-response"];

    if (isset($captcha))
    {
        $secretKey = SK_reCAPTCHA_v2;
        
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        
        if($responseKeys["success"])
            return true;
    }
    
    return false;
}
function reCAPTCHA_V3()
{
    /*
        <head>
            <script src="https://www.google.com/recaptcha/api.js?render=<?php echo PK_reCAPTCHA_v3; ?>"></script>
        </head>

        <script>
            $('#form-id').submit(function(event) {
                var code = "send_dgb";
                event.preventDefault();
        
                grecaptcha.ready(function() {
                    grecaptcha.execute('<?php echo PK_reCAPTCHA_v3; ?>', {action: code}).then(function(token) {
                        $('#form-id').prepend('<input type="hidden" name="token" value="' + token + '">');
                        $('#form-id').prepend('<input type="hidden" name="action" value="' + code + '">');
                        $('#form-id').unbind('submit').submit();
                    });;
                });
            });
        </script>
    */
    
    $token = $_POST['token'];
    $action = $_POST['action'];

    if (isset($token, $action))
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => SK_reCAPTCHA_v3, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $captcha = json_decode($response, true);
        
        if($captcha["success"] == '1' && $captcha["action"] == $action && $captcha["score"] >= 0.9)
            return true;
    }
    
    return false;
}

function Icon($icon)
{
    return "<i class='bi bi-$icon'></i>";
}

function Alert($message, $type = "primary", $dissmiss = false, $icon = "")
{
    $icon = $icon != "" ? Icon($icon) : "";
    
    $close = $dissmiss ? "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>": "";
    $dissmiss = $dissmiss ? " alert-dismissible fade show" : "";
    
    return "
    <div class='alert alert-$type $dissmiss' role='alert'>
        $icon
        $message
        $close
    </div>";
}


if (!function_exists("str_starts_with"))
{
    function str_starts_with($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
?>