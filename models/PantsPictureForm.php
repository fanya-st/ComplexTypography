<?php


namespace app\models;


use Ramsey\Uuid\Uuid;
use thamtech\uuid\helpers\UuidHelper;

class PantsPictureForm extends Pants
{
    public $picture;

    public function rules(){
        return[
            [['picture'], 'image','skipOnEmpty' => true, 'extensions' => 'gif,png,jpg,jpeg','maxSize'=>50*1024*1024],
        ];
    }

    public function upload($model)
    {
        if ($this->validate()) {
            $uuid=UuidHelper::uuid();
            if ($this->picture && $this->picture->tempName) {
                $this->picture->saveAs('pants/' . $uuid . '.' . $this->picture->extension);
                $model->picture = 'pants/' . $uuid . '.' . $this->picture->extension;
            }
            return true;
        } else {
            return false;
        }
    }
}