<?php

class ElectionsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display', 'index');
        $this->layout = "bootstrap/default_admin";
    }
    
    public $name = "Elections";
    
    public function add() {
        /* Need Authentication */
        
        if ($this->request->isPost()) {
            if ($this->Election->save($this->request->data)) {
                $this->Session->setFlash('Pemilu berhasil dibuat', 'flash_custom');
                $this->redirect(array('controller' => 'elections', 'action' => 'manage'));
            }
            else {
                $this->Session->setFlash('Gagal membuat pemilu', 'flash_custom');
            }
            
            $this->redirect('manage');
        }
          
    }
    
    public function display($identifier) {
        $this->layout = "bootstrap/default";
        
        $election = $this->Election->findByidentifier($identifier);

        $this->loadModel('Voter');
        $voters = $this->Voter->find('all', array(
            'conditions' => array(
                'election_id' => $election['Election']['id']
            )
        ));

        $this->set('title_for_layout', $election['Election']['name']);

        $this->set('election', $election);
        $this->set('voters', $voters);
    }
    
    public function edit($election_id) {
        /* Need Authentication */
        
    }
    
    public function generate_keys($election_id) {
        $this->loadModel('VotingKey');
        
        $election = $this->Election->findByid($election_id);

        $this->loadModel('Voter');
        $voters = $this->Voter->find('all', array(
            'conditions' => array(
                'election_id' => $election_id,
                'verified' => true
            )
        ));
        
        if ($voters == NULL) {
            $this->Session->setFlash('Belum ada pemilih yang telah diverifikasi untuk pemilu ini.', 'flash_custom');
            $this->redirect(array('controller' => 'voters', 'action' => 'manage', $election['Election']['id']));
        }
        
        foreach ($voters as $voter) {
            // Create GUID
            $this->VotingKey->create();
            
            if ($this->VotingKey->save(array(
                'voting_key' => $this->generate_guid(),
                'voter_id' => $voter['Voter']['id'],
                'election_id' => $election_id
            ))) {
                // Send e-mail
                $this->send_voting_key($voter['Voter']['id']);
            }         
        }
        
        $this->Session->setFlash('Voting-Keys telah dihasilkan!', 'flash_custom');
        $this->redirect(array('controller' => 'voters', 'action' => 'status', $election['Election']['id']));
    }
    
    public function manage() {
        $elections = $this->Election->find('all');
        $this->set('elections', $elections);
    }

    public function index() {
        $this->set('title_for_layout', "Portal Pemilihan Umum");

        $elections = $this->Election->find('all', array(
            'conditions' => array(
                'end_time > ' => date('Y-m-d H:i:s')
            )
        ));

        $this->set('elections', $elections);
    }
}

?>
