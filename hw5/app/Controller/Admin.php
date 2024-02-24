<?php
namespace App\Controller;

use App\Model\MessageModel;
use Base\AbstractController;

class Admin extends AbstractController
{
    public function preDispatch()
    {
      
        parent::preDispatch();
        if(!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/');
        }
    }

    public function deleteMessage()
    {
        $messageId = (int) $_GET['id'];
        MessageModel::deleteMessage($messageId);
        $this->redirect('/blog');
    }
}