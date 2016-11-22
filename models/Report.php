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
 * @property string $lat
 * @property string $lng
 * @property string $installer
 * @property string $install_date
 * @property string $equipment
 * @property string $engineer
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
            [['customer', 'address', 'lat', 'lng', 'installer', 'install_date', 'equipment', 'engineer'], 'string', 'max' => 255],
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
            'lat' => 'Lat',
            'lng' => 'Lng',
            'installer' => 'Installer',
            'install_date' => 'Install Date',
            'equipment' => 'Equipment',
            'engineer' => 'Engineer',
        ];
    }

     public static function saveReport($report)
    {
        if (empty($report) || count($report) == 1) {
            return;
        }
        
        $sql = sprintf("INSERT tbl_report (notes, customer, address, lat, lng, installer, install_date, equipment, engineer) VALUES ('%s', '%s', '%s',  '%s',  '%s', '%s', '%s', '%s', '%s')", $report['notes'], $report['customer'], $report['address'], $report['lat'], $report['lng'], $report['installer'], $report['installDate'], $report['equipment'], $report['engineer']);

        Yii::$app->getDb()->createCommand($sql)->execute();
        return Yii::$app->getDb()->getLastInsertID();
    }

    public static function findAllReports()
    {
        $sql = "SELECT * from tbl_report";
        $reports = Yii::$app->getDb()->createCommand($sql)->queryAll();

        $sql = "SELECT * from tbl_pile";
        $piles = Yii::$app->getDb()->createCommand($sql)->queryAll();

        $sql = "SELECT * from tbl_photo";
        $photos = Yii::$app->getDb()->createCommand($sql)->queryAll();

        $sql = "SELECT * from tbl_pdf";
        $pdfs = Yii::$app->getDb()->createCommand($sql)->queryAll();

        for ($i=0; $i < count($reports); $i++) { 
            $reports[$i]['piles'] = [];
            for ($j=0; $j < count($piles); $j++) { 
                if ($reports[$i]['Id'] == $piles[$j]['report_id']) {
                    $reports[$i]['piles'][] = $piles[$j];
                }
            }

            for ($j=0; $j < count($photos); $j++) { 
                if ($reports[$i]['Id'] == $photos[$j]['report_id']) {
                    $reports[$i]['photos'][] = $photos[$j];
                }
            }

            for ($j=0; $j < count($pdfs); $j++) { 
                if ($reports[$i]['Id'] == $pdfs[$j]['report_id']) {
                    $reports[$i]['pdfs'][] = $pdfs[$j];
                }
            }
        }

        return $reports;
    }
}
