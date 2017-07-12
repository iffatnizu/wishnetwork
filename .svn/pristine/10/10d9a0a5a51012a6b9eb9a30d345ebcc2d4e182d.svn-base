<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Administrator extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function dologin() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_USERNAME, $_POST['adminUsername']);
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['adminPassword']));

        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();

        if (empty($result)) {
            return '0';
        } else {
            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_LAST_LOGIN_TIME] = time();
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_ID, $result[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID]);
            $this->db->set($data);
            $this->db->update(DBConfig::TABLE_ADMIN);
            return $result;
        }
    }

    public function getSiteContent($contentname = "") {
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentname);

        return $this->db->get(DBConfig::TABLE_CONTENT)->row_array();
    }

    public function updateSiteContent() {
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_TITLE] = $_POST['title'];
        $data[DBConfig::TABLE_CONTENT_ATT_CONTENT_DETAILS] = $_POST['editor1'];
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $_POST['contentName']);

        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_CONTENT);


        return $u;
    }

    public function insertFAQ() {
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_QUESTION] = $_POST['Question'];
        $data[DBConfig::TABLE_FAQ_ATT_FAQ_ANSWER] = $_POST['Answer'];
        $data[DBConfig::TABLE_FAQ_ATT_ADDED_TIME] = time();


        $i = $this->db->insert(DBConfig::TABLE_FAQ, $data);
        if ($i)
            return '1';
    }

    public function deletefaq($id = 0) {
        $this->db->where(DBConfig::TABLE_FAQ_ATT_FAQ_ID, $id);
        $d = $this->db->delete(DBConfig::TABLE_FAQ);

        if ($d)
            return '1';
    }

    public function updateSiteParameter() {
        if ($_FILES['userfile']['name'] == true) {
            $path = "assets/public/site/";

            $imagefilename = uniqid() . basename($_FILES['userfile']['name']);

            $target = $path . $imagefilename;

            $allowedType = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $extension = $_FILES["userfile"]["type"];

            if (in_array($extension, $allowedType)) {
                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target)) {
                    $imagename = $imagefilename;
                    $data[DBConfig::TABLE_SETTINGS_ATT_SITE_LOGO] = $imagename;
                }
            }
        }

        // exit();


        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_TITLE] = trim($_POST['siteTitle']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_KEYWORD] = trim($_POST['siteMetaKeyword']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_META_DESCRIPTION] = trim($_POST['siteMetaDescription']);

        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_EMAIL] = trim($_POST['siteEmail']);
        $data[DBConfig::TABLE_SETTINGS_ATT_SITE_PHONE] = trim($_POST['sitePhone']);


        $this->db->where(DBConfig::TABLE_SETTINGS_ATT_ID, '1');
        $this->db->set($data);
        $u = $this->db->update(DBConfig::TABLE_SETTINGS);

        if ($u) {
            return '1';
        }
    }

    public function insertNewImage() {

        $data[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_NAME] = trim($_POST['catTitle']);


        $i = $this->db->insert(DBConfig::TABLE_WISH_CATEGORY, $data);

        if ($i)
            return 1;
    }

    public function changepassword() {
        $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));
        $result = $this->db->get(DBConfig::TABLE_ADMIN)->row_array();
        if (!empty($result)) {

            $data[DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD] = md5($_POST['new_password']);
            $this->db->where(DBConfig::TABLE_ADMIN_ATT_ADMIN_PASSWORD, md5($_POST['old_password']));

            $this->db->set($data);

            $u = $this->db->update(DBConfig::TABLE_ADMIN);

            if ($u) {
                return '1';
            }
        }
    }

    public function getAllCategory() {
        return $this->db->get(DBConfig::TABLE_WISH_CATEGORY)->result_array();
    }

    public function deleteCategory($id) {
        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_CATEGORY)->row_array();

        $filename = 'assets/public/site/' . $result[DBConfig::TABLE_CATEGORY_ATT_CATEGORY_IMAGE];

        unlink($filename);

        $this->db->where(DBConfig::TABLE_CATEGORY_ATT_CATEGORY_ID, $id);

        $d = $this->db->delete(DBConfig::TABLE_CATEGORY);

        if ($d) {
            return 1;
        }
    }

    public function getCategoryDetails($id) {
        $this->db->where(DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_WISH_CATEGORY)->row_array();

        return $result;
    }

    public function updateCategory($id) {


        $data[DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_NAME] = trim($_POST['catTitle']);


        $this->db->set($data);

        $this->db->where(DBConfig::TABLE_WISH_CATEGORY_ATT_CATEGORY_ID, $id);

        $i = $this->db->update(DBConfig::TABLE_WISH_CATEGORY);

        if ($i)
            return 1;
    }

    public function getPageMetaDataId() {
        return $this->db->get(DBConfig::TABLE_PAGE_SEO)->result_array();
    }

    public function getPageMetaDataById($id) {
        $this->db->where(DBConfig::TABLE_PAGE_SEO_ATT_ID, $id);
        return $this->db->get(DBConfig::TABLE_PAGE_SEO)->row_array();
    }

    public function updatePageMetaData($id) {
        $data[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_TITLE] = $this->input->post('title');
        $data[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_DESCRIPTION] = $this->input->post('description');
        $data[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_META_KEYWORD] = $this->input->post('keyword');
        $data[DBConfig::TABLE_PAGE_SEO_ATT_PAGE_AUTHOR] = $this->input->post('author');

        $this->db->where(DBConfig::TABLE_PAGE_SEO_ATT_PAGE_ID, $id);
        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_PAGE_SEO);

        if ($u) {
            return '1';
        }
    }

    public function getAllWish() {

        $sql = 'UPDATE ' . DBConfig::TABLE_WISH . ' SET ' . DBConfig::TABLE_WISH_ATT_WISH_STATUS . ' = "3" WHERE ' . DBConfig::TABLE_WISH_ATT_WISH_GRANT_DATE . ' < DATE_FORMAT(NOW(),"%Y-%m-%d")';
        //echo $sql;
        $this->db->query($sql);

        $this->db->order_by(DBConfig::TABLE_WISH_ATT_WISH_ID, "ASC");
        $result = $this->db->get(DBConfig::TABLE_WISH)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['category'] = getCategoryNameById($row[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]);
            $row['state'] = getStateNameById($row[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]);
            $row['city'] = getCityNameById($row[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID]);
            $row['username'] = getUserNameById($row[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);
            $row['time'] = date("F j Y g:i a", $row[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE]);

            if (strlen($row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION]) >= 500) {
                $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = substr($row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION], 0, 500) . '...';
            } else {
                $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = $row[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION];
            }

            array_push($data, $row);
        }

        return $data;
    }

    public function updateWishStatus($id, $status) {
        $data[DBConfig::TABLE_WISH_ATT_WISH_STATUS] = $status;

        $this->db->set($data);

        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

        $i = $this->db->update(DBConfig::TABLE_WISH);

        if ($i) {
            return '1';
        }
    }

    public function deleteWish($id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        if (!empty($result)) {
            $path = 'assets/public/wish/';
            unlink($path . $result[DBConfig::TABLE_WISH_ATT_WISH_PHOTO]);

            $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_WISH_ID, $id);
            $this->db->delete(DBConfig::TABLE_WISH_COMMENTS);

            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

            $i = $this->db->delete(DBConfig::TABLE_WISH);

            if ($i) {
                return '1';
            }
        }
    }

    public function getWishDetailsById($id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);


        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        if (!empty($result)) {

            $result['category'] = getCategoryNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]);
            $result['state'] = getStateNameById($result[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]);
            $result['city'] = getCityNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID]);
            $result['username'] = getUserNameById($result[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);
            $result['time'] = date("F j Y g:i a", $result[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE]);
            $result['comments'] = $this->getCommentsByWish($result[DBConfig::TABLE_WISH_ATT_WISH_ID]);

            return $result;
        }
    }

    public function getCommentDetails($id) {
        $sql = 'SELECT ' . DBConfig::TABLE_WISH_COMMENTS . '.*,' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_FIRST_NAME . ',' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_PROFILE_PIC . '
                FROM ' . DBConfig::TABLE_WISH_COMMENTS . '
                LEFT JOIN ' . DBConfig::TABLE_USER_INFO . ' ON ' . DBConfig::TABLE_USER_INFO . '.' . DBConfig::TABLE_USER_INFO_ATT_USER_ID . ' = ' . DBConfig::TABLE_WISH_COMMENTS . '.' . DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID . '
                WHERE  ' . DBConfig::TABLE_WISH_COMMENTS . '.' . DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID . ' = "' . $id . '"   
               ';

        $result = $this->db->query($sql)->row_array();
        $result['time'] = date("F j Y g:i a", $result[DBConfig::TABLE_WISH_COMMENTS_ATT_TIME]);

        return $result;
    }

    public function getCommentsByWish($wish) {
        $this->db->select(DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID);
        $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_WISH_ID, $wish);
        $this->db->order_by(DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID, "DESC");
        $result = $this->db->get(DBConfig::TABLE_WISH_COMMENTS)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['details'] = $this->getCommentDetails($row[DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function getAllTransaction() {
        $result = $this->db->get(DBConfig::TABLE_WISH_DONATE)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['title'] = getWishTitle($row[DBConfig::TABLE_WISH_DONATE_ATT_WISH_ID]);
            $row['paid-by'] = getUserNameById($row[DBConfig::TABLE_WISH_DONATE_ATT_USER_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function getPaypalRequest() {
        $result = $this->db->get(DBConfig::TABLE_USER_PAYPAL)->result_array();
        $data = array();

        foreach ($result as $row) {
            $row['req-by'] = getUserNameById($row[DBConfig::TABLE_USER_PAYPAL_ATT_USER_ID]);
            array_push($data, $row);
        }
        return $data;
    }

    public function changePaypalStatus($infoId, $statusCode) {
        
        $data[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] = $statusCode;
        $this->db->set($data);
        $this->db->where(DBConfig::TABLE_USER_PAYPAL_ATT_ID,$infoId);
        
        $u = $this->db->update(DBConfig::TABLE_USER_PAYPAL);
        
        if($u)
        {
            return '1';
        }
        
    }

}
