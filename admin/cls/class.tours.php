<?php
class Tours {
	const COLLECTION = 'tours';
	private $_mongo;
	private $_collection;
	public $id = '';
	public $tieude = '';
	public $giatour = 0;
	public $giagiamtour = 0;
	//public $ngaykhoihanh = '';
	//public $ngayketthuc = '';
	public $mota = '';
	public $noidung = '';
	public $giave = '';
	public $hinhanh = '';
	public $hienthi = 0;
	public $stick = 0;
	public $orders = 0;
	public $id_danhmuctour = '';
	public $id_danhmucdiemden = '';
	public $date_post = '';

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Tours::COLLECTION);
	}

	public function get_all_list(){
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_all_list_show(){
		$query = array('hienthi' => 1);
		return $this->_collection->find($query)->sort(array('orders' => 1, 'date_post'=>-1));
	}
	public function get_list_condition($condition){
		return $this->_collection->find($condition)->sort(array('orders' => 1, 'date_post'=>-1));
	}

	public function get_list_to_parent(){
		$query = array('id_danhmuctour' => $this->id_danhmuctour, 'hienthi' => 1);
		return $this->_collection->find($query)->limit(20)->sort(array('orders' => 1, 'date_post'=>-1));	
	}

	public function get_tourmoi(){
		$query = array('hienthi' => 1);
		return $this->_collection->find($query)->sort(array('orders' => 1, 'date_post'=>-1))->limit(3);
	}

	public function get_tour_stick(){
		$query = array('hienthi' => 1, 'stick' => 1);
		return $this->_collection->find($query)->sort(array('orders' => 1, 'date_post'=>-1))->limit(3);
	}	

	public function get_diemdenmoi(){
		$query = array('id_danhmucdiemden' => array('$exists' => true), 'hienthi' => 1);
		return $this->_collection->find()->sort(array('orders' => 1, 'date_post'=>-1))->limit(3);
	}

	public function get_one(){
		$query = array('_id' => new MongoId($this->id));
		return $this->_collection->findOne($query);
	}

	public function get_list_home($dmtt){
		$query = array('id_danhmuctour' => $dmtt, 'hienthi' => 1);
		return $this->_collection->find($query)->limit(3);
	}

	public function insert(){
		$query = array(
			'tieude' => $this->tieude,
			'giatour' => intval($this->giatour),
			'giagiamtour' => intval($this->giagiamtour),
			//'ngaykhoihanh' => $this->ngaykhoihanh,
			//'ngayketthuc' => $this->ngayketthuc,
			'mota' => $this->mota,
			'noidung' => $this->noidung,
			'giave' => $this->giave,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'stick' => intval($this->stick),
			'orders' => intval($this->orders),
			'id_danhmuctour' => $this->id_danhmuctour,
			'id_danhmucdiemden' => $this->id_danhmucdiemden,
			'date_post' => new MongoDate()
		);
		return $this->_collection->insert($query);
	}

	public function edit(){
		$query = array('$set' => array(
			'tieude' => $this->tieude,
			'giatour' => intval($this->giatour),
			'giagiamtour' => intval($this->giagiamtour),
			//'ngaykhoihanh' => $this->ngaykhoihanh,
			//'ngayketthuc' => $this->ngayketthuc,
			'mota' => $this->mota,
			'noidung' => $this->noidung,
			'giave' => $this->giave,
			'hinhanh' => $this->hinhanh,
			'hienthi' => intval($this->hienthi),
			'stick' => intval($this->stick),
			'orders' => intval($this->orders),
			'id_danhmuctour' => $this->id_danhmuctour,
			'id_danhmucdiemden' => $this->id_danhmucdiemden,
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