<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\adminuser */

$this->title = 'Update Adminuser: ' . $model->adminuser_id;
$this->params['breadcrumbs'][] = ['label' => 'Adminusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->adminuser_id, 'url' => ['view', 'id' => $model->adminuser_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="adminuser-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
