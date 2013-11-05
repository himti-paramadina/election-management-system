<?php

class CandidatesController extends AppController {
    
    // Overrided method
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display', 'detail', 'result', 'vote');
        $this->layout = "default_admin";
    }
    
    public $name = 'Candidates';
    
    public function add($election_id) {
        /* Need Authentication */
        
        // Load data
        $election = $this->Candidate->Election->findByid($election_id);
        
        // Bypass value to View
        $this->set('election', $election);
        
        if ($this->request->isPost()) {
            $this->request->data['Candidate']['election_id'] = $election['Election']['id'];            
            
            if ($this->Candidate->save($this->request->data)) {
                // Handle file uploads
                $file_name = $this->request->data['Candidate']['userfile']['name'];
                $file_hash = md5_file($this->request->data['Candidate']['userfile']['tmp_name']);
                $upload_dir = realpath(__DIR__ . '../../webroot/img') . '/' . $file_hash . '_' . $file_name;
                
                // Debug +_+
                /*echo "<pre>";
                print_r($this->request->data);
                print_r($this->request->data['Candidate']['userfile']);
                echo 'upload_dir = ' . $upload_dir . '<br/>';
                echo 'filename = ' . $file_name . '<br/>';
                echo "</pre>";
                die();*/
                
                if (move_uploaded_file($this->request->data['Candidate']['userfile']['tmp_name'], $upload_dir)) {
                    $this->request->data['Candidate']['img_url'] = $upload_dir;
                }                
                
                $this->Session->setFlash('Sukses menambahkan kandidat. :)', 'flash_custom');
                $this->redirect(array('controller' => 'candidates', 'action' => 'manage', $election_id));
            }
            else {
                $this->Session->setFlash('Gagal menambahkan kandidat. :(', 'flash_custom');
            }
        }
    }
    
    public function display($election_identifier) {
        $this->layout = "default";
        
        // Load data
        $election = $this->Candidate->Election->findByidentifier($election_identifier);
        $candidates = $this->Candidate->find('all', array(
            'conditions' => array(
                'election_id' => $election['Election']['id']
            )
        ));

        // Bypass value to View
        $this->set('election', $election);
        $this->set('candidates', $candidates);
        
        // Set page title
        $this->set('title_for_layout', 'Kandidat ' . $election['Election']['name']);
    }
    
    public function detail($electionId, $candidateUniqueId) {
        $this->layout = "default";
        $this->set('title_for_layout', 'Detail Data Kandidat');

        // Load data
        $election = $this->Candidate->Election->findByidentifier($electionId);
        $candidates = $this->Candidate->find('all', array(
            'conditions' => array(
                'candidate_unique_identifier' => $candidateUniqueId,
                'election_id' => $election['Election']['id']
            )
        ));
        $candidate = $candidates[0];
        
        // Bypass value to View
        $this->set('candidate', $candidate);
        $this->set('election', $election);
        
        // Set page title
        $title = $candidate['Candidate']['name'];
        if ($candidate['Candidate']['name2'] != NULL) {
            $title = $title . ' & ' . $candidate['Candidate']['name2'];
        }
        
        $this->set('title_for_layout', $title . ' - Kandidat ' . $election['Election']['name']);
    }
        
    public function manage($election_id) {
        /* Need Authentication */
        
        $this->set('title_for_layout', 'Manajemen Data Kandidat');
        
        // Load data
        $election = $this->Candidate->Election->findByid($election_id);
        $candidates = $this->Candidate->find('all', array(
            'conditions' => array(
                'election_id' => $election_id
            )
        ));
        
        // Bypass value to View
        $this->set('election', $election);
        $this->set('candidates', $candidates);
    }
    
    public function result($election_id) {
        $this->layout = 'default';
        
        $election = $this->Candidate->Election->findByidentifier($election_id);
        $this->set('title_for_layout', 'Hasil ' . $election['Election']['name']);
        
        $this->loadModel('ElectionDatum');
        
        $total = $this->ElectionDatum->find('count', array(
            'conditions' => array(
                'ElectionDatum.election_id' => $election['Election']['id']
            )
        ));
        
        $query = "SELECT    candidates.name,
                            candidates.name2,
                            candidates.img_url,
                            COUNT(election_data.id) as 'num'
                            
                  FROM      candidates, election_data
                  
                  WHERE     candidates.id = election_data.candidate_id 
                        AND election_data.election_id = " . $election['Election']['id'] . "
                                
                  GROUP BY  candidates.id
                  ORDER BY  num DESC";
        
        $results = $this->Candidate->ElectionDatum->query($query);
        
        $this->set('results', $results);
        $this->set('total', $total);        
        $this->set('election', $election);
    }
    
    public function vote($candidate_id) {
        $this->layout = 'default';
        $this->set('title_for_layout', 'Vote!');
        
        $this->loadModel('Election');
        
        $candidate = $this->Candidate->findByid($candidate_id);
        $election = $this->Election->findByid($candidate['Candidate']['election_id']);
        
        // Check time
        if (time() < strtotime($election['Election']['start_time'])) {
            $this->Session->setFlash('Pemilu belum dibuka.', 'flash_custom');
            $this->redirect(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier']));
        }
        else if (time() > strtotime($election['Election']['end_time'])) {
            $this->Session->setFlash('Pemilu telah berakhir.', 'flash_custom');
            $this->redirect(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier']));
        }
                
        $this->loadModel('ElectionDatum');
        $this->loadModel('VotingKey');
                
        if ($this->request->isPost()) {
            // Check is voting-key is still valid
            $voting_key = $this->VotingKey->findByvoting_key($this->request->data['VotingKey']['voting_key']);
            
            if ($voting_key == NULL) {
                $this->Session->setFlash('Tidak dapat melakukan vote. Voting-Key Anda tidak valid.', 'flash_custom');
                $this->redirect(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier']));
            }
            
            if (!$voting_key['VotingKey']['activated']) {
                // Add data for this vote
                $this->ElectionDatum->save(array(
                    'election_id' => $candidate['Candidate']['election_id'],
                    'candidate_id' => $candidate['Candidate']['id'],
                    'inserted_time' => date('Y-m-d H:i:s')
                ));
                
                // Set activated = true for voting-key
                $isSaved = $this->VotingKey->save(array(
                    'voting_key' => $voting_key['VotingKey']['voting_key'],
                    'activated' => true,
                    'activated_time' => date('Y-m-d H:i:s'),
                ));
                
                if ($isSaved) {
                    // Send email
                    $this->send_message(3, $voting_key['VotingKey']['voter_id']); // template_id = 3

                    $this->Session->setFlash('Terima kasih. Pilihan Anda sudah tersimpan. :)', 'flash_custom');
                    $this->redirect(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier']));
                }
                else {
                    $this->Session->setFlash('Gagal memproses pemilihan kandidat. Coba ulangi.', 'flash_custom');
                }
            }
            else {
                $this->Session->setFlash('Maaf, voting-key Anda sudah terpakai!', 'flash_custom');
                $this->redirect(array('controller' => 'candidates', 'action' => 'display', $election['Election']['identifier']));
            }
        }
        
        // Bypass value to View
        $this->set('candidate', $candidate);
        $this->set('election', $election);
    }
}