<?php


use yii\bootstrap5\Html;
use kartik\tabs\TabsX;
use yii\bootstrap5\ActiveForm;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

$this->title = Html::encode("Просмотр ID [$material->id] $material->name ");
$this->params['breadcrumbs'][] = ['label' => 'Работа с материалами', 'url' => ['material/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<!--<pre>--><?//print_r(Yii::$app->request->post())?><!--</pre>-->
<?
echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        'material_params'=>
            [
                'label' => 'Параметры материала',
                'content'=>$this->render('_material_tab',compact('material')),
                'active'=>true
            ],
        'material_archive_params'=>
            [
                'label' => 'Архивные данные',
                'content'=>$this->render('_archive_tab',compact('material')),
            ],
        'warehouse'=>
            [
                'label' => 'Складские запасы',
                'content'=>$this->render('_warehouse_tab',compact('material_warehouse')),
            ],
    ],
]);
?>
