<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Home extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getWishes()
    {
        $sql = 'UPDATE '.DBConfig::TABLE_WISH.' SET '.DBConfig::TABLE_WISH_ATT_WISH_STATUS.' = "3" WHERE '.DBConfig::TABLE_WISH_ATT_WISH_GRANT_DATE.' < DATE_FORMAT(NOW(),"%Y-%m-%d")';
        //echo $sql;
        $this->db->query($sql);
        
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_STATUS,'1');       
        $result = $this->db->get(DBConfig::TABLE_WISH)->result_array();
        
        $data = array();
        
        foreach($result as $row)
        {
            $row['category'] = $this->getCategoryNameById($row[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]);
            $row['state'] = $this->getStateNameById($row[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]);
            $row['city'] = $this->getCityNameById($row[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID]);
            $row['username'] = $this->getUserNameById($row[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);
            $row['time'] = date("F j Y g:i a", $row[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE]);
            
            if(strlen($row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION]) >= 500)
            {
                $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = substr($row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION],0,500).'...';
            }
            else{
                $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION];
            }
            
            array_push($data,$row);
        }
        
        return $data;
    }
    
    public function getStateNameById($id) {
        $this->db->where(DBConfig::TABLE_STATES_ATT_STATE_SHORT_NAME, $id);
        $result = $this->db->get(DBConfig::TABLE_STATES)->row_array();

        return $result[DBConfig::TABLE_STATES_ATT_STATE_NAME];
    }

    public function getCityNameById($id) {
        $this->db->where(DBConfig::TABLE_CITY_ATT_CITY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_CITY)->row_array();

        return $result[DBConfig::TABLE_CITY_ATT_CITY_NAME];
    }
    
    public function getCategoryNameById($id)
    {
        $this->db->where(DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_WISH_CATEGORY)->row_array();

        return $result[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_NAME];
    }
    
    public function getUserNameById($id)
    {
        $this->db->where(DBConfig::TABLE_USER_INFO_ATT_USER_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_USER_INFO)->row_array();

        return $result[DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME];
    }
}