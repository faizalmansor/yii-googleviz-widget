<?php

/**
 * Copyright (c) 2012 Faizal Mansor <faizalmansor@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 *
 * This widget for use with the Yii Framework utilises the Google Visualization
 * (https://developers.google.com/chart/) to render graphs and charts for your
 * web application.
 *
 * For information on istallation and usage please visit the projects hosting page
 * on google code: http://code.google.com/p/cvisualizewidget/
 */

class CGoogleVizWidget extends CWidget
{
	/**
	 * @var string the chart type
	 */
	public $id = 'chart_div';
    
	/**
	 * @var string the chart type
	 */
	public $type = 'area';
    
	/**
	 * @var array the data
	 */
	public $data = array();

	/**
	 * @var array the options
	 */
	public $options = array();
	
	/**
	* @var array valid chart types
	*/
	private $_validChartTypes = array('area','bar','pie','column');

	/**
	* @var array chart ref
	*/
    public $chartRef = array(
        'area'=>'AreaChart',
        'bar'=>'BarChart',
        'pie'=>'PieChart',
        'column'=>'ColumnChart',
    );
	
	/**
	 * @var array
	 */
	private $_defaults = array(
		'title'=>'Title',
		'width'=>400,
		'height'=>300
	);

    /**
     * @var int
     */
    private static $count = 0;
	
	/**
	 * The initialisation method
	 */
	public function init()
	{
        //// set table id based on counter
        //if($this->tableID == 'visualize') {
        //    $this->tableID = $this->tableID.self::$count;
        //    self::$count++;
        //}
        
		// ensure valid chart type selected
		if(!in_array($this->type, $this->_validChartTypes))
			throw new CException($this->type . ' is an invalid chart type. Valid charts are ' . implode(',',$this->_validChartTypes));
		
		// check data is present
		if(empty($this->data))
			throw new CException('Please provide some data to render a display');
		
		$this->_registerWidgetScripts();
		
		parent::init();
	}
	
	/**
	 * register Google AJAX API
	 */
	private function _registerWidgetScripts()
	{
        $cs=Yii::app()->getClientScript();
		// load the javascripts
		$cs->registerScriptFile('https://www.google.com/jsapi');
	}
	
	/**
	 * Render the output
	 */
	public function run()
	{
		$this->render('googleviz',
			array(
                'id'=>$this->id,
				'data'=>$this->data,
				'options'=>array_merge($this->_defaults, $this->options)
			),
			false
		);
	}
	
}

?>