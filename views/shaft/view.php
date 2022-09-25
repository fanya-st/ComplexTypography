<?php


use yii\bootstrap5\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Валы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shaft-view">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo  Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'polymer_kind_id',
                'value' => $model->polymerKind->name,
            ],
        ],
    ]) ?>

</div>
