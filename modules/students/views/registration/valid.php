<?php
    use yii\bootstrap4\ActiveForm;
    use yii\bootstrap4\Html;
    $this->title = 'Account Confirmation';
?>
    <div class = 'return_modal'>
        <img src = "<?= $approve['img']; ?>">
        <h4><?= $approve['message']; ?></h4>
        <a href = 'http://localhost:8080/students/registration/'>OK</a>
    </div>
