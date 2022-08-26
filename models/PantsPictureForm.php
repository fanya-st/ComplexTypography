<?php


namespace app\models;


class PantsPictureForm extends Pants
{
    public $picture;

    public function rules(){
        return[
            [['picture'], 'image','skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg','maxSize'=>50*1024*1024],
        ];
    }

    public function upload($model)
    {
        if ($this->validate()) {
            if ($this->picture && $this->picture->tempName) {
                $this->picture->saveAs('pants/' . $model->id . '.' . $this->picture->extension);
                $model->picture = 'pants/' . $model->id . '.' . $this->picture->extension;
            }
            return true;
        } else {
            return false;
        }
    }
}