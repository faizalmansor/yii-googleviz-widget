yii-googleviz-widget
====================

A widget to utilize Google Visualization charts in a yii project
<br />
<h2>Installation</h2>
Put the cgooglevizwidget folder into the extension directory.
The widget can now be used by adding it into the view file.

<h3>Example:</h3>
<code><pre>
<?php $this->widget('ext.cgooglevizwidget.CGoogleVizWidget',array(
  'id'=>'piechart_div',
	'type'=>'pie',
    'data'=>array(
        'columns'=>array(
            'string'=>'Topping',
            'number'=>'Slices',
        ),
        'rows'=>array(
            'Mushrooms' => 3,
            'Onions' => 1,
            'Olives'=>2,
            'Zucchini' => 3,
            'Pepperoni' => 1,
        )
    ),
    'options' => array(
        'title'=>'Pizza Toppings',
        'width'=>400,
        'height'=>300
    )
)); ?>
</pre></code>