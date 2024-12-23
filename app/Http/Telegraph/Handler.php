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

class Handler extends WebhookHandler
{
    public function start()
    {
        $id_user = $this->message->from()->id();
        $cr_post = Create_post::where('id_user', $id_user)->first();
        if ($cr_post !== null)
            $cr_post->delete();  //  подчищаем базу если есть незавершенные посты
        $data = User::where('name', $id_user)->first();
        if ($data == null) {
            User::create(['name' => $id_user, 'email' => '1234@5678', 'password' => '12345678'])->first();
        }
        $this->chat
            ->message('Бот сайта "Автоэлектрики" приветствует вас!')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Попасть на сайт "Автоэлектрики11"')->action('feedback')->param('value', '1'),
                    Button::make('Создать пост без регистрации22')->action('feedback')->param('value', '2'),
                ])
            )->send();
    }

    public function post()
    {
        $id_user = $this->message->from()->id();
        $cr_post = Create_post::where('id_user', $id_user)->first();
        if ($cr_post !== null)
            $cr_post->delete();
        Create_post::create(['id_user' => $id_user, 'date' => '1'])->first();
        $this->chat->html('Напишите название поста, например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000 г троит" и отправьте.')->send();
    }

    public function bag()
    {
        $id_user = $this->message->from()->id();
        $cr_post = Create_post::where('id_user', $id_user)->first();
        if ($cr_post !== null)
            $cr_post->delete();
        $this->chat->html("Пост удален")->send();
        $this->start();
    }


    protected function handleChatMessage($text): void  // метод принимает сообщения, фото, но не команды типа "/start"
    {

        $id = $this->message->toArray();
        // file_put_contents('11.json', count($id));
        $id_user = $this->message->from()->id();
        $data = Create_post::where('id_user', $id_user)->first();
        $photo_no = empty($this->message->photos()->toArray());

        if ($data == null) {                        // если пост не начат а юзер вбивает текст
            $this->chat
                ->message('Бот сайта "Автоэлектрики" приветствует вас!')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Пройти на сайт "Автоэлектрики33"')->action('feedback')->param('value', '1'),
                        Button::make('Создать пост без регистрации44')->action('feedback')->param('value', '2'),
                    ])
                )->send();
            goto a;
        }
        if ($data->date == '1' && count($id) > 9) {  // по количеству элементов массива понимаем что это тектовое сообщение
            $this->chat->html("Неправильное действие")->send();  // отсекаем файлы, видео и пр.
            $this->post();
            goto a;
        }
        if ($data->date == '2') {  // значит юзер стал писать не нажав кнопку после прихода кнопок
            $this->chat->html("Неправильное действие ")->send();
            $id_post = $this->message->id();
            $user_name = $this->message->from()->firstName();
            $this->chat
                ->message("Название поста номер $id_post сохранено")
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make("$user_name жмите для вставки фото55")->action('feedback3')->param('value', "1"),
                        Button::make("$user_name или написать текст66")->action('feedback3')->param('value', "2"),
                    ])
                )->send();
            goto a;
        }

        if ($data->date == '4') {  // значит юзер стал писать не нажав кнопку после прихода кнопок
            $this->chat->html("Неправильное действие ")->send();
            $this->chat
            ->message('Фотография сохранена, выберите вариант')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Написать текст поста или описание фото99')->action('feedback5')->param('value', '1'),
                    Button::make('Завершить пост00')->action('feedback5')->param('value', '2'),
                ])
            )->send();
            goto a;
        }


        if ($data->id_user == $id_user && $data->name_post == null) {  // создание названия поста

            $id_post = $this->message->id();
            $user_name = $this->message->from()->firstName();
            DB::table('create_posts')
                ->where('id_user', $id_user)
                ->update(['user_name' => $user_name, 'name_post' => $text, 'id_post' => $id_post, 'date' => '2']);

            $this->chat
                ->message("Название поста номер $id_post сохранено")
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make("$user_name жмите для вставки фото55")->action('feedback3')->param('value', "1"),
                        Button::make("$user_name или написать текст66")->action('feedback3')->param('value', "2"),
                    ])
                )->send();
            goto a;
        }
        if ($data->date == '3' || $data->date == '5') {
            if ($data->id_user == $id_user && $data->name_post !== null && $data->text_post == null && $photo_no == true) {  // создание текста поста
                DB::table('create_posts')
                    ->where('id_user', $id_user)
                    ->update(['text_post' => $text]);

                $this->chat
                    ->message('Текст поста сохранен, вставте фото или завершите пост')
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Вставить фото77')->action('feedback4')->param('value', '1'),
                            Button::make('Завершить пост88')->action('feedback4')->param('value', '2'),

                        ])
                    )->send();
                goto a;
            }

            if ($data->id_user == $id_user && $data->name_post !== null && $data->url_foto == null && $photo_no == false) {  // скачка , создание имени, сохранение фото

                $photo = $this->message->photos()->toArray();  // получаем  в массив инфу о фото в с разными вариантами размеров
                $data = count($photo) - 1;   // считаем количество элементов массива
                $id_foto = $photo[$data]['id'];  // берем последнее айди фото из массива
                $name_foto = $id_user . '-' . time() . '.jpg';
                DB::table('create_posts')
                    ->where('id_user', $id_user)
                    ->update(['url_foto' => 'storage/app/bot/images' . '/' . $name_foto, 'date' => '4']);
                $this->chat
                    ->message('Фотография сохранена, выберите вариант')
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Написать текст поста или описание фото99')->action('feedback5')->param('value', '1'),
                            Button::make('Завершить пост00')->action('feedback5')->param('value', '2'),
                        ])
                    )->send();
                sleep(5);
                $this->bot->store($id_foto, Storage::path('bot/images'), $name_foto);  // сохраняем на локалке,
                goto a;
            }
            if ($data->id_user == $id_user && $data->name_post !== null && $data->url_foto !== null && $photo_no == false)
                $this->chat
                    ->message('Фотография уже сохранена')
                    ->keyboard(
                        Keyboard::make()->buttons([
                            Button::make('Завершить пост00')->action('feedback5')->param('value', '2'),
                        ])
                    )->send();
        }
        a:
    }



    public function feedback()
    {
        $data = $this->data->get('value');
        if ($data == 1) {
            $this->chat
                ->message('Выберите вариант входа на сайт')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Получить логин и пароль111')->action('feedback2')->param('value', value: '1'),
                        Button::make('Ссылка на сайт автоэлектрики222')->action('feedback2')->param('value', '2'),
                    ])
                )->send();
        }
        if ($data == 2) {
            $id = $this->chat->toArray();
            DB::table('create_posts')
                ->where('id_user', $id["chat_id"])
                ->delete();

            Create_post::create(['id_user' => $id["chat_id"]])->first();
            $this->chat->html('Напишите название поста, например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000 г троит" и отправьте.')->send();
        }
    }

    public function feedback2()  // создаем логин и пароль
    {
        $data = $this->data->get('value');
        $id = $this->chat->toArray();
        if ($data == 1) {
            $password = rand(1222222, 9999999999);
            $email = rand(1222222, 9999999999) . '@' . $password;
            $password_hash = Hash::make($password);
            DB::table('users')
                ->where('name', $id["chat_id"])
                ->update(['email' => $email, 'password' => $password_hash]);
            $this->chat->html("Логин $email Пароль $password")->send();
        }
        if ($data == 2)
            $this->chat->html("https://www.google.kz/")->send();
    }

    public function feedback3()
    {
        $id = $this->chat->toArray();
        DB::table('create_posts')
            ->where('id_user', $id["chat_id"])
            ->update(['date' => '3']);

        $data = $this->data->get('value');
        if ($data == '1')
            $this->chat->html("Вставте одно фото без текста и отправте1")->send();
        if ($data == '2')
            $this->chat->html("Напишите текст для поста или описание фото и отправте2")->send();
    }

    public function feedback4()
    {
        $id = $this->chat->toArray();
        $data = $this->data->get('value');
        $сreate_post = Create_post::where('id_user', $id["chat_id"])->first();
        if ($сreate_post->url_foto !== null) {
            $data = '2';
            file_put_contents('10.json', json_encode($data . $сreate_post->url_foto));
        }
        if ($data == '1')
            $this->chat->html("Выберите фото из галереи или сфоткайте и отправте без текста3")->send();
        if ($data == '2')
            $this->chat
                ->message('Выберите вариант сохранения')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Созранить для всех')->action('feedback6')->param('value', value: '1'),
                        Button::make('Сохранить для своей ленты')->action('feedback6')->param('value', '2'),
                    ])
                )->send();
    }

    public function feedback5()
    {
        $id = $this->chat->toArray();
        DB::table('create_posts')
            ->where('id_user', $id["chat_id"])
            ->update(['date' => '5']);

        $data = $this->data->get('value');
        if ($data == '1')
            $this->chat->html("Напишите текст для поста и отправте5")->send();
        if ($data == '2')
            $this->chat
                ->message('Выберите вариант сохранения')
                ->keyboard(
                    Keyboard::make()->buttons([
                        Button::make('Сохранить для всех')->action('feedback6')->param('value', value: 1),
                        Button::make('Сохранить для своей ленты')->action('feedback6')->param('value', 2),
                    ])
                )->send();
    }
    public function feedback6()
    {
        $id = $this->chat->toArray();
        $data = $this->data->get('value');
        if ($data == '1') {
            $cr_post = Create_post::where('id_user', $id["chat_id"])->first();
            Post::create([
                'user_name' => $cr_post->user_name,
                'name_post' => $cr_post->name_post,
                'id_user' => $cr_post->id_user,
                'id_post' => $cr_post->id_post,
                'text_post' => $cr_post->text_post,
                'url_foto' => $cr_post->url_foto,
                'stuff' => '1',
            ])->first();
            $cr_post->delete();
            $this->chat->html("Пост сохранен для всех 7")->send();
        }

        if ($data == '2') {
            $cr_post = Create_post::where('id_user', $id["chat_id"])->first();
            Post::create([
                'user_name' => $cr_post->user_name,
                'name_post' => $cr_post->name_post,
                'id_user' => $cr_post->id_user,
                'id_post' => $cr_post->id_post,
                'text_post' => $cr_post->text_post,
                'url_foto' => $cr_post->url_foto,
                'stuff' => '2',
            ])->first();
            $cr_post->delete();
            $this->chat->html("Пост сохранен для своей ленты 8")->send();
        }
    }


    protected function handleUnknownCommand($text): void
    {
        $this->chat->html("Нет такой команды, посмотрите список внизу в синем меню")->send();
    }



    public function com()
    {
        Telegraph::registerBotCommands([
            'post' => 'написать новый пост',
            'start' => 'Пройти на сайт, получить новый пароль',
            'bag' => 'удалить недоделанный пост',
        ])->send();
        // Telegraph::unregisterBotCommands()->send();  // убираем меню
    }
    public function help()
    {
        $this->reply('Описание команд...');
    }
    public function fas()
    {
        $this->reply("Жалоба принята!");
    }
}

// $id = $this->chat->toArray();
// file_put_contents('5.json', json_encode($id));
// $user_name = $this->message->from()->firstName();
// $user_name2 = $this->message->from()->userName();