<?php
class models_DB
{
    
    public function __construct()
    {
        global $global_sqli;
        $this->class_sqli = $global_sqli;
    }
    
    public function insert($insert_content, $table_name)
    {
        foreach($insert_content as $k_insert_content => $v_insert_content)
        {
            $insert_content[$k_insert_content] = $this->class_sqli->real_escape_string($v_insert_content);
        }
        
        $i = 0;
        $array_lengh = count($insert_content);
        $column = '';
        $value = '';
        foreach($insert_content as $k_insert_content => $v_insert_content)
        {
            $i++;
            if($i != $array_lengh)
            {
                $column .= $k_insert_content . ', ';
                $value  .= "'$v_insert_content', ";
            }
            else
            {
                $column .= $k_insert_content;
                $value  .= "'$v_insert_content'";
            }
        }
        
        $moment = "INSERT INTO $table_name($column) VALUES($value)";
        
        $result = $this->class_sqli->query($moment);
        
        if($result) $this->last_result_status = 'Insert Success'; 
        else 
        {
            $this->last_result_status = $this->class_sqli->error;
        }
        
        return $result;
    }
    
    public function update($new_value, $talbe_name, $where)
    {
        $query_string = 'UPDATE ' . $talbe_name . ' SET ';
        $i = 0;
        foreach($new_value as $k => $v)
        {
            $new_value[$k] = $this->class_sqli->real_escape_string($v);
        }
        foreach($new_value as $k=>$v)
        {
            if($i == 0) $query_string .= $k . '=' . '\''. $v .'\'';
            else $query_string .= ', ' . $k . '=' . '\''. $v .'\'';
            $i++;
        }
        
        $query_string .= ' ' . $where;
        //echo $query_string;
        $query = $this->class_sqli->query($query_string);
        
        if(!$query) $this->last_result_status = $this->class_sqli->error; else $this->last_result_status = 'Success for update data';
        return $query;
    }
    
    public function get($query_string)
    {
        
        $result = array();
        $query = $this->class_sqli->query($query_string);
        
        if(!$query) $this->last_result_status = $this->class_sqli->error; else $this->last_result_status = 'Success for get data';
        $i = 0;
        while($row = $query->fetch_assoc())
        {
            foreach($row as $k_row => $v_row)
            {
                $result[$i][$k_row] = $v_row;
            }
            $i++;
        }
        
        return $result;
    }
    
    function get_one_value($row_value, $column_name, $table_name)
    {
        /**
         * Chua xay dung xong
         */
        $moment = "SELECT $column_name FROM $table_name WHERE $column_name = '$row_value'";
        $result = $this->get($moment);
        if($result) $this->last_result_status = 'SUCCESS : '.$query_string; else $this->last_result_status = $this->class_sqli->error;
        return $result[0]["$row_value"];
    }
    
    public function query_string($query_string)
    {
        
        $query = $this->class_sqli->query($query_string);
        if($query) $this->last_result_status = 'SUCCESS : '.$query_string; else $this->last_result_status = $this->class_sqli->error;
        return $query;
    }
    
    
    public $class_sqli;
    
    public $last_result_status;
}