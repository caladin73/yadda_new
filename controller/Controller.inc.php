<?php
/**
 * controller/Controller.inc.php
 * @author 
 * @copyright (c) 2017, 
 * @license http://www.fsf.org/licensing/ GPLv3
 */
require_once './model/Model.inc.php';
require_once './model/Users.inc.php';
require_once './model/Yadda.inc.php';
require_once './view/LoginView.inc.php';
require_once './view/UserView.inc.php';
require_once './view/YaddaView.inc.php';
require_once './model/AuthA.inc.php';

class Controller {
    private $model; // bliver sat i action()
    private $get;
    private $post;
    private $function;
    private $file;
    // are cookies allowed

    // Called with param in URL: ?f=
    public function action() {
        switch ($this->function) {
            case 'login':   //auth
                $this->model = new Users(null, null, null, null, null, null, null);
                $view1 = new LoginView($this->model); //TODO
                if (count($this->post) > 0) {
                    $this->auth($this->post);
                }
                $view1->display(); 
                break;
            case 'logout':   //logout
                $this->model = new Users(null, null, null, null, null);
                $view1 = new LoginView($this->model);
                $this->logout();
                $view1->display();
                break;
            case 'register':   //user create
                $this->model = new Users(null, null, null, null, null, null, null); // init a model
                $view1 = new UserView($this->model);// init a view
                if (count($this->post) > 0) {
                    $this->createUser($this->post);               // activate controller
                }
                $view1->display();
                break;
            case 'profile':   //user edit 
                if(!Authentication::isAuthenticated()) {
                    header('Location: ./index.php');
                }
                $this->model = new Users(null, null, null, null, null, null, null); // init a model
                $view1 = new UserView($this->model);                  // init a view
                if (count($this->post) > 0) {
                    $this->activateUser($this->post);
                }
                $view1->displayAdmin();
                break;
            case 'yadda':   //yadda form
                if(!Authentication::isAuthenticated()) {
                    header('Location: ./index.php');
                }
                $this->model = new Yadda(null, null, null, null, null, null, null); // init a model
                $view1 = new YaddaView($this->model);// init a view
                if (count($this->post) > 0) {
                    $this->createYadda($this->post, $this->file);               // activate controller
                }
                $view1->display();
                break;
        }
    }
    
    public function __construct($get, $post, $file) {
        $this->get = $get;
        $this->post = $post;
        $this->file = $file;
        foreach ($get as $key => $value) {
            $$key = $value;
        }
        $this->function = isset($f) ? $f : 'login';
    }

    public function auth($p) {
        if (isset($p) && count($p) > 0) {
            if (!AuthA::isAuthenticated() 
                    && Model::areCookiesEnabled()
                    && isset($p['username'])
                    && isset($p['password'])) {
                        Authentication::authenticate($p['username'], $p['password']);
            }
            $p = array();
        }
        return;
    }
    
    public function activateUser($p) {
        if (isset($p) && count($p) > 0) {
            $active = new Users($p['username'], null, null, null, $p['activated']);
            $active->activateUser();
        }
    }
    
    public function createYadda($p, $f) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $yadda = Yadda::createObject($p, $f);  // object from array
            $yadda->create();         // model method to insert into db
            $p = array();
        }
        return;
    }    

    public function createUser($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $user = new Users($p['username'], $p['password'], $p['name'], $p['email'], null);/*Users::createObject($p);*/  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
        return;
    }
    
    public function createListener($p) {
        if (isset($p) && count($p) > 0) {
            $p['id'] = null; // augment array with dummy
            $user = Listener::createObject($p);  // object from array
            $user->create();         // model method to insert into db
            $p = array();
        }
        return;
    }
        
    public function logout() {
        Authentication::Logout();
        return;
    }
}
