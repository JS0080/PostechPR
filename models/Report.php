<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_report".
 *
 * @property integer $Id
 * @property string $notes
 * @property string $customer
 * @property string $address
 * @property string $installer
 * @property string $install_date
 * @property string $equipment
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notes'], 'string'],
            [['customer', 'address', 'installer', 'install_date', 'equipment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'notes' => 'Notes',
            'customer' => 'Customer',
            'address' => 'Address',
            'installer' => 'Installer',
            'install_date' => 'Install Date',
            'equipment' => 'Equipment',
        ];
    }
}
