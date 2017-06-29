<?php
class Banner {
	const COLLECTION = 'banner';
	private $_mongo;
	private $_collection;
	
	public $id = '5951214f7247aef00f00002d';
	public $banner = array(); //array('filename', 'aliasname', link);
	public $banner_right = array(); 

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Banner::COLLECTION);
	}

	public function edit(){
		$query = array('$set' => array(
			'banner' => $this->banner,
			'banner_right' => $this->banner_right
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function edit_banner(){
		$query = array('$set' => array(
			'banner' => $this->banner,
			'banner_right' => $this->banner_right
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}
}

?>