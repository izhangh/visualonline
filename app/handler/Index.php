<?php
namespace handler;

use linger\framework\Application;
use linger\framework\Controller;

class Index extends Controller
{
    public function _init()
    {
        if (empty($_SESSION['uid'])) {
            $this->getResponse()->redirect('/login');
        }
        $config = Application::app()->getConfig();
        $this->getView()
            ->setScriptPath(\APP_PATH . 'app/view')
            ->assign('ws', 'ws://' . $config['ws_server']['host'] . ':' . $config['ws_server']['port']);
    }

    public function index()
    {
        $userId = $this->getRequest()
            ->getQuery('userId', $_SESSION['uid'], 'intval');

        $this->getView()
            ->assign('userId', $userId)
            ->display('index/index.phtml');
    }

    public function mobile()
    {
        $this->getView()
            ->display('index/mobile.phtml');
    }
}