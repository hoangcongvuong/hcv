<?php
class models_HandleAction extends models_query
{
    public function delete_post($post_id)
    {
        $query_string = 'DELETE FROM post WHERE post_id = ' . $post_id;
        return  $this->query_string($query_string);
    }
    
    public function delete_term($term_id)
    {
        $query_string = 'DELETE FROM term WHERE term_id = ' . $term_id;
        return  $this->query_string($query_string);
    }
    
    public function delete_block_area($block_area_id)
    {
        $query_string = 'DELETE FROM block_area WHERE block_area_id = ' . $block_area_id;
        return  $this->query_string($query_string);
    }
}