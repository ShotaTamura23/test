<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
    	'username' => array(
    		'required' => array(
    				'rule' => array('notEmpty'),
    				'required' => true, 'allowEmpty' => false,
    				'message' => 'ユーザネームを入力してください。'
    		),
    		'unique_username' => array(
    				'rule' => array('isUnique', 'username'),
    				'message' => 'このユーザネームは既につかわれています。'
    		),
    		'username_min' => array(
    				'rule' => array('minLength', '3'),
    				'message' => 'ユーザネームは３文字以上にしてください。'
    		)
    	),

    	'email' => array(
    			'isValid' => array(
    						'rule' => 'email',
    						'required' => true,
    						'message' => 'メールアドレスを入力してください。'
    				),
    			'isUnique' => array(
    						'rule' => array('isUnique', 'email'),
    						'message' => 'このメールアドレスは既に登録されています。'
    				)
    	),
    		
        'password' => array(
        	'too_short' => array(
        			'rule' => array('minLength', '6'),
        			'message' => '６文字以上のパスワードを入力してください。'
        	),
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'パスワードを入力してください。'
            )
        ),
    		
    );
    
    public function beforeSave($options = array()) {
      if (isset($this->data[$this->alias]['password'])) {
          $passwordHasher = new BlowfishPasswordHasher();
          $this->data[$this->alias]['password'] = $passwordHasher->hash(
              $this->data[$this->alias]['password']
          );
      }
      return true;
    }
}
