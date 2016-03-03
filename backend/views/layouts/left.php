<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Sales'), 'icon' => 'fa fa-file-code-o', 'url' => ['/sale']],
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Regions'), 'icon' => 'fa fa-file-code-o', 'url' => ['/region']],
                    ['label' => Yii::t('app', 'Districts'), 'icon' => 'fa fa-file-code-o', 'url' => ['/district']],
                    ['label' => Yii::t('app', 'Facilities'), 'icon' => 'fa fa-file-code-o', 'url' => ['/facilities']],
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Phrases'), 'icon' => 'fa fa-file-code-o', 'url' => ['/message']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                ],
            ]
        ) ?>

    </section>

</aside>
