<?php

namespace app\modules\students\models\Info;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "tblSTUDENTS".
 *
 * @property int $id
 * @property string $RegStud_No_PK
 * @property string $RegStud_Name1
 * @property string $RegStud_Email
 * @property string $RegStud_Name2
 * @property string $RegStud_Name3
 * @property int $RegStud_Title
 */

class Register extends ActiveRecord
{
    public static function getDb()
    {
        // use the "db_tum" application component
        return \Yii::$app->db_tum;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblSTUDENTS';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RegStud_No_PK', 'RegStud_Name1', 'RegStud_Name2', 'RegStud_Name3', 'RegStud_Email', 'RegStud_Title'], 'required'],
            [['RegStud_No_PK', 'RegStud_Email'], 'string', 'max' => 255],
            [['RegStud_No_PK', 'RegStud_Email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'RegStud_No_PK' => 'Reg Stud No Pk',
            'RegStud_Email' => 'Reg Stud Email',
            'RegStud_Name1' => 'Reg Stud Name 1',
            'RegStud_Name2' => 'Reg Stud Name 2',
            'RegStud_Name3' => 'Reg Stud Name 3',
            'RegStud_Title' => 'Reg Stud Title'
        ];
    }
}
?>