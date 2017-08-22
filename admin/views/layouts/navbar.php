<?php
/**
 * Created by PhpStorm.
 * User: andri
 * Date: 19.08.17
 * Time: 12:45
 */
use app\widgets\Nav;

?>
<!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <?php
                        $items = [
                            ['label' => Yii::t('app', 'Home'), 'url' => ['/'], 'icon' => 'flag'],
                            ['label' => Yii::t('app', 'Forms'), 'url' => ['/'], 'icon' => 'flag'],
                            ['label' => Yii::t('app', 'UI Elements'), 'url' => ['/'], 'icon' => 'flag'],
                            ['label' => Yii::t('app', 'Tables'), 'url' => ['/'], 'icon' => 'flag'],
                            ['label' => Yii::t('app', 'Data Presentation'), 'url' => ['/'], 'icon' => 'flag'],
                            ['label' => Yii::t('app', 'Layouts'), 'url' => ['/'], 'icon' => 'flag'],
                        ];

                        echo Nav::widget([
                            'items' => $items,
                            'options' => [
                                'class' => 'nav side-menu',
                            ],
                        ]);


                        ?>


</div>

</div>
<!-- /sidebar menu -->