<?php
class TuVanViSa {
	const COLLECTION = 'tuvanvisa';
	private $_mongo;
	private $_collection;

	public $id = '';
	public $tieude = '';
	public $mota = '';
	public $noidung = '';
	public $hinhanh = '';
	public $hienthi = 0;
	public $orders = 0;
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(TuVanViSa::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_list_to_parent(){
		$query = array('id_danhmuctintuc' => $this->id_danhmuctintuc);
		return $this->_collection->find($query)->limit(20)->sort(array('orders' => 1, 'date_post'=>-1));	
	}

	public function get_tintucmoi(){
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1))->limit(3);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_list_home($dmtt){
		$query = array('id_danhmuctintuc' => $dmtt, 'hienthi' => 1);
		return $this->_collection->find($query)->limit(3);
	}

	public function insert(){
		$query = array(
			'tieude' => $this->tieude,
			'mota' => $this->mota,
			'noidung' => $this->noidung,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array(
			'tieude' => $this->tieude,
			'mota' => $this->mota,
			'noidung' => $this->noidung,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'orders' => intval($this->orders),
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