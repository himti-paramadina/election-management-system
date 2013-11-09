<?php

class VotersController extends AppController {

    /*
        Pending Works
        - Update email_templates in database
        - Update string replacement inside email for each information
    */

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
    
    public function broadcast_message($template_id, $election_id) {
        $this->loadModel('EmailTemplate');
        
        $email = $this->EmailTemplate->findBykey($template_id);
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
        $this->loadModel('Election');
        $election = $this->Election->findByidentifier($election_identifier);

        // Check time
        if (time() >= strtotime($election['Election']['start_time'])) {
            $this->Session->setFlash('Maaf, masa registrasi pemilih sudah habis.', 'flash_custom');
            $this->redirect('/info/' . $election['Election']['identifier']);
        }
        
        // Set page title 
        $this->set('title_for_layout', "Registrasi Pemilih " . $election['Election']['name']);
        
        // Set page layout
        $this->layout = 'default';
        
        // Bypass value to View
        $this->set('election', $election);
        
        // Handle saving actions
        if ($this->request->isPost()) {
            // Assign election_id
            $this->request->data['Voter']['election_id'] = $election['Election']['id'];
            
            // Try to find any existing registered voter.
            $voters = $this->Voter->find('all', array(
                'conditions' => array(
                    'email' => $this->request->data['Voter']['email'],
                    'election_id' => $election['Election']['id']
                )
            ));

            if (count($voters) == 0) {
                // Assign current time
                $this->request->data['Voter']['registered_date'] = date('Y-m-d H:i:s');

                if ($this->Voter->save($this->request->data)) {
                    $newVoterId = $this->Voter->getInsertID();

                    // Send e-mail to user
                    $this->loadModel('EmailTemplate');

                    $email = $this->EmailTemplate->findBykey('voter-registration-notification');

                    $voter = $this->Voter->findByid($newVoterId);

                    $body = str_replace(
                        array(
                            '<<name>>',
                            '<<recipient>>',
                            '<<election_name>>',
                            '<<organization_name>>'
                        ),
                        array(
                            $voter['Voter']['name'],
                            $voter['Voter']['email'],
                            $election['Election']['name'],
                            $election['Election']['organization']
                        ),
                        $email['EmailTemplate']['body']
                    );

                    $headers = str_replace(
                        array(
                            '<<name>>',
                            '<<recipient>>'
                        ),
                        array(
                            $voter['Voter']['name'],
                            $voter['Voter']['email']
                        ),
                        $email['EmailTemplate']['headers']
                    );

                    $subject = str_replace(
                        array(
                            '<<election_name>>'
                        ),
                        array(
                            $election['Election']['name']
                        ), 
                        $email['EmailTemplate']['subject']
                    );

                    mail(
                        $voter['Voter']['email'],
                        $subject,
                        $body,
                        $headers
                    );
                            
                    $this->Session->setFlash('Registrasi pemilih berhasil. :)', 'flash_custom');
                    $this->redirect('/info/' . $election['Election']['identifier']);
                }
                else {
                    $this->Session->setFlash('Registrasi gagal. :(', 'flash_custom');
                }
            }
            else {
                $this->Session->setFlash('Anda telah terdaftar sebagai pemilih.', 'flash_custom');
                $this->redirect('/info/' . $election['Election']['identifier']);
            }                        
        }        
    }

    public function resend_voting_key($voterId) {
        $this->send_voting_key($voterId);

        $this->Session->setFlash('Voting key telah dikirimkan ulang.', 'flash_custom');
        $this->redirect('/info/' . $election['Election']['identifier']);
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
            $this->send_message('voter-verification-information', $voter['Voter']['id']); // template_id = 2
            $this->Session->setFlash('User dengan id ' . $voter_id . ' bernama ' . $voter['Voter']['name'] . ' telah diverifikasi.', 'flash_custom');
        }
        else {
            $this->Session->setFlash('Verifikasi gagal!', 'flash_custom');
        }
        
        $this->redirect(array('controller' => 'voters', 'action' => 'manage', $voter['Voter']['election_id']));
    }
}

?>