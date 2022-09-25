<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;


$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пантоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pantone-view">

    <h1><?php echo  Html::encode($this->title) ?></h1>

    <p>
        <?php echo  Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                    'attribute'=>'pantone_kind_id',
                    'value'=>$model->pantoneKind->name,
            ],
            'price_euro',
            'subscribe',
            [
                    'attribute'=>'mashine_list',
                    'value'=>function($model){
                        foreach ($model->mashine as $mashine){
                            $list.=$mashine->name.', ';
                        }
                        return $list;
                    },
            ],


        ],
    ]) ?>
    <?php if(!empty($model->mixedPantone)):?>
    <div class="row">
        <div class="col">
            <table class="table table-bordered rounded table-sm caption-top">
                <caption>Состав смешанного PANTONE</caption>
                <thead>
                <tr class="text-center">
                    <th scope="col">PANTONE</th>
                    <th scope="col">Вес</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($model->mixedPantone as $mixed_pantone):?>
                    <?php if(!empty($mixed_pantone->component_pantone_id)):?>
                        <tr class="text-center">
                            <th><?php echo $mixed_pantone->pantone->name?></th>
                            <td><?php echo $mixed_pantone->weight?></td>
                        </tr>
                    <?php endif;?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <div class="col"></div>
    </div>

    <?php endif;?>

</div>
