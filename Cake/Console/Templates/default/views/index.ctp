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
<div class="col-md-2 btn-group-vertical actions">
	<h3><?php echo "<?php echo __('Actions'); ?>"; ?></h3>
	<?php echo 
"	<?php echo \$this->BootStrapButton->addButton(
		__('New " . $singularHumanName . "'), 
		array('action' => 'add'), 
		array('class' => array('form-input'))
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
<div class="<?php echo $pluralVar; ?> index col-md-10">
	<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
	<tr>
	<?php foreach ($fields as $field): ?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
	<?php endforeach; ?>
		<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo	
"			<?php echo \$this->BootStrapButton->buttonLink(
				__('View'), 
				array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),
				array('class' => array('form-input', 'btn-warning')),
				'list'
			);?>";
		echo	
"			<?php echo \$this->BootStrapButton->editButton(
				__('Edit'), 
				array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),
				array('class' => array('form-input', 'btn-info'))
			);?>\n";
		echo	
"			<?php echo \$this->BootStrapButton->deleteButton(
				__('Delete'), 
				array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']),
				array(),
				__('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])
			);?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
	</tbody>
	</table>
	<p>
<?php echo 
"	<?php echo \$this->Paginator->pagination(array('ul' => 'pagination')); ?>";
?>
</div>

