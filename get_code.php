#!/usr/bin/php -q
<?php
# loading configuration variables from env.inc file
include("dev.inc");
 
# set some oauth2 variables
$metadata = http($oauth_root.'/.well-known/openid-configuration');
$state = bin2hex(random_bytes(5));
 
# setup a local webservice to trap token responses
$redirect_uri = "https://$ecs_cluster_domain/flower/";
 
$authorize_url = $metadata->authorization_endpoint.'?'.http_build_query([
'response_type' => 'code',
'client_id' => $client_id,
'redirect_uri' => $redirect_uri,
'state' => $state,
'scope' => $scope
]);
 
system ("wslview \"$authorize_url\"");
die();
 
//////////////////////////
 
function http($url, $params=false) {
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
# curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if($params)
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
$output=curl_exec($ch);
# var_dump ($output);
return json_decode($output);
}
 
?>
