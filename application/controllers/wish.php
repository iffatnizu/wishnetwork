<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';

class Wish extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper(array('site'));
        $this->load->database();
        $this->load->library(array('form_validation', 'email'));
        $this->load->model('model_wish');
        $this->load->model('model_user');
        /**
         * PAYPAL INTEGRATION
         */
        $this->load->library('merchant');
        $this->merchant->load('paypal_express');
    }

    public function index() {
        $this->create();
    }

    public function create() {
        if ($this->session->userdata('_userLogin')) {
            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('wish-title', 'Wish Title', 'required');
                $this->form_validation->set_rules('wish-description', 'Wish Description', 'required');
                $this->form_validation->set_rules('wish-goal-amount', 'Goal Amount', 'required');
                $this->form_validation->set_rules('wish-currency', 'Currency', 'required');
                $this->form_validation->set_rules('wish-category', 'Category', 'required');
                $this->form_validation->set_rules('wish-grant-date', 'Grant Date', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');


                if ($this->form_validation->run() == TRUE) {

                    if ($_FILES['userfile']['name'] == true) {
                        $i = $this->model_wish->createWish($this->session->userdata('_userID'));

                        if ($i) {
                            $sess['successMsg'] = '<b>Wish successfullly created</b>.Your created wish is waiting for approved.';
                            $this->session->set_userdata($sess);

                            redirect(SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_POST_WISH);
                        }
                    } else {
                        $e['upload-error'] = true;
                        $this->session->set_userdata($e);
                    }
                }
            }
            $data['title'] = 'CREATE WISH';
            $data['nav'] = '3';
            $data['pronav'] = '4';
            $data['currency'] = getCurrency();
            $data['states'] = getAllStates();
            $data['category'] = getAllCategory();
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_CREATE, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN);
        }
    }

    public function manage() {
        if ($this->session->userdata('_userLogin')) {
            $data['title'] = 'USER MANAGE WISH';
            $data['nav'] = '0';
            $data['pronav'] = '5';
            $data['wishes'] = $this->model_wish->getUserWishes($this->session->userdata('_userID'));
            $data['profile'] = $this->model_user->getUserInfo($this->session->userdata('_userID'));
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_MANAGE_WISH, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function edit($id) {
        if ($this->session->userdata('_userLogin')) {

            if (isset($_POST['submit'])) {

                $this->form_validation->set_rules('wish-title', 'Wish Title', 'required');
                $this->form_validation->set_rules('wish-description', 'Wish Description', 'required');
                $this->form_validation->set_rules('wish-category', 'Category', 'required');
                $this->form_validation->set_rules('state', 'State', 'required');
                $this->form_validation->set_rules('city', 'City', 'required');


                if ($this->form_validation->run() == TRUE) {

                    $i = $this->model_wish->updateWish($this->session->userdata('_userID'), $id);

                    if ($i == '1') {
                        $sess['successMsg'] = '<b>Wish successfullly updated</b>';
                        $this->session->set_userdata($sess);

                        redirect(SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_EDIT_WISH . $id);
                    }
                }
            }

            $data['title'] = 'USER EDIT WISH';
            $data['nav'] = '0';
            $data['pronav'] = '0';
            $data['currency'] = getCurrency();
            $data['states'] = getAllStates();
            $data['category'] = getAllCategory();
            $data['details'] = $this->model_wish->getWishDetails($id);
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_EDIT, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url());
        }
    }

    public function delete($id) {
        if ($this->session->userdata('_userLogin')) {
            $d = $this->model_wish->deleteWish($this->session->userdata('_userID'), $id);

            if ($d == '1') {
                $sess['successMsg'] = '<b>Wish successfullly deleted</b>';
                $this->session->set_userdata($sess);

                redirect(SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_MANAGE_WISH);
            }
        } else {
            redirect(base_url());
        }
    }

    public function details($id) {
        //if ($this->session->userdata('_userLogin')) {
        $data['title'] = 'WISH DETAILS';
        $data['nav'] = '0';
        $data['pronav'] = '0';
        $data['wish'] = $this->model_wish->getWishDetailsById($id);

        $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
        $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
        $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_DETAILS_WISH, '', TRUE);
        $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
        $this->load->view(siteConfig::SITE_MASTER, $page);
    }

    public function commentOnWish() {
        if ($this->session->userdata('_userLogin')) {
            $i = $this->model_wish->commentOnWish($this->session->userdata('_userID'));
            echo json_encode($i);
        } else {
            echo 'Not authorized';
        }
    }

    public function updateCommment() {
        if ($this->session->userdata('_userLogin')) {
            echo $this->model_wish->updateCommment();
        }
    }

    public function deleteCommment() {
        if ($this->session->userdata('_userLogin')) {
            echo $this->model_wish->deleteCommment($this->session->userdata('_userID'));
        }
    }

//    public function testPaypal() {
//        $settings = $this->merchant->default_settings();
//        $settings = array(
//            'username' => 'akram_api1.corepiler.com',
//            'password' => '1386660054',
//            'signature' => 'Ai1PaghZh5FmBLCDCTQpwG8jB264AumYsO3o3jXp9MHUIVXpDPS-Tqbh ',
//            'test_mode' => true);
//
//        $this->merchant->initialize($settings);
//
//        $params = array(
//            'amount' => 20.00,
//            'currency' => 'USD',
//            'return_url' => 'http://localhost:81/wishnetwork/wish/payment_return/',
//            'cancel_url' => 'http://localhost:81/wishnetwork/wish/checkout/');
//
//        $response = $this->merchant->purchase($params);
//    }

    public function paymentreturn() {
        if ($this->session->userdata('_userLogin')) {

            $paypalinfo = $this->model_user->getPaypalInfoByUserId($this->session->userdata('paypal-receiver-id'));

            $settings = $this->merchant->default_settings();
            $settings = array(
                'username' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_USERNAME]),
                'password' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_PASSWORD]),
                'signature' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_SIGNATURE]),
                'test_mode' => true
            );

            $this->merchant->initialize($settings);

            $id = $this->session->userdata('paypal-return-id');

            $params = array(
                'amount' => $this->session->userdata('paypal-amount'),
                'currency' => 'USD',
                'return_url' => base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_PAYMENT_RETURN,
                'cancel_url' => base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DONATE . $id
            );

            $response = $this->merchant->purchase_return($params);

            $gateway_reference = $response->reference();

            if ($response->success()) {

                $insert = $this->model_wish->insertPaypalInfo(decode($id), $gateway_reference, $this->session->userdata('_userID'), $this->session->userdata('paypal-wish'), $this->session->userdata('paypal-amount'));

                if ($insert == '1') {
                    redirect(base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_PAYMENT_STATUS . $response->status() . '/' . decode($id));
                }
            } else {
                redirect(base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_PAYMENT_STATUS . $response->status() . '/' . decode($id));
            }
        }
        //debugPrint($response->status());
    }

    public function donate($id) {
        if ($this->session->userdata('_userLogin')) {

            $wishdetails = $this->model_wish->getWishDetailsById(decode($id));
            $paypalinfo = $this->model_user->getPaypalInfoByUserId($wishdetails[DBConfig::TABLE_WISH_ATT_WISH_USER_ID]);

            //debugPrint($paypalinfo);

            
            
            $data['wish'] = $wishdetails;
            $data['paypalInfo'] = $paypalinfo;

            if ($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_STATUS] == '1') {

                if (isset($_POST['submit'])) {
                    $this->form_validation->set_rules('donate-amount', 'Donate Amount', 'required');
                    $this->form_validation->set_rules('simple-wish', 'Simple Wish', 'required');
                    if ($this->form_validation->run() == TRUE) {

                        $pay['paypal'] = TRUE;
                        $pay['paypal-amount'] = $this->input->post('donate-amount');
                        $pay['paypal-wish'] = $this->input->post('simple-wish');
                        $pay['paypal-return-id'] = $id;
                        $pay['paypal-receiver-id'] = $wishdetails[DBConfig::TABLE_WISH_ATT_WISH_USER_ID];

                        $this->session->set_userdata($pay);

                        $settings = $this->merchant->default_settings();
                        $settings = array(
                            'username' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_USERNAME]),
                            'password' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_PASSWORD]),
                            'signature' => decode($paypalinfo[DBConfig::TABLE_USER_PAYPAL_ATT_SIGNATURE]),
                            'test_mode' => true);

                        $this->merchant->initialize($settings);

                        $params = array(
                            'amount' => $this->input->post('donate-amount'),
                            'description' => $wishdetails[DBConfig::TABLE_WISH_ATT_WISH_TITLE],
                            'currency' => 'USD',
                            'return_url' => base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_PAYMENT_RETURN,
                            'cancel_url' => base_url() . SiteConfig::CONTROLLER_WISH . SiteConfig::METHOD_WISH_DONATE . $id
                        );

                        $response = $this->merchant->purchase($params);
                    }
                }
            }

            $data['title'] = 'DONATE WISH';
            $data['nav'] = '0';
            $data['pronav'] = '0';


            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_DONATE, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN);
        }
    }

    public function paymentstatus($status, $wishId) {
        if ($this->session->userdata('_userLogin')) {

            $pay['paypal'] = FALSE;
            $pay['paypal-amount'] = FALSE;
            $pay['paypal-wish'] = FALSE;
            $pay['paypal-return-id'] = FALSE;

            $this->session->unset_userdata($pay);

            $data['title'] = 'PAYMENT STATUS';
            $data['nav'] = '0';
            $data['pronav'] = '0';
            $data['status'] = $status;
            $data['wishId'] = $wishId;
            $page['_top'] = $this->load->view(siteConfig::MOD_TOP, $data, TRUE);
            $page['_navigation'] = $this->load->view(siteConfig::MOD_NAVIGATION, '', TRUE);
            $page['_content'] = $this->load->view(siteConfig::COMPONENT_WISH_PAYMENT_STATUS, '', TRUE);
            $page['_footer'] = $this->load->view(siteConfig::MOD_FOOTER, '', TRUE);
            $this->load->view(siteConfig::SITE_MASTER, $page);
        } else {
            redirect(base_url() . SiteConfig::CONTROLLER_USER . SiteConfig::METHOD_USER_LOGIN);
        }
    }

}
