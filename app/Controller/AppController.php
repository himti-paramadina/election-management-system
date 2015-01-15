<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array('Html', 'Form');

    // Authentication Related
    public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'administrators',
                'action' => 'login'
            ),
            'loginRedirect' => array('controller' => 'elections', 'action' => 'manage'),
            'logoutRedirect' => array('controller' => 'administrators', 'action' => 'login'),
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Administrator',
                    'fields' => array('username' => 'email')
                )
            )
        )
    );
    
    function generate_guid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    
    public function logEmail($data) {
        $this->loadModel('Email');
        $this->Email->create();
        $this->Email->save($data);
    }
    
    public function send_message($template_id, $voter_id) {
        $this->loadModel('EmailTemplate');
        $this->loadModel('Voter');
        
        $email = $this->EmailTemplate->findBykey($template_id);
        
        $voter = $this->Voter->findByid($voter_id);
        
        $election = $this->Election->findByid($voter['Voter']['election_id']);

        $body = str_replace(
                array(
                    '<<name>>',
                    '<<recipient>>',
                    '<<organization_name>>',
                    '<<election_name>>'
                ),
                array(
                    $voter['Voter']['name'],
                    $voter['Voter']['email'],
                    $election['Election']['organization'],
                    $election['Election']['name']
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
        
        if (mail(
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
    
    public function send_voting_key($voter_id) {
        $this->loadModel('Election');
        $this->loadModel('EmailTemplate');
        $this->loadModel('Voter');
        
        $email = $this->EmailTemplate->findBykey('voting-key-usage-notification');
        
        $voter = $this->Voter->findByid($voter_id);
        $voting_key = $this->Voter->VotingKey->findByvoter_id($voter_id);
        
        $election = $this->Election->findByid($voting_key['VotingKey']['election_id']);
        
        $body = str_replace(
                array(
                    '<<name>>',
                    '<<voting-key>>',
                    '<<vote-url>>',
                    '<<organization_name>>',
                    '<<election_name>>'
                ),
                array(
                    $voter['Voter']['name'],
                    $voting_key['VotingKey']['voting_key'],
                    Router::url(array(
                        'controller' => 'candidates', 
                        'action' => 'display', 
                        $election['Election']['identifier']
                    ), true),
                    $election['Election']['organization'],
                    $election['Election']['name']
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
        
        if (mail(
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
    
    public function test_message($template_id) {
        $this->loadModel('EmailTemplate');
        
        $email = $this->EmailTemplate->findByid($template_id);
        
        $body = str_replace(
            '<<name>>', 
            'Imam Hidayat', 
            $email['EmailTemplate']['body']
        );

        $headers = str_replace(
            array(
                '<<recipient>>',
                '<<name>>'
            ),
            array(
                'imam.hidayat92@gmail.com',
                'Imam Hidayat'
            ),
            $email['EmailTemplate']['headers']
        );
        
        if (mail(
            'imam.hidayat92@gmail.com',
            'test_message (KPU HIMTI Paramadina)', 
            $body, 
            $headers
        )) {
            $this->logEmail(array(
                'to' => 'imam.hidayat92@gmail.com',
                'subject' => 'test_message (KPU HIMTI Paramadina)',
                'headers' => $headers,
                'body' => $body
            ));
        }
        
        print '<pre>';
        echo $headers;
        echo '<br/><br/><br/><br/>';
        echo $body;
        print '</pre>';
        
        die();
    }
    
    public function beforeFilter() {
        
    }
    
}