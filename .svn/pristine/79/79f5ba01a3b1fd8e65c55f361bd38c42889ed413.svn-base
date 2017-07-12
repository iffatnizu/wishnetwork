<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email', 'phpbb'));

        $this->load->model('model_user');
    }

    public function index() {
        $this->signup();
    }

    public function signup() {

        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'REGISTRATION';
            $data['nav'] = '0';
            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('first-name', 'First Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_emailAddressCheck');
                $this->form_validation->set_rules('password', 'Password', 'required|matches[con-password]');
                $this->form_validation->set_rules('con-password', 'Confirm Password', 'required');
                $this->form_validation->set_rules('zip', 'Zip Code', 'required');
                $this->form_validation->set_rules('month', 'Month', 'required');
                $this->form_validation->set_rules('day', 'Day', 'required');
                $this->form_validation->set_rules('year', 'Year', 'required');


                if ($this->form_validation->run() == TRUE) {
//            debugPrint($_POST);
                    $this->model_user->userSignup();
                }
            }
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_REGISTRATION, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function emailAddressCheck($email = "") {

        $check = $this->model_user->emailAddressCheck($email);

        if ($check == '1') {
            $this->form_validation->set_message('emailAddressCheck', 'Email Address Already Exist');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function login() {
        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'LOGIN';
            $data['nav'] = '0';
            if (isset($_POST['login'])) {
                $this->model_user->userLogin();
            }
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_LOGIN, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function forgotpassword() {
        if (!$this->session->userdata('_userLogin')) {
            $data['title'] = 'FORGOT PASSWORD';
            $data['nav'] = '0';
            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('email', 'E-mail address', 'required');

                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->forgotpassword();
                }
            }
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_FORGOT_PASSWORD, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function account($name, $token) {
        if (!$this->session->userdata('_userLogin')) {
            $this->model_user->userAccountActivation($name, $token);
            $data['title'] = 'USER ACCOUNT ACTIVATION';
            $data['nav'] = '0';
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_ACCOUNT, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function dashboard() {

        redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_SETTINGS);

        //exit();
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER DASHBOARD';
            $data['nav'] = '0';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_DASHBOARD, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function logout() {
        $session['_userLogin'] = FALSE;
        $session['_userID'] = FALSE;
        $session['_userDisplayName'] = FALSE;

        $this->session->unset_userdata($session);

        $this->phpbb->user_logout();

        redirect(base_url());
    }

    public function home() {
        if ($this->session->userdata('_userLogin')) {
            $data['feed'] = $this->model_user->getUserFeed(encode($this->session->userdata('_userID')));
            $data['stat'] = getUserStatistics($this->session->userdata('_userID'));
            $data['title'] = 'USER HOME';
            $data['nav'] = '0';
            $data['pronav'] = '1';
            $data['activity'] = $this->model_user->getUserActivity($this->session->userdata('_userID'));
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_HOME, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function about() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER ABOUT';
            $data['nav'] = '0';
            $data['pronav'] = '2';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_ABOUT, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function pages() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER PAGES';
            $data['nav'] = '0';
            $data['pronav'] = '3';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_PAGES, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function settings() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER SETTTING';
            $data['nav'] = '0';
            $data['setnav'] = '1';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_DASHBOARD, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function notification() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER NOTIFICATION';
            $data['nav'] = '0';
            $data['setnav'] = '4';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_NOTIFICATION, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function activewish() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'ACTIVE WISH';
            $data['nav'] = '0';

            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_ACTIVE_WISH, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function getCity() {
        $city = $this->model_user->getCityByState($_POST['id']);
        echo json_encode($city);
    }

    public function editprofile() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('first-name', 'First Name', 'required');
                $this->form_validation->set_rules('zip', 'Zip Code', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');

                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->editprofile($this->session->userdata('_userID'));
                }
            }

            $data['title'] = 'USER EDIT PROFILE';
            $data['states'] = getAllStates();
            $data['nav'] = '0';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_EDIT_PROFILE, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function changepassword() {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('new-password', 'New Password', 'required|matches[connew-password]');
                $this->form_validation->set_rules('connew-password', 'Confirm Password', 'required');
                $this->form_validation->set_rules('old-password', 'Old Password', 'required');


                if ($this->form_validation->run() == TRUE) {

                    $this->model_user->changepassword($this->session->userdata('_userID'));
                }
            }
            $data['nav'] = '0';
            $data['pronav'] = '0';
            $data['setnav'] = '5';
            $data['title'] = 'USER CHANGE PASSWORD';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_CHANGE_PASSWORD, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function bio() {
        if ($this->session->userdata('_userLogin')) {
            $data['nav'] = '0';
            $data['pronav'] = '0';
            $data['setnav'] = '6';
            $data['title'] = 'USER BIO';
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_BIO, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function updateBio() {
        if ($this->session->userdata('_userLogin')) {
            echo $this->model_user->updateBio($this->session->userdata('_userID'));
        } else {
            echo 'Not authorized';
        }
    }

    public function details($encUserId) {
        $data['feed'] = $this->model_user->getUserFeed($encUserId);
        $data['nav'] = '0';
        $data['pronav'] = '0';
        $data['setnav'] = '0';
        $data['title'] = 'PROFILE';
        $data['profile'] = $this->model_user->getUserInfo(decode($encUserId));
        $data['stat'] = getUserStatistics(decode($encUserId));
        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_INDIVIDUAL_PROFILE, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function transactionhistory() {
        $data['title'] = 'MANAGE PAYPAL INFO';
        $data['history'] = $this->model_user->getUserTransactionHistory($this->session->userdata('_userID'));
        $data['setnav'] = '3';
        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_TRANSACTION_HISTORY, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function paypal() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('paypal-username', 'Paypal Username', 'required');
                $this->form_validation->set_rules('paypal-password', 'Paypal Password', 'required');
                $this->form_validation->set_rules('paypal-signature', 'Paypal Signature', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $p = $this->model_user->updatePaypalInfo($this->session->userdata('_userID'));

                    if ($p == '1') {
                        $s['successMsg'] = TRUE;
                        $this->session->set_userdata($s);
                        redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_PAYPAL);
                    }
                }
            }
            $data['title'] = 'MANAGE PAYPAL INFO';
            $data['states'] = getAllStates();
            $data['setnav'] = '2';
            $data['paypalinfo'] = $this->model_user->getPaypalInfoByUserId($this->session->userdata('_userID'));
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_USER_PAYPAL_INFO, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

}
