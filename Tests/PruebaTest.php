<?php

use PHPUnit\Framework\TestCase;

class PruebaTest extends TestCase {


    public function testApiCreateUser(){
    

        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/userAPI-Open.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('name_user' => 'Venus Cordoba','mail_user' => 'Venus.cordoba30@gmail.com','username_user' => 'NikolC2','description_user' => 'Novia de carlos
Esoterismo','cel_user' => '3123616317','password' => 'VenusEsoC'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer Abc81391723Xd2141'
  ),
));

$response = curl_exec($curl);

curl_close($curl);


$this->assertSame("El correo electrónico o nombre de usuario ya está en uso.",$response,"Api responde");


    }
    

}
   


