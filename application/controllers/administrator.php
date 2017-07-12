<?php

require_once APPPATH . 'wishnetwork/siteConfig.php';
require_once APPPATH . 'wishnetwork/dbConfig.php';
require_once APPPATH . 'wishnetwork/adminconfig.php';

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'site', 'cookie', 'form', 'url'));
        $this->load->model('model_administrator');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        if (!$this->session->userdata('_wishnetworkAdminLogin')) {

            if (isset($_POST['submit'])) {
                $login = $this->model_administrator->dologin();

                if ($login != '0') {
                    $session['_wishnetworkAdminLogin'] = true;
                    $session['_cheapaschipscleaningAdminID'] = $login[DBConfig::TABLE_ADMIN_ATT_ADMIN_ID];

                    $this->session->set_userdata($session);

                    redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
                } else {
                    $session['_errorlAdminLogin'] = true;
                    $this->session->set_userdata($session);
                }
            }

            $data['title'] = 'Welcome to Administrator Panel';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_LOGIN, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_DASHBOARD));
        }
    }

    public function dashboard() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'Dashboard || Wishnetwork  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_DASBOARD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function logout() {
        $session['_wishnetworkAdminLogin'] = FALSE;
        $session['_directoryAdminID'] = FALSE;
        $this->session->unset_userdata($session);

        redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
    }

    public function sitecontent($contentname, $contentTitle) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if ($contentname && $contentTitle) {
                if (isset($_POST['updateInformation'])) {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('title', 'Title', 'required');
                    $this->form_validation->set_rules('editor1', 'Description', 'required');
                    if (!$this->form_validation->run() == FALSE) {
                        $update = $this->model_administrator->updateSiteContent();

                        if ($update) {
                            $session['_success'] = true;
                            $this->session->set_userdata($session);
                            redirect($_POST['currentUrl']);
                        }
                    }
                }
                $data['title'] = urldecode($contentTitle) . '|| Wishnetwork  Admin';
                $data['contentTitle'] = urldecode($contentTitle);
                $data['contentName'] = $contentname;
                $data['content'] = $this->model_administrator->getSiteContent($contentname);
                $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
                $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
                $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CONTENT, $data, TRUE);
                $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
            } else {
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function faq() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if (isset($_POST['insertFaq'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Question', 'Question', 'required');
                $this->form_validation->set_rules('Answer', 'Answer', 'required');
                if (!$this->form_validation->run() == FALSE) {
                    $i = $this->model_administrator->insertFAQ();

                    if ($i == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
                    }
                }
            }
            $data['title'] = 'Dashboard || Wishnetwork  Admin';
            $data['faq'] = getFAQ();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_FAQ, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function deletefaq($id = 0) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $d = $this->model_administrator->deletefaq($id);
            redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_FAQ);
        }
    }

    public function siteparameter() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if (isset($_POST['submit'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('siteTitle', 'Site Title', 'required');
                $this->form_validation->set_rules('siteMetaKeyword', 'Site Meta Keyword', 'required');
                $this->form_validation->set_rules('siteMetaDescription', 'Site Meta Description', 'required');
                $this->form_validation->set_rules('siteEmail', 'Site Email Address', 'required');
                $this->form_validation->set_rules('sitePhone', 'Site Phone', 'required');


                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateSiteParameter();

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_SITE_PARAMETER);
                    }
                }
            }
            $data['title'] = 'Site Parameter || Wishnetwork  Admin';
            $data['details'] = getSitParameter();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_PARAMETER, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function changepassword() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if (isset($_POST['updatePassword'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('old_password', 'Old Password', 'required');
                $this->form_validation->set_rules('new_password', 'New Password', 'required|matches[con_new_password]');
                $this->form_validation->set_rules('con_new_password', 'Password Confirmation', 'required');

                if (!$this->form_validation->run() == FALSE) {
                    $update = $this->model_administrator->changepassword();
                    if ($update == '1') {
                        $data['_success'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    } else {
                        $data['_notmached'] = true;
                        $this->session->set_userdata($data);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_CHANGE_PASSWORD);
                    }
                }
            }

            $data['title'] = 'Change Administrator Password || Wishnetwork  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_SITE_CHANGE_PASSWORD, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function addCategory() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if (isset($_POST['submit'])) {

                $this->load->library('form_validation');
                $this->form_validation->set_rules('catTitle', 'Category Title', 'required');


                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->insertNewImage();

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_MANAGE_CATEGORY);
                    }
                }
            }
            $data['title'] = 'Add Category || Wishnetwork  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_MANAGE_IMAGE, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function viewCategory() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'View Category || Wishnetwork  Admin';
            $data['category'] = $this->model_administrator->getAllCategory();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_CATEGORY, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        }
    }

    public function deleteCategory($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $d = $this->model_administrator->deleteCategory($id);

            if ($d == 1) {
                redirect(base_url() . Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_CATEGORY);
            }
        }
    }

    public function editCategory($id = 0) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            if (isset($_POST['submit'])) {


                $this->load->library('form_validation');
                $this->form_validation->set_rules('catTitle', 'Category Title', 'required');


                if (!$this->form_validation->run() == FALSE) {
                    $u = $this->model_administrator->updateCategory($id);

                    if ($u == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_EDIT_CATEGORY . $id);
                    }
                }
            }
            $data['title'] = 'Edit Category || Wishnetwork  Admin';
            $data['details'] = $this->model_administrator->getCategoryDetails($id);
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_EDIT_CATEGORY, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function pageMetaData() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['metadata'] = $this->model_administrator->getPageMetaDataId();
            $data['title'] = 'All page meta data || Wishnetwork  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_PAGE_META_DATA, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function editPageMetaData($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {

            if (isset($_POST['submit'])) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');
                $this->form_validation->set_rules('keyword', 'Keyword', 'required');
                $this->form_validation->set_rules('author', 'Author', 'required');


                if (!$this->form_validation->run() == FALSE) {
                    $i = $this->model_administrator->updatePageMetaData($id);

                    if ($i == '1') {
                        $session['_success'] = true;
                        $this->session->set_userdata($session);
                        redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_EDIT_PAGE_META_DATA . $id));
                    }
                } else {
                    $s['e'] = TRUE;
                    $this->session->set_userdata($s);
                }
            }

            $data['metadata'] = $this->model_administrator->getPageMetaDataById($id);
            $data['title'] = 'Edit Page Meta Data || Wishnetwork  Admin';
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_EDIT_META_DATA, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function viewWish() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'View Wish || Wishnetwork  Admin';
            $data['wish'] = $this->model_administrator->getAllWish();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_WISH, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function wishApproved($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $i = $this->model_administrator->updateWishStatus($id, '1');
            if ($i == '1') {
                $session['_success'] = true;
                $this->session->set_userdata($session);
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_WISH));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function wishDetails($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'Wish Details || Wishnetwork  Admin';
            $data['wish'] = $this->model_administrator->getWishDetailsById($id);
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_WISH_DETAILS, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function transaction() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'All Transaction || Wishnetwork  Admin';
            $data['transaction'] = $this->model_administrator->getAllTransaction();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_ALL_TRANSACTION, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function wishDeleted($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $i = $this->model_administrator->deleteWish($id);
            if ($i == '1') {
                $session['_success'] = true;
                $this->session->set_userdata($session);
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_WISH));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function wishBanned($id) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $i = $this->model_administrator->updateWishStatus($id, '0');
            if ($i == '1') {
                $session['_success'] = true;
                $this->session->set_userdata($session);
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_VIEW_WISH));
            }
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function paypalrequest() {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            $data['title'] = 'Paypal Request || Wishnetwork  Admin';
            $data['request'] = $this->model_administrator->getPaypalRequest();
            $admin['header'] = $this->load->view(Adminconfig::VIEW_ADMIN_HEADER, $data, TRUE);
            $admin['navigation'] = $this->load->view(Adminconfig::VIEW_ADMIN_NAVIGATION, '', TRUE);
            $admin['content'] = $this->load->view(Adminconfig::VIEW_ADMIN_COMP_VIEW_ALL_PAYPAL_REQUEST, '', TRUE);
            $this->load->view(Adminconfig::VIEW_ADMIN_MASTER, $admin);
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

    public function changePaypalStatus($infoId, $statusCode) {
        if ($this->session->userdata('_wishnetworkAdminLogin')) {
            
            $updateStatus = $this->model_administrator->changePaypalStatus($infoId,$statusCode);
            
            if ($updateStatus == '1') {
                $session['_success'] = true;
                $this->session->set_userdata($session);
                redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_PAYPAL_REQUEST));
            }
            
        } else {
            redirect(site_url(Adminconfig::CONTROLLER_ADMINISTRATOR . Adminconfig::METHOD_ADMINISTRATOR_LOGIN));
        }
    }

}
