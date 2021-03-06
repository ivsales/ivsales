<?php

use IVSales\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Подарочный сертификат на 5000 рублей!!',
            'price' => 4500,
            'old_price' => 5000,
            'quantity' => '10',
            'is_top' => 0,
            'is_new' => 0,
            'img' => '1.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. ',
            'category_id' => 4,
            'brand_id' => 1,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 2000 рублей!!',
            'price' => 1500,
            'old_price'=>2000,
            'quantity' => '12',
            'is_top' => 0,
            'is_new' => 1,
            'img' => '2.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании.',
            'category_id' => 4,
            'brand_id' =>1,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 1000 рублей!!',
            'price' => 1000,
            'quantity' => '23',
            'is_top' => 1,
            'is_new' => 0,
            'img' => '3.jpg',
            'description' => '
Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании.',
            'category_id' => 4,
            'brand_id' => 1,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 500 рублей!!',
            'price' => 500,
            'old_price' => 550,
            'quantity' => '1',
            'is_top' => 1,
            'is_new' => 0,
            'img' => '4.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании.',
            'category_id' => 4,
            'brand_id' => 1,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 5% скидки на всю одежду!!',
            'price' => 5000,
            'quantity' => '50',
            'is_top' => 1,
            'is_new' => 0,
            'img' => '5.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. Или же скромно пойти и купить одежду со скидкой:D',
         'category_id' => 4,
            'brand_id' => 2,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 10% скидки на всю одежду!!',
            'price' => 10000,
            'quantity' => '67',
            'is_top' => 1,
            'is_new' => 0,
            'img' => '6.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. Или же скромно пойти и купить одежду со скидкой:D',
            'category_id' => 4,
            'brand_id' => 2,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 15% скидки на всю одежду!!',
            'price' => 15000,
            'quantity' => '43',
            'is_top' => 0,
            'is_new' => 1,
            'img' => '7.jpg',
            'description' => 'Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. Или же скромно пойти и купить одежду со скидкой:D',
            'category_id' => 4,
            'brand_id' => 2,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 7% скидки на всю технику!!',
            'price' => 7000,
            'quantity' => '52',
            'is_top' => 0,
            'is_new' => 1,
            'img' => '8.jpg',
            'description' => '
Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. Или же скромно пойти и купить технику со скидкой:D',
            'category_id' => 4,
            'brand_id' => 4,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
        Product::create([
            'title' => 'Подарочный сертификат на 11% скидки на всю одежду!!',
            'price' => 10000,
            'quantity' => '3',
            'is_top' => 0,
            'is_new' => 1,
            'img' => '9.jpg',
            'description' => '
Благодаря подарочному сертификату IVSALES.ru каждый человек, которого вы захотите сделать счастливым, получит приятный сюрприз, способный доказать вашу искреннюю любовь и внимание. Игра в гольф на райском острове, эксклюзивный массаж в роскошном спа-центре или изысканный ужин в гастрономическом ресторане – получатель сам сможет выбрать время и место, где насладиться великолепным предложением
от нашей компании. Или же скромно пойти и купить технику со скидкой:D',
            'category_id' => 4,
            'brand_id' => 4,
            'weight'  => 5,
            'width' => 1,
            'height' => 1,
            'length' => 1
        ]);
    }
}
