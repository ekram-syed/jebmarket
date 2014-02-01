<?php
$this->menu = Yii::app()->params['usermenu'];
$this->menu['blog']['active'] = true;
?>
<div class="row">
    <div class="col-md-5">
        <h1 class="page-title">View Tag</h1>
    </div>
    <div class="col-md-7">
        <div class="right_top_menu">
            <ul class="list-inline">
                <li>
                    <?php echo CHtml::link('Create',array('createtag'), array('class'=>'btn btn-success')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Update',array('updatetag', 'id'=>$model->term_id), array('class'=>'btn btn-success')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Delete',array('#'), array('submit'=>array('deletetag','id'=>$model->term_id),'confirm'=>'Are you sure you want to delete this item?', 'class'=>'btn btn-success')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Manage',array('tag'), array('class'=>'btn btn-success')); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array('class' => 'table  table-view'),
    'data'=>$model,
    'attributes'=>array(
        'name',
        'slug',
        'description',
        'count',
    ),
)); ?>
