<?php
    require_once("src/Brand.php");

    class Store
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
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['S_Id'];
                var_dump($id);
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }

        static function findById($search_id)
        {
            $store_found = null;
            $all_stores = Store::getAll();
            foreach($all_stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                  $store_found = $store;
                }
            }
            return $store_found;
        }

        function addBrand($new_brand)
        {
            //Add into Join Table
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (B_Id, S_Id) VALUES ({$new_brand->getId()}, {$this->getId()});");
        }

//      Here is where the tables will be joined ty
        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
            JOIN brands_stores ON (stores.S_Id = brands_stores.S_Id)
            JOIN brands ON (brands_stores.B_Id = brands.B_Id)
            WHERE stores.S_Id = {$this->getId()};");
            $current_brands = array();
            foreach ($returned_brands as $brand)
            {
                $brand_name = $brand["name"];
                $brand_id = $brand["B_Id"];
                $new_brand = new Brand($brand_name, $brand_id);
                array_push($current_brands, $new_brand);
            }
            return $current_brands;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE S_Id = {$this->getId()};");
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE S_Id = {$this->getId()};");
            $this->setName($new_name);
        }
    }

 ?>
