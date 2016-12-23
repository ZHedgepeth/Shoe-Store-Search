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
            $GLOBALS['DB']->exec("INSERT INTO shoe_stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM shoe_stores;");
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
            $GLOBALS['DB']->exec("DELETE FROM shoe_stores;");
        }

        static function findById($search_id)
        {
            $search_id = (int) $search_id;
            $store_found = null;
            $all_stores = Store::getAll();

            for ($store_index = 0; $store_index < count($all_stores); $store_index++)
            {
                $current_store = $all_stores[$store_index];
                $current_store_id = $current_store->getId();

                if ($current_store_id == $search_id)
                {
                    $store_found = $current_store;
                    return $store_found;
                }
            }
            return $store_found;
        }

        function addBrand($new_brand)
        {
            $brand_Id = (int) $new_brand;
            $store_Id = $this->getId();

            //Add into Join Table
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (B_Id, S_Id) VALUES (" . $brand_Id . ", " . $store_Id .");");
        }

//      Here is where the tables will be joined ty
        function getBrands()
        {

            $current_brands = array();

            $select_all_brands = "SELECT brands.* FROM shoe_stores
            JOIN brands_stores ON (shoe_stores.S_Id = brands_stores.S_Id)
            JOIN brands ON (brands_stores.B_Id = brands.B_Id)
            WHERE shoe_stores.S_Id = {$this->getId()};";


            foreach ($select_all_brands as $brand)
            {
                $brand_name = $current_brand["name"];
                $brand_id = $current_brand["B_Id"];
                $brand_object = new Brand($brand_name, $brand_id);
                array_push($current_brands, $brand_objects);
            }
            return $current_brands;
        }
    }

 ?>
