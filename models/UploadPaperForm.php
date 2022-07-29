<?php


namespace app\models;


use ruskid\csvimporter\CSVImporter;
use ruskid\csvimporter\CSVReader;
use ruskid\csvimporter\MultipleImportStrategy;
use yii\db\ActiveRecord;

class UploadPaperForm extends ActiveRecord
{
    public $csv;
    public $barcode;

    public static function tableName()
    {
        return 'upload_paper';
    }

    public function attributeLabels(){
        return[
            'pallet_id'=>'ID палета от поставщика',
            'roll_id'=>'ID ролика от поставщика',
            'material_id_from_provider'=>'ID от поставщика',
            'width'=>'Ширина',
            'length'=>'Длина',
            'csv'=>'Файл CSV',

        ];
    }

    public function rules(){
        return[
            [['csv'],'file','skipOnEmpty'=>false,'extensions'=>['csv'],'checkExtensionByMimeType'=>false],
            [['barcode'],'safe'],
            [['barcode'],'trim'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $importer = new CSVImporter;
            $importer->setData(new CSVReader([
                'filename' => $this->csv->tempName,
                'fgetcsvOptions' => [
                    'delimiter' => ';'
                ]
            ]));
            $numberRowsAffected = $importer->import(new MultipleImportStrategy([
                'tableName' => UploadPaper::tableName(),
                'configs' => [
                    [
                        'attribute' => 'pallet_id',
                        'value' => function($line) {
                            return $line[0];
                        },
                        'unique' => false, //Will filter and import unique values only. can by applied for 1+ attributes
                    ],
                    [
                        'attribute' => 'width',
                        'value' => function($line) {
                            return $line[1];
                        },
                        'unique' => false,
                    ],
                    [
                        'attribute' => 'length',
                        'value' => function($line) {
                            return $line[2];
                        },
                        'unique' => false,
                    ],
                    [
                        'attribute' => 'material_id_from_provider',
                        'value' => function($line) {
                            return $line[3];
                        },
                        'unique' => false,
                    ],
                    [
                        'attribute' => 'roll_id',
                        'value' => function($line) {
                            return $line[4];
                        },
                        'unique' => false,
                    ],
                ],
            ]));
            return true;
        } else {
            return false;
        }
    }

}