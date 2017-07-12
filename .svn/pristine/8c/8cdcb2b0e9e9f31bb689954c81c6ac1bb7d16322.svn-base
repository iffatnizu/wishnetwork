<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';

class Contact extends CI_Controller {

    public function Contact() {
        parent::__construct();
        $this->load->library(array('form_validation', 'email','session'));
        $this->load->model('model_contact');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
    }

    public function index() {
        $data['title'] = 'Contact with us';

        if (isset($_POST['submitcontact'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Valid Email', 'required|valid_email');
            $this->form_validation->set_rules('message', 'Description', 'required');

            if ($this->form_validation->run() != FALSE) {
                
                $body = "<table>";
                $body.= "<tr><td>Name</td><td>"+$_POST['name']+"</td></tr>";
                $body.= "<tr><td>Email</td><td>"+$_POST['email']+"</td></tr>";
                $body.= "<tr><td>Company</td><td>"+$_POST['address']+"</td></tr>";
                $body.= "<tr><td>Phone</td><td>"+$_POST['phone']+"</td></tr>";
                
                $body.= "<tr><td>Describe in few words most important features of the project</td><td>"+$_POST['message']+"</td></tr>";
                $body.= "</table>";

                $this->email->from($_POST['email']);
                $this->email->to(SiteConfig::CONFIG_ADMIN_EMAIL);


                $this->email->subject('Contact Us Mail');
                $this->email->message($body);

                $this->email->send();
                
                $s['success'] = TRUE;
                $this->session->set_userdata($s);

                //echo $this->email->print_debugger();

                //exit();
            }
        }

        $data['nav'] = '0';
        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        //$page['_slider'] = $this->load->view(siteConfig::MOD_SLIDER, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_CONTACT_US, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

}
