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
        $conf->set('metadata.broker.list', 'localhost:9092');

        // Создаем производителя
        $producer = new Producer($conf);

        // Указываем тему, в которую будем отправлять сообщения
        $topic = $producer->newTopic("test-topic");

        // Отправляем сообщение в тему
        $result = $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Hello, Kafka!");

        // Проверяем результат отправки сообщения
        if ($result !== RD_KAFKA_RESP_ERR_NO_ERROR) {
            // Если произошла ошибка при отправке сообщения
            echo "Error sending message to Kafka: " . rd_kafka_err2str($result);
        } else {
            // Если сообщение успешно отправлено
            echo "Message sent to Kafka!";
        }

        // Флушим сообщения в брокер
        $producer->poll(0);
        $producer->flush(10000); // 10 секунд таймаут на ожидание отправки сообщения
    }

    public function consumeMessage()
    {

        // Создаем конфигурацию Kafka
        $conf = new Conf();
        $conf->set('metadata.broker.list', 'localhost:9092');
        $conf->set('group.id', 'my-consumer-group');
        
        $conf->set('auto.offset.reset', 'earliest');
        // Создаем консьюмера
        $consumer = new \RdKafka\KafkaConsumer($conf);
        
        // Подписываемся на тему
        $consumer->subscribe(["test-topic"]);
        // Бесконечный цикл чтения сообщений
        
        
        // Читаем сообщения из очереди
        $message = $consumer->consume(60    *1000); // Ожидание сообщения в течение 1 секунды
        //dd($message);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    echo "Received message: " . $message->payload . PHP_EOL;
                    break;
                case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                    echo "No more messages; will try again in 1 second." . PHP_EOL;
                    break;
                case RD_KAFKA_RESP_ERR__TIMED_OUT:
                    echo "Timed out waiting for messages; will try again in 1 second." . PHP_EOL;
                    break;
                default:
                    echo "Error: " . $message->errstr() . PHP_EOL;
                    break;
            }
        }
    
}