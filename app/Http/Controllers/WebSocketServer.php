<?php

namespace App\Http\Controllers;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use App\Http\Controllers\MessageController;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Сохраняем соединение в список клиентов
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    
        // Получаем данные от клиента
        $conn->on('message', function ($data) use ($conn) {
            $message = json_decode($data, true);
    
            // Проверяем, что пришло сообщение с типом 'recepient_id'
            if ($message['type'] === 'recepient_id') {
                $conn->recepientId = $message['recepientId'];
                // Делаем что-то с recepientId, например, сохраняем его
            }
        });
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        
        // Распаковываем JSON-строку в ассоциативный массив
        $data = json_decode($msg, true);

        // Проверяем, что сообщение имеет тип 'chat_message' и содержит 'recipient_id'
        if (isset($data['type']) && $data['type'] === 'chat_message' && isset($data['recipient_id'])) {
            $recipientId = $data['recipient_id'];

            // Отправляем сообщение только конкретному клиенту с recipientId
            foreach ($this->clients as $client) {
                if ($client !== $from && $client->resourceId === $recipientId) {
                    $client->send($msg);
                    $this->saveMessageToDatabase($data);
                    
                    break; // Отправляем сообщение только одному клиенту, прерываем цикл
                }
            }
        }
    }
    protected function saveMessageToDatabase($data)
    {
        MessageController::saveMessage($data);
    }
    public function onClose(ConnectionInterface $conn)
    {
        // Удаляем соединение из списка клиентов
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}