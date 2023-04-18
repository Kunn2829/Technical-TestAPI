<?php

use PHPUnit\Framework\TestCase;

class PruebaTest extends TestCase {


//Pruebas GET

public function testGetUserPost(){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsAPI-ManagePostUser.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6IkFsZWphbmRybzI4MjkuIiwiZXhwIjoxNjgxNzUwMTQ3fQ.9XF7ZKcd2KKDhYfNn0cRICHlcjp3IqUQwGWfAHgYy7c'
      ),
    ));
    
    $response = curl_exec($curl);
    $responsejson = json_decode($response,true);
    curl_close($curl);

    $this->assertTrue(array_key_exists("id_post",$responsejson[0]));

}

public function testGetOnePost(){

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsAPI-PostIndividual.php?post_id=3',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6IkFsZWphbmRybzI4MjkuIiwiZXhwIjoxNjgxNzUwMTQ3fQ.9XF7ZKcd2KKDhYfNn0cRICHlcjp3IqUQwGWfAHgYy7c'
      ),
    ));
    
    $response = curl_exec($curl);
    
    
    $responsejson = json_decode($response,true);
    curl_close($curl);

    $this->assertTrue(array_key_exists("id_post",$responsejson[0]));



}

public function testGetFollowingPersonsPost(){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsApi-AllPostFollowed.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6IkFsZWphbmRybzI4MjkuIiwiZXhwIjoxNjgxNzUwMTQ3fQ.9XF7ZKcd2KKDhYfNn0cRICHlcjp3IqUQwGWfAHgYy7c'
  ),
));

$response = curl_exec($curl);
$responsejson = json_decode($response,true);
    curl_close($curl);

    $this->assertTrue(array_key_exists("id_post",$responsejson[0]));


}

public function testSpecificUserData(){


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/userAPI-Open.php?id_user=16',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer Abc81391723Xd2141'
      ),
    ));
    
    $response = curl_exec($curl);
    $responsejson = array(json_decode($response,true));
    curl_close($curl);

    $this->assertTrue(array_key_exists("id_user",$responsejson[0]));


}

public function testApiGetPostSpecificUser(){
    

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsApi-FollowUserPost.php?id_user_followed=16',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjE2LCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6IkFsZWphbmRybzI4MjkuIiwiZXhwIjoxNjgxNzUwMTQ3fQ.9XF7ZKcd2KKDhYfNn0cRICHlcjp3IqUQwGWfAHgYy7c'
      ),
    ));
    
    $response = curl_exec($curl);
    $responsejson = json_decode($response,true);
    curl_close($curl);

    $this->assertTrue(array_key_exists("id_post",$responsejson[0]));



}


//Pruebas POST
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

$responsejson = json_decode($response);
if (http_response_code() === 200) {
    $this->assertSame("El usuario ha sido agregado correctamente",$responsejson["message"],"Api ingresa los datos");
  } else {
    $this->assertSame("El correo electrónico o nombre de usuario ya está en uso.",$response,"Api responde con correo repetivo");
  }

    }


    public function testEditUser(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/UserAPI-EditSession.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('name_user' => 'Alejandro Alvarez','mail_user' => 'Brayany99@gmail.com','username_user' => 'Kunnashi323','description_user' => 'Hola, Busco amigos','cel_user' => '3123616318'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6Ikt1bm5hc2hpMjgiLCJleHAiOjE2ODE4NDgwNDJ9.li9B9rMCz-xgQ5wSIoMLyJNPRL4UENMF0W5bphdaqgE'
          ),
        ));
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals(201,$httpCode,"no inserto correctamente");


    }

    public function testCreatePost(){


        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsAPI-ManagePostUser.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('title_post' => 'Hoy me disculpe con Alejo','description_post' => 'Es el día mas feliz de mi vida'),
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6Ikt1bm5hc2hpMjgiLCJleHAiOjE2ODE4NDgwNDJ9.li9B9rMCz-xgQ5wSIoMLyJNPRL4UENMF0W5bphdaqgE'
          ),
        ));
        
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals(201,$httpCode,"no inserto correctamente");


    }
    
    public function testGiveLike() {

        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/PostsAPI-GiveLike.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id_post' => '5'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6Ikt1bm5hc2hpMjgiLCJleHAiOjE2ODE4NDgwNDJ9.li9B9rMCz-xgQ5wSIoMLyJNPRL4UENMF0W5bphdaqgE'
  ),
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals(201,$httpCode,"no inserto correctamente");

    }

    public function testApiFollow() {
 
       

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/UserAPI-Follow.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id_user_followed' => '17'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6Ikt1bm5hc2hpMjgiLCJleHAiOjE2ODE4NDgwNDJ9.li9B9rMCz-xgQ5wSIoMLyJNPRL4UENMF0W5bphdaqgE'
  ),
));

$response = curl_exec($curl);


$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals(201,$httpCode,"no inserto correctamente");

    }

    public function testUnFollow(){



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/UserAPI-Unfollow.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id_user_followed' => '17','' => ''),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEyLCJuYW1lIjoiQWxlamFuZHJvIEFsdmFyZXoiLCJ1c2VybmFtZSI6Ikt1bm5hc2hpMjgiLCJleHAiOjE2ODE4NDgwNDJ9.li9B9rMCz-xgQ5wSIoMLyJNPRL4UENMF0W5bphdaqgE'
  ),
));

$response = curl_exec($curl);

$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $this->assertEquals(201,$httpCode,"no inserto correctamente");


    }

  public function testLogin(){


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'localhost/TECHNICAL-TESTAPI/Login.php',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('username' => 'FelipeP','password' => 'FelipeP2023'),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    

    $this->assertArrayHasKey('token',json_decode($response,true));
    

  }




    }



