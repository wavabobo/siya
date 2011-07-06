<?php
defined('IN_SY') or exit('No permission resources.');
class index {
    
	private $db,$smarty;
    
	function __construct() {
        $this->smarty = pc_base::load_sys_class('Smarty');
		//$smarty->force_compile = true;
		$this->smarty->debugging = true;
		$this->smarty->caching = false;
		$this->smarty->cache_lifetime = 0;
	}
	
	public function init() {
        $this->smarty->assign("Name","Fred Irving Johnathan Bradley Peppergill",true);
		$this->smarty->assign("FirstName",array("John","Mary","James","Henry"));
		$this->smarty->assign("LastName",array("Doe","Smith","Johnson","Case"));
		$smarty->assign("Class",array(array("A","B","C","D"), array("E", "F", "G", "H"),
			  array("I", "J", "K", "L"), array("M", "N", "O", "P")));

		$smarty->assign("contacts", array(array("phone" => "1", "fax" => "2", "cell" => "3"),
			  array("phone" => "555-4444", "fax" => "555-3333", "cell" => "760-1234")));

		$smarty->assign("option_values", array("NY","NE","KS","IA","OK","TX"));
		$smarty->assign("option_output", array("New York","Nebraska","Kansas","Iowa","Oklahoma","Texas"));
		$smarty->assign("option_selected", "NE");

		$smarty->display('index.tpl');
	}
	
	function ld(){
		if(isset($_GET['parent_id'])){
			$where = "parent_id = ".intval($_GET['parent_id'])." ";
		}else{
			$where = "parent_id = 0 ";
		}
		$data_type = "json";
		if(isset($_GET['data_type'])){
			$data_type = $_GET['data_type'];
		}
		if($data_type == "json"){
			$json_str = "[";
			$json = array();
			$this->db = pc_base::load_model('region_model');
			$arr_ld = $this->db->select($where);
			foreach($arr_ld as $k=>$v){
			    $r = array('region_id' => $v['region_id'],
						   'region_name' => $v['region_name']);
				$json[] = JSON($r);
			}
			$json_str .= implode(',',$json);
			$json_str .= "]";
			echo $json_str;	
		}
		 else if($data_type == "xml"){
			header("Content-type: text/xml;");
			$xml = "<?xml version='1.0' encoding='UTF-8'?>";
			$xml .= "<root>";
			while ($row = mysql_fetch_array($result)) {
				$xml .= "<record>";
					$xml .= "<region_id>".$row['region_id']."</region_id>";
					$xml .= "<region_name>".$row['region_name']."</region_name>";
				$xml .= "</record>";
			}
			$xml .="</root>";
			echo $xml;	
		} 
	}
}
?>