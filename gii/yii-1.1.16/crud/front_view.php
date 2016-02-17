<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/**
 * <?php echo $this->pluralize($this->class2name($this->modelClass)); ?> (<?php echo $this->class2id($this->modelClass); ?>)
 * @var $this <?php echo $this->getControllerClass()."\n"; ?>
 * @var $model <?php echo $this->getModelClass()."\n"; ?>
 *
 * @author Putra Sudaryanto <putra.sudaryanto@gmail.com>
 * @copyright Copyright (c) 2016 Ommu Platform (ommu.co)
 * @created date <?php echo date('j F Y, H:i')." WIB\n"; ?>
 * @link http://company.ommu.co
 * @contect (+62)856-299-4114
 *
 */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\t\$this->breadcrumbs=array(
	\t'$label'=>array('manage'),
	\t\$model->{$nameColumn},
\t);\n";
?>
?>

<?php 
echo "<?php //begin.Messages ?>\n";
echo "<?php\n";
echo "if(Yii::app()->user->hasFlash('success'))
	echo Utility::flashSuccess(Yii::app()->user->getFlash('success'));
?>\n";
echo "<?php //end.Messages ?>\n";?>

<?php echo "<?php"; ?> $this->widget('application.components.system.FDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
/*
echo '<pre>';
print_r($this->tableSchema);
print_r($this->tableSchema->columns);
echo '</pre>';
//echo exit();
*/

foreach($this->tableSchema->columns as $name=>$column)
	if(in_array($column->name, array('publish','status'))) {
		echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'$name',\n";
		echo "\t\t\t'value'=>\$model->$name == '1' ? Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/publish.png') : Chtml::image(Yii::app()->theme->baseUrl.'/images/icons/unpublish.png'),\n";
		echo "\t\t\t//'value'=>\$model->$name,\n";
		echo "\t\t),\n";		
	} else if($column->dbType == 'text') {
		echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'$name',\n";
		echo "\t\t\t'value'=>'value'=>\$model->$name != '' ? \$model->$name : '-',\n";
		echo "\t\t\t//'value'=>\$model->$name != '' ? CHtml::link(\$model->$name, Yii::app()->request->baseUrl.'/public/visit/'.\$model->$name, array('target' => '_blank')) : '-',\n";
		echo "\t\t\t'type'=>'raw',\n";
		echo "\t\t),\n";
	} else if(in_array($column->dbType, array('timestamp','datetime','date'))) {
		if(in_array($column->dbType, array('timestamp','datetime'))) {
			echo "\t\tarray(\n";
			echo "\t\t\t'name'=>'$name',\n";
			echo "\t\t\t'value'=>Utility::dateFormat(\$model->$name, true),\n";
			echo "\t\t),\n";
		} else {
			echo "\t\tarray(\n";
			echo "\t\t\t'name'=>'$name',\n";
			echo "\t\t\t'value'=>Utility::dateFormat(\$model->$name),\n";
			echo "\t\t),\n";			
		}
	} else {
		echo "\t\tarray(\n";
		echo "\t\t\t'name'=>'$name',\n";
		echo "\t\t\t'value'=>\$model->$name,\n";		
		echo "\t\t\t//'value'=>\$model->$name != '' ? \$model->$name : '-',\n";
		echo "\t\t),\n";
	}
?>
	),
)); ?>

<?php 
echo "<div class=\"dialog-content\">\n";
echo "</div>\n";
echo "<div class=\"dialog-submit\">\n";
echo "\t<?php echo CHtml::button(Phrase::trans(4,0), array('id'=>'closed')); ?>\n";
echo "</div>\n";
?>