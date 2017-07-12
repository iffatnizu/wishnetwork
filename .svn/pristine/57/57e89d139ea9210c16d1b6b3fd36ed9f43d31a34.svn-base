<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';

class Messages extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_messages');
    }

    public function index() {
        $data['title'] = 'MESSAGE';
        $data['nav'] = '0';
        $data['conversation'] = $this->model_messages->getConversationMsg($this->session->userdata('_userID'));
        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_MESSAGE_INDEX, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function sendMsg() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_POST['submit'])) {
                //debugPrint($_POST);
                $i = $this->model_messages->sendMsg($this->session->userdata('_userID'));

                echo $i;
            }
        }
    }

    public function loadChat() {
        if ($this->session->userdata('_userLogin')) {
            
            $i = $this->model_messages->loadChat($this->session->userdata('_userID'));

            echo $i;
        }
    }

}
