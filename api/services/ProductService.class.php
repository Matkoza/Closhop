<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/productDao.class.php';

class ProductService extends BaseService{

  public function __construct(){
    $this->dao = new ProductsDao();
  }

  public function get_products($search, $offset, $limit, $order){
    if ($search){
      return $this->dao->get_products($search, $offset, $limit, $order);
    }else{
      return $this->dao->get_all($offset, $limit, $order);
    }
  }

  public function add_product($product){
      $product = [
        "name" => $product['name'],
        "type" => $product['type'],
        "price" => $product['price'],
        "stock" => $product['stock'],
        "description" => $product['description'],
        "color" => $product['color'],
        "sex" => $product['sex'],
      ];
      return parent::add($product);
  }

}
?>
