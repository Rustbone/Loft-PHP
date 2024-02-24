<?php
namespace App\Controller;

use App\Model\MessageModel;
use Base\AbstractController;

class Api extends AbstractController
{
    public function getUserMessages()
    {
        $userId = (int) $_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->response(['error' => 'no_user_id']);
        }
        $messages = MessageModel::getUserMessages($userId, 20);
        if (!$messages) {
            return $this->response(['error' => 'no_messages']);
        }

        $data = array_map(function (MessageModel $message) {
            return $message->getData();
        }, $messages);

        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}