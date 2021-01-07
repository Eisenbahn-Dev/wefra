<?php

use yii\helpers\Html;

humhub\modules\like\assets\LikeAsset::register($this);
?>

<span class="likeLinkContainer" id="likeLinkContainer_<?= $id ?>">

    <?php if (Yii::$app->user->isGuest): ?>

        <?= Html::a(Yii::t('LikeModule.base', 'Like'), Yii::$app->user->loginUrl, ['data-target' => '#globalModal']); ?>
    <?php else: ?>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $likeUrl ?>" class="like likeAnchor<?= !$canLike ? ' disabled' : '' ?>" style="<?= (!$currentUserLiked) ? '' : 'display:none'?>">
            <?= Yii::t('LikeModule.base', 'Like') ?>
        </a>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $unlikeUrl ?>" class="unlike likeAnchor<?= !$canLike ? ' disabled' : '' ?>" style="<?= ($currentUserLiked) ? '' : 'display:none'?>">
            <?= Yii::t('LikeModule.base', 'Unlike') ?>
        </a>
    <?php endif; ?>

        <!-- Create link to show all users, who liked this -->
    <a href="<?= $userListUrl; ?>" data-target="#globalModal">
        <?php if (count($likes)) : ?>
            <span class="likeCount tt" data-placement="top" data-toggle="tooltip" title="<?= $title ?>">(<?= count($likes) ?>)</span>
        <?php else: ?>
            <span class="likeCount" style="display: none;"></span>
        <?php endif; ?>
    </a>

</span>

<script>
    /* console.log('Hola'); 
    function cambio() {
        console.log("Esto cambio");
    }
    document.querySelectorAll('.likeLinkContainer').forEach( likeContainer => {
        likeContainer.addEventListener('click', function(event) {
            console.log(likeContainer.childNodes);
        })
        /* likeContainer.childNodes[1].addEventListener('click', function(event) {
            let initialTarget = document.getElementById(likeContainer.id);
            let actualContent = document.getElementById(likeContainer.id);
            console.log(initialTarget.childNodes);
            cambio()

            /* setInterval(() => {
                actualContent = document.getElementById(likeContainer.id);
                if (actualContent !== initialTarget) {
                    console.log(actualContent);
                }
            }, 1000);
        })
    }) */
</script>


