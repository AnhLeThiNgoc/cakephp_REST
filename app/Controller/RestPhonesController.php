<?php

class RestPhonesController extends AppController {
	public $uses = array('Phone');
    public $helpers = array('Html', 'Form');
	public $components = array('RequestHandler');


	public function index() {
		$phones = $this->Phone->find('all');
        $this->set(array(
            'phones' => $phones,
            '_serialize' => array('phones')
        ));
        $this -> render('/RestPhones/index');
    }

	public function add() {
		$this->Phone->create();
		if ($this->Phone->save($this->request->data)) {
			 $message = 'Created';
		} else {
			$message = 'Error';
		}
		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
    }
	
	public function view($id) {
        $phone = $this->Phone->findById($id);
        $this->set(array(
            'phone' => $phone,
            '_serialize' => array('phone')
        ));
    }

	
	public function edit($id) {
        $this->Phone->id = $id;
        if ($this->Phone->save($this->request->data)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
	
	public function delete($id) {
        if ($this->Phone->delete($id)) {
            $message = 'Deleted';
        } else {
            $message = 'Error';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }
}