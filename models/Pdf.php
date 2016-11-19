<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pdf".
 *
 * @property integer $Id
 * @property string $pdf_name
 * @property string $created_at
 * @property integer $report_id
 */
class Pdf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pdf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id'], 'integer'],
            [['pdf_name', 'created_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'pdf_name' => 'Pdf Name',
            'created_at' => 'Created At',
            'report_id' => 'Report ID',
        ];
    }

    public static function savePdf($report_id, $pdfs)
    {
        if (count($pdfs) == 0) {
            return;
        }

        $subsql = "";
        for ($i=0; $i < count($pdfs); $i++) {
            $pdf = $pdfs[$i];
            $subsql .= sprintf("('%s', '%s', %d),", $pdf['pdf_name'], $pdf['created_at'], $report_id);
        }

        $sql = "INSERT tbl_pdf (pdf_name, created_at, report_id) VALUES $subsql";
         $sql = substr($sql, 0, -1);
        Yii::$app->getDb()->createCommand($sql)->execute();
    }
}
