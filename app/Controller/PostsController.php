<?php

class PostsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }

    public function index($electionUniqueId) {

    }

    public function view($electionUniqueId, $postUniqueId) {
        $this->loadModel('Election');
        $election = $this->Election->findByidentifier($electionUniqueId);

        $this->loadModel('Voter');
        $voters = $this->Voter->find('all', array(
            'conditions' => array(
                'election_id' => $election['Election']['id']
            )
        ));

        $post = array();
        foreach ($election['Post'] as $aParticularPost) {
            if ($aParticularPost['post_unique_identifier'] == $postUniqueId) {
                $post = $aParticularPost;
                break;
            }
        }

        $this->set('election', $election);
        $this->set('post', $post);
        $this->set('voters', $voters);

        $this->set('title_for_layout', $post['title'] . " - " . $election['Election']['name']);
    }

    public function add() {

    }

    public function edit() {

    }

    public function delete() {

    }
}