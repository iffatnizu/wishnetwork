<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_home');

    }

    public function index() {

       // echo FCPATH;
        
        $data['title'] = 'HOME';
        $data['nav'] = '1';
        $data['wishes'] = $this->model_home->getWishes();
        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        $page['_slider'] = $this->load->view(siteConfig::MOD_SLIDER, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_HOME, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }


}
