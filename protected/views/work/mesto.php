<div id="adresses">
    <ul>
        <?php foreach ($maps as $pos=>$map):?>
        <li><?php print CHtml::link($map->adress, array(
            'work/mesto',
            'id' => $model->url,
            '#' => 'work' . $map->id
        ))?></li>
        <?php endforeach;?>
    </ul>
</div>
<?php foreach ($maps as $pos=>$map):?>
<div class="work gradient1" id="work<?php print $map->id;?>">
    <b>
        <?php print $map->adress;?>
        <?php print CHtml::link('К списку адресов', array(
            'work/mesto',
            'id' => $model->url,
            '#' => 'adresses'
        ))?>
    </b>
    <div class="calendar">
        <table>
            <col width="12%"/>
            <?php for ($i=0; $i<7; $i++):?>
            <col width="11%"/>
            <?php endfor;?>
            <tr>
                <td>&nbsp;</td>
                <?php for ($i=0; $i<7; $i++):?>
                <td><?php print Yii::app()->locale->getWeekDayName(($i+1)%7, 'wide')?></td>
                <?php endfor;?>
            </tr>
            <?php for ($i=0; $i<24;$i++):?>
            <tr>
                <td><?php printf('%1$02d:00-%1$02d:59',$i);?></td>
            <?php for ($j=0; $j<7;$j++):?>
                <td></td>
            <?php endfor;?>
            </tr>
            <?php endfor;?>
        </table>
        <?php foreach ($map->work as $work):?>
        <div style="left:<?php print 11+$work->day_begin*116;?>px;width:<?php print 3+($work->day_end-$work->day_begin+1)*115;?>px;top:<?php printf('%d',15+$work->time_begin*16/60)?>px;height:<?php printf('%d', 1+($work->time_end-$work->time_begin)*16/60);?>px;"></div>
        <?php endforeach;?>
    </div>
</div>
<?php endforeach;?>