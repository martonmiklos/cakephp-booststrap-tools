<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>


<div class="actions col-md-2 btn-group-vertical">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
<?php if (strpos($action, 'add') === false): ?>
	<?php echo 
"	<?php echo \$this->BootStrapButton->deleteButton(
		__('Delete'), 
		array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), 
		array('form-input'), 
		__('Are you sure you want to delete # %s?', \$this->Form->value('{$modelClass}.{$primaryKey}'))
		);
	?>\n"; ?>
<?php endif; ?>
<?php echo 
"	<?php echo \$this->BootStrapButton->buttonLink(
		__('List " . $pluralHumanName . "'), 
		array('action' => 'index'),
		array('class' => array('form-input', 'btn-warning')),
		'list'
	);?>\n";
?>
<?php
		$done = array();
		foreach ($associations as $type => $data) {
			foreach ($data as $alias => $details) {
				if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
					echo 
"	<?php 
	echo \$this->BootStrapButton->buttonLink(
		__('List " . Inflector::humanize($details['controller']) . "'), 
		array('controller' => '{$details['controller']}', 'action' => 'index'),
		array('class' => array('form-input', 'btn-warning')),
		'list'
	);
	echo \$this->BootStrapButton->addButton(
		__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), 
		array('controller' =>  '{$details['controller']}', 'action' => 'add'), 
		array('class' => array('form-input'))
	);?>\n";
					$done[] = $details['controller'];
				}
			}
		}
?>
</div>

<div class="<?php echo $pluralVar; ?> form col-md-10">
<?php echo 
"	<?php echo \$this->Form->create('{$modelClass}', array(
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control'
		),
		'class' => 'well'
	));?>\n"; ?>
	<fieldset>
		<legend><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field === $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$this->Form->input('{$field}');\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
	</fieldset>
<?php
	echo 
"	<?php echo \$this->Form->submit(
		/*\$this->element('glyphicon', array('icon' => 'ok')).*/__('Sumbit'), 
		array('div' => 'form-group','class' => 'btn btn-success', 'escape' => false)
	);?>\n";
?>
</div>
