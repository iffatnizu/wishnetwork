<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Wish extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function createWish($id = 0) {

        $path = 'assets/public/wish/';

        $config['upload_path'] = $path;
        $config['allowed_types'] = "gif|jpg|png|bmp|jpeg";
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = "10024"; //define in KB
        $this->load->library('upload');
        $filename = '';

        $this->load->library('upload', $config);

        foreach ($_FILES as $key => $value) {
            if (!empty($key['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($key)) {
                    $errors[] = $this->upload->display_errors();
                } else {
                    $temp = array('upload_data' => $this->upload->data());
                    $info = $this->upload->data();
                    $filename = $info['file_name'];
                }
            }
        }

        $data[DBConfig::TABLE_WISH_ATT_WISH_TITLE] = $this->input->post('wish-title');
        $data[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = $this->input->post('wish-description');
        $data[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] = $filename;
        $data[DBConfig::TABLE_WISH_ATT_WISH_GOAL_AMOUNT] = $this->input->post('wish-goal-amount');
        $data[DBConfig::TABLE_WISH_ATT_WISH_CURRENCY_ID] = $this->input->post('wish-currency');
        $data[DBConfig::TABLE_WISH_ATT_WISH_USER_ID] = $id;
        $data[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE] = time();
        $data[DBConfig::TABLE_WISH_ATT_WISH_STATUS] = 2;
        $data[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID] = $this->input->post('wish-category');
        $data[DBConfig::TABLE_WISH_ATT_WISH_GRANT_DATE] = $this->input->post('wish-grant-date');
        $data[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID] = $this->input->post('state');
        $data[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID] = $this->input->post('city');

        $i = $this->db->insert(DBConfig::TABLE_WISH, $data);

        if ($i) {
            return '1';
        }
    }

    public function getUserWishes($id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $id);

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

    public function getWishDetails($id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);
        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();
        $result['category'] = getCategoryNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]);
        $result['state'] = getStateNameById($result[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]);
        $result['city'] = getCityNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID]);
        $result['username'] = getUserNameById($result[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);
        $result['time'] = date("F j Y g:i a", $result[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE]);

        return $result;
    }

    public function updateWish($userId, $id) {

        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        if (!empty($result)) {

            if ($_FILES['userfile']['name'] == true) {

                $path = 'assets/public/wish/';

                unlink($path . $result[DBConfig::TABLE_WISH_ATT_WISH_PHOTO]);

                $config['upload_path'] = $path;
                $config['allowed_types'] = "gif|jpg|png|bmp|jpeg";
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = "10024"; //define in KB
                $this->load->library('upload');
                $filename = '';

                $this->load->library('upload', $config);

                foreach ($_FILES as $key => $value) {
                    if (!empty($key['name'])) {
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($key)) {
                            $errors[] = $this->upload->display_errors();
                        } else {
                            $temp = array('upload_data' => $this->upload->data());
                            $info = $this->upload->data();
                            $filename = $info['file_name'];
                        }
                    }
                }
                $data[DBConfig::TABLE_WISH_ATT_WISH_PHOTO] = $filename;
            }

            $data[DBConfig::TABLE_WISH_ATT_WISH_TITLE] = $this->input->post('wish-title');
            $data[DBConfig::TABLE_WISH_ATT_WISH_DESCRIPTION] = $this->input->post('wish-description');
            $data[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID] = $this->input->post('wish-category');
            $data[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID] = $this->input->post('state');
            $data[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID] = $this->input->post('city');

            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

            $this->db->set($data);

            $i = $this->db->update(DBConfig::TABLE_WISH);

            if ($i) {
                return '1';
            }
        }
    }

    public function deleteWish($userId, $id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        if (!empty($result)) {
            $path = 'assets/public/wish/';
            unlink($path . $result[DBConfig::TABLE_WISH_ATT_WISH_PHOTO]);


            $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_WISH_ID, $id);
            $this->db->delete(DBConfig::TABLE_WISH_COMMENTS);

            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
            $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);

            $i = $this->db->delete(DBConfig::TABLE_WISH);

            if ($i) {
                return '1';
            }
        }
    }

    public function getWishDetailsById($id) {
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $id);
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_STATUS, '1');

        $result = $this->db->get(DBConfig::TABLE_WISH)->row_array();

        if (!empty($result)) {

            $result['category'] = getCategoryNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CATEGORY_ID]);
            $result['state'] = getStateNameById($result[DBConfig::TABLE_WISH_ATT_WISH_STATE_ID]);
            $result['city'] = getCityNameById($result[DBConfig::TABLE_WISH_ATT_WISH_CITY_ID]);
            $result['username'] = getUserNameById($result[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);
            $result['time'] = date("F j Y g:i a", $result[DBConfig::TABLE_WISH_ATT_WISH_ADDED_DATE]);
            $result['comments'] = $this->getCommentsByWish($result[DBConfig::TABLE_WISH_ATT_WISH_ID]);
            $result['donate'] = $this->getDonateByWish($result[DBConfig::TABLE_WISH_ATT_WISH_ID]);
            $result['donateAmount'] = $this->getDonateAmountByWish($result[DBConfig::TABLE_WISH_ATT_WISH_ID]);

            return $result;
        }
    }

    public function getDonateAmountByWish($param) {
        $sql = 'SELECT SUM(' . DBConfig::TABLE_WISH_DONATE_ATT_AMOUNT . ') as total FROM ' . DBConfig::TABLE_WISH_DONATE . ' WHERE ' . DBConfig::TABLE_WISH_DONATE_ATT_WISH_ID . ' = "' . $param . '" ';

        $result = $this->db->query($sql)->row_array();

        return $result['total'];
    }

    public function getDonateByWish($param) {

        $this->db->where(DBConfig::TABLE_WISH_DONATE_ATT_WISH_ID, $param);

        $result = $this->db->get(DBConfig::TABLE_WISH_DONATE)->result_array();

        $data = array();

        foreach ($result as $row) {
            $row['userDetails'] = getUserDetailsById($row[DBConfig::TABLE_WISH_DONATE_ATT_USER_ID]);
            array_push($data, $row);
        }

        return $data;
    }

    public function commentOnWish($userId) {
        //debugPrint($_POST);

        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $this->input->post('wishId'));
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_STATUS, '1');
        $result = $this->db->get(DBConfig::TABLE_WISH)->num_rows();

        if ($result > 0) {

            $data[DBConfig::TABLE_WISH_COMMENTS_ATT_WISH_ID] = $this->input->post('wishId');
            $data[DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS] = $this->input->post('comment');
            $data[DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID] = $userId;
            $data[DBConfig::TABLE_WISH_COMMENTS_ATT_TIME] = time();

            $i = $this->db->insert(DBConfig::TABLE_WISH_COMMENTS, $data);

            $lastId = $this->db->insert_id();

            if ($i) {
                return $this->getCommentDetails($lastId);
            }
        } else {
            return '0';
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

    public function updateCommment() {
        //debugPrint($_POST);
        $data[DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS] = $_POST['updateTxt'];
        $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_USER_ID, $_POST['userId']);
        $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID, $_POST['commentId']);
        $this->db->set($data);

        $u = $this->db->update(DBConfig::TABLE_WISH_COMMENTS);

        if ($u) {
            return 'Comment Successfully Updated';
        }
    }

    public function deleteCommment($userId) {
        $commentId = $_POST['commentId'];
        $wishId = $_POST['wishId'];


        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_USER_ID, $userId);
        $this->db->where(DBConfig::TABLE_WISH_ATT_WISH_ID, $wishId);

        $r = $this->db->get(DBConfig::TABLE_WISH)->num_rows();

        if ($r > 0) {
            $this->db->where(DBConfig::TABLE_WISH_COMMENTS_ATT_COMMENTS_ID, $commentId);
            $d = $this->db->delete(DBConfig::TABLE_WISH_COMMENTS);

            if ($d) {
                return '1';
            }
        }
    }

    public function insertPaypalInfo($wishId, $ref, $userId, $comments, $amount) {
        $data[DBConfig::TABLE_WISH_DONATE_ATT_WISH_ID] = $wishId;
        $data[DBConfig::TABLE_WISH_DONATE_ATT_AMOUNT] = $amount;
        $data[DBConfig::TABLE_WISH_DONATE_ATT_GETEWAY_REFERENCE] = $ref;
        $data[DBConfig::TABLE_WISH_DONATE_ATT_PAY_TIME] = time();
        $data[DBConfig::TABLE_WISH_DONATE_ATT_TOKEN] = $_GET['token'];
        $data[DBConfig::TABLE_WISH_DONATE_ATT_PAYER_ID] = $_GET['PayerID'];
        $data[DBConfig::TABLE_WISH_DONATE_ATT_USER_ID] = $userId;
        $data[DBConfig::TABLE_WISH_DONATE_ATT_COMMENTS] = $comments;

        $i = $this->db->insert(DBConfig::TABLE_WISH_DONATE, $data);

        if ($i) {

            $wisherEmailAddress = $this->wisherEmailAddress($wishId);

            $this->email->from(SiteConfig::CONFIG_ADMIN_EMAIL, 'Site administrator');
            $this->email->to($wisherEmailAddress);
            $this->email->subject('Receive Donation');
            $body = "<p>Dear User</p><br/>";
            $body.= '<p>You receive a donation $' . $amount . ' from user ' . getUserNameById($userId) . '</p><br/>';
            $body.= '<p>for your wish ' . getWishTitle($wishId) . '</p><br/>';
            $this->email->message($body);

            $this->email->send();

            return '1';
        }
    }

    public function wisherEmailAddress($wishId) {
        $sql = 'SELECT '.DBConfig::TABLE_WISH.'.'.DBConfig::TABLE_WISH_ATT_WISH_USER_ID.','.DBConfig::TABLE_USER.'.'.DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS.'
                FROM '.DBConfig::TABLE_WISH.'
                LEFT JOIN '.DBConfig::TABLE_USER.' ON '.DBConfig::TABLE_USER.'.'.DBConfig::TABLE_USER_ATT_USER_ID.' = '.DBConfig::TABLE_WISH.'.'.DBConfig::TABLE_WISH_ATT_WISH_USER_ID.'
                WHERE '.DBConfig::TABLE_WISH.'.'.DBConfig::TABLE_WISH_ATT_WISH_ID.' = "'.$wishId.'"
               ';
        $result = $this->db->query($sql)->row_array();
        
        return $result[DBConfig::TABLE_USER_ATT_USER_EMAIL_ADDRESS];
    }

}
