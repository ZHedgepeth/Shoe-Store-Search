<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once ("src/Store.php");
    require_once ("src/Brand.php");

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Shoeby Doowop";
            $new_brand = new Brand($name);
            $expected_output = $name;

            //Act
            $result = $new_brand->getName();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Nike";
            $new_brand = new Brand($name);
            $new_name = "Adidas";
            $expected_output = $new_name;

            //Act
            $new_brand->setName($new_name);
            $result = $new_brand->getName();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Sketcher";
            $id = 1;
            $new_brand = new Brand($name, $id);
            $expected_output = $id;

            //Act
            $result = $new_brand->getId();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //Arrange
            $id = null;
            $name = "Shoebies";
            $new_brand = new Brand($name, $id);
            //Act
            $new_brand->save();
            //Assert
            $this->assertEquals($new_brand, Brand::getAll()[0]);

        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "Nike";
            $new_brand = new Brand($name, $id);
            $new_brand->save();

            $name2 = "Adidas";
            $new_brand2 = new Brand($name2, $id);
            $new_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Nike";
            $name2 = "Adidas";
            $new_brand = new Brand($name);
            $new_brand->save();
            $new_brand2 = new Brand($name2);
            $new_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getStores()
        {
            //Arrange
            $name = "Nike";
            $id = null;
            $new_brand = new Brand($name, $id);
            $new_brand->save();

            $name = "Doctor Shoe";
            $id = null;
            $new_store = new Store($name, $id);
            $new_store->save();
            $new_brand->addStore($new_store);

            $name2 = "Whatsonya Foot";
            $id = null;
            $new_store2 = new Store($name2, $id);
            $new_store2->save();
            $new_brand->addStore($new_store2);

            //Act
            $result = $new_brand->getStores();

            //Assert
            $this->assertEquals([$new_store, $new_store2], $result);
        }

        function test_addStore()
        {
            //Arrange
            $brand_name = "Nike";
            $new_brand = new Brand($brand_name);
            $new_brand->save();

            $store_name = "Whatsonya Foot";
            $new_store = new Store($store_name);
            $new_store->save();

            //Act
            $new_brand->addStore($new_store);

            //Assert
            $this->assertEquals([$new_store], $new_brand->getStores());
        }

        function testDelete()
        {
            //Arrange
            $name = "Nike";
            $id = null;
            $new_brand = new Brand($name, $id);
            $new_brand->save();

            $name2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($name2, $id);
            $new_brand2->save();

            //Act
            $new_brand->delete();

            //Assert
            $this->assertEquals([$new_brand2], Brand::getAll());
        }


    }
