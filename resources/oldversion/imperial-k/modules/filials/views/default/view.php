<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Филиалы','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

 <h1><?= Html::encode($this->title) ?></h1>

<?=
	DetailView::widget([
    'model' => $model,
    'attributes' => [
        [                      
            'label' => 'Инфо',
            'value' => $model->info,
        ],             
    ],
]);

?>
</div>