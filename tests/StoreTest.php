<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once ("src/Store.php");
    require_once ("src/Client.php");

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

    }

?>
