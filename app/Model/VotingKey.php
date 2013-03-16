<?php
App::uses('AppModel', 'Model');
/**
 * VotingKey Model
 *
 * @property Voter $Voter
 * @property Election $Election
 */
class VotingKey extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'voting_key';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'voting_key';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Voter' => array(
			'className' => 'Voter',
			'foreignKey' => 'voter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Election' => array(
			'className' => 'Election',
			'foreignKey' => 'election_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
