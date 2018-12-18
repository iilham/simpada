<?php

use yii\helpers\Url;
use yii\helpers\Html;
$helper = Yii::$app->myHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar-bg">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar5.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!-- /.search form -->

        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header']],
                        ['label' => 'Terima Pagu', 'icon' => 'file-excel-o', 'url' => ['/dipa/create']],
                        ['label' => 'Entri Data', 'icon' => 'file-code-o', 'url' => ['/dipa'], 'visible' => $helper->sin()],
                        ['label' => 'Monitoring', 'icon' => 'database', 'url' => ['/diparealisasi'], 'visible' => $helper->sin()],
                        ['label' => 'Grafik Realisasi', 'icon' => 'bar-chart', 'url' => ['/site']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        [
                            'label' => 'Pengaturan',
                            'icon' => 'smile-o',
                            'url' => '#',
                            'items' => [
                                ['label' => 'List Pegawai', 'icon' => 'square-o', 'url' => Url::toRoute('/pegawai')],
                                [
                                    'label' => 'Tambah Pegawai',
                                    'icon' => 'clone',
                                    'visible' => (Yii::$app->user->identity->id_jabatan == 1 || Yii::$app->user->identity->id_jabatan == '3' || Yii::$app->user->identity->id_jabatan == '21') ? true : false,
                                    'url' => Url::toRoute('/pegawai/create')],
                                [
                                    'label' => 'Konfigurasi',
                                    'icon' => 'gear',
                                    'url' => Url::toRoute('/pengaturan/update?id=1'),
                                    'visible' => Yii::$app->user->id == 1 ? true : false,
                                ],
                            ]
                        ],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                    ],
                ]
        )
        ?>

    </section>

</aside>
