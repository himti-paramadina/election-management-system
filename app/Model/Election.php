<?php
App::uses('AppModel', 'Model');
/**
 * Election Model
 *
 * @property Candidate $Candidate
 * @property ElectionDatum $ElectionDatum
 * @property Voter $Voter
 * @property VotingKey $VotingKey
 */
class Election extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Candidate' => array(
			'className' => 'Candidate',
			'foreignKey' => 'election_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ElectionDatum' => array(
			'className' => 'ElectionDatum',
			'foreignKey' => 'election_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Voter' => array(
			'className' => 'Voter',
			'foreignKey' => 'election_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'VotingKey' => array(
			'className' => 'VotingKey',
			'foreignKey' => 'election_id',
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
