<?php
use shop\models\product;


class google_merchant_feed extends controller
{

  function __construct()
  {
  }

  function indexAction ()
  {
    global $db;
    //$products = product::get([], 10000);

    $products = $db->gen("SELECT sp.id,sp.title,sp.upc,sp.image,sp.description,sp.price,(CASE WHEN new_price='' THEN sp.price ELSE new_price END) as sale_price,sku.stock as stock FROM shop_product sp, shop_sku sku WHERE product_id=sp.id AND sku.stock>0;");

    echo "id\ttitle\tprice\tdescription\tlink\timage_link\tavailability\tsale_price\n";
    foreach($products as $p) {
      echo $p[0]."\t".$p[1]."\t".$p['price']."\t".$p['description']."\t";
      echo gila::url('shop/product/'.$p[0])."\t";
      echo $p['image']."\tin stock".$p['sale_price']."\n";
    }
  }
}
