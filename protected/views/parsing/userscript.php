<?php
/**
 * Created by PhpStorm.
 * User: ZyManch
 * Date: 16.03.14
 * Time: 9:48
 */?>
<pre>

<ol>
    <li>Скачайте <a href="http://www.telerik.com/download/fiddler" target="_blank">fiddler</a></li>
    <li>
        Заполните поля <b>AutoResponder</b> следующими значениями:
        <ul>
            <li>Rule editor: http://maps.yandex.ru/script.js</li>
            <li>Local file: http://kuda-pojti.com/parsing/script</li>
            <li>Rule editor: http://maps.yandex.ru/download.js</li>
            <li>Local file: http://kuda-pojti.com/parsing/download</li>
        </ul>
    </li>
    <li>fiddler необходимо запускать до запуска оперы</li>
</ol>


if(location.href.indexOf('maps.yandex.ru')!==-1) {
    var script = document.createElement('script');
    script.setAttribute('type',"text/javascript");
    script.src = "http://<?php echo $_SERVER['SERVER_NAME'];?>/parsing/script";
    document.getElementsByTagName('head')[0].appendChild(script);
}
</pre>