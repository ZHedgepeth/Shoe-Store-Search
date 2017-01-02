<?php

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
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['B_Id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE B_Id = {$this->getId()};");
        }

        function addStore($new_store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (B_Id, S_Id) VALUES ({$this->getId()}, {$new_store->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
            JOIN brands_stores ON (brands.B_Id = brands_stores.B_Id)
            JOIN stores ON (brands_stores.S_Id = stores.S_Id)
            WHERE brands.B_Id = {$this->getId()};");
            $current_stores = array();
            foreach ($returned_stores as $store)
            {
                $store_name = $store["name"];
                $store_id = $store["S_Id"];
                $new_store = new Store($store_name, $store_id);
                array_push($current_stores, $new_store);
            }
            return $current_stores;
        }

        static function findById($search_id)
        {
            $brand_found = null;
            $all_brands = Brand::getAll();
            foreach($all_brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                  $brand_found = $brand;
                }
            }
            return $brand_found;
        }
    }
?>
