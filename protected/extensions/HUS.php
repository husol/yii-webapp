<?php
class HUS extends CApplicationComponent {
	static $_registry; 

	// Common
	static function _initRegistry()
	{
		HUS::$_registry = array();
	}

	static function register($object_name, $object)
	{
		if (HUS::$_registry === null) {
			HUS::_initRegistry();
		}
		
		HUS::$_registry[$object_name] = $object;
	}

	static function load($object_name)
	{
		if (HUS::$_registry === null) {
			HUS::_initRegistry();
		}
		return HUS::$_registry[$object_name];
	}

	static function registerSession($object_name, $object)
	{
		$session = new CHttpSession;
		$session->open();
		$session[$object_name] = $object;
		$session->close();
	}

 	static function loadSession($object_name)
	{
		$session = new CHttpSession;
		$session->open();
		$result = $session[$object_name];
		$session->close();
		return $result;
	}

	static function removeSession($object_name)
	{
		$session = new CHttpSession;
		$session->open();
		$result = $session->remove();
		$session->close();
		return $result;
	}

	static function removeSessionAll()
	{
		$session = new CHttpSession;
		$session->open();
		$session->clear();
		$session->destroy();
	}

	static function getHomeUrl()
	{
		return Yii::app()->homeUrl;
	}

	static function getBaseUrl() {
		return Yii::app()->request->getBaseUrl(true).'/';
	}

	static function getBackLink($text){
		$pos = strpos(Yii::app()->request->urlReferrer, self::getHomeUrl());
		if($pos === false) {
			$controller = "/".Yii::app()->controller->id;
			$arrBackLink = array($controller);
		} else {
			$arrBackLink = Yii::app()->request->urlReferrer;
		}

		return CHtml::link($text,$arrBackLink);
	}

	static function getParam($name, $default = null)
	{
		if (isset(Yii::app()->params[$name]))
			return Yii::app()->params[$name];
		else
			return $default;
	}

	function cHtmlEncode($var) {
		return CHtml::encode($var);
	}

	static function getCurrentTimeDB() {
		return new CDbExpression('NOW()');
	}

	//------------------------ Language ----------------------------------------
	// Get content rely on current language
	function lang($text) {
		$langContent = HUS::load('langContent');
		return $langContent[$text];
	}

	// Translate content rely on current language
    function getLang($content){
        $lan = HUS::load('langType');
        $arr = explode("<$lan>", $content);
        if (isset($arr[1])){
            $arr = explode("</$lan>", $arr[1]);
            return $arr[0];
        }
        return $content;
    }

	//--------------------- DB Adias -------------------------------------------
	static function buildQuery($type='array'){
		if ($type == "object")
			return Yii::app()->db->createCommand()->setFetchMode(PDO::FETCH_OBJ);
		return Yii::app()->db->createCommand();
	}

	static function query($sql,$arr_param= array()){
		return Yii::app()->db->createCommand($sql)->query($arr_param);
	}

	static function queryExecute($sql,$arr_param= array()){
		return Yii::app()->db->createCommand($sql)->execute($arr_param);
	}
	//--------------------- Image Management ------------------------------------
	static function checkImageSize($image,$w, $h){
		list($width, $height, $type, $attr) = getimagesize($image);
		if($width > $w || $height > $h)	return false;
		return true;
	}

	static function scaleImage($new_file, $old_file, $new_width, $new_height, $new_x = 0, $new_y = 0){
		list($width, $height, $type) = getimagesize($old_file);
		// Load
		$dimg = imagecreatetruecolor($new_width, $new_height);
		// type: 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP
		switch ($type) {
			case 1 : $simg = imagecreatefromgif($old_file); break;
			case 3 : $simg = imagecreatefrompng($old_file); break;
			case 6 : $simg = imagecreatefromwbmp($old_file); break;
			default : $simg = imagecreatefromjpeg($old_file);
		}
		// Resize image
		imagecopyresized($dimg, $simg, $new_x, $new_y, 0, 0, $new_width, $new_height, $width, $height);
        //Remove old image
        unlink($old_file);
		// Save new image
		switch ($type) {
			case 1 : imagegif($dimg, $new_file.'.gif'); $result = 'gif'; break;
			case 3 : imagepng($dimg, $new_file.'.png'); $result = 'png'; break;
			case 6 : imagewbmp($dimg, $new_file.'.bmp'); $result = 'bmp'; break;
			default : imagejpeg($dimg, $new_file.'.jpg'); $result = 'jpg';
		}
		imagedestroy($simg); imagedestroy($dimg);  // Destroying The Temporary Image
		return $result;
	}
	//--------------------- File Management ------------------------------------
        // Check File Type on Upload
        function checkFileExt($filename, $arr_type){
            $ext = strtolower(substr(strrchr($filename, "."),1));
            return in_array($ext, array_map("strtolower", $arr_type));
        }

	// Convert xml to csv file
	function convertFileXmlToCsv($fileXml, $fileCsv, $object) {
		if (file_exists($fileXml)) {
			$xml = simplexml_load_file($fileXml);
			$f = fopen($fileCsv, 'w');
			foreach ($xml->$object as $obj) {
				fputcsv($f, get_object_vars($obj),',','"');
			}
			fclose($f);
		}
	}
	// Get Icon Of File Type
	function getIconOfFile($filename){
	    $arrFileType = array('7z','avi','doc','docx','flv','gif','jpg','mp3','mp4','pdf','png','ppt','pptx','rar','tar','txt','wav','wma','wmv','xls','xlsx','zip');
	    $ext = strtolower(substr(strrchr($filename, "."),1));
	    foreach ($arrFileType as $type) {
		    if ($ext == $type) {
			    return HUS::getBaseUrl()."img/icon_files/icon_".$type.".png";
		    }
	    }
	    return HUS::getBaseUrl()."img/icon_files/icon_file.png";
	}
	// Backup list of records
	static function backupRecords($listRecords,$table,$fields,$sqlFile) {
		$numField = sizeof($fields); $str_fields = implode(",", $fields);
		$str_sql = "/* BACKUP DATA FOR `".$table."` */\nINSERT INTO `$table` ($str_fields) VALUES\n";
		foreach ($listRecords as $row){
			$str_sql .="(";
			foreach($fields as $field){
				$row[$field] = addslashes($row[$field]);
				$row[$field] = str_replace("\n","\\n",$row[$field]);
				$str_sql .= (isset($row[$field])) ? ('"'.$row[$field].'",') : 'NULL,';
			}
			$str_sql = substr_replace($str_sql, "),\n", -1);
		}
		$str_sql = substr_replace($str_sql, ";\n\n", -2);
		// Save to file
		file_put_contents($sqlFile, $str_sql, FILE_APPEND | LOCK_EX);
	}

	// Zip data
	function zipDir($source, $destination) {
		if (extension_loaded('zip')) {
			if (file_exists($source)) {
				$zip = new ZipArchive();
				if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
					$source = realpath($source);
					if (is_dir($source)) {
						$iterator = new RecursiveDirectoryIterator($source);
						// Skip dot files while iterating
						$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
						$files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
						foreach ($files as $file) {
							$file = realpath($file);
							if (is_dir($file)) {
								$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
							} else if (is_file($file)) {
								$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
							}
						}
					} else if (is_file($source)) {
						$zip->addFromString(basename($source), file_get_contents($source));
					}
				}
				return $zip->close();
			}
		}
		return false;
	}

	// Remove directory with all files and subdirectories
	static function removeDir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
				  if (filetype($dir.DIR_SEP.$object) == "dir") {
						HUS::removeDir($dir.DIR_SEP.$object); 
				  } else {
					  unlink($dir.DIR_SEP.$object);
				  }
				}
			}
			reset($objects);
			rmdir($dir);
		}
   }

	//---------------------- Hosting Manager ------------------------------------
	static function getSpaceHostingStatus($domain,$username,$password){
		// Url Hosting
		$url ="http://cpanel.".$domain.":2082/xml-api/cpanel?user=".$username."&cpanel_xmlapi_module=StatsBar&cpanel_xmlapi_func=stat&display=diskusage";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($curl, CURLOPT_HEADER,0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl, CURLOPT_USERPWD, $username.":".$password);
		curl_setopt($curl, CURLOPT_URL, $url);
		$result = curl_exec($curl);
		curl_close($curl); 

		$xml = simpleXML_load_string($result);

		$df = $xml->data[0]->_count + 200; // used MB - 200 MB space for backup
		$ds = $xml->data[0]->_max; // max MB
		$du = $ds - $df; // free MB
		$perc = ($ds > 0) ? number_format(100 * $df / $ds, 2) : 0;

		if ($perc > 75){
			$color = '#F61B1C';
		} elseif ($perc > 50) {
			$color = '#e8cf7d';
		} else {
			$color = '#e87d7d';
		}

		return '<li style="list-style-type: none;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#182227;color:#afc5cf;">'
			.$perc.' % used disk space'
			.'<div style="border:1px solid #ccc;width:100%;margin:2px 5px 2px 0;padding:1px">'
			.'<div style="width:'.$perc.'%;background-color:'.$color.';height:6px"></div></div>'
			.$du.' of '.$ds.' MB free'.'</li>';
	}
}

?>