<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Contact extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function getSiteContent($contentname="") {
        $this->db->where(DBConfig::TABLE_CONTENT_ATT_CONTENT_NAME, $contentname);

        return $this->db->get(DBConfig::TABLE_CONTENT)->row_array();
    }
}