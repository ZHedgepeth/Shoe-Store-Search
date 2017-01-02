<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    date_default_timezone_set('America/New_York');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    $app->get("/stores/{store_id}", function($store_id) use($app) {
        $current_store = Store::findById($store_id);
        return $app['twig']->render('store.html.twig', array(
            'individual_store' => $current_store,
            'all_stores' => Store::getAll(),
            'brands' => $current_store->getBrands()
        ));
    });

    $app->get("/stores", function() use($app) {
      return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });

    $app->post("/stores", function() use($app) {
      $store = $_POST['store'];
      $id = null;
      $new_store =  new Store($store, $id);
      $new_store->save();
      return $app['twig']->render('index.html.twig', array('stores' => Store::getAll()));
    });

    return $app;

?>
