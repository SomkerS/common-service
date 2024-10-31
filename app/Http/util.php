<?php

function formatErrors($message)
{
    if (is_array($message)) {
        foreach ($message as $k => $v) {
            $message = isset($v[0])?$v[0]:$v;
            break;
        }
    }
    return $message;
}