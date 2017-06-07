<?php
class Users{
	const COLLECTION = 'users';
	public $id = '';
	public $username = '';
	public $password = '';
	public $roles = 0;
	public $hoten = '';
	public $namsinh = 0;
	public $sodienthoai = '';
	public $diachi = '';
	public $email = '';
	public $hinhanh = '';
	public $logs = '';
	private $_mongo;
	private $_collection;
	private $_user;

	public function __construct(){
		$this->_mongo = DBConnect::init();
		$this->_collection = $this->_mongo->getCollection(Users::COLLECTION);
		if ($this->isLoggedIn()) $this->_loadData();
	}

	public function get_list(){
		return $this->_collection->find();
	}

	public function get_list_50(){
		return $this->_collection->find()->limit(50);	
	}

	public function get_one(){
		return $this->_collection->findOne(array('_id'=>new MongoId($this->id)));
	}

	public function get_one_default(){
		$id_user = $this->get_userid();
		return $this->_collection->findOne(array('_id'=>new MongoId($id_user)));	
	}

	public function get_list_condition($condition){
		return $this->_collection->find($condition);
	}

	public function check_exist_username(){
		$query = array('username'=> $this->username);
		$result = $this->_collection->findOne($query);
		if($result['_id']) return true;
		return false;
	}

	public function insert(){
		$query = array(
			'username'=> $this->username,
			'password'=>md5($this->password),
			'roles'=>$this->roles,
			'hoten'=>$this->hoten,
			'namsinh' => $this->namsinh ? intval($this->namsinh) : '',
			'sodienthoai' => $this->sodienthoai,
			'diachi' => $this->diachi,
			'email' => $this->email,
			'hinhanh' => $this->hinhanh,
			'date_post' => new MongoDate());
		return $this->_collection->insert($query);
	}
	public function push_logs_in(){
		$query = array('$push' => array('logs' => array('in' => new MongoDate())));
		$condition = array('_id' => new MongoId($this->get_userid()));
		return $this->_collection->update($condition, $query);
	}
	public function push_logs_out(){
		$query = array('$push' => array('logs' => array('out' => new MongoDate())));
		$condition = array('_id' => new MongoId($this->get_userid()));
		return $this->_collection->update($condition, $query);
	}
	public function edit(){
		$condition = array('_id'=> new MongoId($this->id));
		$query = array('$set' => array(
			'password'=>md5($this->password),
			'roles'=>$this->roles,
			'hoten'=>$this->hoten,
			'namsinh' => intval($this->namsinh),
			'sodienthoai' => $this->sodienthoai,
			'diachi' => $this->diachi,
			'email' => $this->email,
			'hinhanh' => $this->hinhanh));
		return $this->_collection->update($condition, $query);
	}

	public function set_username(){
		$query = array('$set' => array('username' => $this->username));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function change_password(){
		$query = array('$set' => array('password' => md5($this->password)));
		$condition = array('_id' => new MongoId($this->id));
		return $this->_collection->update($condition, $query);
	}

	public function reset_password(){
		$condition = array('_id' => new MongoId($this->id));
		$query = array('$set' => array('password' => md5($this->password)));
		return $this->_collection->update($condition, $query);
	}

	public function delete(){
		return $this->_collection->remove(array('_id'=> new MongoId($this->id)));
	}

	public function isLoggedIn() {
		return isset($_SESSION['user_id']);
	}

	public function getRole(){
		return $_SESSION['roles'];
	}

	public function get_username(){
		$result = $this->_collection->findOne(array("_id"=>new MongoId($_SESSION['user_id'])), array('username'=>true));
		return $result['username'];
	}

	public function get_userid(){
		return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
	}

	public function is_admin(){
		return ($_SESSION['roles'] & ADMIN);
	}

	public function is_manager(){
		return ($_SESSION['roles'] & MANAGER);
	}

	public function is_users(){
		return ($_SESSION['roles'] & USERS);
	}

	public function authenticate($username, $password){
		$query = array(
			'username' => $username,
			'password' => md5($password)
		);

		$this->_user = $this->_collection->findOne($query);
		if (empty($this->_user)) return false;
			$_SESSION['user_id'] = strval($this->_user['_id']);
			$_SESSION['roles'] = intval($this->_user['roles']);
			return true;
	}

	public function logout(){
		unset($_SESSION['user_id']);
		session_destroy();
	}

	private function _loadData() {
		$id = new MongoId($_SESSION['user_id']);
		$this->_user = $this->_collection->findOne(array('_id' => $id));
	}

	public function get_list_id($arr){
		$query = array('_id' => array('$nin' => $arr));
		$field = array('_id' => true);
		return $this->_collection->find($query, $field);
	}

	public function generate_capcha(){
		$random_alpha = md5(rand());
		$captcha_code = substr($random_alpha, 0, 6);
		$_SESSION["captcha_code"] = $captcha_code;
		return '<img src="captcha_code.php?captcha_code='.$captcha_code.'" />';
	}

	public function get_capcha(){
		return $_SESSION['captcha_code'];
	}
}

?>