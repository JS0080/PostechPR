<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_photo".
 *
 * @property integer $Id
 * @property string $photo_name
 * @property string $created_at
 * @property integer $report_id
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['photo_name', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'photo_name' => 'Photo Name',
            'created_at' => 'Created At',
            'report_id' => 'Report ID',
        ];
    }

    public static function savePhoto($report_id, $photos)
    {
        if (count($photos) == 0) {
            return;
        }

        $subsql = "";
        for ($i=0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $subsql .= sprintf("('%s', '%s', %d),", $photo['photo_name'], $photo['created_at'], $report_id);
        }

        $sql = "INSERT tbl_photo (photo_name, created_at, report_id) VALUES $subsql";
         $sql = substr($sql, 0, -1);
        Yii::$app->getDb()->createCommand($sql)->execute();
    }
}
