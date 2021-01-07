<?php

use humhub\assets\TopNavigationAsset;
use humhub\libs\Html;

/* @var $this \humhub\modules\ui\view\components\View */
/* @var $menu \humhub\widgets\TopMenu */
/* @var $entries \humhub\modules\ui\menu\MenuEntry[] */

TopNavigationAsset::register($this);

?>
<div class="second-title">
    <span class="second-inactive">
        <i class="fa fa-circle" aria-hidden="true"></i>
    </span>
    <span class="second-active">
        COMMUNITY
    </span>
</div>
<?php foreach ($entries as $entry) : ?>
    <li class="top-menu-item2 <?php if ($entry->getIsActive()): ?>active<?php endif; ?>">
        <?= Html::a($entry->getIcon() . $entry->getLabel(), $entry->getUrl(), $entry->getHtmlOptions()); ?>
    </li>
<?php endforeach; ?>

<li id="top-menu-sub" class="dropdown" style="display:none;">
    <a href="#" id="top-dropdown-menu" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-align-justify"></i><br>
        <?= Yii::t('base', 'Menu'); ?>
        <b class="caret"></b>
    </a>
    <ul id="top-menu-sub-dropdown" class="dropdown-menu">

    </ul>
</li>
