<?php
class m140218_070641_UpdateData extends CDbMigration {

    public function up() {
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => '5',
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("work",array (
  'id' => '1',
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '4',
  'time_begin' => 0,
  'time_end' => 60,
), "id = :pk",array("$pk" => '1'));
        $this->update("work",array (
  'id' => '2',
  'maps_id' => '4',
  'day_begin' => '5',
  'day_end' => '6',
  'time_begin' => 0,
  'time_end' => 120,
), "id = :pk",array("$pk" => '2'));
        $this->update("work",array (
  'id' => '3',
  'maps_id' => '4',
  'day_begin' => '7',
  'day_end' => '7',
  'time_begin' => 0,
  'time_end' => 60,
), "id = :pk",array("$pk" => '3'));
        $this->update("work",array (
  'id' => '4',
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '7',
  'time_begin' => 600,
  'time_end' => 1440,
), "id = :pk",array("$pk" => '4'));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '4',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '5',
  'day_end' => '6',
  'time_begin' => 0,
  'time_end' => 120,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '7',
  'day_end' => '7',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '7',
  'time_begin' => 600,
  'time_end' => 1440,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '4',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '5',
  'day_end' => '6',
  'time_begin' => 0,
  'time_end' => 120,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '7',
  'day_end' => '7',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '7',
  'time_begin' => 600,
  'time_end' => 1440,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '4',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '5',
  'day_end' => '6',
  'time_begin' => 0,
  'time_end' => 120,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '7',
  'day_end' => '7',
  'time_begin' => 0,
  'time_end' => 60,
  'id' => NULL,
));
        $this->insert("work",array (
  'maps_id' => '4',
  'day_begin' => '1',
  'day_end' => '7',
  'time_begin' => 600,
  'time_end' => 1440,
  'id' => NULL,
));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,discont,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->insert("maps",array (
  'mesto_id' => '2',
  'city' => '2',
  'info' => '50/10',
  'structure' => 'Бульвар',
  'adress' => 'Новоборовецкий',
  'street' => '',
  'building' => '',
  'office' => '',
  'phones' => '318601,368601',
  'map_x' => '55.771223',
  'map_y' => '52.431320',
  'id' => NULL,
  'yandex_map_id' => NULL,
  'changed' => NULL,
));
        $this->insert("maps",array (
  'mesto_id' => '2',
  'city' => '2',
  'info' => '13/15',
  'structure' => 'Проспект',
  'adress' => 'Шамиля Усманова',
  'street' => '',
  'building' => '',
  'office' => '',
  'phones' => '312031, 368636',
  'map_x' => '55.742297',
  'map_y' => '52.387278',
  'id' => NULL,
  'yandex_map_id' => NULL,
  'changed' => NULL,
));
        $this->insert("maps",array (
  'mesto_id' => '2',
  'city' => '2',
  'info' => '6/01',
  'structure' => 'Проспект',
  'adress' => 'Хасана Туфана',
  'street' => '',
  'building' => '',
  'office' => '',
  'phones' => '363700,313500',
  'map_x' => '55.740482',
  'map_y' => '52.409688',
  'id' => NULL,
  'yandex_map_id' => NULL,
  'changed' => NULL,
));
        $this->insert("images",array (
  'mesto_id' => '2',
  'title' => 'Тайфун',
  'width' => 807,
  'height' => 605,
  'preview' => 'images/gallery/chelny/2/2.jpg',
  'url' => 'images/gallery/chelny/2/2_full.jpg',
  'id' => NULL,
  'changed' => NULL,
));
        $this->insert("images",array (
  'mesto_id' => '2',
  'title' => 'Тайфун',
  'width' => 807,
  'height' => 605,
  'preview' => 'images/gallery/chelny/2/3.jpg',
  'url' => 'images/gallery/chelny/2/3_full.jpg',
  'id' => NULL,
  'changed' => NULL,
));
        $this->insert("images",array (
  'mesto_id' => '2',
  'title' => 'Тайфун',
  'width' => 807,
  'height' => 605,
  'preview' => 'images/gallery/chelny/2/4.jpg',
  'url' => 'images/gallery/chelny/2/4_full.jpg',
  'id' => NULL,
  'changed' => NULL,
));
        $this->insert("images",array (
  'mesto_id' => '2',
  'title' => 'Тайфун',
  'width' => 807,
  'height' => 605,
  'preview' => 'images/gallery/chelny/2/1.jpg',
  'url' => 'images/gallery/chelny/2/1_full.jpg',
  'id' => NULL,
  'changed' => NULL,
));
        $this->delete("categories","id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'yandex_mesto_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->update("mesto",array (
  'id' => '2',
  'forum_id' => NULL,
  'url' => 'taifun',
  'title' => 'Тайфун',
  'content' => '',
  'site' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'enabled' => '1',
  'description' => '',
  'changed' => '2014-02-17 18:24:02',
), "id = :pk",array("$pk" => '2'));
        $this->insert("mesto",array (
  'enabled' => '1',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'title' => 'Тайфун',
  'content' => '',
  'url' => 'http://тайфун-суши.рф/',
  'avatar' => 'none.png',
  'email' => '',
  'description' => '',
  'id' => NULL,
  'forum_id' => NULL,
  'site' => NULL,
  'changed' => NULL,
));
        $this->update("mesto",array (
  'enabled' => '1',
  'pages' => 'main,gallery,proezd,menu,work,comments',
  'title' => 'Тайфун',
  'content' => '',
  'url' => 'http://тайфун-суши.рф/',
  'avatar' => '2.jpg',
  'email' => '',
  'description' => '',
  'id' => '2',
  'forum_id' => NULL,
  'site' => NULL,
  'changed' => NULL,
), "enabled = :pk",array("$pk" => '1'));
    }

    public function down() {

    }

}