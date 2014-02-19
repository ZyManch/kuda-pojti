<?php
/**
 * @var Mesto $model
 * @var MenuCategory $menuCategory
 */
?>

<?php foreach ($model->getMenu()->getData() as $menuCategory):?>
    <div class="menu-block">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
           'dataProvider'=>new CArrayDataProvider($menuCategory->menu,array(
               'pagination' => false,
               'sort' => array(
                   'defaultOrder' => array('price' => 'asc'),
                   'attributes' => array(
                       'title' => array(
                           'asc'=>'title ASC',
                           'desc'=>'title DESC'
                       ),
                       'price' => array(
                           'asc'=>'price ASC',
                           'desc'=>'price DESC'
                       ),
                       'value' => array(
                           'asc'=>'value ASC',
                           'desc'=>'value DESC'
                       ),
                   )

               )
           )),
           'itemsCssClass' => 'menu gradient1',
           'columns'=>array(
               array(
                   'name' => 'title',
                   'header' => $menuCategory->title
               ),
               array(
                   'name' => 'price',
                   'header' => 'Цена'
               ),
               array(
                   'header' => '#',
                   'name' => 'description',
                   'type' => 'raw',
                   'value' => function($menu) {
                       return '<div class="help"><div>'.nl2br(htmlspecialchars($menu->description)).'</div></div>';
                   }
               ),
               array(
                   'visible' => $menuCategory->settings != 'none',
                   'header' => $menuCategory->settings == 'weight' ? 'Вес' :
                           ($menuCategory->settings == 'volume' ? 'Объем' : '-'),
                   'name' => 'value',
               )
           ),
        )); ?>
    </div>
<?php endforeach;?>