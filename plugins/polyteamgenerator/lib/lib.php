<?php

function get_error_codes() {
    $CODES = array(
        "invalid-team-size-range"
    );

    $error_codes = new stdClass();

    foreach ($CODES as $code) {
        $error_codes->{$code} = get_string("error:code:" . $code, 'block_polyteamgenerator');
    }

    return $error_codes;
}