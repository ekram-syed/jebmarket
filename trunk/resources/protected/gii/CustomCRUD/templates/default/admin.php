<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1 class="page-title">Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
<div class="note bs-callout bs-callout-info">
    <p>
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </p>
</div>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn btn-primary')); ?> &nbsp;
<?php echo CHtml::link('Create', 'create', array('class' => 'btn btn-success')); ?>

<div class="search-form" style="display:none">
<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'itemsCssClass' => 'table table-striped table-hover',
        'summaryCssClass' => 'label label-info',
        'htmlOptions' => array('class' => 'table-responsive'),
        'dataProvider' => $model->search(),
        'pagerCssClass' => 'page-nav',
        'pager' => array('header' => '', 'selectedPageCssClass' => 'active', 'htmlOptions' => array('class' => 'pagination')),
        'filter' => $model,
        'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
                        'template' => '{update}{view}{delete}',
                        'buttons' => array(
                            'update' => array(
                                'label' => Yii::t('phrase', 'Edit'),
                                'imageUrl' => false,
                                'options' => array('class' => 'btn btn-warning btn-xs')
                            ),
                            'delete' => array(
                                'label' => Yii::t('phrase', 'Delete'),
                                'imageUrl' => false,
                                'options' => array('class' => 'btn btn-danger btn-xs')
                            ),
                            'view' => array(
                                'label' => Yii::t('phrase', 'View'),
                                'imageUrl' => false,
                                'options' => array('class' => 'btn btn-info btn-xs')
                            )
                        )
		),
	),
)); ?>