<?php

class AdministratorsController extends AppController {
        
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
        $this->layout = "default_admin";
    }
    
    public function administrators() {
        
    }
    
    public function add() {
        if ($this->request->isPost()) {
            if ($this->Administrator->save($this->request->data)) {
                $this->Session->setFlash('Pendaftaran berhasil. :)', 'flash_custom');
                $this->redirect(array('action' => 'login'));
            }
            else {
                $this->Session->setFlash('Pendaftaran gagal. :(', 'flash_custom');
            }
        }
    }
        
    public function login() {
        $this->layout = "default";
        
        if ($this->request->isPost()) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            }
            else {
                $this->Session->setFlash('Tidak bisa melakukan login. Coba lagi.', 'flash_custom');
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
}

?>