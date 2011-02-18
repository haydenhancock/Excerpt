<?php
$plugin_info = array(
	'pi_name' => 'Excerpt',
	'pi_version' => '1.0',
	'pi_author' => 'Hayden Hancock',
	'pi_author_url' => 'http://haydenhancock.com',
	'pi_description' => 'The excerpt word amount will be 55 words and if the amount is greater than that, then the string "..." will be appended to the excerpt. If the string is less than 55 words, then the content will be returned as is. The 55 word limit can be modified by using the excerpt_length parameter. The "..." string can be modified by using the excerpt_more parameter.',
	'pi_usage' => Excerpt::usage()
);

Class Excerpt {
	var $return_data;
	function excerpt() {
		$this->EE =& get_instance();
		$text = $this->EE->TMPL->tagdata;
		
		// Parameter(s)
		$excerpt_length = $this->EE->TMPL->fetch_param('excerpt_length');
		$excerpt_more = $this->EE->TMPL->fetch_param('excerpt_more');
		
		// Set defaults
		if (!is_numeric($excerpt_length)) {
			$excerpt_length = 55;
		}
		
		if ($excerpt_more == '') {
			$excerpt_more = '...';
		}
		
		$this->return_data = $this->trim_excerpt($text, $excerpt_length, $excerpt_more);
	}
	
	function trim_excerpt($text, $excerpt_length, $excerpt_more) {
		if (strlen($text) < $excerpt_length) {
			return $text;
		}
		
		$words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $text)));
		if (count($words) <= $excerpt_length) {
			return $text;
		}
		
		$text = '';
		for ($i=0; $i<$excerpt_length; $i++) {
			$text .= $words[$i].' ';
		}
		
		return trim($text).$excerpt_more;
	}
	
	function usage() {
		ob_start();
		?>
        STEP ONE:
        Insert plugin tag into your template. Set paramters and variables.
        
        PARAMETERS:
        The tag has two parameters:
        
        1) excerpt_length - The number of words to include in the excerpt (default = 55 words).
        
        2) excerpt_more - The string that is appended at the end of the excerpt (default = ...).
        
        EXAMPLE:
        {exp:excerpt excerpt_length="12" excerpt_more="[...]"}
            {description}
        {/exp:excerpt}
        
        ABOUT:
        This plugin should function similar to WordPress excerpts.
        
        <?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}
?>