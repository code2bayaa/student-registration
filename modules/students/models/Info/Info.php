<?php

namespace app\modules\students\models\Info;

use Yii;

/**
 * This is the model class for table "info".
 *
 * @property int $id
 * @property string $student_id
 * @property string $name
 * @property string $student_email
 * @property string $mobile
 * @property int $personal_id
 * @property int $age
 * @property string $personal_email
 * @property string $gender
 * @property string campus
 * @property string token
 * @property date expire
 */

class Info extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'name', 'student_email', 'mobile', 'personal_id', 'age', 'personal_email', 'campus', 'gender'], 'required'],
            [['personal_id'], 'integer'],
            [['student_email','personal_email'], 'email'],
            [['token'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'name' => 'Name',
            'student_email' => 'Student Email',
            'mobile' => 'Mobile',
            'personal_id' => 'Personal ID',
            'personal_email' => 'Personal Email',
            'gender' => 'Gender',
            'campus' => 'Campus',
            'token' => 'Token',
            'expire' => 'Expire'
        ];
    }
}
