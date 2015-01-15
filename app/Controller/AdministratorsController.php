<?php

class AdministratorsController extends AppController {
        
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
        $this->layout = "bootstrap/default_admin";
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
        /* TODO: Filter administrator by it's privilege to a particular election. */
        
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