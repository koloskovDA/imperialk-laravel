<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\shop\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form col-md-5">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->where('id<>1')->addOrderBy('lft')->all(),'id','name')) ?>


    <?= $form->field($model, 'sku')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'metal')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'diameter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'packing')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'trial')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'quality_coin')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'degree_safe')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'circulation')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'specificity')->textInput(['maxlength' => 255]) ?>
    <?php if($model->isNewRecord):?>
         <?= $form->field($model, 'image')->fileInput() ?>
    <?php else:?>
        <?php
        echo \newerton\jcrop\jCrop::widget([
            // Image URL
            'url' => Yii::getAlias('@web/upload/product') . DIRECTORY_SEPARATOR .$model->image,
            // options for the IMG element
            'imageOptions' => [
                'id' => 'imageId',
                'alt' => 'Crop this image'
            ],
            // Jcrop options (see Jcrop documentation [http://deepliquid.com/content/Jcrop_Manual.html])
            'jsOptions' => array(
                'minSize' => [50, 50],
               // 'aspectRatio' => 1,
                'onRelease' => new yii\web\JsExpression("function() {ejcrop_cancelCrop(this);}"),
                //customization

                'bgOpacity' => 0.4,
                'selection' => true,
                'theme' => 'light',
            ),
            // if this array is empty, buttons will not be added
            'buttons' => array(
                'start' => array(
                    'label' => 'Выделите область для обрезки',
                    'htmlOptions' => array(
                        'class' => 'myClass',
                        'style' => 'color:red;'
                    )
                ),
                'crop' => array(
                    'label' => 'Обрезать',
                ),
                'cancel' => array(
                    'label' => 'Отменить'
                )
            ),
            // URL to send request to (unused if no buttons)
            'ajaxUrl' => 'crop',
            // Additional parameters to send to the AJAX call (unused if no buttons)
            'ajaxParams' => ['imgPath' =>'product/'.$model->image ],
        ]);
        ?>
        <?= $form->field($model, 'image')->fileInput() ?>

    <?php endif;?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'h1_title')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
