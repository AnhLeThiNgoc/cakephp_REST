<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');
App::uses('Post', 'Model');

class ApiController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User','Post','Comment', 'Category');

    public function process($requestName) {
        $this->layout = null;

        if($requestName == 'user_register'){
            if (!$this->request->is('post')) {
                $this->set('result', $this->apiResponse($this->apiFailed('Invalid request type! Must be POST.')));
                return;
            }
        }

        // Get request data
        // Sample post data
        // array("request_data" => {"name":"Long"});

        if (array_key_exists('request_data', $this->request->data)) {
            $requestData = $this->request->data['request_data'];
        } else {
            $requestData = null;
        }

        // Process data
        $result = $this->apiProcess($requestName, $requestData, $_FILES);
        
        // Response to client
        $this->set('result', $this->apiResponse($result));
    }

    protected function apiDecrypt($requestData) {
        return json_decode($requestData, true);
    }

    protected function apiEncrypt($responseData) {
        return json_encode($responseData);
    }

    protected function apiProcess($requestName, $requestData, $files) {
        // $requestData = $this->apiEncrypt($requestData);
        // $requestData = $this->apiDecrypt($requestData);
        if($this->request->is('post')){
            $requestData = $this->apiDecrypt($requestData);
        } else {
            $requestData = $this->apiEncrypt($requestData);
        }

        if (empty($requestData)) {
            return $this->apiFailed('Cannot decrypt data');
        }

        if (!empty($files)) {
            foreach ($files as $file) {
                $tmpName = $file['tmp_name'];
                move_uploaded_file($tmpName, 'C:\xampp\htdocs\cakephp_2_4\app\webroot\upload\\' . $file['name']);
            }
            $requestData['files'] = $files;
        }
        // var_dump($requestData);
        // die();
        switch ($requestName) {
        case 'post_getall':
            return $this->processPostGetAll($requestData);
        case 'post_view':
            return $this->processPostView($requestData);
        case 'post_create':
            return $this->processPostCreate($requestData);
        case 'post_edit':
            return $this->processPostEdit($requestData);
        case 'post_delete':
            return $this->processPostDelete($requestData);
        case 'comment_getall':
            return $this->processCommentGetAll($requestData);
        case 'comment_view':
            return $this->processPostView($requestData);
        case 'comment_create':
            return $this->processPostCreate($requestData);
        case 'comment_edit':
            return $this->processPostEdit($requestData);
        case 'comment_delete':
            return $this->processPostDelete($requestData);
        case 'category_getall':
            return $this->processCategoryGetAll($requestData);
        case 'category_view':
            return $this->processPostView($requestData);
        case 'category_create':
            return $this->processPostCreate($requestData);
        case 'category_edit':
            return $this->processPostEdit($requestData);
        case 'category_delete':
            return $this->processPostDelete($requestData);
        }

        return $this->apiFailed('Unknown request name');
    }

    protected function apiFailed($message) {
        return array('status' => false, 'message' => $message);
    }

    protected function apiResponse($responseData) {
        return $this->apiEncrypt($responseData);
    }

    protected function processPostGetAll($requestData){
        return array('status' => true, 'posts' => $this->Post->find('all'));
    }

    protected function processCommentGetAll($requestData){
        return array('status' => true, 'comments' => $this->Comment->find('all'));
    }

    protected function processCategoryGetAll($requestData){
        return array('status' => true, 'comments' => $this->Category->find('all'));
    }
    protected function processPostView($requestData) {
        // $id = $requestData['id'];
        $id = $this->request->query['id'];
        if(empty($id)){
            return $this->apiFailed("Invalid Post");
        }
        $post = $this->Post->findById($id);
        if($post){
            return array('status' => true, 'post' => $post);
        }
        return $this->apiFailed("Invalid post");
    }

    protected function processPostCreate($requestData){
        // var_dump($requestData);
        // die();
        // die(var_dump($requestData));
        // die(var_dump($requestData['files']['image']['name']));
        // $accessToken = $requestData['access_token'];
        // $user = $this->User->findByAccessToken($accessToken);
        // if(empty($user)) {
        //     return $this->apiFailed('Invalid Post');
        // }

        // insert fields in post
        // $requestData['Post']['user_id'] = $user['User']['id'];
        // $requestData['Post']['title'] = $requestData['title'];
        // $requestData['Post']['body'] = $requestData['body'];

        // $requestData['Post']['link'] = $requestData['files']['image']['name'];
   
        // $requestData['Post']['category_id'] = $requestData['category_id'];
        // $requestData['Post']['like'] = 0;

        //save data
        $this->Post->save($requestData);
        return array('status' => true, 'post_id' => $this->Post->id);
    }

    protected function processPostEdit($requestData){
        // die(var_dump($requestData));
        $accessToken = $requestData['access_token'];
        
        $user = $this->User->findByAccessToken($accessToken);
        if(empty($user)){
            return $this->apiFailed("You are not login");
        }
        // $id = $this->request->query['id'];
        $id = $requestData['id'];
        if(empty($id)){
            return $this->apiFailed("Invalid Post");
        }

        $requestData['Post']['user_id'] = $user['User']['id'];
        $requestData['Post']['title'] = $requestData['title'];
        $requestData['Post']['body'] = $requestData['body'];
        $requestData['Post']['link'] = $requestData['link'];
        $requestData['Post']['category_id'] = $requestData['category_id'];
        $requestData['Post']['like'] = $requestData['like'];


        // $this->Post->saveField('id', $id);
        // $this->Post->saveField('title', $requestData['title']);
        // $this->Post->saveField('body', $requestData['body']);
        // $this->Post->saveField('link', $requestData['link']);
        // $this->Post->saveField('category_id', $requestData['category_id']);
        // $this->Post->saveField('like', $requestData['like']);

        $post = $this->Post->save($requestData);
        if($post){
            return array('status' => true, 'post_id' => $this->Post->id);
        }
        return $this->apiFailed("Invalid post");
    }

    protected function processPostDelete($requestData) {
        // $accessToken = $this->request->query['access_token'];
        $accessToken = $requestData['access_token'];
     //    var_dump($requestData);
     //    die();
        // die(var_dump($requestData['id']));
        
        $user = $this->User->findByAccessToken($accessToken);
        if(empty($user)){
            return $this->apiFailed("You are not login");
        }

        // $id = $this->request->query['id'];
        $id = $requestData['id'];
        if($id == 0){
            return $this->apiFailed("Invalid Post");
        }
        $aa = $this->Post->findById($id);
        // die(var_dump($user['User']['id']));
        // die(var_dump($aa));
        if($user['User']['id'] == $aa['Post']['user_id']) {
            // die(var_dump("delete"));
            $post = $this->Post->delete($id);
            return array('status' => true, 'message' => "Post Deleted");
        }

        return $this->apiFailed("Invalid post");
    }

}