<?php
App::uses('HttpSocket', 'Network/Http');
class ClientController extends AppController {
	public $components = array('Security', 'RequestHandler');
	
	public function index(){
		
	}

	public function request_index(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones.json';
		// die(var_dump($link));
		
		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_view($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->get($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_edit($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$data['Phone']['name'] = 'Updated Phone Name';
		$data['Phone']['manufacturer'] = 'Updated Phone  Manufacturer';
		$data['Phone']['name'] = 'Updated Phone  Description';
		$response = $httpSocket->put($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_add(){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$data['Phone']['name'] = 'New Phone';
		$data['Phone']['manufacturer'] = 'New Phone Manufacturer';
		$data['Phone']['name'] = 'New Phone Description';
		$response = $httpSocket->post($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
	
	public function request_delete($id){
	
		// remotely post the information to the server
		$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones/'.$id.'.json';

		$data = null;
		$httpSocket = new HttpSocket();
		$response = $httpSocket->delete($link, $data );
		$this->set('response_code', $response->code);
		$this->set('response_body', $response->body);
		
		$this -> render('/Client/request_response');
	}
}