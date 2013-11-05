<?php

class PostsController extends AppController {
    public function index($electionId) {

    }

    public function view($electionId, $postUniqueId) {
        $post = $this->Post->findBypost_unique_identifier($postUniqueId);

        $this->set('post', $post);
    }

    public function add() {

    }

    public function edit() {

    }

    public function delete() {

    }
}