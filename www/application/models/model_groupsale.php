<?php
class Model_Groupsale extends Model
{
    public $id_group;
    public $code;
    public $max_user;
    public $id_location;
    public $id_subject;
    public $id_type;
    
    public function get_data()
	{	
		
	}
    public function select_groups($param=false)
	{	
                $str = '';
                if(!empty($this->id_group)) $str .= "id_group = '".$this->id_group."' ";
                if(!empty($this->id_location)) $str .= " AND id_location = '".$this->id_location."' ";
                if(!empty($this->id_subject)) $str .= " AND id_subject = '".$this->id_subject."' ";
                if(!empty($this->id_type)) $str .= " AND id_type = '".$this->id_type."' ";
                $trim = trim($str,'AND ');// пробел обязательно удалить
		$select = array(
                    'where' => $trim
                );
                $sql = new Model_Groups($select);
                $m = $sql->getAllRows();
                
		// Здесь мы просто сэмулируем реальные данные.
		
		return $m;
	}

}
