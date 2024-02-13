<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RdKafka\Producer;
use RdKafka\Conf;

class KafkaController extends Controller
{
    public function produceMessage()
    {
        // Создаем конфигурацию Kafka
        $conf = new Conf();
        $conf->set('metadata.broker.list', 'kafka:9092');

        // Создаем производителя
        $producer = new Producer($conf);

        // Указываем тему, в которую будем отправлять сообщения
        $topic = $producer->newTopic("test-topic");

        // Отправляем сообщение в тему
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Hello, Kafka!");

        // Флушим сообщения в брокер
        $producer->poll(0);
        $producer->flush(10000); // 10 секунд таймаут на ожидание отправки сообщения

        return "Message sent to Kafka!";
    }

    public function consumeMessage()
    {
        // Создаем конфигурацию Kafka
        $conf = new Conf();
        $conf->set('metadata.broker.list', 'kafka:9092');
        $conf->set('group.id', 'my-consumer-group');

        // Создаем консьюмера
        $consumer = new \RdKafka\KafkaConsumer($conf);

        // Подписываемся на тему
        $consumer->subscribe(["test-topic"]);

        // Читаем сообщения из очереди
        $message = $consumer->consume(120 * 1000); // 2 минуты таймаут на ожидание сообщения

        // Обрабатываем полученное сообщение
        if ($message) {
            return "Received message: " . $message->payload;
        } else {
            return "No message received from Kafka!";
        }
    }
}