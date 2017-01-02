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

    class StoreTest extends PHPUnit_Framework_TestCase
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
            $new_store = new Store($name);
            $expected_output = $name;

            //Act
            $result = $new_store->getName();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_setName()
        {
            //Arrange
            $name = "Whatsonya Foot";
            $new_store = new Store($name);
            $new_name = "Shoe me the way";
            $expected_output = $new_name;

            //Act
            $new_store->setName($new_name);
            $result = $new_store->getName();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Shoe Rock";
            $id = 1;
            $new_store = new Store($name, $id);
            $expected_output = $id;

            //Act
            $result = $new_store->getId();

            //Assert
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //Arrange
            $id = null;
            $name = "Whatsonya Foot";
            $new_store = new Store($name, $id);
            //Act
            $new_store->save();
            //Assert
            $this->assertEquals($new_store, Store::getAll()[0]);

        }

        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "GlueAShoeToYou";
            $new_store = new Store($name, $id);
            $new_store->save();

            $name2 = "Shoe Glide";
            $new_store2 = new Store($name2, $id);
            $new_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$new_store, $new_store2], $result);
        }

        function test_getBrands()
        {
            //Arrange
            $name = "GlueAShoeToYou";
            $id = null;
            $new_store = new Store($name, $id);
            $new_store->save();

            $name = "Nike";
            $id = null;
            $new_brand = new Brand($name, $id);
            $new_brand->save();
            $new_store->addBrand($new_brand);

            $name2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($name, $id);
            $new_brand2->save();
            $new_store->addBrand($new_brand2);

            //Act
            $result = $new_store->getBrands();

            //Assert
            $this->assertEquals([$new_brand, $new_brand2], $result);
        }

        function test_addBrand()
        {
            //Arrange
            $store_name = "Whatsonya Foot";
            $new_store = new Store($store_name);
            $new_store->save();

            $brand_name = "Nike";
            $new_brand = new Brand($brand_name);
            $new_brand->save();

            //Act
            $new_store->addBrand($new_brand);

            //Assert
            $this->assertEquals([$new_brand], $new_store->getBrands());
        }

        function testUpdate()
        {
            //Arrange
            $name = "Doctor Shoe";
            $id = null;
            $new_store = new Store($name, $id);
            $new_store->save();

            $new_name = "Nurse Shoe";

            //Act
            $new_store->update($new_name);

            //Assert
            $this->assertEquals("Nurse Shoe", $new_store->getName());
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Doctor Shoe";
            $name2 = "Nurse Shoe";
            $new_store = new Store($name);
            $new_store->save();
            $new_store2 = new Store($name2);
            $new_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function testDelete()
        {
            //Arrange
            $name = "Doctor Shoe";
            $id = null;
            $new_store = new Store($name, $id);
            $new_store->save();

            $name2 = "Nurse Shoe";
            $id = null;
            $new_store2 = new Store($name2, $id);
            $new_store2->save();

            //Act
            $new_store->delete();

            //Assert
            $this->assertEquals([$new_store2], Store::getAll());
        }

    }

?>
