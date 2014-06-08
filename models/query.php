<?php
class models_query extends models_DB
{
    public function query_posts($query_string)
    {
        /**
         * Query example:
         * array(
         *      'post_id'             => '2',
         *      'post_id_or'          => '2,4,5',
         *      'post_cat'            => '5',
         *      'post_cat_or'         => '2,3,4',      
         *      'post_cat_and'        => '2,3,4',
         *      'post_url'            => 'abc',
         *      'post_url_or'         => '"abc","adf"',
         *      'post_status'         => 'published',
         *      'post_status_or'      => 'published,pendding',
         *      'post_id_not_in'      => '2,3,4',
         *      'post_cat_not_in'     => '2,3',
         *      'page'                => '2',
         *      'max_post'            => '23',
         *      'orderby'             => 'post_title',
         *      'order'               => 'desc'          
         * );
         */
        if(!isset($query_string['page'])) $limit = '';
        else
        {
            if(!isset($query_string['max_post'])) $query_string['max_post'] = 10;
            $limit = 'LIMIT ';
            
            $limit_start = $query_string['max_post'] * ( $query_string['page'] -1) + 1;
            $limit_end   = $query_string['max_post'] * $query_string['page'];
            $limit .= $limit_start . ', ' . $limit_end;
        }
        
        $where = array();
         
        if(!isset($query_string['post_id'])) $post_id = '1';
        else
        {
            $where[] = $post_id = ' post_id = ' . $query_string['post_id'];
        }
        
        if(!isset($query_string['post_id_or'])) $post_id_or = '1';        
        else  $where[] = $post_id_or = 'post_id IN (\'' . $query_string['post_id_or'] . '\')'; 
        
        if(!isset($query_string['post_url'])) $post_url = '1';
        else $where[] = $post_url = 'post_url = \''. $query_string['post_url'] . '\'';
         
        if(!isset($query_string['post_url_or'])) $post_url_or = '1';
        else
        {
           $where[] = $post_url_or = ' post_url_or IN ('. $query_string['post_url_or'] .')';
        }
        
        if(!isset($query_string['post_cat'])) $post_cat = '1';
        else $where[] = $post_cat = ' FIND_IN_SET(\'' . $query_string['post_cat'] . '\', post_cat)';
        
        if(!isset($query_string['post_cat_or'])) $post_cat_or = '1';     
        else
        {
            foreach(explode(',', $query_string['post_cat_or']) as $k => $v)
            {
                if($k == 0) $post_cat_or = 'FIND_IN_SET(\'' . $v . '\', post_cat)';
                else $post_cat_or .= ' OR FIND_IN_SET(\'' . $v . '\', post_cat)';
            }
        } 
        
        if(!isset($query_string['post_cat_and'])) $post_cat_and = '1';     
        else
        {
            foreach(explode(',', $query_string['post_cat_and']) as $k => $v)
            {
                if($k == 0) $post_cat_and = 'FIND_IN_SET(\'' . $v . '\', post_cat)';
                else $post_cat_and .= ' AND FIND_IN_SET(\'' . $v . '\', post_cat)';
            }
        } 
        
        if(!isset($query_string['post_status'])) $post_status = '1';        
        else  $post_status = ' post_status = ' . $query_string['post_status'];
        
        if(!isset($query_string['post_status_or'])) $post_status_or = '1';  
        else $post_status_or .= 'post_status IN (' . $query_string['post_status'] . ')';
        
        if(!isset($query_string['post_id_not_in'])) $post_id_not_in = '1';
        else  $post_id_not_in = 'post_id NOT IN (' . $query_string['post_id_not_in'] . ')';
        
        if(!isset($query_string['post_cat_not_in'])) $post_cat_not_in = '1';
        else
        {
            foreach(explode(',', $query_string['post_cat_not_in']) as $k => $v)
            {
                if($k == 0) $post_cat_not_in = '!FIND_IN_SET(\'' . $v . '\', post_cat)';
                else $post_cat_not_in .= ' AND !FIND_IN_SET(\'' . $v . '\', post_cat)';
            }
        }
        
        if(!isset($query_string['order'])) $order = 'desc';
        else  $order = $query_string['order'];       
        
        
        if(!isset($query_string['orderby'])) $orderby = 'post_id';
        else  $orderby = $query_string['orderby'];
        
    
        $temporary = 'SELECT * FROM post WHERE ' . ' (' . $post_id . ') ' . 'AND' . ' (' . $post_id_or . ') ' . 'AND' . ' (' . $post_url . ') ' . 'AND' . ' (' . $post_url_or . ') ' . 'AND' . ' (' . $post_cat . ') ' . 'AND' . ' (' . $post_cat_or . ') ' . 'AND' . ' (' . $post_cat_and . ') ' . 'AND' . ' (' . $post_status . ') ' . 'AND' . ' (' . $post_status_or . ') ' . 'ORDER BY ' . $orderby . ' ' .$order . ' ' .$limit;       
        $t = 'SELECT * FROM post WHERE ' . implode(' AND ', $where);
        //echo $t;
        //echo $temporary;
        
        $exe = $this->get($temporary);
        $this->last_result_status = $this->class_sqli->error;
        return $this->get($temporary);
    }
    
    public function query_terms($query_string)
    {
        /**
         * Query example:
         * array(
         *      'term_id'              => '2',
         *      'term_id_or'           => '2,4,5',
         *      'term_url'             => 'abc',
         *      'term_url_or'          => '"abc","xyz"',
         *      'orderby'             => 'post_title',
         *      'order'               => 'desc'          
         * );
         */
         if(!isset($query_string['term_id'])) $term_id = '1';
         else $term_id = ' term_id = '. $query_string['term_id'];
         
         if(!isset($query_string['term_id_or'])) $term_id_or = '1';
         else
         {
            $term_id_or = ' term_id IN (\''. $query_string['term_id_or'] .'\')';
         }
         
         if(!isset($query_string['term_url'])) $term_url = '1';
         else $term_url = 'term_url = \''. $query_string['term_url'] . '\'';
         
         if(!isset($query_string['term_url_or'])) $term_url_or = '1';
         else
         {
            $term_url_or = ' term_url_or IN ('. $query_string['term_url_or'] .')';
         }
         
         if(!isset($query_string['order'])) $order = 'desc';
         else  $order = $query_string['order'];       
        
         
         if(!isset($query_string['orderby'])) $orderby = 'term_id';
         else  $orderby = $query_string['orderby'];
         
         $temporary = 'SELECT * FROM term WHERE ' . ' (' . $term_id . ') ' . 'AND' . ' (' . $term_id_or . ') ' . 'AND' . ' (' . $term_url . ') ' . 'AND' . ' (' . $term_url_or . ') '  . 'ORDER BY ' . $orderby . ' ' .$order;      
        
         //echo $temporary;
               
         $exe = $this->get($temporary);
         $this->last_result_status = $this->class_sqli->error;
         return $exe;
    }
    
    public function url_exists($url)
    {

        $urls = $this->query_terms(array('term_url'   => $url));

        if(count($urls)) 
        { 
            return $urls[0]['term_id'];
        }

        
        $urls = $this->query_posts(array('post_url'   => $url));
        
        if(count($urls))
        {
            return $urls[0]['post_id'];
        }
        return false;
    }
    
    public function row_exists($column, $value, $table_name)
    {
        
        //echo 'SELECT * FROM ' . $table_name . ' WHERE ' . $column . ' = \'' . $value . '\'';
        $row = $this->get('SELECT * FROM ' . $table_name . ' WHERE ' . $column . ' = \'' . $value . '\'');
        
        if(!empty($row)) return $row[0][$table_name.'_id'];
        return false;
    }
}