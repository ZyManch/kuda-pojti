<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 17.02.14
 * Time: 17:54
 */
class FillCategoriesMigration extends CDbMigration {

    public function up() {
        $this->insert('categories', array('id' => 1, 'title' => 'Еда', 'url' => 'eda', 'avatar' => 'eda.png', 'position' => 1));
        $this->insert('categories', array('id' => 2, 'title' => 'Напитки',  'url' => 'napitki', 'avatar' => 'napitki.png', 'position' => 2));
        $this->insert('categories', array('id' => 9, 'title' => 'Музеи',  'url' => 'myzei', 'avatar' => 'myzei.png', 'position' => 3));
        $this->insert('categories', array('id' => 11, 'title' => 'Музыка и танцы',  'url' =>  'music', 'avatar' => 'music.png','position' =>  4));
        $this->insert('categories', array('id' => 14, 'title' => 'Кино и театры',  'url' =>  'kino', 'avatar' => 'kino.png', 'position' => 5));
        $this->insert('categories', array('id' => 27, 'title' => 'Учеба',  'url' =>  'ycheba', 'avatar' => 'ycheba.png','position' =>  6));
        $this->insert('categories', array('id' => 29, 'title' => 'Развлечения',  'url' =>  'razvlechenia','avatar' =>  'razvlechenia.png', 'position' => 7));
        $this->insert('categories', array('id' => 35, 'title' => 'Шопинг',  'url' => 'shoping', 'avatar' => 'shoping.png','position' =>  8));
        $this->insert('categories', array('id' => 36, 'title' => 'Спорт',  'url' => 'sport', 'avatar' => 'sport.png', 'position' => 9));
        $this->insert('categories', array('id' => 42, 'title' => 'Прогулки',  'url' =>  'progylki', 'avatar' => 'progylki.png', 'position' => 10));
        $this->insert('categories', array('id' => 43, 'title' => 'Вода',  'url' => 'voda', 'avatar' => 'voda.png', 'position' => 11));
        $this->insert('categories', array('id' => 53, 'title' => 'Красота',  'url' =>  'krasota','avatar' =>  'krasota.png', 'position' => 12));
        $this->insert('categories', array('id' => 58, 'title' => 'Воздух',  'url' => 'vozdyh', 'avatar' => 'vozdyh.png', 'position' => 14));
        $this->insert(
             "filters", array(
                     'id'          => '1',
                     'title'       => 'Цены',
                     'help'        => 'Предполагаемая цена, которую вы готовы потратить на одного человека',
                     'type'        => 'RangeIn',
                     'params'      => '0
100000
Выбрано %d рублей',
                     'category_id' => null,
                     'key'         => 'price',
                     'king'        => 'general',
                     'position'    => '1',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '2',
                     'title'       => 'Количество человек',
                     'help'        => 'Примерное количество человек в компании, которой хотите прийти',
                     'type'        => 'RangeIn',
                     'params'      => '1
50
Выбрано %d человек',
                     'category_id' => null,
                     'key'         => 'people-count',
                     'king'        => 'general',
                     'position'    => '2',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '3',
                     'title'       => 'Тип компании',
                     'help'        => 'Что из себя представляет Ваша компания',
                     'type'        => 'Radio',
                     'params'      => 'man=Мужская компания
woman=Женская компания
both=Смешанная
love=Пара',
                     'category_id' => null,
                     'key'         => 'people-type',
                     'king'        => 'general',
                     'position'    => '3',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '4',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относится заведение, в котором Вы собираетесь поесть',
                     'type'        => 'Multy',
                     'params'      => 'kafe=кафе
restoran=restoran
pizza=pizza
sushi=sushi
water-restoran=ресторан на воде
out-city-restoran=загородный ресторан
kylinaria=kylinaria
fastfud=fastfud
stolovie=stolovie',
                     'category_id' => '1',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '5',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относится заведение, в которое Вы собираетесь пойти',
                     'type'        => 'Multy',
                     'params'      => 'bar-pub=bar-pub
pivnya=пивная
kofe=kofe
tea=чайная
vino=vino
traktir=трактир',
                     'category_id' => '2',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '6',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относится заведение, в котором Вы собираетесь пойти',
                     'type'        => 'Multy',
                     'params'      => 'myzei=myzei
pamyatniki=pamyatniki
stendi=стенды
vistavochnii-zal=выставочный зал
galerea=galerea
hydozestvenyi-myzei=художественный музей
naychnii-myzei=научно-технический музей
literatyrny-myzei=литературный музей
kyltyrny-centr=kyltyrny-centr
istorichesky-myzei=исторический музей
vistavochnii-kompleks=выставочный kompleks=комплекс
myzei-teatra=музей театра
dom-myzei=дом-музей
remesla=музей декоративно-прикладного искусства и ремесел
hram=храм
library=библиотека
estestvenii-myzei=естественнонаучный музей
dom-kyltyri=дом культуры
ekskyrsii=ekskyrsii',
                     'category_id' => '9',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '7',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относиться заведение, в которое Вы хотите сходить',
                     'type'        => 'Multy',
                     'params'      => 'kinoteatr=kinoteatr
teatr=teatr
koncert-ploshadka=концертная площадка
koncertnii-zal=koncertnii-zal
kino=кино
cirk=цирк',
                     'category_id' => '14',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '8',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относится заведение куда вы хотите сходить послушать музыку',
                     'type'        => 'Multy',
                     'params'      => 'bard-ploshadka=Бард площадка
djaz-klub=Джаз клуб
klub=klub
myziki=Музыки
hkola-tancev=hkola-tancev',
                     'category_id' => '11',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '9',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относиться заведения, куда вы хотите сходить подвигаться',
                     'type'        => 'Multy',
                     'params'      => 'sport-kompleks=sport-kompleks
joga=joga
ohota-ribalka=ohota-ribalka
auto=auto
golf=golf
tennis=tennis
stadioni=stadioni
fitnes-klub=fitnes-klub
bilyard=bilyard
katki=katki
boyling=boyling
katok=Каток
ligi=ligi
paintboll=paintboll
konii-klub=Конный клуб
tiri=tiri
sport-bar=sport-bar
sport-klub=sport-klub
wellness=Wellness',
                     'category_id' => '36',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '10',
                     'title'       => 'Тип заведения',
                     'help'        => 'Куда вы хотите сходить поучиться',
                     'type'        => 'Multy',
                     'params'      => 'ychebnoe-zavedenie=учебное заведение
shkola=школа',
                     'category_id' => '27',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '11',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу заведения относиться место, куда вы хотите пойти погулять',
                     'type'        => 'Multy',
                     'params'      => 'zoopark=zoopark
lesoparki-zapovedniki=lesoparki-zapovedniki
dvorci=dvorci
ysadba=усадьба
zoni-otdiha=zoni-otdiha
parks=парки',
                     'category_id' => '42',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '12',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относиться заведение куда Вы хотите сходить развлечся',
                     'type'        => 'Multy',
                     'params'      => 'razvlekatilny-centr=razvlekatilny-centr
atracion=atracion
sportivno-razvlekatilny-centr=sportivno-razvlekatilny-centr
klubi-dosyga=klubi-dosyga
detskye-ploshadki=detskye-ploshadki',
                     'category_id' => '29',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '13',
                     'title'       => 'Тип заведения',
                     'help'        => 'Тип торговых сооружений',
                     'type'        => 'Multy',
                     'params'      => 'torgovy-centr=торговый центр',
                     'category_id' => '35',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '14',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу заведения относиться здание, в котором Вы хотите поплавать',
                     'type'        => 'Multy',
                     'params'      => 'bassein=bassein
akvapark=akvapark
bany-sayni=bany-sayni
yaht-klybi=yaht-klybi',
                     'category_id' => '43',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '15',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу относиться заведения в которое вы хотите сходить',
                     'type'        => 'Multy',
                     'params'      => 'salon-krasoti=salon-krasoti
parikmaherskie=parikmaherskie
kosmetologiya=kosmetologiya
spa=spa
solarii=solarii
massag=massag
taty=taty
vizagisti-stilisti=vizagisti-stilisti',
                     'category_id' => '53',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '17',
                     'title'       => 'Тип заведения',
                     'help'        => 'К какому типу заведений относиться здание в котором вы хотите попрыгать',
                     'type'        => 'Multy',
                     'params'      => 'aeroklub=аэроклуб',
                     'category_id' => '58',
                     'key'         => 'type',
                     'king'        => 'type',
                     'position'    => '10',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '18',
                     'title'       => 'Ближайщая станция метро',
                     'help'        => 'Какая станция метро находиться возле места куда хотите схдить',
                     'type'        => 'Metro',
                     'params'      => '',
                     'category_id' => null,
                     'key'         => 'metro',
                     'king'        => 'general',
                     'position'    => '4',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '19',
                     'title'       => 'Время работы',
                     'help'        => 'Введите дату и время, в которое данное заведение должно работать. При поиске праздники не учитываются',
                     'type'        => 'Work',
                     'params'      => '',
                     'category_id' => null,
                     'key'         => 'work',
                     'king'        => 'medium',
                     'position'    => '5',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '20',
                     'title'       => 'wi-fi',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'wi_fi',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '21',
                     'title'       => 'караоке',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'karaoke',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '22',
                     'title'       => 'специальное меню',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'пивное=пивное
детское=детское
вегетарианское=вегетарианское
постное=постное
сезонное=сезонное
блинное=блинное
гриль=гриль
фитнес=фитнес
диетическое=диетическое
экзотик=экзотик
кошерное=кошерное',
                     'category_id' => '1',
                     'key'         => 'special_menu',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '23',
                     'title'       => 'кальян',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'hookah',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '24',
                     'title'       => 'музыка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'живая=живая
80-90-х=80-90-х
DJ`s=DJ`s
pop=pop
диско=диско
ретро=ретро
рок-н-ролл=рок-н-ролл
танцевальная=танцевальная
по заказу=по заказу
фоновая=фоновая
europop=europop
soul=soul
авторская песня=авторская песня
блюз=блюз
джаз=джаз
евро дэнс=евро дэнс
звёзды эстрады=звёзды эстрады
инструментальная=инструментальная
кантри=кантри
классическая=классическая
лаунж=лаунж
рок=рок
ремиксы на шлягеры=ремиксы на шлягеры
фольклорная=фольклорная
Chillout=Chillout
funky=funky
house=house
этника=этника
шансон=шансон
восточная=восточная
R\'n\'B=R\'n\'B
Euro Dance=Euro Dance
панк=панк
рэп=рэп
disco house=disco house
british house=british house
live Dj sets=live Dj sets
электронная=электронная
tech=tech
mash-up=mash-up
reggae=reggae
Deep House=Deep House
Hard Dance=Hard Dance
Drum \'n\' Bass=Drum \'n\' Bass
progressive=progressive
rockabilly=rockabilly
латиноамериканская=латиноамериканская
Trance=Trance
electro=electro
electro-house=electro-house
progressive house=progressive house
deep tek house=deep tek house',
                     'category_id' => '1',
                     'key'         => 'music',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '25',
                     'title'       => 'меню',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'шашлыки=шашлыки
комплексные обеды=комплексные обеды
суши=суши
узбекская еда=узбекская еда
домашняя еда=домашняя еда
выпечка=выпечка
гриль=гриль
пицца=пицца
китайская еда=китайская еда
сладости=сладости
осетинские пироги=осетинские пироги',
                     'category_id' => '1',
                     'key'         => 'variety_food',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '26',
                     'title'       => 'кухня',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'европейская=европейская
японская=японская
итальянская=итальянская
смешанная=смешанная
международная=международная
русская=русская
мясная=мясная
рыбная=рыбная
средиземноморская=средиземноморская
авторская=авторская
домашняя=домашняя
морская=морская
восточная=восточная
американская=американская
английская=английская
кавказская=кавказская
немецкая=немецкая
чешская=чешская
мексиканская=мексиканская
узбекская=узбекская
охотничья=охотничья
грузинская=грузинская
армянская=армянская
швейцарская=швейцарская
бельгийская=бельгийская
китайская=китайская
корейская=корейская
украинская=украинская
французская=французская
индийская=индийская
испанская=испанская
филиппинская=филиппинская
вьетнамская=вьетнамская
еврейская=еврейская
тайская=тайская
ливанская=ливанская
арабская=арабская
азербайджанская=азербайджанская
фьюжн=фьюжн
азиатская=азиатская
латиноамериканская=латиноамериканская
паназиатская=паназиатская
татарская=татарская
скандинавская=скандинавская
сибирская=сибирская
донская=донская
австрийская=австрийская
болгарская=болгарская
кубинская=кубинская
славянских народов=славянских народов
греческая=греческая
баварская=баварская
турецкая=турецкая
народов Севера=народов Севера
марокканская=марокканская
африканская=африканская
аргентинская=аргентинская
индонезийская=индонезийская
сингапурская=сингапурская
таджикская=таджикская
якутская=якутская
португальская=португальская
балканская=балканская
тибетская=тибетская
тайваньская=тайваньская
иранская=иранская
пакистанская=пакистанская
бразильская=бразильская
югославская=югославская
сербская=сербская
молекулярная=молекулярная
австралийская=австралийская
ирландская=ирландская
колониальная=колониальная
континентальная=континентальная
осетинская=осетинская
тосканская=тосканская
уйгурская=уйгурская
казахская=казахская
молдавская=молдавская
шотландская=шотландская
белорусская=белорусская
гавайская=гавайская
датская=датская
польская=польская
словацкая=словацкая
прибалтийская=прибалтийская',
                     'category_id' => '1',
                     'key'         => 'type_cuisine',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '29',
                     'title'       => 'vip-зал',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'vip_room',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '30',
                     'title'       => 'детская комната',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'nursery',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '31',
                     'title'       => 'еда на вынос',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'takeaway',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '32',
                     'title'       => 'дресс-код',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'dress_code',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '33',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'car_park',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '34',
                     'title'       => 'проведение банкетов',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'banquet',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '36',
                     'title'       => 'фейс-контроль',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'face_control',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '37',
                     'title'       => 'вход',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'свободный=свободный
платный на мероприятия=платный на мероприятия
по флаеру=по флаеру',
                     'category_id' => '1',
                     'key'         => 'admission',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '38',
                     'title'       => 'танцпол',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'dancefloor',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '39',
                     'title'       => 'завтрак',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'breakfast',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '40',
                     'title'       => 'VIP-зона',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'vip-zone',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '42',
                     'title'       => 'стриптиз',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'strip',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '43',
                     'title'       => 'сцена',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'scene',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '45',
                     'title'       => 'вместимость',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'до 200 чел.=до 200 чел.
до 300 чел.=до 300 чел.
до 100 чел.=до 100 чел.
до 1500 чел.=до 1500 чел.
до 400 чел.=до 400 чел.
до 800 чел.=до 800 чел.
до 600 чел.=до 600 чел.',
                     'category_id' => '1',
                     'key'         => 'capacity',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '47',
                     'title'       => 'шоу-программа',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'show-program',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '51',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'бесплатная=бесплатная
охраняемая=охраняемая
гостевая=гостевая
открытая=открытая
наземная=наземная
неохраняемая=неохраняемая
платная=платная
длительная=длительная
для легковых автомобилей=для легковых автомобилей
подземная=подземная
для грузовиков=для грузовиков
краткосрочная=краткосрочная
VIP=VIP
предварительное бронирование=предварительное бронирование',
                     'category_id' => '1',
                     'key'         => 'type_parking',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '60',
                     'title'       => 'интернет',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '1',
                     'key'         => 'internet',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '64',
                     'title'       => 'банкетных залов',
                     'help'        => '',
                     'type'        => 'RangeIn',
                     'params'      => '0
4
Выбран %d',
                     'category_id' => '1',
                     'key'         => 'number_banqu',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '65',
                     'title'       => 'wi-fi',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'wi_fi',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '66',
                     'title'       => 'караоке',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'karaoke',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '67',
                     'title'       => 'специальное меню',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'пивное=пивное
постное=постное
гриль=гриль
вегетарианское=вегетарианское
детское=детское
сезонное=сезонное
диетическое=диетическое
фитнес=фитнес
кошерное=кошерное
блинное=блинное
экзотик=экзотик',
                     'category_id' => '2',
                     'key'         => 'special_menu',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '68',
                     'title'       => 'кальян',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'hookah',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '69',
                     'title'       => 'музыка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'живая=живая
фольклорная=фольклорная
фоновая=фоновая
этника=этника
лаунж=лаунж
джаз=джаз
DJ`s=DJ`s
pop=pop
авторская песня=авторская песня
диско=диско
евро дэнс=евро дэнс
звёзды эстрады=звёзды эстрады
панк=панк
ремиксы на шлягеры=ремиксы на шлягеры
80-90-х=80-90-х
ретро=ретро
рок-н-ролл=рок-н-ролл
танцевальная=танцевальная
рок=рок
блюз=блюз
шансон=шансон
по заказу=по заказу
восточная=восточная
british house=british house
disco house=disco house
funky=funky
house=house
live Dj sets=live Dj sets
электронная=электронная
Chillout=Chillout
классическая=классическая
electro=electro
electro-house=electro-house
soul=soul
инструментальная=инструментальная
progressive=progressive
Trance=Trance
progressive house=progressive house
латиноамериканская=латиноамериканская
europop=europop
mash-up=mash-up
R\'n\'B=R\'n\'B
reggae=reggae
rockabilly=rockabilly
Euro Dance=Euro Dance
кантри=кантри
deep tek house=deep tek house
tech=tech
рэп=рэп
Drum \'n\' Bass=Drum \'n\' Bass
Deep House=Deep House
Hard Dance=Hard Dance',
                     'category_id' => '2',
                     'key'         => 'music',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '70',
                     'title'       => 'меню',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'шашлыки=шашлыки
комплексные обеды=комплексные обеды
гриль=гриль
домашняя еда=домашняя еда
пицца=пицца
осетинские пироги=осетинские пироги
выпечка=выпечка
суши=суши
китайская еда=китайская еда
сладости=сладости
узбекская еда=узбекская еда',
                     'category_id' => '2',
                     'key'         => 'variety_food',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '72',
                     'title'       => 'кухня',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'европейская=европейская
английская=английская
смешанная=смешанная
немецкая=немецкая
мясная=мясная
рыбная=рыбная
русская=русская
охотничья=охотничья
узбекская=узбекская
авторская=авторская
итальянская=итальянская
мексиканская=мексиканская
восточная=восточная
швейцарская=швейцарская
средиземноморская=средиземноморская
арабская=арабская
домашняя=домашняя
японская=японская
кавказская=кавказская
паназиатская=паназиатская
тайская=тайская
азиатская=азиатская
морская=морская
азербайджанская=азербайджанская
австрийская=австрийская
украинская=украинская
чешская=чешская
грузинская=грузинская
испанская=испанская
французская=французская
фьюжн=фьюжн
таджикская=таджикская
еврейская=еврейская
американская=американская
китайская=китайская
балканская=балканская
армянская=армянская
греческая=греческая
международная=международная
индийская=индийская
латиноамериканская=латиноамериканская
бразильская=бразильская
кубинская=кубинская
индонезийская=индонезийская
ливанская=ливанская
корейская=корейская
славянских народов=славянских народов
донская=донская
уйгурская=уйгурская
казахская=казахская
молдавская=молдавская
баварская=баварская
тайваньская=тайваньская
австралийская=австралийская
белорусская=белорусская
бельгийская=бельгийская
континентальная=континентальная
аргентинская=аргентинская
ирландская=ирландская
осетинская=осетинская
вьетнамская=вьетнамская
турецкая=турецкая
татарская=татарская
марокканская=марокканская
сибирская=сибирская
африканская=африканская
сербская=сербская
иранская=иранская',
                     'category_id' => '2',
                     'key'         => 'type_cuisine',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '74',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'car_park',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '75',
                     'title'       => 'vip-зал',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'vip_room',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '78',
                     'title'       => 'фейс-контроль',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'face_control',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '79',
                     'title'       => 'детская комната',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'nursery',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '80',
                     'title'       => 'проведение банкетов',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'banquet',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '81',
                     'title'       => 'еда на вынос',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'takeaway',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '82',
                     'title'       => 'вход',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'свободный=свободный
платный на мероприятия=платный на мероприятия
по флаеру=по флаеру',
                     'category_id' => '2',
                     'key'         => 'admission',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '89',
                     'title'       => 'танцпол',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'dancefloor',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '90',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'бесплатная=бесплатная
наземная=наземная
неохраняемая=неохраняемая
платная=платная
длительная=длительная
открытая=открытая
для легковых автомобилей=для легковых автомобилей
охраняемая=охраняемая
краткосрочная=краткосрочная
гостевая=гостевая
VIP=VIP
предварительное бронирование=предварительное бронирование
крытая=крытая
для грузовиков=для грузовиков
подземная=подземная',
                     'category_id' => '2',
                     'key'         => 'type_parking',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '92',
                     'title'       => 'стриптиз',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '2',
                     'key'         => 'strip',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '93',
                     'title'       => 'вместимость',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'до 300 чел.=до 300 чел.
до 200 чел.=до 200 чел.
до 100 чел.=до 100 чел.
до 900 чел.=до 900 чел.
до 1200 чел.=до 1200 чел.',
                     'category_id' => '2',
                     'key'         => 'capacity',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '96',
                     'title'       => 'танцы',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'R&B=R&B
фламенко=фламенко
сальса=сальса
восточные=восточные
танго=танго
индийские=индийские
бальные=бальные
стрип-дэнс=стрип-дэнс
хастл=хастл
капоэйра=капоэйра
современные=современные
Hip-Hop=Hip-Hop
латина=латина',
                     'category_id' => '2',
                     'key'         => 'dance',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '103',
                     'title'       => 'бильярд',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'billiards',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '105',
                     'title'       => 'боулинг для детей',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'for_kids',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '112',
                     'title'       => 'настольные игры',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'board_games',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '117',
                     'title'       => 'боевые искусства',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'бокс=бокс
каратэ=каратэ
айкидо=айкидо
джиу-джитсу=джиу-джитсу
кикбоксинг=кикбоксинг
рукопашный бой=рукопашный бой
таэквондо=таэквондо
дзюдо=дзюдо
самбо=самбо
самооборона=самооборона
тай-бо=тай-бо
ушу=ушу
капоэйра=капоэйра
тайский бокс=тайский бокс
вольная борьба=вольная борьба
тай-чи=тай-чи
бокс для женщин=бокс для женщин
боевое самбо=боевое самбо
панкратион=панкратион
кобудо=кобудо
чанбара=чанбара
киокушинкай=киокушинкай
греко-римская борьба=греко-римская борьба
славяно-горицкая борьба=славяно-горицкая борьба
кендо=кендо
вин чун=вин чун
хапкидо=хапкидо
окинава тэ=окинава тэ
айки-кэн=айки-кэн
сумо=сумо
рестлинг=рестлинг
тансудо=тансудо
комбатан=комбатан',
                     'category_id' => '36',
                     'key'         => 'martial_arts',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '118',
                     'title'       => 'танцы',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'go-go=go-go
современные=современные
восточные=восточные
танго=танго
балет=балет
хастл=хастл
фламенко=фламенко
Hip-Hop=Hip-Hop
народные=народные
латина=латина
брейк-дэнс=брейк-дэнс
R&B=R&B
стрип-дэнс=стрип-дэнс
свинг=свинг
бальные=бальные
tecktonik=tecktonik
капоэйра=капоэйра
клубные=клубные
джаз=джаз
ирландские=ирландские
хореография=хореография
модерн=модерн
сальса=сальса
бачата=бачата
афро-джаз=афро-джаз
рок-н-ролл=рок-н-ролл
хаус=хаус
свободные=свободные
буги-вуги=буги-вуги
реггетон=реггетон
шотландские=шотландские
индийские=индийские
контемпорари=контемпорари
буто=буто
крамп=крамп
поппинг=поппинг
локинг=локинг
линди-хоп=линди-хоп
меренге=меренге
импровизация=импровизация
контактная импровизация=контактная импровизация
исторические=исторические',
                     'category_id' => '36',
                     'key'         => 'dance',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '120',
                     'title'       => 'игровой спорт',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'теннис=теннис
футбол=футбол
настольный теннис=настольный теннис
фехтование=фехтование
бадминтон=бадминтон
сквош=сквош
боулинг=боулинг
скалолазание=скалолазание
прыжки на батуте=прыжки на батуте
мини-футбол=мини-футбол
волейбол=волейбол
баскетбол=баскетбол
бильярд=бильярд
гольф=гольф
стрит бол=стрит бол
пейнтбол=пейнтбол',
                     'category_id' => '36',
                     'key'         => 'sport_game',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '122',
                     'title'       => 'залы',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'тренажерный зал=тренажерный зал
кардиозал=кардиозал
зал групповых программ=зал групповых программ
cycle зал=cycle зал
зал на открытом воздухе=зал на открытом воздухе
зал бокса=зал бокса
зал восточных единоборств=зал восточных единоборств',
                     'category_id' => '36',
                     'key'         => 'hall',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '124',
                     'title'       => 'танцы',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'dances',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '125',
                     'title'       => 'каток',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'ice_rink',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '126',
                     'title'       => 'тренажерный зал',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'gym',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '127',
                     'title'       => 'ледовые вечеринки',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'ice_party',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '129',
                     'title'       => 'прокат коньков',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'skate_rental',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '130',
                     'title'       => 'выдача экипировки',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'outfit',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '131',
                     'title'       => 'камера хранения',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'baggage_room',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '134',
                     'title'       => 'аренда/мероприятия',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'lease-events',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '135',
                     'title'       => 'стадион',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'крытый=крытый',
                     'category_id' => '36',
                     'key'         => 'stadium_type',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '139',
                     'title'       => 'обучение инструкторов',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'for_teachers',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '140',
                     'title'       => 'поле для гольфа',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'area_golf',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '142',
                     'title'       => 'теннисный корт',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'tennis_court',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '143',
                     'title'       => 'прокат',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'лодок=лодок',
                     'category_id' => '36',
                     'key'         => 'rental',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '144',
                     'title'       => 'боулинг',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'bowling',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '145',
                     'title'       => 'пейнтбол',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'paintballing',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '146',
                     'title'       => 'верховая езда',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'riding',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '148',
                     'title'       => 'рыбалка',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'fishing',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '149',
                     'title'       => 'лыжная школа',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'ski_school',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '151',
                     'title'       => 'настольный теннис',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'table_tennis',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '152',
                     'title'       => 'бизнес-центр',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '36',
                     'key'         => 'business_cen',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '153',
                     'title'       => 'музыка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => '80-90-х=80-90-х
DJ`s=DJ`s
pop=pop
диско=диско
ретро=ретро
рок-н-ролл=рок-н-ролл
танцевальная=танцевальная
живая=живая
по заказу=по заказу
авторская песня=авторская песня
евро дэнс=евро дэнс
звёзды эстрады=звёзды эстрады
панк=панк
ремиксы на шлягеры=ремиксы на шлягеры
джаз=джаз
рок=рок
блюз=блюз
europop=europop
фоновая=фоновая
disco house=disco house
лаунж=лаунж
british house=british house
funky=funky
house=house
live Dj sets=live Dj sets
электронная=электронная
tech=tech
R\'n\'B=R\'n\'B
mash-up=mash-up
классическая=классическая
Deep House=Deep House
Hard Dance=Hard Dance
Drum \'n\' Bass=Drum \'n\' Bass
Chillout=Chillout
progressive=progressive
шансон=шансон
фольклорная=фольклорная
rockabilly=rockabilly
инструментальная=инструментальная
латиноамериканская=латиноамериканская
Trance=Trance
кантри=кантри
reggae=reggae
soul=soul
рэп=рэп
electro=electro
electro-house=electro-house
progressive house=progressive house
Euro Dance=Euro Dance
deep tek house=deep tek house
восточная=восточная
этника=этника',
                     'category_id' => '11',
                     'key'         => 'music',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '154',
                     'title'       => 'сцена',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '11',
                     'key'         => 'scene',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '156',
                     'title'       => 'танцпол',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '11',
                     'key'         => 'dancefloor',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '157',
                     'title'       => 'шоу-программа',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '11',
                     'key'         => 'show-program',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '158',
                     'title'       => 'Жанр музыки',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'джаз=джаз
рок-музыка=рок-музыка
блюз=блюз
кантри=кантри
народная музыка=народная музыка
классическая музыка=классическая музыка
латиноамериканская музыка=латиноамериканская музыка
электронная музыка=электронная музыка
ска, рокстеди, реггей=ска, рокстеди, реггей
бардовская музыка=бардовская музыка
ретро=ретро
DJ=DJ
поп-музыка=поп-музыка
шансон=шансон
диско=диско
рэп, хип-хоп=рэп, хип-хоп',
                     'category_id' => '11',
                     'key'         => 'music_genre',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '161',
                     'title'       => 'танцы',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '11',
                     'key'         => 'dances',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '163',
                     'title'       => 'танцы',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'капоэйра=капоэйра
брейк-дэнс=брейк-дэнс
стрип-дэнс=стрип-дэнс
современные=современные
go-go=go-go
Hip-Hop=Hip-Hop
tecktonik=tecktonik
восточные=восточные
латина=латина
клубные=клубные
R&B=R&B
меренге=меренге
народные=народные
сальса=сальса
бачата=бачата
балет=балет
хореография=хореография
фламенко=фламенко
танго=танго
бальные=бальные
хастл=хастл
джаз=джаз
модерн=модерн
свободные=свободные
контемпорари=контемпорари
афро-джаз=афро-джаз
крамп=крамп
поппинг=поппинг
локинг=локинг
хаус=хаус
реггетон=реггетон
импровизация=импровизация
индийские=индийские
свинг=свинг
ирландские=ирландские
шотландские=шотландские
буги-вуги=буги-вуги
линди-хоп=линди-хоп
контактная импровизация=контактная импровизация
исторические=исторические
рок-н-ролл=рок-н-ролл',
                     'category_id' => '11',
                     'key'         => 'dance',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '164',
                     'title'       => 'личный тренер',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '11',
                     'key'         => 'personal_tra',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '165',
                     'title'       => 'бассейн',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'бассейн=бассейн
подсветка=подсветка
купель=купель
джакузи=джакузи
гидромассаж=гидромассаж
подогрев=подогрев
противоток=противоток
гидромассажная ванна=гидромассажная ванна
водопад=водопад
фонтан=фонтан',
                     'category_id' => '43',
                     'key'         => 'water_stuff',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '166',
                     'title'       => 'парная',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'финская=финская
русская=русская
турецкая=турецкая
инфракрасная=инфракрасная
на дровах=на дровах
японская=японская
римская=римская',
                     'category_id' => '43',
                     'key'         => 'steam',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '167',
                     'title'       => 'караоке',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'karaoke',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '170',
                     'title'       => 'wi-fi',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'wi_fi',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '172',
                     'title'       => 'spa',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'spa',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '174',
                     'title'       => 'солярий',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'solarium',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '175',
                     'title'       => 'сауна',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'sauna',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '176',
                     'title'       => 'массаж',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'massage',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '177',
                     'title'       => 'бассейн',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'pool',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '183',
                     'title'       => 'лагуна',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'lagoon',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '185',
                     'title'       => 'волновой бассейн',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'wave_pool',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '188',
                     'title'       => 'джакузи',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'whirlpool',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '190',
                     'title'       => 'вода в бассейне',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'морская=морская
минеральная=минеральная',
                     'category_id' => '43',
                     'key'         => 'water_pool',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '191',
                     'title'       => 'трамплин',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '43',
                     'key'         => 'trampoline',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '195',
                     'title'       => 'сеанс в бассейне',
                     'help'        => '',
                     'type'        => 'RangeIn',
                     'params'      => '0
45
Выбран %d',
                     'category_id' => '43',
                     'key'         => 'time_swimmin',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '197',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '29',
                     'key'         => 'car_park',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '198',
                     'title'       => 'парковка',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'бесплатная=бесплатная
открытая=открытая
наземная=наземная
неохраняемая=неохраняемая
охраняемая=охраняемая
длительная=длительная
для легковых автомобилей=для легковых автомобилей
VIP=VIP
гостевая=гостевая
предварительное бронирование=предварительное бронирование
платная=платная',
                     'category_id' => '29',
                     'key'         => 'type_parking',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '199',
                     'title'       => 'число горок/аттракционов',
                     'help'        => '',
                     'type'        => 'RangeIn',
                     'params'      => '0
4
Выбран %d',
                     'category_id' => '29',
                     'key'         => 'number_of_at',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '200',
                     'title'       => 'аттракционы',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '42',
                     'key'         => 'attractions',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '201',
                     'title'       => 'отделы в зоопарке',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'отдел приматов=отдел приматов
отдел хищных=отдел хищных
отдел копытных=отдел копытных
отдел грызунов=отдел грызунов
отдел орнитологии=отдел орнитологии
экзотариум=экзотариум
инсектарий=инсектарий
аквариальный отдел=аквариальный отдел',
                     'category_id' => '42',
                     'key'         => 'zoo_areas',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '202',
                     'title'       => 'аудиогид',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '42',
                     'key'         => 'audio_guide',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '203',
                     'title'       => 'проведение дней рождения',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '42',
                     'key'         => 'birthdays',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '204',
                     'title'       => 'экскурсии',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '42',
                     'key'         => 'excursions',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '207',
                     'title'       => '3D',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '14',
                     'key'         => '3d',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '209',
                     'title'       => 'VIP-зона',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '14',
                     'key'         => 'vip-zone',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '210',
                     'title'       => 'под открытым небом',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '14',
                     'key'         => 'outdoor',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '212',
                     'title'       => 'кафе',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '14',
                     'key'         => 'cafe',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '213',
                     'title'       => 'imax',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '14',
                     'key'         => 'imax',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '215',
                     'title'       => 'звук',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'SDDS=SDDS
Dolby Surround EX=Dolby Surround EX
моно=моно',
                     'category_id' => '14',
                     'key'         => 'sound',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '216',
                     'title'       => 'спектакли',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'драматические=драматические
детские=детские
кукольные=кукольные
мюзикл=мюзикл
балет=балет
опера=опера
пародия=пародия
пантомима=пантомима
оперетта=оперетта',
                     'category_id' => '14',
                     'key'         => 'performance',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '217',
                     'title'       => 'театр',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'театр песни и поэзии=театр песни и поэзии
театр танца=театр танца
театр зверей=театр зверей
театр эстрады=театр эстрады
театр теней=театр теней',
                     'category_id' => '14',
                     'key'         => 'theater_type',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '218',
                     'title'       => 'залов',
                     'help'        => '',
                     'type'        => 'RangeIn',
                     'params'      => '0
12
Выбран %d',
                     'category_id' => '14',
                     'key'         => 'number_halls',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '220',
                     'title'       => 'выезд на дом',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'home_visit',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '221',
                     'title'       => 'косметология',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'beautician',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '225',
                     'title'       => 'стрижка',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'haircut',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '228',
                     'title'       => 'макияж',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'свадебный=свадебный
вечерний=вечерний
естественный=естественный
для фотосессий=для фотосессий
деловой=деловой
омолаживающий=омолаживающий
для показов=для показов
стилизация=стилизация',
                     'category_id' => '53',
                     'key'         => 'make-up',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '230',
                     'title'       => 'стайлинг',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'styling',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '231',
                     'title'       => 'криотерапия',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'cryotherapy',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '233',
                     'title'       => 'флоатинг',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'floating',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '234',
                     'title'       => 'эпиляция',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'лазерная=лазерная
восковая=восковая
сахарная=сахарная
фотоэпиляция=фотоэпиляция
электроэпиляция=электроэпиляция
энзимная=энзимная',
                     'category_id' => '53',
                     'key'         => 'hair_removal',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '235',
                     'title'       => 'пирсинг',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'piercing',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '237',
                     'title'       => 'солярий',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'solarium',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '238',
                     'title'       => 'тату',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'татуаж=татуаж
татуировки=татуировки
био-тату=био-тату',
                     'category_id' => '53',
                     'key'         => 'tattoo',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '239',
                     'title'       => 'spa',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'spa',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '242',
                     'title'       => 'spa',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'spa-маникюр=spa-маникюр
spa-программы=spa-программы
spa-педикюр=spa-педикюр
spa-капсула=spa-капсула',
                     'category_id' => '53',
                     'key'         => 'spa_services',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '243',
                     'title'       => 'боди-арт',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'body-art',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '247',
                     'title'       => 'салон красоты',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '53',
                     'key'         => 'beauty_salon',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '249',
                     'title'       => 'Специальность',
                     'help'        => '',
                     'type'        => 'Multy',
                     'params'      => 'Мастер маникюра, педикюра=Мастер маникюра, педикюра
Парикмахер=Парикмахер
Косметолог=Косметолог
Визажист=Визажист
Стилист=Стилист',
                     'category_id' => '53',
                     'key'         => 'speciality',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
        $this->insert(
             "filters", array(
                     'id'          => '253',
                     'title'       => 'аудиогид',
                     'help'        => '',
                     'type'        => 'Bool',
                     'params'      => '',
                     'category_id' => '9',
                     'key'         => 'audio_guide',
                     'king'        => 'lower',
                     'position'    => '0',
                 )
        );
    }
}