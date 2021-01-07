<?php
/* @var $this \yii\web\View */
/* @var $content string */

\humhub\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= strip_tags($this->pageTitle); ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head() ?>
        <?= $this->render('head'); ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!-- start: first top navigation bar -->
        <div id="topbar-first" class="topbar">
            <div class="topbar-menu-icon">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="topbar-brand hidden-xs">
                <?= \humhub\widgets\SiteLogo::widget(); ?>
            </div>
            
            <div class="user-menu">
                <div class="topbar-actions pull-right">
                    <?= \humhub\modules\user\widgets\AccountTopMenu::widget(); ?>
                </div>
                <div class="notifications pull-right">
                    <?= \humhub\widgets\NotificationArea::widget(); ?>
                </div>
            </div>                
        </div>
        <!-- end: first top navigation bar -->

        <!-- start: second top navigation bar -->
        <div id="topbar-second" class="topbar">
            <ul class="nav" id="top-menu-nav">
                <div class="topbar-menu-icon-close">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <!-- load space chooser widget -->
                <?= \humhub\modules\space\widgets\Chooser::widget(); ?>

                <!-- load navigation from widget -->
                <?= \humhub\widgets\TopMenu::widget(); ?>
            </ul>

            <ul class="nav" id="search-menu-nav">
                <?= \humhub\widgets\TopMenuRightStack::widget(); ?>
            </ul>
        </div>
        <!-- end: second top navigation bar -->

        <?= $content; ?>

        <?php $this->endBody() ?>
    </body>

    <script>
        const topbarSecond = document.getElementById("topbar-second")
        topbarSecond.addEventListener('mouseenter', function () {
            topbarSecond.classList.add('active')
        })
        topbarSecond.addEventListener('mouseleave', function () {
            topbarSecond.classList.remove('active')
        })

        const responsiveMenuButton = document.querySelector(".topbar-menu-icon")
        responsiveMenuButton.onclick = function () {
            if (topbarSecond.classList.contains('active')) {
                console.log('Estoy active');
                topbarSecond.classList.remove('active')
            } else {
                topbarSecond.classList.add('active')
            }
        }

        const responsiveMenuButtonToClose = document.querySelector(".topbar-menu-icon-close")
        responsiveMenuButtonToClose.onclick = function () {
            if (topbarSecond.classList.contains('active')) {
                console.log('Estoy active');
                topbarSecond.classList.remove('active')
            } else {
                topbarSecond.classList.add('active')
            }
        }
    </script>
</html>
<?php $this->endPage() ?>
