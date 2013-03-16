<?php
App::uses('AppModel', 'Model');
/**
 * Candidate Model
 *
 * @property Election $Election
 * @property ElectionDatum $ElectionDatum
 */
class Candidate extends AppModel {

    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Nama tidak boleh kosong'
        ),
        'email' => array(
            'rule' => 'email',
            'message' => 'E-mail Anda tidak valid'
        ),
        'description' => array(
            'rule' => 'notEmpty',
            'message' => 'Deskripsi tidak boleh kosong'
        )
    );
    
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Election' => array(
			'className' => 'Election',
			'foreignKey' => 'election_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ElectionDatum' => array(
			'className' => 'ElectionDatum',
			'foreignKey' => 'candidate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
