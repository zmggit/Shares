<?php
$location = 'gz';
$version = 'v4.2.3';
return [
    'version' => $version,
    'api_cos_api_end_point' => env('API_COS_API_END_POINT',''),
    'app_id' => env('APP_ID',''),
    'secret_id' =>env('SECRET_ID',''),
    'secret_key' => env('SECRET_KEY',''),
    'user_agent' => 'cos-php-sdk-'.$version,
    'time_out' => 18000,
    'location' => $location,
];