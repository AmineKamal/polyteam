<?php

require(__DIR__ . '/../../../config.php'); 
require_once($CFG->dirroot.'/user/profile/lib.php');

require_login();

global $USER;

$url = "https://polyteam-backend-staging.herokuapp.com/personality"; // Default
if (isset($CFG->block_polyteamgenerator_url)) {
    $url = $CFG->block_polyteamgenerator_url;
}

$ch = curl_init($url);
$payload = file_get_contents('php://input');

curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
}

curl_close($ch);

if (isset($error_msg)) {
    echo $error_msg;
    http_response_code(500);
} else {
    $profile = json_decode($USER->profile_field_polyteam);
    $profile->personality = json_decode($result);
    $USER->profile_field_polyteam = json_encode($profile);
    profile_save_data($USER);
    echo $result;
}