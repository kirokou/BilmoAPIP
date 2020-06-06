<?php

namespace App\Tests\Unit;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    private $product;

     /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->product = new Product();
    }

     /**
     * @return void
     */
    public function testGetReference():void
    {
        $value = 'S0S7_32N';
        $response = $this->product->setReference($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getReference());
    }

     /**
     * @return void
     */
    public function testGetName():void 
    {
        $value = 'kirikou';
        $response = $this->product->setName($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getName());
    }

     /**
     * @return void
     */
    public function testGetDescription():void 
    {
        $value = 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même.';
        $response = $this->product->setDescription($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getDescription());
    }

    /**
     * @return void
     */
    public function testGetPrice():void 
    {
        $value = 1400;        
        $response = $this->product->setPrice($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getPrice());
    }

     /**
     * @return void
     */
    public function testGetQuantity():void 
    {
        $value = 400;
        $response = $this->product->setQuantity($value);

        self::assertInstanceOf(Product::class, $response);
        self::assertEquals($value, $this->product->getQuantity());
    }

}