<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    private $user;
    
    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->user = new User();
    }

     /**
     * @return void
     */
    public function testGetFirstname():void
    {
        $value = 'kirikou'; 
        $response = $this->user->setFirstname($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getFirstname());
    }

     /**
     * @return void
     */
    public function testGetLastname():void
    {
        $value = 'karaba'; 
        $response = $this->user->setLastname($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getLastname());
    }
    
    /**
     * @return void
     */
    public function testGetEmail():void
    {
        $value = 'test@test.com';
        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getEmail());
    }
    
    /**
     * @return void
     */
    public function testGetClient():void 
    {
        $value = new Client();
        $response = $this->user->setClient($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getClient());
    }
    
    /**
     * @return void
     */
    public function testGetCreatedAt():void 
    {
        $value = new \DateTime();
       
        $response = $this->user->setCreatedAt($value);
        self::assertInstanceOf(User::class, $response);
    }
}