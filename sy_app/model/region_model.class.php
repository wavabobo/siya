<?php
defined('IN_SY') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class region_model extends model {
	public function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'region';
		parent::__construct();
	}
}
?>