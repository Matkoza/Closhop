<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class ReviewsDao extends BaseDao{

  public function __construct(){
    parent::__construct("reviews");
  }

}
?>
