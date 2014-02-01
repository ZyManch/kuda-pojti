<?php 
$date = strtotime('+1 day');
$yearSelected = date('Y', $date);
$monthSelected = date('m', $date);
$daySelected = date('d', $date);
$hourSelected = 18;
$minutsSelected = 0;
Yii::app()->clientScript->registerScript(
    'filter_' . $filter->key, 
    'setWorkValue("' . $filter->key . '");', 
    CClientScript::POS_LOAD
);
?>
<table>
    <tr>
        <td><b>Дата:</b></td>
        <td>
            <select class="work" id="filter_day" onchange="setWorkValue('<?php print $filter->key;?>')">
                <?php foreach (range(1, 31) as $day):?>
                <option value="<?php print $day;?>"<?php if($daySelected==$day):?> selected<?php endif;?>>
                    <?php printf('%02d', $day);?>
                </option>
                <?php endforeach;?>
            </select>
        </td>
        <td><b>.</b></td>
        <td>
            <select class="work" id="filter_month" onchange="setWorkValue('<?php print $filter->key;?>')">
                <?php foreach (range(1, 12) as $month):?>
                <option value="<?php print $month;?>"<?php if($monthSelected==$month):?> selected<?php endif;?>>
                    <?php print Yii::app()->getLocale()->getMonthName($month, 'abbreviated');?>
                </option>
                <?php endforeach;?>
            </select>
        </td>
        <td><b>.</b></td>
        <td>
            <select class="work" id="filter_year" onchange="setWorkValue('<?php print $filter->key;?>')">
                <?php foreach (range($yearSelected, $yearSelected + 1) as $year):?>
                <option value="<?php print $year;?>"<?php if($yearSelected==$year):?> selected<?php endif;?>>
                    <?php print $year;?>
                </option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr>
        <td><b>Время:</b></td>
        <td>
            <select class="work" id="filter_hour" onchange="setWorkValue('<?php print $filter->key;?>')">
                <?php foreach (range(0, 23) as $hour):?>
                <option value="<?php print $hour;?>"<?php if($hourSelected==$hour):?> selected<?php endif;?>>
                    <?php printf('%02d', $hour);?>
                </option>
                <?php endforeach;?>
            </select>
        </td>
        <td><b>:</b></td>
        <td>
            <select class="work" id="filter_minuts" onchange="setWorkValue('<?php print $filter->key;?>')">
                <?php foreach (range(0, 59, 10) as $minuts):?>
                <option value="<?php print $minuts;?>"<?php if($minutsSelected==$minuts):?> selected<?php endif;?>>
                    <?php printf('%02d', $minuts);?>
                </option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
</table>