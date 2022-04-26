<?php

namespace app\models\Emails;

use Yii;

/**
 * This is the model class for table "emails".
 *
 * @property int $email_id
 * @property string $receiver_name
 * @property string $receiver_email
 * @property string $subject
 * @property string $content
 * @property string $attatchment
 * @property string $time
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receiver_name', 'receiver_email', 'subject', 'content', 'attatchment'], 'required'],
            [['content'], 'string'],
            [['time'], 'safe'],
            [['receiver_name'], 'string', 'max' => 60],
            [['receiver_email'], 'string', 'max' => 400],
            [['subject'], 'string', 'max' => 200],
            [['attatchment'], 'string', 'max' => 999],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email_id' => 'Email ID',
            'receiver_name' => 'Receiver Name',
            'receiver_email' => 'Receiver Email',
            'subject' => 'Subject',
            'content' => 'Content',
            'attatchment' => 'Attatchment',
            'time' => 'Time',
        ];
    }
}
