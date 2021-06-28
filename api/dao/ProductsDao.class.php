<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class ProductsDao extends BaseDao{

  public function __construct(){
    parent::__construct("products");
  }

  public function get_products($search, $offset, $limit, $order, $total=FALSE){
    list($order_column, $order_direction) = self::parse_order($order);
    $params = [];
    if ($total){
      $query = "SELECT COUNT(*) AS total ";
    }else{
      $query = "SELECT * ";
    }
    $query .= "FROM products
               WHERE 1 = 1 ";
    if (isset($search)){
    $query .= "AND ( LOWER(name) LIKE CONCAT('%', :search, '%'))";
    $params['search'] = strtolower($search);
      }

    if ($total){
    return $this->query_unique($query, $params);
      }else{
        $query .="ORDER BY ${order_column} ${order_direction} ";
        $query .="LIMIT ${limit} OFFSET ${offset}";

        return $this->query($query, $params);
        }
    }

    public function get_male_products($sex, $id){
           return $this->query_unique("SELECT * FROM products WHERE sex = :male AND id = :id", ["sex" => $sex, "id" => $id]);
     }

}
?>
