<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function load_view($data, $CIobj = '', $ret_view = false) {
    //get curr theme
    global $use_theme, $base_template;
    if (empty($CIobj)) {
        $CIobj = & get_instance();
    }

    if (!empty($data['use_theme'])) {
        $use_theme = $data['use_theme'];
    } else {
        $use_theme = TEMPLATE;
    }

    $file_theme = 'index';
    if (!empty($data['file_theme'])) {
        $file_theme = $data['file_theme'];
    } else {
        $file_theme = FILE_TEMP;
    }

    if (empty($data['dir'])) {
        $data['dir'] = DIR;
    }

    $main_content = 'index';
    if (!empty($data['main_content'])) {
        $main_content = $data['main_content'];
    }

    //check theme file
    if (@file_exists(THEME_PATH . $use_theme . '/' . $file_theme . '.php')) {
        if (!defined('CSS_THEME_URL')) {
            define('CSS_THEME_URL', THEME_URL . $use_theme . '/css/');
        }
        if (!defined('IMAGE_THEME_URL')) {
            define('IMAGE_THEME_URL', THEME_URL . $use_theme . '/images/');
            //$CIobj->js->inline('var IMAGE_THEME_URL = \''.IMAGE_THEME_URL.'\';'."\n");	
        }
        if (!defined('JS_THEME_URL')) {
            define('JS_THEME_URL', THEME_URL . $use_theme . '/js/');
        }
        if (!defined('CURR_THEME_URL')) {
            define('CURR_THEME_URL', THEME_URL . $use_theme . '/');
            //$CIobj->js->inline('var CURR_THEME_URL = \''.CURR_THEME_URL.'\';'."\n");			
        }
        if (!defined('CURR_THEME_PATH')) {
            define('CURR_THEME_PATH', THEME_PATH . $use_theme . '/');
        }
        // if (!defined('CURR_MOD_URL')) {
        //     define('CURR_MOD_URL', APP_URL . MOD_DIR . '/' . module_var() . '/');
        //      $CIobj->js->inline('var BASE_URL = \''.BASE_URL.'\';'."\n");
        //       $CIobj->js->inline('var MODULE_URL = \''.module_url().'\';'."\n");
        //       $CIobj->js->inline('var BASE_MODULE_URL = \''.CURR_MOD_URL.'\';'."\n");
        //       $CIobj->js->inline('var CURR_MODULE = \''.module_var().'\';'."\n"); 
        // }

        if ($ret_view) {
            $data_view = $CIobj->load->view($use_theme . '/' . $file_theme, $data, true);
        } else {
            $data_view = $CIobj->load->view($use_theme . '/' . $file_theme, $data);
        }
  // print_r($use_theme . '/' . $file_theme . '/'. $main_content);die();
		
        return $data_view;
    } else {
        echo 'LOAD THEME : ' . $use_theme . ' FAILED! <br/>check here : ' . THEME_PATH . $use_theme . '/' . $file_theme . '.php';
        die();
    }
}

function clear_html($v) {
    return htmlspecialchars($v, ENT_QUOTES);
}

function module_var($segment = 1, $CIobj = '', $echoed = false) {
    if (empty($CIobj)) {
        $CIobj = & get_instance();
    }
    $segs = $CIobj->uri->segment_array();
    if (!empty($segs[$segment])) {
        $curr_module_var = $segs[$segment];
    } else {
        $curr_module_var = '';
    }

    $curr_module_var = strtolower($curr_module_var);

    if ($echoed) {
        echo $curr_module_var;
    } else {
        return $curr_module_var;
    }
}

function write_log($action, $user = 'system') {
    $CIobj = & get_instance();

    $action = str_replace(",", ", ", $action);
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    //$CIobj->db->query("alter session set nls_date_format='yyyy-mm-dd hh24:mi:ss'");
    $username = $CIobj->session->userdata("username");
    if (!empty($username)) {
        $username = $CIobj->session->userdata("username");
    } else {
        $username = $user;
    }

    $action = str_replace("'", "''", htmlspecialchars($action, ENT_QUOTES));
    $data_log = array("TIMESTAMP" => date("Y-m-d H:i:s"),
        "USERNAME" => $username,
        "ACTION" => $action,
        "NOTE" => $_SERVER['HTTP_USER_AGENT'],
        "IP" => $ip);
    //print_r($data_log);
    api_post("/log/insert", $data_log);
}

function has_privilege($username, $module_name, $priv = "_view") {
    write_log("accessing " . $module_name);
    return true;
    /* $CIobj =& get_instance();

      $priv = strtoupper("HAS".$priv);

      //$CIobj->db->query("alter session set nls_date_format='yyyy-mm-dd hh24:mi:ss'");
      $module_id = get_name("UI_MODULES","MODULE_ID","MODULE_VAR",$module_name);
      //write_log("Accessing module ".$module_name." (".$priv.")");
      $userid = $CIobj->session->userdata('userid');

      $CIobj->db->select("IS_LOGIN,LOGIN_TOKEN,LAST_ACTIVITY,IS_BLOCK")->from("UI_USERS")->where("USER_ID",$userid);
      $qc = $CIobj->db->get();
      //echo $CIobj->db->last_query();
      $dc = $qc->result_array();

      $last_activity = @$dc[0]['LAST_ACTIVITY'];
      //echo $last_activity;
      $is_block = @$dc[0]['IS_BLOCK'];
      $now = date("Y-m-d H:i:s");
      $seconds = strtotime($now) - strtotime($last_activity);
      $minute = floor($seconds/60);
      $idle_time = getPref('_SESSION_IDLE_TIME');
      //echo "idle for : ".$minute;
      if($minute>=$idle_time){
      $CIobj->db->trans_start();
      //echo "masuk idle time ".$minute." ".$idle_time;
      $CIobj->db->query("update UI_USERS set IS_LOGIN = 'N' where USER_ID='".$userid."'");
      $CIobj->db->trans_complete();
      write_log("user session has been expired ");
      $CIobj->session->sess_destroy();
      $data['error_msg'] = "Your session has been expired";

      echo "Your session has been expired, click <a href='".base_url()."login'>here</a> to relogin <br /> ".$last_activity." ".$minute." ".$idle_time;
      return false;

      }


      if($is_block=="Y"){
      //echo "masuk block";
      //$CIobj->db->query("update UI_USERS set IS_LOGIN = 'N' where USER_ID='".$userid."'");
      write_log("user session has been terminated");
      $CIobj->session->sess_destroy();
      $data['error_msg'] = "Your account has been blocked";
      //redirect('login');
      //$CIobj->load->view("login/login_temp",$data);
      return false;
      exit;
      }

      $groupid = $CIobj->session->userdata('groupid');
      $userid = $CIobj->session->userdata('userid');
      $token = $CIobj->session->userdata('login_token');

      if(empty($userid)){
      //echo "masuk session gak ke save";
      $data['error_msg'] = "Your session has been expired";
      return false;
      exit;
      }


      //check login

      //print_r($dc);
      if(@$dc[0]["IS_LOGIN"]=="N" or $token!=@$dc[0]["LOGIN_TOKEN"]){
      //destroy session
      echo "masuk login token sama is login = n";
      $CIobj->session->sess_destroy();
      $data['error_msg'] = "Your session has been expired";
      $CIobj->load->view("login/login_temp",$data);
      return false;
      exit;
      }
      else{

      $CIobj->db->select("*")->from("UI_PRIVILEGE")->where("GROUP_ID",$groupid)->where("MODULE_ID",$module_id)->where($priv,1);
      $q =  $CIobj->db->get();
      //echo "select * from UI_PRIVILEGE where GROUP_ID = '".$groupid."' and MODULE_ID = '".$module_id."' and ".$priv."=1";
      $num = $q->num_rows();

      if(!empty($num)){
      //update last activity
      //echo $priv;
      if($priv=="is_view"){
      //echo "test";
      $access_module = get_name("UI_MODULES","MODULE_NAME","MODULE_VAR",$module_name);
      write_log("Access ".$access_module);
      }
      $CIobj->db->trans_start();
      $CIobj->db->query("update UI_USERS set LAST_ACTIVITY = '".date("Y-m-d H:i:s")."', LAST_MODULE='".$module_name."', IS_LOGIN='Y' where USER_ID = '".$userid."'");
      $CIobj->db->trans_complete();
      return true;
      }
      else{
      //echo "You don't have permission to access this feature";
      return false;
      }
      } */
}

function getOptionList($table, $selected_id, $id_name, $list_name, $where = "", $all = true) {
    $ci = & get_instance();
    $ci->db->select("*")->from($table, false);
    //echo $where;
    if ($where) {
        $ci->db->where($where);
    }
    $q = $ci->db->get();
    //echo $ci->db->last_query();
    $d = $q->result_array();
    $html = "";
    if ($all) {
        $html = "<option value='0'>- All " . str_replace("REF", "", str_replace("_", " ", $table)) . "-</option>";
    }
    $selected = "";
    //echo $id_name;
    foreach ($d as $k => $v) {
        if ($d[$k][$id_name] == $selected_id) {
            $selected = "selected = 'selected'";
        }
        $html.="<option value='" . $d[$k][$id_name] . "' " . $selected . ">" . $d[$k][$list_name] . "</option>";
        $selected = "";
    }
    return $html;
}

function getGeoListODBC($parent = '', $parent_field = '', $field_id = 'TERRITORY', $field_name = 'TERRITORY_NAME', $selected_id = '', $all = 'true', $send = "id") {
    $ci = & get_instance();
    //prepare locking table

    $territory_id = $ci->session->userdata("territory_id");
    $region_id = $ci->session->userdata("region_id");
    $subregion_id = $ci->session->userdata("subregion_id");
    $depo_id = $ci->session->userdata("depo_id");
    $cluster_id = $ci->session->userdata("cluster_id");

    $conn = new PDO("odbc:AbSQL10", "balajik", "");
    //check territory lock
    //$ci->db->select('DISTINCT('.$field_id.'),'.$field_name)->from('IDEX_GEOG_HIERARCHY')->order_by($field_name." asc");
    $added_sql = "";
    if (!empty($territory_id) and $field_id == 'TERRITORY') {
        $added_sql = $field_id . "='" . $territory_id . "'";
    }
    if (!empty($region_id) and $field_id == 'REGION') {
        $added_sql = $field_id . "='" . $region_id . "'";
    }
    if (!empty($subregion_id) and $field_id == 'SUBREGION') {
        $added_sql = $field_id . "='" . $subregion_id . "'";
    }
    if (!empty($depo_id) and $field_id == 'DEPO') {
        $added_sql = $field_id . "='" . $depo_id . "'";
    }
    if (!empty($cluster_id) and $field_id == 'CLUSTER_CODE') {
        $added_sql = $field_id . "='" . $cluster_id . "'";
    }
    if (!empty($parent) and ! empty($parent_field)) {
        if (!empty($added_sql)) {
            $added_sql = " and " . $added_sql;
        }
        $q = "select distinct(" . strtolower($field_id) . ")," . $field_name . " from absql.dim_dealer_master 
							   where " . strtolower($parent_field) . " = '" . $parent . "' " . $added_sql . " order by " . $field_name . " asc";
        $stmt = $conn->query($q);
        //$ci->db->where($parent_field,$parent);
    } else {
        if (!empty($added_sql)) {
            $added_sql = " where " . $added_sql;
        }
        $q = "select distinct(" . strtolower($field_id) . ")," . $field_name . " from absql.dim_dealer_master " . $added_sql . " order by " . $field_name . " asc";
        $stmt = $conn->query($q);
    }
    //echo $q;
    //$q = $ci->db->get();
    //echo $ci->db->last_query();
    //$d = $q->result_array();
    $html = "";
    if ($all == 'true') {
        $html = "<option value='0'>- ALL " . $field_id . " -</option>";
    }
    $selected = "";

    while ($result = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
        $id = $result[0];
        $name = $result[1];
        if (!empty($id)) {
            if ($id == $selected_id) {
                $selected = "selected='selected'";
            }
            $html.="<option value='" . $id . "' " . $selected . ">" . $name . "</option>";
            $selected = "";
        }
        /* if(!empty($d[$k][$field_id])){
          if($d[$k][$field_id]==$selected_id){
          $selected = "selected = 'selected'";
          }
          if($send=="id"){
          $id_select = $d[$k][$field_id];
          }
          else{
          $id_select = $d[$k][$field_name];
          }
          if(empty($d[$k][$field_name])){
          $name = $id_select;
          }
          else{
          $name = $d[$k][$field_name];
          }

          } */
    }
    return $html;
}

function getGeoList($parent = '', $parent_field = '', $field_id = 'TERRITORY', $field_name = 'TERRITORY_NAME', $selected_id = '', $all = 'true', $send = "id") {
    $ci = & get_instance();
    //prepare locking table
    $ci->db->select('DISTINCT(' . $field_id . '),' . $field_name)->from('IDEX_GEOG_HIERARCHY')->order_by($field_name . " asc");
    if (!empty($parent) and ! empty($parent_field)) {
        $ci->db->where($parent_field, $parent);
    }

    $q = $ci->db->get();
    //echo $ci->db->last_query();
    $d = $q->result_array();
    $html = "";
    if ($all == 'true') {
        $html = "<option value='0'>- ALL " . $field_id . " -</option>";
    }
    $selected = "";

    foreach ($d as $k => $v) {
        if (!empty($d[$k][$field_id])) {
            if ($d[$k][$field_id] == $selected_id) {
                $selected = "selected = 'selected'";
            }
            if ($send == "id") {
                $id_select = $d[$k][$field_id];
            } else {
                $id_select = $d[$k][$field_name];
            }
            if (empty($d[$k][$field_name])) {
                $name = $id_select;
            } else {
                $name = $d[$k][$field_name];
            }
            $html.="<option value='" . $id_select . "' " . $selected . ">" . $d[$k][$field_name] . "</option>";
            $selected = "";
        }
    }
    return $html;
}

//write pagination
function writePage($total_rec, $per_page, $cur_page, $function = 'loadModulePage') {
    $showPage = getPref('_PAGE_COUNT');
    $from = (($cur_page - 1) * $per_page) + 1;
    $to = ($from + $per_page) - 1;
    if ($to > $total_rec) {
        $to = $total_rec;
    }
    $limiter = $showPage - 2;
    $start = $cur_page - $limiter;
    $prev = $cur_page - $showPage;
    $next = $cur_page + $showPage;
    $max_page = ceil($total_rec / $per_page);
    $loop = $start + $showPage;

    if ($start < 1) {
        $start = 1;
    }
    if ($prev < 1) {
        $prev = 1;
    }
    if ($next > $max_page) {
        $next = $max_page;
    }
    $text = '<span class="label">View : ' . $from . '-' . $to . ' from ' . $total_rec . '</span>
			<div class="pagination">
				<ul>
					<li><a href="javascript:' . $function . '(' . $prev . ')">Prev</a></li>';
    for ($i = 1; $i <= $showPage; $i++) {
        if ($start <= $max_page) {
            if ($cur_page == $start) {
                $active = "active";
            } else {
                $active = "";
            }
            $text.='<li class="' . $active . '"><a href="javascript:' . $function . '(' . $start . ')">' . $start . '</a></li>';
            $start++;
        }
    }
    $text.='		<li><a href="javascript:' . $function . '(' . $next . ')">Next</a></li>
				</ul>	
			</div>';
    return $text;
}

function is_date($str) {
    $stamp = strtotime($str);
    if (!is_numeric($stamp))
        return FALSE;
    $month = date('m', $stamp);
    $day = date('d', $stamp);
    $year = date('Y', $stamp);
    if (checkdate($month, $day, $year))
        return TRUE;
    return FALSE;
}

function generateSalt($max = 15) {
    $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $i = 0;
    $salt = "";
    while ($i < $max) {
        $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
        $i++;
    }
    return $salt;
}

function generateKey($max = 10) {
    $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $i = 0;
    $salt = "";
    while ($i < $max) {
        $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
        $i++;
    }
    return $salt;
}

function generatePassword($max = 10) {
    $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
    $i = 0;
    $salt = "";
    while ($i < $max) {
        $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
        $i++;
    }
    return $salt;
}

function js_string_escape($data) {
    $safe = "";
    for($i = 0; $i < strlen($data); $i++)
    {
        if(ctype_alnum($data[$i]))
            $safe .= $data[$i];
        else
            $safe .= sprintf("\\x%02X", ord($data[$i]));
    }
    return $safe;
}

function full_current_url() {
    $CI =& get_instance();

    $url = $CI->config->site_url('index.php/'.$CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}
?>