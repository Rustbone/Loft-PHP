<?php
namespace hw5\Controller;

use hw5\Model\MessageModel.php as MessageModel;

class MessageController {
  public function sendMessage($text, $image) {
      if (!User::isLoggedIn()) {
          return "Пользователь не авторизован.";
      }

      $messageText = $_POST['message_text'];

      $attachedImage = $_FILES['attached_image'];

      $message = new MessageModel($messageText, $attachedImage);
      $message->save();

      return "Сообщение отправлено.";
  }

  public function showLatestMessages() {
    $messages = Message::getLatestMessages(20);

    foreach ($messages as $message) {
        $sender = User::getUserById($message->getSenderId());
        $message->setSenderName($sender->getName());
    }

    return view('latest_messages', ['messages' => $messages]);
}
}