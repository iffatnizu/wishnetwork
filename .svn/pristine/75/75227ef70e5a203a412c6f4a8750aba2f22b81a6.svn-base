<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Common extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCurrency() {
        return $this->db->get(DBConfig::TABLE_CURRENCY)->result_array();
    }

    public function getAllStates() {
        return $this->db->get(DBConfig::TABLE_STATES)->result_array();
    }

    public function getAllCategory() {
        return $this->db->get(DBConfig::TABLE_WISH_CATEGORY)->result_array();
    }

    public function getSitParameter() {
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL);
        $this->db->select(DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE);


        return $this->db->get(DBConfig::TABLE_SETTINGS)->row_array();
    }

    public function getFAQ() {
        return $this->db->get(DBConfig::TABLE_FAQ)->result_array();
    }

    public function getWishTitle($wishId) {
        $this->db->select(DBConfig::TABLE_WISH_ATT_WISH_TITLE);
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $wishId);
        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        return $result[DBConfig::TABLE_WISH_ATT_WISH_TITLE];
    }

    public function getUserStatistics($userId) {

        $this->db->select(DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE);
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, $userId);
        $result2 = $this->db->get(DBConfig::TABLE_USER)->row_array();

        if (!empty($result2)) {
            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
            $result = $this->db->get(DBConfig::TABLE_WISH)->num_rows();

            $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID, $userId);
            $result1 = $this->db->get(DBConfig::TABLE_WISH_COMMENTS)->num_rows();



            $data = array();

            $data['allWish'] = $result;
            $data['allComments'] = $result1;
            $data['memberSince'] = date("F j Y g:i a", $result2[DBConfig::TABLE_USER_ATT_USER_REGISTRATION_DATE]);

            return $data;
        }
    }

    public function getNumOfPaypalReq() {
        $this->db->where(DBConfig::TABLE_USER_PAYPAL_ATT_STATUS, '0');
        $result = $this->db->get(DBConfig::TABLE_USER_PAYPAL)->num_rows();

        return $result;
    }

    public function getUserNamePhoto($id) {
        $this->db->select(DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME);
        $this->db->select(DBConfig::TABLE_USER_INFO_ATT_USER_ID);
        $this->db->select(DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC);
        $this->db->where(DBConfig::TABLE_USER_INFO_ATT_USER_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_USER_INFO)->row_array();

        $propic = $result[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC];

        if ($propic == "") {
            $result[DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC] = "default.jpg";
        }

        return $result;
    }

}
