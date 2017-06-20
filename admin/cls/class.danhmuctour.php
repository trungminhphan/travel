<?php
class DanhMucTour {
    const COLLECTION = 'danhmuctour';
    private $_mongo;
    private $_collection;

    public $id = '';
    public $ten = '';
    public $id_parent = '';
    public $mota = '';
    public $hinhanh = '';

    public function __construct(){
        $this->_mongo = DBConnect::init();
        $this->_collection = $this->_mongo->getCollection(DanhMucTour::COLLECTION);
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

    public function get_tours($arr){
        $str_arr = array();
        if($arr){
            foreach ($arr as $key => $value) {
                $this->id = $value; $t = $this->get_one();
                array_push($str_arr, $t['ten']);
            }
        }
        return implode(", ", $str_arr);
    }

    public function insert(){
        $query = array(
            'ten' => $this->ten,
            'id_parent' => $this->id_parent ? new MongoId($this->id_parent) : '',
            'mota' => $this->mota,
            'hinhanh' => $this->hinhanh
        );
        return $this->_collection->insert($query);
    }

    public function edit(){
        $query = array('$set' => array(
            'ten' => $this->ten,
            'id_parent' => $this->id_parent ? new MongoId($this->id_parent) : '',
            'mota' => $this->mota,
            'hinhanh' => $this->hinhanh));
        $condition = array('_id' => new MongoId($this->id));
        return $this->_collection->update($condition, $query);
    }

    public function delete(){
        $query = array('_id' => new MongoId($this->id));
        return $this->_collection->remove($query);
    }

    public function check_dmtour($id_dmtour){
        $query = array('id_parent' => new MongoId($id_dmtour));
        $field = array('_id' => true);
        $result = $this->_collection->findOne($query, $field);
        if(isset($result['_id']) && $result['_id']) return true;
        else return false;
    }
}
?>