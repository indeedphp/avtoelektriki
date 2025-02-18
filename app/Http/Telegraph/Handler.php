<?php

namespace App\Http\Telegraph;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\Button;
use Illuminate\Support\Facades\Storage;
use App\Models\Create_post;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Handler extends WebhookHandler
{
    public function start()
    {
        $id_user = $this->message->from()->id();
        $user_name = $this->message->from()->firstName();
        info($id_user);
        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post !== null)
            $create_post->delete();  //  подчищаем базу если есть незавершенные посты
        $user_data = User::where('telegram', $id_user)->first();
        if ($user_data == null) {
            $email = Str::password(10, true, true, false, false);
            $password = Str::password(9, true, true, false, false);
            User::create(['telegram' => $id_user, 'email' => $email, 'password' => $password, 'name' => $user_name])->first();
        }
        $this->chat
            ->message('Бот сайта "Автоэлектрики" приветствует вас! Все команды бота в кноке "меню" внизу экрана')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Ссылка на сайт "Автоэлектрики"')->action('feedback_1')->param('value', '1'),
                    Button::make('Вход на сайт через одноразовую ссылку')->action('feedback_1')->param('value', '4'),
                    Button::make('Получить логин и пароль от сайта')->action('feedback_1')->param('value', value: '2'),
                    Button::make('Создать пост без регистрации')->action('feedback_1')->param('value', '3'),

                ])
            )->send();
    }

    public function feedback_1()
    {
        $value_button = $this->data->get('value');
        $chat_id = $this->chat->chat_id;
        info($chat_id);
        $user_data = User::where('telegram',  $chat_id)->first();
        if ($value_button == 1)
            $this->chat->html('Ссылка на сайт' . url('/'))->send();

        if ($value_button == 2) {  // создаем новый пароль от сайта
            $password = Str::password(9, true, true, false, false);
            $password_hash = Hash::make($password);
            $user_data->update(["password" => $password_hash]);

            $this->chat->html("Ваш логин $user_data->email и пароль $password")->send();
        }

        if ($value_button == 3) {
            DB::table('create_posts')
                ->where('id_user', $chat_id)
                ->delete();
            Create_post::create(['id_user' => $chat_id, 'step' => '1'])->first();
            $this->chat->html('Напишите название поста, например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000г троит" и отправьте.')->send();
        }

        if ($value_button == 4) { // создаем одноразовую ссылку для входа на сайт
            $token = Str::ulid();
            $token_hash = Hash::make($token);

            User::where('id', $user_data->id)
                ->update([
                    "token" => $token_hash
                ]);
            $this->chat->html('Одноразовая ссылка для входа, никому не передавайте её! ' . url('/') . '/login_token?email=' . $user_data->email . '&token=' . $token)->withoutPreview()->send();
        }
    }
    // ,  json_encode(['disable_web_page_preview' => true])
    protected function handleChatMessage($text): void  // метод сортирует сообщения, фото
    {
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        $photo_no = empty($this->message->photos()->toArray());
        $count_vol = count($this->message->toArray());
        if ($create_post == null) {
            $this->reply("Выберите команду для бота в синем меню внизу");
        } else {
            switch ($create_post->step) {
                case 1:
                    if ($photo_no == true && $count_vol == 9) {
                        $this->name_post_create();
                    } else {
                        $this->chat->html('<i>Неправильное действие1</i>')->send();
                    }
                    break;
                case 2:
                case 5:
                case 8:
                    if ($photo_no == false) {
                        $this->foto_create();
                    } else {
                        $this->chat->html('<i>Неправильное действие2</i>')->send();
                    }
                    break;
                case 3:
                case 6:
                case 9:
                    if ($photo_no == true && $count_vol == 9) {
                        $this->text_post_create();
                    } else {
                        $this->chat->html('<i>Неправильное действие3</i>')->send();
                    }
                    break;
                default:
                    $this->chat->html('<i>Неправильное действие4</i>')->send();
            }
        }
    }

    protected function name_post_create() // создаем название поста
    {
        $id_user = $this->message->from()->id();
        // $lang_user = $this->message->from()->languageCode();
        $text = $this->message->text();
        // $id_post = $this->message->id();
        // $date_post = time();
        $user_name = $this->message->from()->firstName();
        // info($this->message->toArray());
        // info($date_post);
        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update(['user_name' => $user_name, 'name_post' => $text, 'step' => '2']);

        $this->reply("Название сохранено. Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен");
    }

    protected function foto_create() // скачиваем, создаем имя, сохраняем фото
    {
        $id_user = $this->message->from()->id();
        $photo = $this->message->photos()->toArray();  // получаем  в массив инфу о фото в с разными вариантами размеров
        $data = count($photo) - 1;   // считаем количество элементов массива
        $id_foto = $photo[$data]['id'];  // берем последнее айди фото из массива
        $name_foto = $id_user . '-' . time() . '.jpg';

        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post->url_foto_1 == null) {
            $url_foto = 'url_foto_1';
            $step = '3';
        } else {
            if ($create_post->url_foto_2 == null) {
                $url_foto = 'url_foto_2';
                $step = '6';
            } else {
                $url_foto = 'url_foto_3';
                $step = '9';
            }
        }

        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update([$url_foto => 'storage/app/bot/images' . '/' . $name_foto, 'step' => $step]);
        $this->reply("Фото сохранено. Опишите фото или расскажите о машине, ее проблеме, неисправности и т.д.");

        sleep(5); // пауза между запросами и для тяжелых фото
        $this->bot->store($id_foto, Storage::path('bot/images'), $name_foto);  // сохраняем на локалке,
    }

    protected function text_post_create() // создаем текст поста
    {
        $message = $this->message->toArray();
        $text = $this->message->text();
        $id_user = $this->message->from()->id();

        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post->text_post_1 == null) {
            $text_post = 'text_post_1';
            $step = '4';
        } else {
            if ($create_post->text_post_2 == null) {
                $text_post = 'text_post_2';
                $step = '7';
            } else {
                $text_post = 'text_post_3';
                $step = '10';
            }
        }

        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update([$text_post => $text, 'step' => $step]);

        if ($step == 10) {
            $this->chat
                ->message('Выберите вариант с помощью кнопок')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                    ])
                )->send();
        } else {
            $this->chat
                ->message('Выберите вариант с помощью кнопок')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Дописать еще блок с фото и текстом"')->action('feedback_2')->param('value', '1'),
                        Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                    ])
                )->send();
        }
    }

    public function feedback_2() // получаем запросы от кнопок из text_post_create()
    {
        $chat_id = $this->chat->chat_id;  
        $user_data = User::where('telegram', $chat_id)->first();
        info($chat_id);
        $chat_data = $this->chat->toArray();
        $value_button = $this->data->get('value');
        $create_post = Create_post::where('id_user', $chat_id)->first();
        if ($create_post->step == '4') {
            $step = '5';
        } else {
            $step = '8';
        }
        if ($value_button == '1') {
            DB::table('create_posts')
                ->where('id_user', $chat_id)
                ->update(['step' => $step]);
            $this->chat->html("Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен2")->send();
        }

        if ($value_button == '2') {
            $date = date('Y-m-d H:i:s');
            $id = DB::table('posts')->insertGetId([
                'created_at' => $date,
                'updated_at' => $date,
                // 'date' => $create_post->date,
                'user_name' => $user_data->name,
                'name_post' => $create_post->name_post,
                'id_user' => $user_data->id,   
                // 'id_post' => $create_post->id_post,
                'text_post' => $create_post->text_post_1,
                'url_foto' => $create_post->url_foto_1,
                'text_post_2' => $create_post->text_post_2,
                'url_foto_2' => $create_post->url_foto_2,
                'text_post_3' => $create_post->text_post_3,
                'url_foto_3' => $create_post->url_foto_3,
                // 'stuff' =>  '1',
            ]);

            $create_post->delete();

            $this->chat->html("Пост сохранен под номером $id и после проверки появится на сайте")->send();
        }
    }

    public function new_post()  // идем через команду /new_post
    {
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post !== null)
            $create_post->delete();
        Create_post::create(['id_user' => $id_user, 'step' => '1'])->first();
        $this->chat->html('Напишите название поста, например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000 г троит" и отправьте2.')->send();
    }

    public function delete_post()
    {
        $id_user = $this->message->from()->id();
        $cr_post = Create_post::where('id_user', $id_user)->first();
        if ($cr_post !== null)
            $cr_post->delete();
        $this->chat->html("Пост удален. Можете выбрать команды в меню")->send();
    }

    public function new_psassword()
    {
        $id_user = $this->message->from()->id();
        $user_data = User::where('telegram',  $id_user)->first();
        $password = Str::password(9, true, true, false, false);
        $password_hash = Hash::make($password);
        $user_data->update(["password" => $password_hash]);

        $this->chat->html("Ваш логин $user_data->email и пароль $password")->send();
    }

    protected function handleUnknownCommand($text): void
    {
        $this->chat->html("Нет такой команды, посмотрите список внизу в синем меню")->send();
    }
}
