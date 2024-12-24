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
        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post !== null)
            $create_post->delete();  //  подчищаем базу если есть незавершенные посты
        $user_data = User::where('name', $id_user)->first();
        if ($user_data == null) {
            User::create(['name' => $id_user, 'email' => '1234@5678', 'password' => '12345678'])->first();
        }
        $this->chat
            ->message('Бот сайта "Автоэлектрики" приветствует вас! Все команды бота в кноке "меню" внизу экрана')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Ссылка на сайт "Автоэлектрики15555"')->action('feedback_1')->param('value', '1'),
                    Button::make('Получить логин и пароль от сайта111')->action('feedback_1')->param('value', value: '2'),
                    Button::make('Создать пост без регистрации22')->action('feedback_1')->param('value', '3'),
                ])
            )->send();
    }

    public function feedback_1()
    {
        $value_button = $this->data->get('value');
        $id_user = $this->chat->toArray();

        if ($value_button == 1)
            $this->chat->html("Ссылка на сайт https://avtoelektriki.duckdns.org")->send();

        if ($value_button == 2) {
            $password = rand(1222222, 9999999999);
            $login = rand(1222222, 9999999999) . '@' . $password;
            $password_hash = Hash::make($password);
            DB::table('users')
                ->where('name', $id_user["chat_id"])
                ->update(['email' => $login, 'password' => $password_hash]);
            $this->chat->html("Ваш логин $login и пароль $password")->send();
        }

        if ($value_button == 3) {
            DB::table('create_posts')
                ->where('id_user', $id_user["chat_id"])
                ->delete();
            Create_post::create(['id_user' => $id_user["chat_id"], 'date' => '1'])->first();
            $this->chat->html('Напишите название поста, например "Мазда 3 ремонт стеклоочистителя" или "Ниссан Микра 2000г троит" и отправьте.')->send();
        }
    }

    protected function handleChatMessage($text): void  // метод сортирует сообщения, фото
    {
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        $photo_no = empty($this->message->photos()->toArray());
        $count_vol = count($this->message->toArray());
        if ($create_post == null) {
            $this->reply("Выберите команду для бота в синем меню внизу");
        } else {
            switch ($create_post->date) {
                case 1:
                    if ($photo_no == true && $count_vol == 9) {
                        $this->name_post_create();
                    } else {
                        $this->chat->html('<i>Неправильное действие1</i>')->send();
                    }
                    break;
                case 2:
                case 4:
                    if ($photo_no == false) {
                        $this->foto_create();
                    } else {
                        $this->chat->html('<i>Неправильное действие2</i>')->send();
                    }
                    break;
                case 3:
                case 5:
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

    protected function name_post_create()
    {
        $id_user = $this->message->from()->id();
        $text = $this->message->text();
        $id_post = $this->message->id();
        $user_name = $this->message->from()->firstName();

        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update(['user_name' => $user_name, 'name_post' => $text, 'id_post' => $id_post, 'date' => '2']);

        $this->reply("Название сохранено. Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен");
    }

    protected function foto_create()
    {
        $id_user = $this->message->from()->id();
        $photo = $this->message->photos()->toArray();  // получаем  в массив инфу о фото в с разными вариантами размеров
        $data = count($photo) - 1;   // считаем количество элементов массива
        $id_foto = $photo[$data]['id'];  // берем последнее айди фото из массива
        $name_foto = $id_user . '-' . time() . '.jpg';


        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update(['url_foto' => 'storage/app/bot/images' . '/' . $name_foto, 'date' => '3']);
        $this->reply("Фото сохранено. Опишите фото или расскажите о машине, ее проблеме, неисправности и т.д.");

        sleep(5); // пауза между запросами и для тяжелых фото
        $this->bot->store($id_foto, Storage::path('bot/images'), $name_foto);  // сохраняем на локалке,
    }

    protected function text_post_create()
    {
        $message = $this->message->toArray();
        $text = $this->message->text();
        $id_user = $this->message->from()->id();

        DB::table('create_posts')
            ->where('id_user', $id_user)
            ->update(['text_post' => $text, 'date' => '4']);

        $this->chat
            ->message('Поздавляем, минимальный пост создан! Выберите вариант с помощью кнопок')
            ->keyboard(
                Keyboard::make()->buttons([
                    Button::make('Дописать еще блок с фото и текстом"')->action('feedback_2')->param('value', '1'),
                    Button::make('Сохранить пост и опубликовать')->action('feedback_2')->param('value', value: '2'),
                ])
            )->send();

    }

    public function feedback_2()// получаем запросы от кнопок из text_post_create()
    {
        $id = $this->chat->toArray();
        $value_button = $this->data->get('value');

        if ($value_button == '1') {
            $this->chat->html("Вставте одно фото, например автомобиля, его салона, неисправной детали и пр. Текст под фото не нужен")->send();
        }

        if ($value_button == '2') {
            $create_post = Create_post::where('id_user', $id["chat_id"])->first();
           $date = date('Y-m-d H:i:s');
            $id = DB::table('posts')->insertGetId([
                'created_at' => $date, 
                'updated_at'=> $date,
                'user_name' => $create_post->user_name,
                'name_post' => $create_post->name_post,
                'id_user' => $create_post->id_user,
                'id_post' => $create_post->id_post,
                'text_post' => $create_post->text_post,
                'url_foto' => $create_post->url_foto,
                'stuff' => '1',
            ]);
        
            // Post::create([
            //     'user_name' => $create_post->user_name,
            //     'name_post' => $create_post->name_post,
            //     'id_user' => $create_post->id_user,
            //     'id_post' => $create_post->id_post,
            //     'text_post' => $create_post->text_post,
            //     'url_foto' => $create_post->url_foto,
            //     'stuff' => '1',
            // ])->first();
            $create_post->delete();

            $this->chat->html("Пост сохранен под номером $id и после проверки появится на сайте")->send();
        }
    }

    public function new_post()
    {
        $id_user = $this->message->from()->id();
        $create_post = Create_post::where('id_user', $id_user)->first();
        if ($create_post !== null)
            $create_post->delete();
        Create_post::create(['id_user' => $id_user, 'date' => '1'])->first();
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
        $id_user = $this->chat->toArray();
        $password = rand(1222222, 9999999999);
        $login = rand(1222222, 9999999999) . '@' . $password;
        $password_hash = Hash::make($password);
        DB::table('users')
            ->where('name', $id_user["chat_id"])
            ->update(['email' => $login, 'password' => $password_hash]);
        $this->chat->html("Ваш логин $login и пароль $password")->send();
    }

        protected function handleUnknownCommand($text): void
    {
        $this->chat->html("Нет такой команды, посмотрите список внизу в синем меню")->send();
    }



}

