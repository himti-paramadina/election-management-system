<?php

class VotersController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register');
        $this->layout = "default_admin";
    }
        
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Voter.name' => 'asc'
        )
    );
        
    public $name = "Voters";
    
    public function add($election_id) {
        /* Need Authentication */
    }
    
    public function broadcast_message($template_id, $election_id) {
        $this->loadModel('EmailTemplate');
        
        $email = $this->EmailTemplate->findByid($template_id);
        $voters = $this->Voter->find('all', array(
            'conditions' => array(
                'election_id' => $election_id
            )
        ));
        
        foreach ($voters as $voter) {
            $body = str_replace(
                '<<name>>', 
                $voter['Voter']['name'], 
                $email['EmailTemplate']['body']
            );
            
            $headers = str_replace(
                array(
                    '<<recipient>>',
                    '<<name>>'
                ),
                array(
                    $voter['Voter']['email'],
                    $voter['Voter']['name']
                ),
                $email['EmailTemplate']['headers']
            );
            
            if(mail(
                $voter['Voter']['email'], 
                $email['EmailTemplate']['subject'], 
                $body, 
                $headers
            )) {
                $this->logEmail(array(
                    'to' => $voter['Voter']['email'],
                    'subject' => $email['EmailTemplate']['subject'],
                    'headers' => $headers,
                    'body' => $body
                ));
            }
        }       
        
        $this->Session->setFlash('Email telah dikirimkan kepada seluruh pemilih.', 'flash_custom');
        $this->redirect(array('controller' => 'elections', 'action' => 'manage'));
    }
    
    public function manage($election_id) {
        /* Need Authentication */
        
        // Load data
        $election = $this->Voter->Election->findByid($election_id);
        $number_of_voting_keys = $this->Voter->VotingKey->find('count', array(
            'conditions' => array(
                'VotingKey.election_id' => $election_id
            )
        ));
        
        // Bypass value to View
        $this->set('election', $election);
        $this->set('number_of_voting_keys', $number_of_voting_keys);
       
        $this->paginate = array(
            'conditions' => array('election_id' => $election_id)
        );
        
        $this->set('voters', $this->paginate('Voter'));
    }
    
    public function register($election_identifier) {
        // Load data
        $election = $this->Voter->Election->findByidentifier($election_identifier);

        // Check time
        if (time() >= strtotime($election['Election']['start_time'])) {
            $this->Session->setFlash('Maaf, masa registrasi pemilih sudah habis.', 'flash_custom');
            $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
        }
        
        // Set page title 
        $this->set('title_for_layout', "Registrasi Pemilih " . $election['Election']['name']);
        
        // Set page layout
        $this->layout = 'default';
        
        // Bypass value to View
        $this->set('election_identifier', $election_identifier);
        $this->set('election', $election);
        
        // Handle saving actions
        if ($this->request->isPost()) {
            // Assign election_id
            $this->request->data['Voter']['election_id'] = $election['Election']['id'];
            
            // Assign current time
            $this->request->data['Voter']['registered_date'] = date('Y-m-d H:i:s');
            
            if ($this->Voter->save($this->request->data)) {
                // Send e-mail to user
                
                // The message
                $message = 	"Dear " . $this->request->data['Voter']['name'] . "," . "\n\n" .
                            "Kamu telah berhasil mendaftarkan diri sebagai pemilih untuk " . $election['Election']['name'] . ". " .
                            "Setelah ini, kamu akan mendapatkan informasi berkala dari Komisi Pemilihan Umum HIMTI Paramadina " .
                            "terutama jika terdapat pembaruan terbaru di situs KPU. Pastikan kamu juga secara berkala melihat " .
                            "pembaruan yang ada di alamat: http://himti.paramadina.ac.id/election" . "\n\n" .
                            "Terima kasih telah mendaftar sebagai pemilih. Pilihan kamu menentukan masa depan HIMTI. :)" . "\n\n" .
                            "Salam," . "\n" .
                            "Komisi Pemilihan Umum" . "\n" .
                            "HIMTI Paramadina" ;

                // In case any of our lines are larger than 70 characters, we should use wordwrap()
                $message = wordwrap($message, 70);

                // Send
                mail($this->request->data['Voter']['email'], 'Registrasi Pemilih - ' . $election['Election']['name'], $message, 'From: "KPU HIMTI" <kpu@himti.paramadina.ac.id>');
                                
                $this->Session->setFlash('Registrasi pemilih berhasil. :)', 'flash_custom');
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            }
            else {
                $this->Session->setFlash('Registrasi gagal. :(', 'flash_custom');
            }            
        }        
    }
    
    public function status($election_id) {
        $election = $this->Voter->Election->findByid($election_id);
        
        $this->paginate = array(
            'conditions' => array(
                'election_id' => $election_id,
                'verified' => true
            )
        );
        
        $this->set('election', $election);      
        $this->set('voters', $this->paginate('Voter'));
    }
    
    public function verify($voter_id) {
        $voter = $this->Voter->findByid($voter_id);
                
        if ($this->Voter->save(array(
            'id' => $voter_id,
            'verified' => true
        ))) {
            $this->send_message(2, $voter['Voter']['id']); // template_id = 2
            $this->Session->setFlash('User dengan id ' . $voter_id . ' bernama ' . $voter['Voter']['name'] . ' telah diverifikasi.', 'flash_custom');
        }
        else {
            $this->Session->setFlash('Verifikasi gagal!', 'flash_custom');
        }
        
        $this->redirect(array('controller' => 'voters', 'action' => 'manage', $voter['Voter']['election_id']));
    }
}

?>