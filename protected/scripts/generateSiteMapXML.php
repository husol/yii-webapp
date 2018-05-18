<?php
require_once dirname(__FILE__)."/lib/load_config.php";
require_once dirname(__FILE__)."/lib/LogHelper.php";

class GenerateSiteMapXMLScript {
	private $xml_log_dir = null;

	function __construct()
	{
		return $this->init();
	}

	/**
	 * Initialization
	 */
	function init() {
		$this->xml_log_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;
		return true;
	}

    /////////////////////////////////////////////////////
    // x. get all links from site url
    function getAllLinks()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, SITE_URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec ($ch);
		curl_close ($ch);

		// Search The Results From The Starting Site
		$links = array();
		if( $result )
		{
			preg_match_all( "/<A[ \r\n\t]{1}[^>]*HREF[^=]*=[ '\"\n\r\t]*([^ \"'>\r\n\t#]+)[ \"'>\r\n\t#>][^>]*>/isU", $result, $output, PREG_SET_ORDER );

			foreach( $output as $item ) {
				if (!(strpos($item[1], 'index.php') === false || in_array(SITE_URL.$item[1], $links))) {
					$links[] = SITE_URL.$item[1];
				}
			}
		}

        return $links;
    }
	/////////////////////////////////////////////////////
    // xx. generate site map XML
	function generateXMLSiteMap()
	{
		$urls = array(array('loc' => SITE_URL, 'changefreq' => 'daily', 'priority' => '1.00'));
		$links = $this->getAllLinks();
		foreach($links as $link) {
			if (substr_count($link,'/') == 3) {
				$chfr = 'weekly';
				$prior = (substr_count($link, '?r=') == 0) ? '0.90' : '0.80';
			} else if (substr_count($link,'/') == 4) {
				$chfr = CHANGE_FREQ_DEFAULT;
				$prior = PRIORITY_DEFAULT;
			} else {
				$chfr = CHANGE_FREQ_DEFAULT;
				$prior = '0.60';
			}

			$urls[] = array('loc' => $link, 'changefreq' => $chfr, 'priority' => $prior);
		}

		$doc = new DOMDocument();
		$doc->formatOutput = true;

		$r = $doc->createElement( 'urlset' );
		$doc->appendChild( $r );
		$doc->createAttributeNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');

		foreach( $urls as $url )
		{
			$b = $doc->createElement( "url" );

			$loc = $doc->createElement( "loc" );
			$loc->appendChild(
				$doc->createTextNode( $url['loc'] )
			);
			$b->appendChild( $loc );

			$changefreq = $doc->createElement( "changefreq" );
			$changefreq->appendChild(
				$doc->createTextNode( $url['changefreq'] )
			);
			$b->appendChild( $changefreq );

			$priority = $doc->createElement( "priority" );
			$priority->appendChild(
				$doc->createTextNode( $url['priority'] )
			);
			$b->appendChild( $priority );

			$r->appendChild( $b );
		}
		echo $doc->saveXML();	$doc->save($this->xml_log_dir."sitemap.xml");
		return true;
	}

	/////////////////////////////////////////////////////
    // xx. submit site map XML to Google
	function submitXMLSiteMapToGoogle() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://www.google.com/webmasters/tools/ping?sitemap=".urlencode(SITE_URL."sitemap.xml"));
		curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec ($ch);
		$result  = curl_getinfo( $ch );
		curl_close ($ch);

		$result['content'] = $content;
		if ($result['http_code'] != 200) {
			LogHelper::error("generateSiteMapXML Script: ".$result['http_code'], "Cannot submit XML SiteMap to Google.");
			return false;
		}
		return true;
	}

	/**
	 * Execute script
	 */
 	function execute()
	{
		if (!$this->generateXMLSiteMap())	return false;
		if (!$this->submitXMLSiteMapToGoogle())	return false;

		return true;
	}
}

///////////////////////////////////////////
// Main execution
set_time_limit(0);
ini_set('memory_limit', MEMORY_LIMIT);
LogHelper::info('generateSiteMapXML Script: Start', 'Start generating sitemap XML');

$generateSiteMapXMLScript = new GenerateSiteMapXMLScript();

if ($generateSiteMapXMLScript) {
	$chk = $generateSiteMapXMLScript->execute();
	if (!$chk) return;
} else return;

LogHelper::info('generateSiteMapXML Script: Stop', 'Stop generating sitemap XML');