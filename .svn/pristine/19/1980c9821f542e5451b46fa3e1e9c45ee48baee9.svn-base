<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_messages
 *
 * @author Akram Rana
 */
class Model_Messages extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function sendMsg($sender) {

        //echo decode($_POST['str']);
        $this->db->where(DBConfig::TABLE_USER_ATT_USER_ID, decode($_POST['str']));
        $r = $this->db->get(DBConfig::TABLE_USER)->row_array();

        if (!empty($r)) {

            $data[DBConfig::TABLE_USER_MESSAGES_ATT_FROM] = $sender;
            $data[DBConfig::TABLE_USER_MESSAGES_ATT_TO] = decode($_POST['str']);
            $data[DBConfig::TABLE_USER_MESSAGES_ATT_MESSAGE] = $_POST['msg'];
            $data[DBConfig::TABLE_USER_MESSAGES_ATT_SENT_TIME] = time();
            $data[DBConfig::TABLE_USER_MESSAGES_ATT_IS_READ] = "0";

            $i = $this->db->insert(DBConfig::TABLE_USER_MESSAGES, $data);

            if ($i) {
                return '1';
            }
        }
    }

    public function getConversationMsg($userId) {
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_USER_MESSAGES . ' WHERE  `' . DBConfig::TABLE_USER_MESSAGES_ATT_FROM . '` = "' . $userId . '" OR `' . DBConfig::TABLE_USER_MESSAGES_ATT_TO . '` = "' . $userId . '"  GROUP BY `' . DBConfig::TABLE_USER_MESSAGES_ATT_TO . '`,`from`';

        //echo $sql;

        $r = $this->db->query($sql)->result_array();

        $data = array();

        $to = array();
        $from = array();


        foreach ($r as $row) {
            array_push($to, $row[DBConfig::TABLE_USER_MESSAGES_ATT_TO]);
            array_push($from, $row[DBConfig::TABLE_USER_MESSAGES_ATT_FROM]);
        }

        $temp = array_merge($to, $from);
        $temp = array_unique($temp);

        foreach ($temp as $val) {
            if ($val != $userId) {
                $row['details'] = getUserNamePhoto($val);
                array_push($data, $row);
            }
        }

        $result = array();

        $result['size'] = sizeof($data);
        $result['object'] = $data;
        return $result;
    }

    public function loadChat($userId) {
        $withId = $_GET['id'];
        $sql = 'SELECT * FROM ' . DBConfig::TABLE_USER_MESSAGES . ' WHERE (`' . DBConfig::TABLE_USER_MESSAGES_ATT_FROM . '`= "' . $userId . '" OR `' . DBConfig::TABLE_USER_MESSAGES_ATT_TO . '`= "' . $userId . '") AND (`' . DBConfig::TABLE_USER_MESSAGES_ATT_FROM . '`= "' . $withId . '" OR `' . DBConfig::TABLE_USER_MESSAGES_ATT_TO . '`= "' . $withId . '")';

        $r = $this->db->query($sql)->result_array();
        //echo  $sql;

        $data = array();

        foreach ($r as $row) {
            $row['from'] = getUserNamePhoto($row[DBConfig::TABLE_USER_MESSAGES_ATT_FROM]);
            $row['to'] = getUserNamePhoto($row[DBConfig::TABLE_USER_MESSAGES_ATT_TO]);
            array_push($data, $row);
        }

        return json_encode($data);
    }

}
