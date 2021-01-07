<?php

use humhub\libs\Html;
use humhub\modules\user\models\forms\Login;
use humhub\modules\user\models\Invite;
use yii\captcha\Captcha;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use humhub\modules\user\widgets\AuthChoice;
use humhub\widgets\SiteLogo;

$this->pageTitle = Yii::t('UserModule.auth', 'Login');

$news = array(
    array(
        "title" => "Business Ultra Day",
        "category" => "Bussiness",
        "date" => "2. November 2021",
        "image" => "https://geisens.com/wp-content/uploads/2019/10/jad-limcaco-VZAtCl6MQZc-unsplash-700x500.jpg",
        "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, dignissimos! Nulla    consequatur fugit eos unde ipsa amet. Veniam doloribus explicabo, harum voluptatum libero delectus adipisci itaque quasi dolor natus amet!",
        "link" => "https://geisens.com/events/"
    ),
    array(
        "title" => "Business Ultra Day",
        "category" => "Bussiness",
        "date" => "2. November 2021",
        "image" => "",
        "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, dignissimos! Nulla    consequatur fugit eos unde ipsa amet. Veniam doloribus explicabo, harum voluptatum libero delectus adipisci itaque quasi dolor natus amet!",
        "link" => "https://geisens.com/events/"
    ),
    array(
        "title" => "Business Ultra Day",
        "category" => "Bussiness",
        "date" => "2. November 2021",
        "image" => "",
        "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit, dignissimos! Nulla    consequatur fugit eos unde ipsa amet. Veniam doloribus explicabo, harum voluptatum libero delectus adipisci itaque quasi dolor natus amet!",
        "link" => "https://geisens.com/events/"
    ),
)

/* @var $canRegister boolean */
/* @var $model Login */
/* @var $invite Invite */
?>

<div class="row" style="margin: 0;">
    <div class="col-md-5 text-center login-right">
        <div style="text-align: center;">
            <?= SiteLogo::widget(['place' => 'login']); ?>
            <br>

            <div class="panel panel-default animated bounceIn" id="login-form"
                style="margin: 0 auto 20px; text-align: center;">

                <div class="panel-heading"><?= Yii::t('UserModule.auth', '<strong>Please</strong> sign in'); ?></div>

                <div class="panel-body">

                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (AuthChoice::hasClients()): ?>
                        <?= AuthChoice::widget([]) ?>
                    <?php else: ?>
                        <?php if ($canRegister) : ?>
                            <p><?= Yii::t('UserModule.auth', "If you're already a member, please login with your username/email and password."); ?></p>
                        <?php else: ?>
                            <p><?= Yii::t('UserModule.auth', "Please login with your username/email and password."); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'enableClientValidation' => false]); ?>
                        <?= $form->field($model, 'username')->textInput(['id' => 'login_username', 'placeholder' => $model->getAttributeLabel('username'), 'aria-label' => $model->getAttributeLabel('username')])->label(false); ?>
                        <?= $form->field($model, 'password')
                            ->passwordInput(['id' => 'login_password', 'placeholder' => $model->getAttributeLabel('password'), 'aria-label' => $model->getAttributeLabel('password')])
                            ->label(false); ?>
                        <?= $form->field($model, 'rememberMe')->checkbox(); ?>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <?= Html::submitButton(Yii::t('UserModule.auth', 'Sign in'), ['id' => 'login-button', 'data-ui-loader' => "", 'class' => 'btn btn-large btn-primary']); ?>
                            </div>
                            <div class="col-md-12 text-center">
                                <a id="password-recovery-link" href="<?= Url::toRoute('/user/password-recovery'); ?>"
                                data-pjax-prevent>
                                    <button id="password-recovery-button" class="btn btn-large btn-password">
                                        <?= Yii::t('UserModule.auth', 'Forgot your password?') ?>
                                    </button>
                                </a>

                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <br>

            <?php if ($canRegister) : ?>
                <div id="register-form"
                    class="panel panel-default animated bounceInLeft"
                    style="margin: 0 auto 20px; text-align: center;">

                    <div class="panel-heading"><?= Yii::t('UserModule.auth', '<strong>Sign</strong> up') ?></div>

                    <div class="panel-body">

                        <p><?= Yii::t('UserModule.auth', "Don't have an account? Join the network by entering your e-mail address."); ?></p>

                        <?php $form = ActiveForm::begin(['id' => 'invite-form']); ?>
                        <?= $form->field($invite, 'email')->input('email', ['id' => 'register-email', 'placeholder' => $invite->getAttributeLabel('email'), 'aria-label' => $invite->getAttributeLabel('email')])->label(false); ?>
                        <?php if ($invite->showCaptureInRegisterForm()) : ?>
                            <div id="registration-form-captcha" style="display: none;">
                                <div><?= Yii::t('UserModule.auth', 'Please enter the letters from the image.'); ?></div>

                                <?= $form->field($invite, 'captcha')->widget(Captcha::class, [
                                    'captchaAction' => 'auth/captcha',
                                ])->label(false); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?= Html::submitButton(Yii::t('UserModule.auth', 'Register'), ['class' => 'btn btn-primary', 'data-ui-loader' => '']); ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            <?php endif; ?>

            <?= humhub\widgets\LanguageChooser::widget(); ?>
        </div>
    </div>
    <div class="col-12 col-md-7 text-center login-news">
        <div class="news-container">
            <?php foreach ($news as $value) :  ;?>
            <div class="panel panel-default news-entry">
                <?php if ($value["image"] != ''): ;?>
                <div class="panel-header">
                    <img src="<?php echo $value["image"] ;?>">
                </div>
                <?php endif ;?>
                <div class="panel-body">
                    <div class="news-entry-header">
                        <div class="news-entry-category">
                            <?php echo $value["category"]; ?>
                        </div>
                        <div class="news-entry-title">
                            <a href="<?php echo $value["link"];?>">
                                <?php echo $value["title"]; ?>
                            </a>
                        </div>
                    </div>
                        
                    <div class="news-entry-body">
                        <div class="news-entry-content">
                            <?php 
                                if (strlen($value["content"]) > 200):
                                    echo substr($value["content"], 0, 200) . '...';
                                else:
                                    echo $value["content"];
                                endif;
                            ?>
                            <br />
                            <br />
                            <a href="<?php echo $value["link"];?>">
                                <?= Yii::t('CustomPagesModule.modules_template_widgets_CollapsableFOrmGroup', 'Show more'); ?>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="news-entry-footer">
                    <img src="https://geisens.com/wp-content/uploads/avatars/1/5fd9d01209f4a-bpthumb.jpg">
                    <?php echo $value["date"]; ?>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<script <?= Html::nonce() ?>>
    $(function () {
        // set cursor to login field
        $('#login_username').focus();
    });

    // Shake panel after wrong validation
    <?php if ($model->hasErrors()) { ?>
    $('#login-form').removeClass('bounceIn');
    $('#login-form').addClass('shake');
    $('#register-form').removeClass('bounceInLeft');
    $('#app-title').removeClass('fadeIn');
    <?php } ?>

    // Shake panel after wrong validation
    <?php if ($invite->hasErrors()) { ?>
    $('#register-form').removeClass('bounceInLeft');
    $('#register-form').addClass('shake');
    $('#login-form').removeClass('bounceIn');
    $('#app-title').removeClass('fadeIn');
    <?php } ?>

    <?php if ($invite->showCaptureInRegisterForm()) { ?>
    $('#register-email').on('focus', function () {
        $('#registration-form-captcha').fadeIn(500);
    });
    <?php } ?>

</script>


