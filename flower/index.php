<?php
echo "<pre>";
 
# secrets
include("dev.inc");
$scope="openid";
 
if (!isset($_GET['state']))
{
  echo "POST\n";
  print_r($_POST);
  echo "\n\nGET\n";
  print_r($_GET);
  die();
}
 
$state = $_GET['state'];
$code = $_GET['code'];
 
echo "Sending out token request ($state)...\n";
 
$response = http("https://login.microsoftonline.com/tttttttttttttttttttttttt/oauth2/token", [
'grant_type' => 'authorization_code',
'code' => $code,
'redirect_uri' => $redirect_uri,
'client_id' => $client_id,
'client_secret' => $client_secret,
]);
 
echo "Response\n";
print_r($response);
 
if (!isset($response->access_token))
  die("(!) Error fetching access token\n");
 
$id_token = $response->id_token;
 
echo "id-token\n";
print_r(json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $id_token)[1])))));
 
die();
 
//////////////////////////
 
function http($url, $params=false) {
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if($params)
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
$output=curl_exec($ch);
// var_dump($output);
return json_decode($output);
}
 
?>
