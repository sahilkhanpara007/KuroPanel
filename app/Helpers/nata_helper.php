<?php

/**
 * create_password
 *
 * @param  mixed $password
 * @param  mixed $enc
 * @return string
 */
function create_password($password, $enc = true)
{
    $optn = ['cost' => 8];
    $patt = "XquxmymXDtWRA66D";
    $hash = md5($patt . $password);
    $pass = password_hash($hash, PASSWORD_DEFAULT, $optn);
    return ($enc ? $pass : $hash);
}

function getName($user)
{
    if ($user->fullname) {
        return word_limiter($user->fullname, 1, '');
    } else {
        return $user->username;
    }
}

function getLevel($level = 0)
{
    switch ($level) {
        case '1':
            $a = 'Admin';
            break;
        case '2':
            $a = 'Reseller';
            break;
        default:
            $a = 'Unknown';
            break;
    }
    return $a;
}

function setMessage($msg, $color = 'secondary')
{
    return [$msg, $color];
}

function getDevice($devices)
{
    $total = 0;
    $listDevice = "";
    if ($devices) {
        $clean_comma = reduce_multiples($devices, ",", true);
        $ex = explode(',', $clean_comma);
        $listDevice = "";
        foreach ($ex as $ld) {
            $listDevice .= "$ld\n";
        }
        $total = count($ex);
    }
    return (object) ['total' => $total, 'devices' => trim($listDevice)];
}

function setDevice($devicesPost, $max)
{
    // dont touch this forever please -_-
    if ($devicesPost) {
        $clean_enter = reduce_multiples($devicesPost, "\n", true);
        $ez = [''];
        $ef = array_unique(array_filter(preg_replace("/[^A-Za-z0-9]/", "", explode("\n", $clean_enter))));
        $ex = array_filter(array_merge($ez, $ef));
        foreach ($ex as $k => $item) {
            if ($k <= $max) {
                $result[] = trim($item);
            }
        }
        return implode(",", array_unique($result));
    }
}

function getPrice($price, $duration, $device_max)
{
    $priceReal = $price[$duration];
    $result = ($priceReal * $device_max);
    return ($result <= 0) ? false : $result;
}
