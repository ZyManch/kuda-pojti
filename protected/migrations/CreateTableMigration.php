<?php

class CreateTableMigration extends CDbMigration {
	public function up() {
        $this->createTable('categories', array(
            'id' => 'pk',
            'title' => 'varchar(64) NOT NULL COMMENT "название категории"',
            'content' => 'text NOT NULL COMMENT "описание категории"',
            'description' => 'text NOT NULL COMMENT "метатег description"',
            'url' => 'varchar(64) NOT NULL COMMENT "адрес"',
            'avatar' => 'varchar(16) NOT NULL COMMENT "ссылка на аваратку"',
            'position' => 'int(11) NOT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->createTable('filters', array(
            'id' => 'pk',
            'title' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'help' => 'text COLLATE utf8_bin NOT NULL',
            'type' => 'enum("Radio","Multy","RangeIn","RangeOut","Metro","Work","Bool") COLLATE utf8_bin NOT NULL DEFAULT "Multy"',
            'params' => 'text COLLATE utf8_bin NOT NULL',
            'category_id' => 'int(11) DEFAULT NULL',
            'key' => 'varchar(12) COLLATE utf8_bin NOT NULL',
            'king' => 'enum("general","type","medium","lower") COLLATE utf8_bin NOT NULL DEFAULT "lower"',
            'position' => 'int(11) NOT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->createTable('images', array(
            'id' => 'pk',
            'mesto_id' => 'int(11) NOT NULL',
            'title' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'preview' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'url' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'width' => 'int(11) NOT NULL',
            'height' => 'int(11) NOT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->createIndex('company','images','mesto_id');
        $this->createTable('maps', array(
            'id' => 'pk',
            'mesto_id' => 'int(11) NOT NULL',
            'info' => 'text COLLATE utf8_bin',
            'city' => 'text COLLATE utf8_bin',
            'structure' => 'enum("Улица","Переулок","Бульвар","Площадь","Проспект","Проезд","Тупик","Шоссе","Набережная","Вал","Парк") COLLATE utf8_bin DEFAULT NULL',
            'adress' => 'text COLLATE utf8_bin',
            'street' => 'text COLLATE utf8_bin',
            'building' => 'text COLLATE utf8_bin',
            'office' => 'text COLLATE utf8_bin',
            'phones' => 'text COLLATE utf8_bin NOT NULL',
            'map_x' => 'double DEFAULT NULL',
            'map_y' => 'double DEFAULT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ),'ENGINE=MyISAM');
        $this->createIndex('company_id','maps','mesto_id');
        $this->execute('ALTER TABLE maps ADD FULLTEXT (adress)');
        $this->createTable('maps_metro', array(
            'id' => 'pk',
            'maps_id' => 'int(11) NOT NULL',
            'metro_id' => 'int(11) NOT NULL',
        ));
        $this->createIndex('coord_id','maps_metro','maps_id');
        $this->createTable('mesto', array(
            'id' => 'pk',
            'forum_id' => 'int(11) DEFAULT NULL',
            'yandex_mesto_id' => 'int(11) DEFAULT NULL',
            'url' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'art' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'title' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'content' => 'text COLLATE utf8_bin NOT NULL',
            'site' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'avatar' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'email' => 'varchar(64) COLLATE utf8_bin NOT NULL',
            'pages' => 'set("main","gallery","discont","afisha","proezd","menu","work","comments") COLLATE utf8_bin NOT NULL',
            'enabled' => 'tinyint(1) NOT NULL DEFAULT "1"',
            'description' => 'text COLLATE utf8_bin NOT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->createTable('mesto_cats', array(
            'id' => 'pk',
            'mesto_id' => 'int(11) NOT NULL',
            'category_id' => 'int(11) NOT NULL',
        ));
        $this->createIndex('company','mesto_cats','mesto_id,category_id', true);
        $this->createTable('mesto_filters', array(
            'id' => 'pk',
            'mesto_id' => 'int(11) NOT NULL',
            'filter_id' => 'int(11) NOT NULL',
            'range_from' => 'int(11) DEFAULT NULL',
            'range_to' => 'int(11) DEFAULT NULL',
            'value' => 'varchar(24) COLLATE utf8_bin DEFAULT NULL',
        ));
        $this->createIndex('filter_id','mesto_filters','filter_id');
        $this->createTable('metro', array(
            'id' => 'pk',
            'line' => 'enum("sokol","zamosk","kahov","arbat","filev","colco","kalyg","tagan","kalinin","serpyh","lublin","bytov","mono") COLLATE utf8_bin NOT NULL',
            'title' => 'varchar(32) COLLATE utf8_bin NOT NULL',
            'map_x' => 'double NOT NULL',
            'map_y' => 'double NOT NULL',
        ));
        $this->createTable('news', array(
            'id' => 'pk',
            'title' => 'varchar(128) COLLATE utf8_bin NOT NULL',
            'content' => 'text COLLATE utf8_bin NOT NULL',
            'changed' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->createTable('work', array(
            'id' => 'pk',
            'maps_id' => 'int(11) NOT NULL',
            'day_begin' => 'tinyint(4) NOT NULL',
            'day_end' => 'tinyint(4) NOT NULL',
            'time_begin' => 'mediumint(9) NOT NULL',
            'time_end' => 'mediumint(9) NOT NULL',
        ));
    }

	public function down() {
        $this->dropTable('categories');
        $this->dropTable('filters');
        $this->dropTable('images');
        $this->dropTable('maps');
        $this->dropTable('maps_metro');
        $this->dropTable('mesto');
        $this->dropTable('mesto_cats');
        $this->dropTable('mesto_filters');
        $this->dropTable('metro');
        $this->dropTable('news');
        $this->dropTable('work');
    }
}