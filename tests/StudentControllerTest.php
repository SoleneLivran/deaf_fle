<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentControllerTest extends WebTestCase
{
    // test page cannot be accessed when not connected
    public function testAccessDeniedIsNotConnected()
    {
        $client = static::createClient();
        $client->request('GET', '/api/groups/1/students');
        $this->assertResponseStatusCodeSame('401');
    }

    // test token generation is ok
    // TODO : factorization in a tests tool directory
    public function testJWTokenGenerate()
    {
        $client = static::createClient();
        $client->request('POST', '/api/login_check');
//        file_put_contents(__DIR__ . '/toto.html', $client->getResponse()->getContent());
    }

    // test page can be accessed when logged in with group teacher

    // test page cannot be accessed when logged in with other group's teacher

    // test list. For a specific group :
    // right number of results (students) in json
    // right student data (check one correct name)
    // no wrong student data (check one incorrect name, from another group)
//    public function testStudentsList()
//    {
//        $client = self::createClient();
//
//
//
//        $client->request('GET', '/api/group/1/students');
//        $response = $client->getResponse()->getContent();
//        var_dump($response);
//    }
}