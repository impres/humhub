<?php

use humhub\modules\user\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var User $user */
?>
<div class="panel-heading">
    <?php echo Yii::t('UserModule.account', '<strong>User</strong> modules'); ?>
</div>

<div class="panel-body">
    <div class="help-block"><?php echo Yii::t('UserModule.account', 'Enhance your profile with modules.'); ?></div>

    <?php foreach ($availableModules as $moduleId => $module): ?>
        <hr>
        <div class="media">
            <a class="pull-left" href="#">
                <img src="<?= $module->getContentContainerImage($user); ?>"
                     class="" width="64" height="64">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $module->getContentContainerName($user); ?></h4>
                <p><?= $module->getContentContainerDescription($user); ?></p>


                    <?php if ($user->moduleManager->canDisable($module->id)): ?>
                        <a href="#" style="<?= $user->moduleManager->isEnabled($module->id) ? '' : 'display:none' ?>"
                           data-action-click="content.container.disableModule" 
                           data-action-url="<?= Url::to(['/user/account/disable-module', 'moduleId' => $module->id]) ?>" data-reload="1"
                           data-action-confirm="<?= Yii::t('UserModule.account', 'Are you really sure? *ALL* module data for your profile will be deleted!') ?>"
                           class="btn btn-sm btn-primary disable disable-module-<?= $module->id ?>" data-ui-loader>
                               <?= Yii::t('UserModule.account', 'Disable') ?>
                        </a>
                    <?php endif; ?>
                
                    <?php if ($module->getContentContainerConfigUrl($user) && $user->moduleManager->isEnabled($module->id)) : ?>
                        <?= Html::a(Yii::t('UserModule.account', 'Configure'), $module->getContentContainerConfigUrl($user), ['class' => 'btn btn-sm btn-default']); ?>
                    <?php endif; ?>

                    <a href="#" style="<?= $user->moduleManager->isEnabled($module->id) ? 'display:none' : '' ?>"
                       data-action-click="content.container.enableModule" data-action-url="<?= Url::to(['/user/account/enable-module', 'moduleId' => $module->id]) ?>" data-reload="1"
                       class="btn btn-sm btn-primary enable enable-module-<?= $module->id ?>" data-ui-loader>
                        <?= Yii::t('UserModule.account', 'Enable') ?>
                    </a>

            </div>
        </div>
    <?php endforeach; ?>
</div>