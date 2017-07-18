<?php
class Booking {
	const COLLECTION = 'booking';
    private $_mongo;
    private $_collection;

    public $id = '';
    public $hoten = '';
    public $email = '';
    public $dienthoai = '';
    public $sove = '';
    public $ghichu = '';
    public $id_tour = '';
    public $date_post ='';

    public function __construct(){
        $this->_mongo = DBConnect::init();
        $this->_collection = $this->_mongo->getCollection(Booking::COLLECTION);
    }

    public function get_all_list(){
        return $this->_collection->find()->sort(array('ma'=>1));
    }

    public function get_list_condition($condition){
        return $this->_collection->find($condition)->sort(array('ma'=>1));
    }

    public function get_one(){
        $query = array('_id' => new MongoId($this->id));
        return $this->_collection->findOne($query);
    }

    public function insert(){
        $query = array(
            'hoten' => $this->hoten,
            'email' => $this->email,
            'dienthoai' => $this->dienthoai,
            'sove' => $this->sove,
            'ghichu' => $this->ghichu,
            'id_tour' => $this->id_tour ? new MongoId($this->id_tour) : '',
            'date_post' => new MongoDate()
        );
        return $this->_collection->insert($query);
    }

    public function edit(){
        $query = array('$set' => array(
            'hoten' => $this->hoten,
            'email' => $this->email,
            'dienthoai' => $this->dienthoai,
            'sove' => $this->sove,
            'ghichu' => $this->ghichu,
            'id_tour' => $this->id_tour ? new MongoId($this->id_tour) : '',
            'date_post' => new MongoDate()));
        $condition = array('_id' => new MongoId($this->id));
        return $this->_collection->update($condition, $query);
    }

    public function delete(){
        $query = array('_id' => new MongoId($this->id));
        return $this->_collection->remove($query);
    }

    public function check_dmtour($id_tour){
        $query = array('id_tour' => new MongoId($id_tour));
        $field = array('_id' => true);
        $result = $this->_collection->findOne($query, $field);
        if(isset($result['_id']) && $result['_id']) return true;
        else return false;
    }
}

?>