<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/ProductsDao.class.php';

class ProductService extends BaseService{

  public function __construct(){
    $this->dao = new ProductsDao();
  }

  public function get_products($search, $offset, $limit, $order, $total=FALSE){
    return $this->dao->get_products($search, $offset, $limit, $order, $total);
  }

  public function add_product($product){
    try{
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
    } catch (\Exception $e) {
      if (str_contains($e->getMessage(), 'products.uq_products_name')) {
        throw new Exception("Product already exists", 400, $e);
      }else{
        throw new Exception($e->getMessage(), 400, $e);
      }
    }
  }

}
?>
