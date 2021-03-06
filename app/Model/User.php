<?php
    App::uses('AppModel', 'Model');
    App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
    // app/Model/User.php
    class User extends AppModel {
        public $actsAs = array('SoftDelete');

        public $useTable = 'users';

        public $hasMany = array(
            'Post' => array(
                'foreignKey' => 'user_id'
            ),
            'Good' => array(
                'foreignKey' => 'send_user_id',
            ),
            'Icon' => array(
                'foreignKey'  => 'user_id',
            )
            
        );

        public $hasOne = array(
            'Profile' => array(
                'foreignKey' => 'user_id'
            )
        );

        public $validate = array(
            'username' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'A username is required'
                )
            ),
            'password' => array(
                'required' => array(
                    'rule' => 'notBlank',
                    'message' => 'A password is required'
                )
            ),
            'role' => array(
                'valid' => array(
                    'rule' => array('inList', array('admin', 'author')),
                    'message' => 'Please enter a valid role',
                    'allowEmpty' => false
                )
            )
        );

        public function beforeSave($options = array()) {
            //パスワードのハッシュ化
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new BlowfishPasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            return true;
        }

    }

?>