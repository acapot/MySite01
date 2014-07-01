<?php

  // http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/

  class Db {
    private $dbh = null;

    public function __construct() {
      try {
        $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      } catch(PDOException $e) {
        echo $e->getMessage();
      }
    }

    private $item_sql = "select item.id, item.title, item.text,
                         item.category_id, item.thumbnail_url,
                         categories.name as category_name
                         from item inner join
                         categories on item.category_id =
                         categories.id";
	/*					 
	private $item_to_portfolio_sql = "select *
                         from item, categories inner join
                         categories on item.category_id =
                         categories.id ";*/
						 
	//Alexis: this select the items which will show in the portfolio.php, this is related with getItemsByCategory($id) 
	private $item_to_portfolio_sql = "select item.*, categories.*
						 	from item
							inner join categories on categories.id = item.category_id";
	
	
	//Alexis: this select the items which will show in the portfolio.php, this is related with getItemsByCategory($id) 
						 
	private $item_to_portfolio_sql2="select item.*, categories.name, categories.id category_id
						 			from item
									JOIN cat_item ON cat_item.item_id = item.id
									JOIN categories ON categories.id = cat_item.category_id";
	

											
	//Alexis Capot
	private $categories_sql = "select *
                         from 
                         categories";
	
	//Alexis this question is to set the info in the website show.php
	private $item_sql2 = "select *
                         from 
                         item";

    //Alexis
	public function getCategories() {
      $sth = $this->dbh->query($this->categories_sql);
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }

      return $objects;
    }
	
	
	//Alexis2
	public function getItems() {
      $sth = $this->dbh->query($this->item_to_portfolio_sql2." GROUP BY item.title DESC");
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Item');

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }
	  
	 return $objects;
    }
	  
	  //Alexis this is to 
	  
	public function getCategoriesToAdmin($id){
		
		
		}
	
	//Alexis2
	public function getItemsById($id) {
      $sql = $this->item_to_portfolio_sql2." where item.id= :id  GROUP BY item.title";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
	  $sth->setFetchMode(PDO::FETCH_CLASS, 'Item');
	  $sth->execute();
	  
      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }
	  
	   if (count($objects) > 0) {
        return $objects[0];
      } else {
        return null;
      }

      
    }
	
	
	//Alexis2
    public function getItemsByCategory($id) {
      $sql = $this->item_to_portfolio_sql2." where cat_item.category_id = :id GROUP BY title";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->setFetchMode(PDO::FETCH_CLASS, 'item');
      $sth->execute();

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }
	
	  return $objects;
      
    }
	
	//Alexis2
    public function getCategoryByItemToShow($id) {
      $sql = $this->item_to_portfolio_sql2." where cat_item.item_id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');
      $sth->execute();

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }
	
	  return $objects;
      
    }
	public function categoryToAddToEdit($id){
		$cat=$this->getCategories();
		$catById=$this->getCategoryByItemToShow($id);
		$catToAdd=array_diff($cat,$catById);
		
		return $catToAdd;
		
		
		}
	
	
    public function deleteItem($id,$cat) {
      $sql = "delete from item where id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->execute();
	  
	
      if ($sth->rowCount() > 0) {
        $bool= true;
      } else {
        $bool= false;
      }
	  
	  if(isset($cat)){
		  foreach ($cat as $d){
			$c=$d->id;
			$sql2 = "delete from cat_item where id = :c";
		  $sth2 = $this->dbh->prepare($sql2);
		  $sth2->bindParam(':c', $c, PDO::PARAM_INT);
		  $sth2->execute();
			  if ($sth2->rowCount() > 0) {
				$bool= true;
			  } else {
				$bool= false;
			  }
			  
			}//end foreach
	  
	  }//end if isset
	  
	  if ($bool) return true;
	  else return false;
	  
    }

    public function updateItem($id, $title, $text, $thumbnail_url) {
      $data = array($title, $text, $thumbnail_url, $id);
      $sth = $this->dbh->prepare("update item set title = ?, text = ?, thumbnail_url = ? where id = ?");
      if ($sth->execute($data)) {
        return true;
      } else {
        return false;
      }
    }
	//Alexis Capot
    public function createItem($title, $text, $thumbnail_url='') {
      $data = array($title, $text,$thumbnail_url);
      $sth = $this->dbh->prepare("insert into item (title, text, thumbnail_url) values (?, ?, ?)");
      $sth->execute($data);

      if ($sth->rowCount() > 0) {
        return $this->dbh->lastInsertId();
      } else {
        return null;
      }
    }
 //Alexis Capot
   public function insertCatItem($cat, $item_id){
	   $data = array($cat, $item_id);
      $sth = $this->dbh->prepare("insert into cat_item (category_id,item_id) values (?, ?)");
      $sth->execute($data);
	   
	   }
	
	public function insertNewCat($catName){
	   $data = array('',$catName);
      $sth = $this->dbh->prepare("insert into categories (id,name) values (?, ?)");
      $sth->execute($data);
	   
	   }
	     
	public function delCatItem($cat,$id){ 
	$data = array($cat, $id);
      $sth = $this->dbh->prepare("delete from cat_item where category_id=? AND item_id=?");
      $sth->execute($data);	  
	}

    public function getCategory($id) {
      $sql = "select * from categories where id = :id";
      $sth = $this->dbh->prepare($sql);
      $sth->bindParam(':id', $id, PDO::PARAM_INT);
      $sth->setFetchMode(PDO::FETCH_CLASS, 'Category');
      $sth->execute();

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }

      if (count($objects) > 0) {
        return $objects[0];
      } else {
        return null;
      }
    }

    public function updateCategory($id, $name) {
      $data = array($name, $id);
      $sth = $this->dbh->prepare("update categories set name = ? where id = ?");
      if ($sth->execute($data)) {
        return true;
      } else {
        return false;
      }
    }

    public function query($sql, $class_name) {
      $sth = $this->dbh->query($sql);
      $sth->setFetchMode(PDO::FETCH_CLASS, $class_name);

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }

      return $objects;
    }

    public function get($id, $table_name, $class_name, $sql = null) {
      if ($sql == null) {
        $sql = "SELECT * FROM $table_name WHERE id = $id LIMIT 1";
      }

      $sth = $this->dbh->query($sql);
      $sth->setFetchMode(PDO::FETCH_CLASS, $class_name);

      $objects = array();

      while($obj = $sth->fetch()) {
        $objects[] = $obj;
      }

      if (count($objects) > 0) {
        return $objects[0];
      } else {
        return null;
      }
    }

    public function __destruct() {
      $this->dbh = null;
    }
  }