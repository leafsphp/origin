<?php

namespace App\Controllers;

/**
 * This is the base controller for your Leaf MVC Project.
 * You can initialize packages or define methods here to use
 * them across all your other controllers which extend this one.
 */
class Controller extends \Leaf\Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->setupLogedUser();

    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function setupLogedUser()
    {
        if(auth()->id()){
            $this->loggedUser = auth()->user();
            unset($this->loggedUser['password']);
        }
    
    }

    protected function renderPage($title, $view, $data = [])
    {
        $this->title = $title;
        return render($view, array_merge($this->data, $data));
    }

    protected function jsonResponse($state, $successMsg, $errorMsg, $redirect = null)
    {
        if ($state) {
            $this->status = true;
            $this->message = $successMsg;
            $this->redirect = $redirect;
        } else {
            $this->status = false;
            $this->message = $errorMsg;
        }
        return response()->json($this->data);
    }

    protected function jsonError($message)
    {
        $this->status = false;
        $this->message = $message;
        return response()->json($this->data);
    }

    protected function jsonSuccess($message)
    {
        $this->status = true;
        $this->message = $message;
        return response()->json($this->data);
    }

    protected function jsonException($e)
    {
        $this->status = false;
        $this->message = "An unexpected error occurred";

        if (getenv('app_debug') != 'false') {
            $this->debug = [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ];
        }
        return response()->json($this->data);
    }
}
