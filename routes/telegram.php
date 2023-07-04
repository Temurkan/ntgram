<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use SergiX44\Nutgram\Conversations\Conversation;
use SergiX44\Nutgram\Conversations\InlineMenu;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Message\Message;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/
//
//

$bot->onCommand('start', function (Nutgram $bot) {
    $kb = ['reply_markup' =>
        ['keyboard' => [
            [
                ['text' => '🍴 Меню'],
            ],
            [
                ['text' => '🛍 Мои заказы'],
            ],
            [
                ['text' => '✍️ Оставить отзыв'],
                ['text' => '⚙️ Настройки'],
            ],
        ], 'resize_keyboard' => true]
    ];
    $bot->sendMessage("Выберите одно из следующих", $kb);
});

$bot->onText('🍴 Меню', function (Nutgram $bot) {

    $kb2 = ['reply_markup' =>
        ['keyboard' => [
            [
                ['text' => '📍 отправить геолокацию'],
                ['text' => '☎ отправить контакты','request_contact'=> true],
            ],
            [
                ['text' => '⬅ назад'],

            ],
        ], 'resize_keyboard' => true]
    ];

    $bot->sendMessage("Выберите", $kb2);
    $bot->answerCallbackQuery();
});



$bot->onText('📍 отправить геолокацию', function (Nutgram $bot) {

    $kb2 = ['reply_markup' =>
        ['keyboard' => [
                [
                    ['text' => 'Лаваш'],
                    ['text' => 'Бургер'],
                    ['text' => 'Картошка'],
                ],
                [
                    ['text' => 'Хот-доги'],
                    ['text' => 'Шаурма'],
                    ['text' => 'Напитки'],
                ],
                [
                    ['text' => '⬅ назад'],
                ],
        ], 'resize_keyboard' => true]
    ];

    $bot->sendMessage("Выберите", $kb2);
});

$bot->onText('Лаваш', function (Nutgram $bot) {

    // Send a photo to a specific user ***********************************************
    $photo = fopen('public/lavash.jpg', 'r+'); // open the file

    /** @var Message $message */
    $message = $bot->sendPhoto($photo, ['chat_id' => 814336975]); // pass the resource

    fclose($photo); // close the file

    $kb2 = ['reply_markup' =>
        ['keyboard' => [
            [
                ['text' => 'Лаваш с курицей'],
                ['text' => 'Лаваш острый с курицей'],
                ['text' => 'Лаваш с курицей и сыром'],
            ],
            [
                ['text' => 'Лаваш с говядиной'],
                ['text' => 'Лаваш острый с говядиной'],
                ['text' => 'Лаваш с курицей и говядиной'],
            ],
            [
                ['text' => '⬅ назад'],
            ],
        ], 'resize_keyboard' => true]
    ];
    $bot->sendMessage("Выберите", $kb2);
    $bot->run();
});

$bot->onText('⬅ назад', function (Nutgram $bot) {
    $kb = ['reply_markup' =>
        ['keyboard' => [
            [
                ['text' => '🍴 Меню'],
            ],
            [
                ['text' => '🛍 Мои заказы'],
            ],
            [
                ['text' => '✍️ Оставить отзыв'],
                ['text' => '⚙️ Настройки'],
            ],
        ], 'resize_keyboard' => true]
    ];
    $bot->sendMessage("Выберите одно из следующих ", $kb);

});

$bot->onChannelPost(function (Nutgram $bot){

    $msg_id = $bot->messageId();
    $bot->forwardMessage('814336975', '-1001907229718', $msg_id);
});

