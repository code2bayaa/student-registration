<?php
namespace app\modules\students\middleware;

use Yii;
use app\modules\students\models\Info\Register;
use app\modules\students\models\Info\Info;

class ConfirmStudent
{
    public function fetchStudent($data){
        $connection = \Yii::$app->db_tum;
        if($data['db'])
            $connection = \Yii::$app->db;

        $rows = (new \yii\db\Query())
            ->select($data['column'])
            ->from($data['table'])
            ->limit($data['limit'])
            ->orderBy($data['order'])
            //->join('tbl_profile p', 'u.id=p.user_id')
            ->where($data['sql'], $data['query']);
        $data = $rows->all($connection);
        if(count($data) > 0)
            return $data;
        else
            return false;
    }
    public function fetchStudents($data){

        // returns all students
        $connection = \Yii::$app->db;
        $command = $connection->createCommand('SELECT * FROM post');
        $posts = $command->queryAll();
        if($posts)
            return true;
        else
            return false;
    }
    public function UpdateStudent($sql){
        $connection = \Yii::$app->db;
        $command = $connection->createCommand($sql);
        $command->execute();
        if($command)
            return true;
        else
            return false;
    }
    public function returnStudent($data){
        $rows = (new \yii\db\Query())
            ->select($data['column'])
            ->from($data['table'])
            ->where($data['query'])
            ->limit($data['limit'])
            ->all();
        if($rows)
            return $rows;
        else
            return false;
    }
}
?>