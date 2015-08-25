<?
include_once(".htdb2.inc.php");
include_once("VisitCounter/VisitCounterSettings.class.php");

class VisitCounter
{
	var $counterExists;
	
	var $counterName;
	
	var $currentCount;
	
	var $settings;
	
	function VisitCounter($counterName = "") {
		$this->settings = new VisitCounterSettings();

		if ($counterName == "") {
			$counterName = $this->settings->defaultCounterName;
		}
		
		$this->counterName = $counterName;
		$this->counterExists = null;
	}
	
	function count() {
		$this->getCurrentCount();
		
		if ($this->isValidVisit()) {
			$this->increaseCount();
		}
	}

	function countAndShow() {
		$this->count();
		
		return $this->show();
	}
	
	/**
	 * @static
	 */
	function display() {
		$instance = new VisitCounter();
		return $instance->countAndShow();
	}
	
	function ensureCounterExists() {
		if ($this->counterExists == null) {
			$dbConnection = getDbConnection();
			$counterName = addslashes($this->counterName);
			if ($result = mysql_query("SELECT COUNT(*) FROM {$this->settings->mysqlVisitCounterTableName} WHERE name = '$counterName'", $dbConnection)) {
				$row = mysql_fetch_row($result);
				$this->counterExists = $row[0] > 0;
			}
			
			if (!$this->counterExists) {
				if ($result = mysql_query("INSERT INTO {$this->settings->mysqlVisitCounterTableName} (name) VALUES ('$counterName')", $dbConnection)) {
					$this->counterExists = true;
				} else {
					 //echo mysql_error();
				}
			}
		}
	}
	
	/**
	 * @private
	 */
	function getCurrentCount() {
		$this->ensureCounterExists();
		
		$dbConnection = getDbConnection();
		
		$counterName = addslashes($this->counterName);
		if ($result = mysql_query("SELECT visitCount FROM {$this->settings->mysqlVisitCounterTableName} WHERE name = '$counterName'", $dbConnection)) {
			$row = mysql_fetch_row($result);
			$this->currentCount = $row[0];
		} else {
			$this->currentCount = -1;
		}
	}
	
	function getTodayCount() {
		$this->ensureCounterExists();
		
		$dbConnection = getDbConnection();
		
		$counterName = addslashes($this->counterName);
		if ($result = mysql_query("SELECT COUNT(*) FROM {$this->settings->mysqlValidVisitTableName} WHERE counterName = '$counterName' AND visitTime > CURDATE()", $dbConnection)) {
			$row = mysql_fetch_row($result);
			return $row[0];
		} else {
			return 0;
		}
	}
	
	function getYesterdayCount() {
		$this->ensureCounterExists();
		
		$dbConnection = getDbConnection();
		
		$counterName = addslashes($this->counterName);
		if ($result = mysql_query("SELECT COUNT(*) FROM {$this->settings->mysqlValidVisitTableName} WHERE counterName = '$counterName' AND visitTime > DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND visitTime < CURDATE()", $dbConnection)) {
			$row = mysql_fetch_row($result);
			return $row[0];
		} else {
			return 0;
		}
	}
	
	/**
	 * @private
	 */
	function increaseCount() {
		$this->ensureCounterExists();
		
		$dbConnection = getDbConnection();
		$counterName = addslashes($this->counterName);
		if ($result = mysql_query("UPDATE {$this->settings->mysqlVisitCounterTableName} SET visitCount = visitCount + 1 WHERE name = '$counterName'", $dbConnection)) {
			$this->currentCount++;
		}
	}
	
	/**
	 * @private
	 */
	function isValidVisit() {
		$isValid = true;
		
		$ip = $_SERVER["REMOTE_ADDR"];
		// A request is invalid if there exists a valid request from the same IP not older than half an hour.
		if ($this->visitedRecently($ip)) {
			$isValid = false;
		}
		
		if ($isValid) {
			$this->storeValidVisit($ip);
		}
		
		return $isValid;
	}
	
	function show() {
		$counterString = str_pad($this->currentCount, 7, "0", STR_PAD_LEFT);
		$counterArray = preg_split('//', $counterString, -1, PREG_SPLIT_NO_EMPTY);
		
		$output = "<span class=\"visitCounter\">";
		foreach ($counterArray as $char) {
			$output .= "<span class=\"visitCounterChar\">$char</span>";
		}
		$output .= "</span>";
		return $output;
	}
	
	function storeValidVisit($ip) {
		$dbConnection = getDbConnection();
		$counterName = addslashes($this->counterName);
		mysql_query("INSERT INTO {$this->settings->mysqlValidVisitTableName} (ip, counterName) VALUES ('$ip', '$counterName')");		
	}
	
	/**
	 * Returns true if there exists a valid visit from the specified IP not older then 30 minutes.
	 */
	function visitedRecently($ip) {
		$dbConnection = getDbConnection();
		// Retrieves entries with the same IP, not older than 30 minutes ago.
		$counterName = addslashes($this->counterName);
		$result = mysql_query("SELECT * FROM {$this->settings->mysqlValidVisitTableName} WHERE ip = '$ip' AND counterName = '$counterName' AND visitTime > NOW() - INTERVAL 30 MINUTE", $dbConnection);
		
		if (mysql_num_rows($result) > 0) {
			$visitedRecently = true;
		} else {
			$visitedRecently = false;
		}
		
		return $visitedRecently;
	}
}
?>