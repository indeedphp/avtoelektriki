<?php

namespace App\Http\Telegraph;

use DefStudio\Telegraph\Handlers\WebhookHandler;
// use DefStudio\Telegraph\Facades\Telegraph;
// use DefStudio\Telegraph\Keyboard\ReplyButton;
// use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\Button;
use Illuminate\Support\Facades\Storage;
use App\Models\Draft_post;
use App\Models\Create_post;
// use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\UserData;

class Handler extends WebhookHandler
{
    // ------------------------------------------------------------------------------------------------------------------------------

    public function start()  // метод вызывется при входе в бота первый раз, а так же из меню по команде start
    {
        $id_user = $this->message->from()->id();  // получаем ид телеграмм пользователя
        $user_name = $this->message->from()->firstName();  // получаем из телеграмма имя
        $create_post = Create_post::where('id_user', $id_user)->first(); // получаем черновик из базы

        if ($create_post !== null)
            $create_post->delete();  // подчищаем черновик если есть незавершенный пост
        $user_data = User::where('telegram', $id_user)->first(); // получаем пользователя
        if ($user_data == null) {    // если пользователя нет то создаем
            $email = Str::password(10, true, true, false, false);
            $password = Str::password(9, true, true, false, false);
            $user = User::create(['telegram' => $id_user, 'email' => $email, 'password' => $password, 'name' => $user_name])->first();
            UserData::create(['user_id' => $user->id])->first(); // под таблицу данных юзера тоже создаем запись
        }
        $this->chat  // выводим кнопки в бота
            ->message('Бот сайта "Автоэлектрики" приветствует вас! Все команды бота в кнопке "меню" внизу экрана')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Ссылка на сайт "Автоэлектрики"')->action('feedback_1')->param('value', '1'),  // ответ в методе feedback_1
                    Button::make('Вход на сайт через одноразовую ссылку')->action('feedback_1')->param('value', '4'),
                    Button::make('Получить логин и пароль от сайта')->action('feedback_1')->param('value', value: '2'),
                    Button::make('Создать пост без регистрации')->action('feedback_1')->param('value', '3'),
                ])
            )->send();
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    public function feedback_1()  // обрабатываем команды от кнопок команды start
    {
        $value_button = $this->data->get('value');  // получаем значения от кнопок из бота
        $chat_id = $this->chat->chat_id;
        $user_data = User::where('telegram',  $chat_id)->first();

        if ($value_button == 1)  // выдаем простую ссылку на сайт 
            $this->chat->html('Ссылка на сайт ' . url('/'))->send();

        if ($value_button == 2) {  // создаем новый пароль от сайта
            $password = Str::password(9, true, true, false, false);
            $password_hash = Hash::make($password);
            $user_data->update(["password" => $password_hash]);

            $this->chat->html("Ваш логин $user_data->email и пароль $password")->send();
        }

        if ($value_button == 3) {  // создаем название поста
            DB::table('create_posts')
                ->where('id_user', $chat_id)
                ->delete();
            Create_post::create(['id_user' => $chat_id, 'step' => '1'])->first();
            $this->chat->html('Напишите название поста (максимум 250 символов), например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000г троит" и отправьте.')->send();
        }

        if ($value_button == 4) { // создаем одноразовую ссылку для входа на сайт
            $token = Str::ulid();
            $token_hash = Hash::make($token);

            User::where('id', $user_data->id)
                ->update([
                    "token" => $token_hash
                ]);
            $this->chat->html('Одноразовая ссылка для входа, никому не передавайте её! ' . url('/') . '/login_token?login=' . $user_data->email . '&token=' . $token)->withoutPreview()->send();
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    protected function handleChatMessage($text): void  // метод приема всех сообщений от бота настроен для сортировки сообщения, фото, ютуб ссылки
    {
        info($this->message);
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        $photo_no = empty($this->message->photos()->toArray());  // есть ли фотки в сообщении
        $count_vol = count($this->message->toArray());   // по обьему массива определяем текстовое сообщение
        if ($create_post == null) {  // если просто отправлено сообщение вне команд и пустой черновик бота
            $this->reply("Выберите команду для бота в синем меню внизу");
        } else {
            if ($create_post->vid_step == '1' && $photo_no == true) {  // если установлен шаг 1 создания видео из ютуба в посте
                $this->video_create(); // сохраняем видео с ютуб через метод
            } else if ($create_post->vid_step == '2' && $photo_no == true) { // если установлен шаг 2 создания видео из ютуба в посте
                $this->video_text_create(); // сохраняем описание видео с ютуб через метод
            } else {
                switch ($create_post->step) {
                    case 1:  // первый шаг создание названия поста
                        if ($photo_no == true && $count_vol == 9) { // определяем точно ли текстовое сообщение
                            $this->name_post_create();  // отправляем создавать название поста
                        } else {
                            $this->chat->html('<i>Неправильное действие1</i>')->send();
                        }
                        break;
                    case 2:  // эти шаги приводят к сохранению фото
                    case 5:
                    case 8:
                    case 11:
                    case 14:
                        if ($photo_no == false) {
                            $this->foto_create();
                        } else {
                            $this->chat->html('<i>Жду фото</i>')->send();
                        }
                        break;
                    case 3:  // эти шаги приводят к сохранению текста
                    case 6:
                    case 9:
                    case 12:
                    case 15:
                        if ($photo_no == true && $count_vol == 9) {
                            $this->text_post_create();
                        } else {
                            $this->chat->html('<i>Жду текст</i>')->send();
                        }
                        break;
                    default:
                        $this->chat->html('<i>Неправильное действие4</i>')->send();
                }
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    protected function video_text_create() // создаем текст под видео в посте
    {
        $id_user = $this->message->from()->id();
        $text = $this->message->text();
        $create_post = Create_post::where('id_user', $id_user)->first();

        if (mb_strlen($text) > 2000) $this->reply("Текст слишком длинный, сделайте не более 2000 символов");
        else {
            DB::table('create_posts')
                ->where('id_user', $id_user)
                ->update(['text_video' => $text, 'vid_step' => '3']);

            return $this->chat
                ->message('Текст под видео сохранен. Выберите вариант с помощью кнопок, просмотр будущего поста тут ' . url('/') . '/draft_post_bot/' . $create_post->id)
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Дописать еще блок с фото и текстом')->action('feedback_2')->param('value', '1'),
                        Button::make('Сохранить в черновике(доступен в кабинете)')->action('feedback_2')->param('value', value: '3'),
                        Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                    ])
                )->withoutPreview()->send();
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------


    protected function video_create() // создаем id youtube видео, для видео в посте
    {
        $id_user = $this->message->from()->id();
        $text = $this->message->text();
        $text = trim($text);

        if (mb_strlen($text) > 100) $this->reply("Ссылка на видео слишком длинная, вставте стандартную ссылку");
        else {
            if (strstr($text, 'https://youtu.be') != null || strstr($text, 'https://www.youtube') != null) {
                $pattern = '#(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})#';
                preg_match($pattern, $text, $matches);
                $video_id_youtube = isset($matches[1]) ? $matches[1] : null;

                DB::table('create_posts')
                    ->where('id_user', $id_user)
                    ->update(['id_youtube' => $video_id_youtube, 'vid_step' => '2']);

                return  $this->reply("Ссылка на ютуб видео сохранена, напишите о чем видео");
            } else {
                // return  $this->reply("Ссылка на видео не с ютуб, вставте стандартную ссылку ютуб");
                return  $this->chat->html("<b>Ссылка на видео не с ютуб, вставте стандартную ссылку ютуб</b>")->send();  //отправляем html
            }
        }
    }

    // ------------------------------------------------------------------------------------------------------------------------------

    protected function name_post_create() // создаем название поста
    {
        $id_user = $this->message->from()->id();
        $text = $this->message->text();
        $user_name = $this->message->from()->firstName();
        if (mb_strlen($text) > 250) $this->reply("Название поста слишком длинное, сделайте на более 250 символов");
        else {
            DB::table('create_posts')
                ->where('id_user', $id_user)
                ->update(['user_name' => $user_name, 'name_post' => $text, 'step' => '2']);

            $this->reply("Название сохранено. Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен");
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    protected function foto_create() // скачиваем, создаем название, сохраняем фото
    {
        $id_user = $this->message->from()->id();
        $user_data = User::where('telegram', $id_user)->first();  // получаем пользователя
        $photo = $this->message->photos()->toArray();  // получаем  в массив инфу о фото в с разными вариантами размеров
        $data = count($photo) - 1;   // считаем количество элементов массива
        $id_foto = $photo[$data]['id'];  // берем последнее айди фото из массива
        $name_foto = $user_data->id . '-' . time() . '.jpg';

        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post->url_foto_1 == null) { // в зависимости от заполнения мнеяем ячейку для фото в базе
            $url_foto = 'url_foto_1';
            $step = '3';
        } else {
            if ($create_post->url_foto_2 == null) {
                $url_foto = 'url_foto_2';
                $step = '6';
            } else {
                if ($create_post->url_foto_3 == null) {
                    $url_foto = 'url_foto_3';
                    $step = '9';
                } else {
                    if ($create_post->url_foto_4 == null) {
                        $url_foto = 'url_foto_4';
                        $step = '12';
                    } else {
                        $url_foto = 'url_foto_5';
                        $step = '15';
                    }
                }
            }
        }

        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update([$url_foto => 'storage/app/bot/images' . '/' . $name_foto, 'step' => $step]);
        $this->reply("Фото сохранено. Опишите фото или расскажите о машине, ее проблеме, неисправности и т.д.");

        sleep(5); // пауза между запросами и для тяжелых фото
        $this->bot->store($id_foto, Storage::path('bot/images'), $name_foto);  // сохраняем на локалке,
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    protected function text_post_create() // создаем текст поста в зависимости от шага
    {
        $message = $this->message->toArray();
        $text = $this->message->text();
        $id_user = $this->message->from()->id();

        if (mb_strlen($text) > 2000) $this->reply("Текст слишком длинный, сделайте не более 2000 символов");
        else {

            $create_post = Create_post::where('id_user', $id_user)->first();
            if ($create_post->text_post_1 == null) {  // в зависимости от заполнения мнеяем ячейку для текста в базе
                $text_post = 'text_post_1';
                $step = '4';
            } else {
                if ($create_post->text_post_2 == null) {
                    $text_post = 'text_post_2';
                    $step = '7';
                } else {
                    if ($create_post->text_post_3 == null) {
                        $text_post = 'text_post_3';
                        $step = '10';
                    } else {
                        if ($create_post->text_post_4 == null) {
                            $text_post = 'text_post_4';
                            $step = '13';
                        } else {
                            $text_post = 'text_post_5';
                            $step = '16';
                        }
                    }
                }
            }

            DB::table('create_posts')
                ->where('id_user', $id_user)
                ->update([$text_post => $text, 'step' => $step]);


            if ($step == 16 && $create_post->vid_step == 3) {  // выдаем в бот кнопки
                return $this->chat
                    ->message('Текст сохранен. Выберите вариант с помощью кнопок, просмотр будущего поста тут ' . url('/') . '/draft_post_bot/' . $create_post->id)
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Сохранить в черновике(доступен в кабинете)')->action('feedback_2')->param('value', value: '3'),
                            Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                        ])
                    )->withoutPreview()->send();
            } else if ($step == 16 && $create_post->vid_step != 3) {  // выдаем в бот кнопки
                return  $this->chat
                    ->message('Текст сохранен. Выберите вариант с помощью кнопок, просмотр будущего поста тут ' . url('/') . '/draft_post_bot/' . $create_post->id)
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Вставить видео с ютуба')->action('feedback_2')->param('value', '4'),
                            Button::make('Сохранить в черновике(доступен в кабинете)')->action('feedback_2')->param('value', value: '3'),
                            Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                        ])
                    )->withoutPreview()->send();
            } else if ($create_post->vid_step == 3 && $step <= 15) { // если ютуб видео сохранено
                return $this->chat
                    ->message('Текст сохранен. Выберите вариант с помощью кнопок, просмотр будущего поста тут ' . url('/') . '/draft_post_bot/' . $create_post->id)
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Дописать еще блок с фото и текстом')->action('feedback_2')->param('value', '1'),
                            Button::make('Сохранить в черновике(доступен в кабинете)')->action('feedback_2')->param('value', value: '3'),
                            Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                        ])
                    )->withoutPreview()->send();
            } else {  // выдаем в бот кнопки
                return $this->chat
                    ->message('Текст сохранен. Выберите вариант с помощью кнопок, просмотр будущего поста тут ' . url('/') . '/draft_post_bot/' . $create_post->id)
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Дописать еще блок с фото и текстом')->action('feedback_2')->param('value', '1'),
                            Button::make('Вставить видео с ютуба')->action('feedback_2')->param('value', '4'),
                            Button::make('Сохранить в черновике(доступен в кабинете)')->action('feedback_2')->param('value', value: '3'),
                            Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                        ])
                    )->withoutPreview()->send();
            }
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    public function feedback_2() // получаем запросы от кнопок из text_post_create()
    {
        $chat_id = $this->chat->chat_id;
        $user_data = User::where('telegram', $chat_id)->first();
        $value_button = $this->data->get('value');
        $create_post = Create_post::where('id_user', $chat_id)->first();

        if ($create_post->step == '4') { // добавляем шаги в базу
            $step = '5';
        } else {
            if ($create_post->step == '7') {
                $step = '8';
            } else {
                if ($create_post->step == '10') {
                    $step = '11';
                } else {
                    $step = '14';
                }
            }
        }

        if ($value_button == '1') {   // предлагаем в боте закинуть фото
            DB::table('create_posts')
                ->where('id_user', $chat_id)
                ->update(['step' => $step]);
            $this->chat->html("Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен2")->send();
        }

        if ($value_button == '2') {  // сохраняем пост для ленты постов
            $date = date('Y-m-d H:i:s');
            $id = DB::table('posts')->insertGetId([
                'created_at' => $date,
                'updated_at' => $date,
                'user_name' => $user_data->name,
                'name_post' => $create_post->name_post,
                'id_user' => $user_data->id,
                'text_post' => $create_post->text_post_1,
                'url_foto' => $create_post->url_foto_1,
                'text_post_2' => $create_post->text_post_2,
                'url_foto_2' => $create_post->url_foto_2,
                'text_post_3' => $create_post->text_post_3,
                'url_foto_3' => $create_post->url_foto_3,
                'text_post_4' => $create_post->text_post_4,
                'url_foto_4' => $create_post->url_foto_4,
                'text_post_5' => $create_post->text_post_5,
                'url_foto_5' => $create_post->url_foto_5,
                'bot' =>  '1',
                'stuff' => $create_post->id_youtube,
                'date' => $create_post->text_video,

            ]);

            $create_post->delete();  // удаляем пост из черновика бота после сохранения его в таблице пост

            $this->chat->html("Пост сохранен под номером $id и после проверки появится на сайте")->send();
        }

        if ($value_button == '3') {  // переносим пост в черновик кабинета
            $draft_post = Draft_post::where('id_user', $user_data->id,)->first();
            if ($draft_post != null) $draft_post->delete();

            $id = DB::table('draft_posts')->insertGetId([
                'user_name' => $user_data->name,
                'name_post' => $create_post->name_post,
                'id_user' => $user_data->id,
                'text_post' => $create_post->text_post_1,
                'url_foto' => $create_post->url_foto_1,
                'text_post_2' => $create_post->text_post_2,
                'url_foto_2' => $create_post->url_foto_2,
                'text_post_3' => $create_post->text_post_3,
                'url_foto_3' => $create_post->url_foto_3,
                'text_post_4' => $create_post->text_post_4,
                'url_foto_4' => $create_post->url_foto_4,
                'text_post_5' => $create_post->text_post_5,
                'url_foto_5' => $create_post->url_foto_5,
                'stuff' => $create_post->id_youtube,
                'date' => $create_post->text_video,
            ]);
        }

        if ($value_button == '4') {   // предлагаем вставить ссылку на ютуб видео
            DB::table('create_posts')
                ->where('id_user', $chat_id)
                ->update(['vid_step' => '1']);
            $this->chat->html("Вставте ссылку на ютуб видео")->send();
        }
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    public function new_post()  // идем через команду /new_post
    {
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post !== null)
            $create_post->delete();
        Create_post::create(['id_user' => $id_user, 'step' => '1'])->first();
        $this->chat->html('Напишите название поста (максимум 250 символов), например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000 г троит" и отправьте2.')->send();
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    public function delete_post() // идем через команду /delete_post
    {
        $id_user = $this->message->from()->id();
        $cr_post = Create_post::where('id_user', $id_user)->first();
        if ($cr_post !== null)
            $cr_post->delete();
        $this->chat->html("Пост удален. Можете выбрать команды в меню")->send();
    }
    // ------------------------------------------------------------------------------------------------------------------------------

    public function new_psassword() // идем через команду /new_psassword
    {
        $id_user = $this->message->from()->id();
        $user_data = User::where('telegram',  $id_user)->first();
        $password = Str::password(9, true, true, false, false);
        $password_hash = Hash::make($password);
        $user_data->update(["password" => $password_hash]);

        $this->chat->html("Ваш логин $user_data->email и пароль $password")->send();
    }
    // ------------------------------------------------------------------------------------------------------------------------------
    protected function handleUnknownCommand($text): void //  идем через неизвестную команду
    {
        $this->chat->html("Нет такой команды, посмотрите список внизу в синем меню")->send();
    }
}



// https://www.youtube.com/watch?v=F3bBTs-lka0

// [2025-03-18 09:52:49] local.INFO: array (
//     'id' => 1147,
//     'date' => '2025-03-18T09:52:49.000000Z',
//     'text' => 'https://www.youtube.com/watch?v=F3bBTs-lka0',
//     'protected' => false,
//     'from' => 
//     array (
//       'id' => 1605592406,
//       'is_bot' => false,
//       'first_name' => 'Сергей',
//       'last_name' => '',
//       'username' => 'Avtosega',
//       'language_code' => 'ru',
//       'is_premium' => false,
//     ),
//     'chat' => 
//     array (
//       'id' => '1605592406',
//       'type' => 'private',
//       'title' => 'Avtosega',
//     ),
//     'photos' => 
//     array (
//     ),
//     'new_chat_members' => 
//     array (
//     ),
//     'entities' => 
//     array (
//       0 => 
//       array (
//         'type' => 'url',
//         'offset' => 0,
//         'length' => 43,
//       ),
//     ),
//   )  