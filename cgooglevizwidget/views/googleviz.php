<div id="<?php echo $id; ?>"></div>

<script type="text/javascript">
// Load the Visualization API and the chart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the chart, passes in the data and
// draws it.
function drawChart() {
	// Create the data table.
	var data = new google.visualization.DataTable();
	<?php foreach($data['columns'] as $key=>$value) : ?>
	<?php echo "data.addColumn('$key', '$value');"; ?>
	<?php endforeach; ?>
	data.addRows([
		<?php foreach($data['rows'] as $key=>$value) : ?>
		<?php echo "['$key', $value],"; ?>
		<?php endforeach; ?>
	]);
	
	// Set chart options
	var options = {
		<?php foreach(array_keys($options) as $opt) : ?>
		<?php echo $opt; ?>:<?php echo is_int($options[$opt]) ? (int)$options[$opt] : is_array($options[$opt]) ? CJSON::encode($options[$opt]) : '"'.$options[$opt].'"'; ?>,
		<?php endforeach; ?>
	};
	
	// Instantiate and draw our chart, passing in some options.
	var chart = new google.visualization.PieChart(document.getElementById('<?php echo $id; ?>'));
	chart.draw(data, options);
}
</script>