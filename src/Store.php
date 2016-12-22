<?php
    require_once("src/Brand.php");

    class Store
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = (string) $name;
            $this->id = (int) $id;
        }

        function getName()
        {
            return (string) $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getId()
        {
            return (int) $this->id;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM shoe_stores;");
        }

        function save()
        {
            $name = $this->getName();

            $GLOBALS['DB']->exec("INSERT INTO shoe_stores (name) VALUES ('" . $name . "');");

            $this->id = (int) $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $stores = [];
            $storesPDOStatement = $GLOBALS['DB']->query("SELECT * FROM shoe_stores;");

            if ($storesPDOStatement)
            {
                $stores_data = $storesPDOStatement->fetchAll();

                for($store_index = 0; $store_index < count($stores_data); $store_index++)
                {
                    $current_store = $stores_data[$store_index];
                    $store_name = $current_store["name"];
                    $store_id = $current_store["S_Id"];

                    $store_object = new Store($store_name, $store_id);

                    $stores[] = $store_object;
                }
            }
            return $stores;
        }
    }

 ?>
