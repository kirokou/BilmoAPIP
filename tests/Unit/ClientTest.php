<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ClientTest extends KernelTestCase
{
    private $client;

     /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->client = new Client();
    }

     /**
     * @return void
     */
    public function testGetEmail():void
    {
        $value = 'test@test.com';
        $response = $this->client->setEmail($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertEquals($value, $this->client->getEmail());
    }

     /**
     * @return void
     */
    public function tesGetRoles():void 
    {
        $value = ['ROLE_ADMIN'];
        $response = $this->client->setRoles($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertContains('ROLE_USER', $this->client->getRoles());
        self::assertContains('ROLE_ADMIN', $this->client->getRoles());
    }

     /**
     * @return void
     */
    public function tesGetPassword():void 
    {
        $value = 'password';
        $response = $this->client->setPassword($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertContains($value , $this->client->getPassword());
    }

     /**
     * @return void
     */
    public function testGetName():void
    {
        $value = 'karaba'; 
        $response = $this->client->setName($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertEquals($value, $this->client->getName());
    }

     /**
     * @return void
     */
    public function testGetUser():void 
    {
        //test add method
        $value = new User();
        $response = $this->client->addUser($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertCount(1, $this->client->getUsers());
        self::assertTrue($this->client->getUsers()->contains($value));

        //test remove method
        $response = $this->client->removeUser($value);

        self::assertInstanceOf(Client::class, $response);
        self::assertCount(0, $this->client->getUsers());
        self::assertFalse($this->client->getUsers()->contains($value));
    }
}