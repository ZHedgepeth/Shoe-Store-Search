<?php
    require_once("src/Store.php");

    class Brand
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return (string)$this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return (int) $this->id;
        }

        function save()
        {
            $name = $this->getName();

            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('" . $name . "');");

            $this->id = (int) $GLOBALS['DB']->lastInsetId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }


    }
?>
