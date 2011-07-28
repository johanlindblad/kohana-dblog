<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * @package    dblog
 * @author     Bastian Bräu
 */
class Model_DBlog_Log extends ORM
{
	protected $_table_name = 'logs';
	protected $_primary_key = 'id';
	protected $_primary_val = 'message';
	protected $_created_column = array('column' => 'created', 'format' => TRUE);
	protected $_updated_column = array('column' => 'updated', 'format' => TRUE);

	public function set_additional_data(array $additional_data)
	{
		foreach ($additional_data as $key => & $value)
		{
			$this->$key = $value;
		}
		return $this;
	}

	public function __get($column) {
		switch ($column)
		{
			case 'tstamp':
				$val = strftime(self::$time_format, parent::__get('tstamp'));
				break;
			default:
				$val = parent::__get($column);
		}
		return $val;
	}

	/**
	 * Get table name from config
	 *
	 * @return  void
	 */
	protected function _initialize()
	{
		$this->_table_name = Kohana::$config->load('dblog.table');
		parent::_initialize();
	}

}