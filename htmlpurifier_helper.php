<?php 

if (! function_exists('html_purify')) {

	/**
	 * CodeIgniter4 HTMLPurifier Helper
	 *
	 * Ported from Tyler Brownell's Codeigniter HTMLPurifier Helper.
	 * @see: https://www.github.com/refringe/CodeIgniter-HTMLPurifier
	 * 
	 * Purify input using the HTMLPurifier standalone class.
	 * Easily use multiple purifier configurations.
	 * 
	 * @author    enderlinp
	 * @copyright Public Domain
	 *
	 * @access public
	 * @param  string|array $dirty_html The string (or array of strings) to be cleaned.
	 * @param  string|bool  $config     The name of the configuration (switch case) to use.
	 *
	 * @return string|array             The cleaned string (or array of strings).
	 */
	function html_purify(string|array $dirty_html, string|bool $config = false): string|array
	{
		$clean_html = '';
		
		if (is_array($dirty_html)) {
			foreach ($dirty_html as $key => $value) {
				$clean_html[$key] = html_purify($value, $config);
			}
		} else {
			$charset = config('App')->charset;
			
			switch ($config) {
				case false:
					$config = \HTMLPurifier_Config::createDefault();
					$config->set('Core.Encoding', $charset);
                    $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
				break;
				
				case 'comment':
					$config = \HTMLPurifier_Config::createDefault();
                    $config->set('Core.Encoding', $charset);
                    $config->set('HTML.Doctype', 'XHTML 1.0 Strict');
                    $config->set('HTML.Allowed', 'p,a[href|title],abbr[title],acronym[title],b,strong,blockquote[cite],code,em,i,strike');
                    $config->set('AutoFormat.AutoParagraph', true);
                    $config->set('AutoFormat.Linkify', true);
                    $config->set('AutoFormat.RemoveEmpty', true);
				break;
				
				default:
					throw new \Exception("The HTMLPurifier configuration labeled `{$config}` could not be found.");
			}
			
			$purifier = new \HTMLPurifier($config);
			$clean_html = $purifier->purify($dirty_html);
		}
		
		return $clean_html;
	}
}
