<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
	<base href="<?php print Yii::app()->getBaseUrl(true); ?>"/>
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/inputs.css" />
	<link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/city/<?php echo Yii::app()->params['avatar'];?>.css" />
	<title><?php print CHtml::encode($this->pageTitle); ?></title>
	<script type="text/javascript" src="js/scripts.js"></script>
    <?php if (Yii::app()->params['google_analytics']): ?>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo Yii::app()->params['google_analytics'];?>']);
        _gaq.push(['_setDomainName', 'kuda-pojti.ru']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <?php endif;?>
</head>

<body>
<div id="bg">

</div>
<div id="site_width">
	<div id="kuda_pojti"></div>
	<div id="search">
		<div class="text"></div>
		<div class="container">
			<input type="text"/>
		</div>
	</div>
	<div id="main" style="background-image: url(/images/avatars/<?php print Yii::app()->params['avatar'];?>.jpg);">
		<div class="city_label"></div>
		<div class="city_box">
			<?php $this->renderPartial('//widgets/select', array(
				'items' => array(
					//'moscow' => 'Москва',
					'chelny' => 'Набережные Челны',
				),
				'selected' => Yii::app()->params['avatar']
			));?>
		</div>
	</div>
	<div id="banners">
	
	</div>
	<div id="menu">
		<div class="items">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<a href="/" class="by_home first"><span><span>Главная</span></span></a>
					</td>
					<td>
						<a href="<?php print CHtml::normalizeUrl(array('categories/index'));?>" class="by_category"><span><span>Все места</span></span></a>
					</td>
					<td>
						<a href="<?php print CHtml::normalizeUrl(array('forumlist/index'));?>" class="by_people"><span><span>Форум</span></span></a>
					</td>
					<td>
                        <?php if(Yii::app()->user->isGuest):?>
                            <?php print CHtml::link('<span><span>Регистрация</span></span>',array('site/register'), array('class' => 'by_register'));?>
                        <?php else:?>
                            <?php print CHtml::link('<span><span>Профиль</span></span>',array('site/profile'), array('class' => 'by_profile'));?>
                        <?php endif;?>
					</td>
                    <td>
                        <?php if(Yii::app()->user->isGuest):?>
                            <?php print CHtml::link('<span><span>Войти</span></span>',array('site/login'), array('class' => 'by_login last'));?>
                        <?php else:?>
                            <?php print CHtml::link('<span><span>Выйти</span></span>',array('site/logout'), array('class' => 'by_logout last'));?>
                        <?php endif;?>
                    </td>
				</tr>
			</table>
		</div>
	</div>

	<div id="spacer1"></div>
	
	<?php if($this->adminMenu):?>
        <div id="admin-menu">
            <?php foreach ($this->adminMenu as $menuItem):?>
                <a href="<?php echo CHtml::normalizeUrl($menuItem['url']);?>">
                    <?php if ($menuItem['image']):?>
                        <img src="/images/template/buttons/<?php echo $menuItem['image'];?>.png">
                    <?php endif;?>
                    <?php echo $menuItem['label'];?>
                </a>
            <?php endforeach;?>
        </div>
	<?php endif;?>
	
	<?php echo $content; ?>
	
	<div id="spacer2"></div>
	
	<div id="footer">
		<div class="text">
			Copyright &copy; <?php echo date('Y'); ?> by <a href="http://vkontakte.ru/zymanch" target="_blank">ZyManch</a>.
		</div>
        <?php if (Yii::app()->params['counters']):?>
		<div class="liveinternet">
			<!--LiveInternet counter--><script type="text/javascript"><!--
            document.write("<a href='http://www.liveinternet.ru/click' "+
            "target=_blank><img src='//counter.yadro.ru/hit?t15.6;r"+
            escape(document.referrer)+((typeof(screen)=="undefined")?"":
            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
            ";"+Math.random()+
            "' alt='' title='LiveInternet: показано число просмотров за 24"+
            " часа, посетителей за 24 часа и за сегодня' "+
            "border='0' width='88' height='31'><\/a>")
            //--></script><!--/LiveInternet-->
		</div>
        <?php endif;?>
	</div>

</div>

</body>
</html>