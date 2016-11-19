<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pile".
 *
 * @property integer $Id
 * @property string $model
 * @property integer $depth_foot
 * @property integer $depth_inch
 * @property integer $SLS_required_value
 * @property string $SLS_required_unit
 * @property integer $int
 * @property integer $PSI_actual
 * @property integer $torque
 * @property integer $SLS_achieved_value
 * @property string $SLS_achieved_unit
 * @property string $notes
 * @property integer $report_id
 */
class Pile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['depth_foot', 'depth_inch', 'SLS_required_value', 'int', 'PSI_actual', 'torque', 'SLS_achieved_value', 'report_id'], 'integer'],
            [['model', 'SLS_required_unit', 'SLS_achieved_unit', 'notes'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'model' => 'Model',
            'depth_foot' => 'Depth Foot',
            'depth_inch' => 'Depth Inch',
            'SLS_required_value' => 'Sls Required Value',
            'SLS_required_unit' => 'Sls Required Unit',
            'int' => 'Int',
            'PSI_actual' => 'Psi Actual',
            'torque' => 'Torque',
            'SLS_achieved_value' => 'Sls Achieved Value',
            'SLS_achieved_unit' => 'Sls Achieved Unit',
            'notes' => 'Notes',
            'report_id' => 'Report ID',
        ];
    }
}
