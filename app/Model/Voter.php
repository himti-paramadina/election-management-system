<?php
App::uses('AppModel', 'Model');
/**
 * Voter Model
 *
 * @property Election $Election
 * @property VotingKey $VotingKey
 */
class Voter extends AppModel {

    public $validate = array(
        'name' => array(
            'name-rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Nama tidak boleh kosong'
            ),
            'name-rule2' => array(
                'rule'    => array('minLength', 3),
                'message' => 'Huruf di nama Anda terlalu sedikit'
            )
        ),
        'email' => array(
            'email-rule1' => array(
                'rule' => 'email',
                'message' => 'E-mail Anda tidak valid'
            )
        ),
        'phone_number' => array(
            'phone-rule1' => array(
                'rule' => 'numeric',
                'message' => 'Nomor telepon Anda tidak valid'
            ),
            'phone-rule2' => array(
                'rule'    => array('minLength', 7),
                'message' => 'Nomor telepon yang valid minimal 7 karakter'
            )
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
		'VotingKey' => array(
			'className' => 'VotingKey',
			'foreignKey' => 'voter_id',
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
