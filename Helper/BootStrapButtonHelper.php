<?php
class BootStrapButtonHelper extends Helper {
    public  $helpers = array('Html', 'Form');
    
    private function addOptions(&$options, $class) 
    {
		$options['escape'] = false;
		if (!isset($options['class'])) {
			$options['class'] = $class;
		} else if (is_array($options['class'])) {
			$options['class'][] = $class;
		} else {
			$options['class'] = $options['class'].' '.$class;
		}
    }
    
	public function addButton($title, $url, $options)
	{
		$this->addOptions($options, 'btn btn-success');
		$editText = '<span class="glyphicon glyphicon-plus"></span>&nbsp;'.$title;
		echo $this->Html->link($editText, $url, $options);
	}
    
	public function editButton($title, $url, $options)
	{
		$this->addOptions($options, 'btn');
		$editText = '<span class="glyphicon glyphicon-pencil"></span>&nbsp;'.$title;
		echo $this->Html->link($editText, $url, $options);
	}
	
	public function buttonLink($title, $url, $options, $glyphicon = '')
	{
		$this->addOptions($options, 'btn');
		if ($glyphicon != '')
			$title = '<span class="glyphicon glyphicon-'.$glyphicon.'"></span>&nbsp;'.$title;
		echo $this->Html->link($title, $url, $options);
	}
	
	public function button($title, $options, $glyphicon = '')
	{
		$this->addOptions($options, 'btn');
		if ($glyphicon != '')
			$title = '<span class="glyphicon glyphicon-'.$glyphicon.'"></span>&nbsp;'.$title;
		echo $this->Html->tag('button', $title, $options);
	}
	
	public function deleteButton($title, $url, $options, $confirmMessage)
	{
		$this->addOptions($options, 'btn btn-danger');
		$title = '<span class="glyphicon glyphicon-remove"></span>&nbsp;'.$title;
		echo $this->Form->postLink($title, $url, $options, $confirmMessage); 
	}
}
