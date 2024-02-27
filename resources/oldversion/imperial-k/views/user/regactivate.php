<div class="row">
    <?php if (Yii::$app->session->hasFlash('regactSuccess')): ?>

        <div class="alert alert-success">
            Ваша учетная запись активирована.
        </div>

    <?php endif;?>
</div>