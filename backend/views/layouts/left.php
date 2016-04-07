<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Sales'), 'icon' => 'fa fa-tags', 'url' => ['/sale']],
                    ['label' => Yii::t('app', 'Objects'), 'icon' => 'fa fa-home', 'url' => ['/object']],
                    ['label' => Yii::t('app', 'Map'), 'icon' => 'fa fa-map-marker', 'url' => ['/map']],
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Regions'), 'icon' => 'fa fa-map', 'url' => ['/region']],
                    ['label' => Yii::t('app', 'Districts'), 'icon' => 'fa fa-map-o', 'url' => ['/district']],
                    ['label' => Yii::t('app', 'Facilities'), 'icon' => 'fa fa-coffee', 'url' => ['/facilities']],
                    ['label' => Yii::t('app', 'Views'), 'icon' => 'fa fa-picture-o', 'url' => ['/view']],
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Users'), 'icon' => 'fa fa-user', 'url' => ['/user']],
                    ['label' => Yii::t('app', 'Phrases'), 'icon' => 'fa fa-font', 'url' => ['/message']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                ],
            ]
        ) ?>

    </section>

</aside>
