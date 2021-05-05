<?php

namespace App\Http\Controllers;

use App\Traits\MakeComponents;
use App\Traits\RequestTrait;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    use RequestTrait;
    use MakeComponents;

    public function webhook()
    {
        return $this->apiRequest('setWebhook', [
            'url' => url(route('webhook')),

        ]) ? ['success'] : ['something wrong'];
    }


    public function index()
    {
        $result = json_decode(file_get_contents('php://input'));
        $action = $result->message->text;
        $userId = $result->message->from->id;


        if ($action == '/start') {
            $text = "Please choose the city that can see time";
            $option = [
                ['New York', 'Los Angeles'],
                ['Texas', 'California']
            ];
            [
                'chat_id' => $userId,
                'text' => $text,
                'reply_markup' => $this->keyBoardBtn($option)
            ];
            $this->apiRequest{'sendMessage'};


        }
    }
}
