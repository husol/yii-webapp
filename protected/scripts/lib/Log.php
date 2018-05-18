<?php
/**
 * AdServer's logging class
 *
 * This class is designed to build log files based on the
 * W3C specification at: http://www.w3.org/TR/WD-logfile.html
 *
 * Adapted based on Joomla's JLog
 */
class Log
{
	/**
	 * Log File Pointer
	 * @var	resource
	 */
	var $_file;

	/**
	 * Log File Path
	 * @var	string
	 */
	var $_path;

	/**
	 * Log Format
	 * @var	string
	 */
	var $_format = "{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}";

	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	string	$path		Log file path
	 * @param	array	$options	Log file options
	 */
	function __construct($path, $options)
	{
		// Set default values
		$this->_path = $path;
		$this->setOptions($options);
	}

	/**
	 * Returns a reference to the global log object, only creating it
	 * if it doesn't already exist.
	 *
	 * This method must be invoked as:
	 * 		<pre>  $log = & Log::getInstance();</pre>
	 *
	 * @access	public
	 * @static
	 * @return	object	The Log object.
	 */
	function & getInstance($path, $options = null)
	{
		static $instances;

		$sig = md5($path);

		if (!isset ($instances)) {
			$instances = array ();
		}

		if (empty ($instances[$sig])) {
			$instances[$sig] = new Log($path, $options);
		}

		return $instances[$sig];
	}

	/**
	 * Set log file options
	 *
	 * @access	public
	 * @param	array	$options	Associative array of options to set
	 * @return	boolean				True if successful
	 */
	function setOptions($options) {

		if (isset ($options['format'])) {
			$this->_format = $options['format'];
		}
		return true;
	}

	function addEntry($entry)
	{
		if (!isset ($entry['date'])) {
			$entry['date'] = date('Y-m-d');
		}
		if (!isset ($entry['time'])) {
			$entry['time'] = date('H:i:s');
		}
		if (!isset ($entry['c-ip'])) {
			$entry['c-ip'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		}

		// Ensure that the log entry keys are all uppercase
		$entry = array_change_key_case($entry, CASE_UPPER);

		// Find all fields in the format string
		$fields = array ();
		$regex = "/{(.*?)}/i";
		preg_match_all($regex, $this->_format, $fields);

		// Fill in the field data
		$line = $this->_format;
		for ($i = 0; $i < count($fields[0]); $i++)
		{
			$line = str_replace($fields[0][$i], (isset ($entry[$fields[1][$i]])) ? $entry[$fields[1][$i]] : "-", $line);
		}

		// Write the log entry line
		if ($this->_openLog())
		{
			if (!fputs($this->_file, "\n" . $line)) {
				return false;
			}
		} else {
			return false;
		}
		return true;
	}

	/**
	 * Open the log file pointer and create the file if it doesn't exist
	 *
	 * @access 	public
	 * @return 	boolean	True on success
	 */
	function _openLog()
	{
		// Only open if not already opened...
		if (is_resource($this->_file)) {
			return true;
		}

		if (!file_exists($this->_path))
		{
			// Prepare the fields string
			$fields = str_replace("{", "", $this->_format);
			$fields = str_replace("}", "", $fields);
			$fields = strtolower($fields);
			$header[] = $fields;

			$head = implode("\n", $header);
		} else {
			$head = false;
		}

		if (!$this->_file = fopen($this->_path, "a")) {
			return false;
		}

		if ($head)
		{
			if (!fputs($this->_file, $head)) {
				return false;
			}
		}

		if (!$this->_file = fopen($this->_path, "a")) {
			return false;
		}

		// If we opened the file lets make sure we close it
		register_shutdown_function(array(&$this,'_closeLog'));
		return true;
	}

	/**
	 * Close the log file pointer
	 *
	 * @access 	public
	 * @return 	boolean	True on success
	 */
	function _closeLog()
	{
		if (is_resource($this->_file)) {
			fclose($this->_file);
		}
		return true;
	}
}