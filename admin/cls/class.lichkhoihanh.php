<?php
class Tours {
	const COLLECTION = 'lickkhoihanh';
	private $_mongo;
	private $_collection;
	public $id = '';
	public $ngaykhoihanh = '';
	public $ngayketthuc = '';
	public $id_tours = array();
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Tours::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('date_post'=>-1));
	}

	public function insert(){
		$query = array(
			'ngaykhoihanh' => $this->ngaykhoihanh,
			'ngayketthuc' => $this->ngayketthuc,
			'id_tours' => $this->id_tours,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}


	public function insert(){
		$query = array('$set' => array(
			'ngaykhoihanh' => $this->ngaykhoihanh,
			'ngayketthuc' => $this->ngayketthuc,
			'id_tours' => $this->id_tours,
			'date_post' => new MongoDate()
		));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->remove($query);
	}
}
?>