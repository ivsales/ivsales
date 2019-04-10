<?php

use IVSales\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'name' => 'Бондаренко В.И.',
            'email' => 'bondarenko.v.i@gmail.com',
            'user_id' => 1,
            'article_id' => 1,
            'text' => 'Хороший диплом и скидки интересные! Желаю по скорее внедрить систему!'
        ]);
        Comment::create([
            'name' => 'Шарий Т.В.',
            'email' => 'shariy.t.v@gmail.com',
            'article_id' => 1,
            'text' => 'Всё очень круто! ООП не просто на уровне шаблона фреймверка, но еще и сам студент неплохо проработал стуктуру диплома!'
        ]);
    }
}
