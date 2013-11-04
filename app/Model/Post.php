<?php

class Post extends AppModel {
    public $name = 'Post';

    public $belongsTo = array(
        'Election'
    );
}