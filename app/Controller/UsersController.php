<?php
class UsersController extends AppController {

      public $helpers = array('Html', 'Form');
      public $uses = array( 'User');
      
    public function beforeFilter() {
        parent::beforeFilter();
        // login,add,logoutを許可
        $this->Auth->allow('login', 'add', 'logout');
    }

    // ログイン
    public function login() {
      
            if ($this->request->is('post')) {
                  if ($this->Auth->login()) {
                        $this->redirect($this->Auth->redirect());
                  } else {
                        $this->Session->setFlash(__('Invalid username or password, try again'));
                  }
            }
    }

    // ログアウト
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    // ログイン後の遷移
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        
        $user = $this->Auth->user();
    }

    // 新規登録
    public function add() {
      
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('ユーザーが登録できません。'));
            }
        }
    }
    


    // 個人情報の設定
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('無効なユーザーです。'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('編集しました。'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('編集できませんでした。'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    // 退会する
    public function delete($id = null) {
      
      // 退会後に退会user_idがついているコンテンツ(product,cart,favorite)のステイタスを無効にする(購入履歴以外)
      // Userのステイタスを無効にする
      // Userステイタスが無効になったと同時にProduct,Favorite,Cartも無効にする
      // 退会したユーザのメールアドレスに退会した後にメール送信する
      // ポップアップで退会理由を記述してもらう
    }
    
    // (パスワード変更)
    // パスワードリセット
    // メール認証URL付きメール送信
    // SNSログイン・登録
}