<?php
/**
 * Generate style formats by using annotated comments in the sass/objects/_prose.scss
 */

/**
 * Add the custom style formats that are generated from `sass/objects/_prose.scss`.
 */
add_filter( 'ZEROTHEME_editor_style_formats', 'ZEROTHEME_generate_style_formats_from_scss' );
function ZEROTHEME_generate_style_formats_from_scss( $style_formats ) {

	$generated_style_formats = wp_cache_get( 'generate_style_formats_from_scss', 'ZEROTHEME' );
	if ( !is_array($generated_style_formats) ) {
		$prose_files = apply_filters( 'ZEROTHEME_generate_style_formats_from_scss_files', array( get_template_directory() . '/sass/objects/_prose.scss' ) );

		$scss = '';

		foreach ( $prose_files as $filename ) {
			if ( file_exists($filename) ) {
				$scss = $scss . "\n" . file_get_contents($filename);
			}
		}

		if ( empty($scss) ) {
			return $style_formats;
		}

		$parser = new ZEROTHEME_parse_scss_with_annotated();
		$tree = $parser->parse( $scss );

		$generator = new ZEROTHEME_generate_format_rules();
		$generated_style_formats = $generator->generate( $tree );
		wp_cache_set( 'generate_style_formats_from_scss', 'ZEROTHEME' );
	}

	return array_merge( $style_formats, $generated_style_formats, $generated_style_formats );
}

/**
 * Parser for a SCSS for selectors with their annotated comments
 */
class ZEROTHEME_parse_scss_with_annotated {

	static $CommentBlock = '#\n[ \t]*/\*\*[ ]*(?<content>(\n[ \t]*\*[^\n]*)*)\n[ \t]*\*/#';
	static $Selector = '#(?<selector>[^;{}\s][^;{}]+)\{#';
	static $EndBlock = '#\}#';


	function __construct() {}

	/**
	 * Parse a SCSS file into a tree
	 *
	 * The tree is made up nodes. Each node has an element named 'selectors' that is an
	 * array of sub-nodes where the key for each node is the selector. 
	 * The annotations are keys on the node with their value.
	 *
	 * @param $scss string - the SCSS to parse
	 * @return array - a tree of selectors and annotations
	 */
	function parse( $scss ) {
		$scss = str_replace("\r", "", $scss);
		$scss = $this->strip_line_comment( $scss );
		$tree = $this->new_node();
		preg_match(self::$CommentBlock, $scss, $comment_matches, PREG_OFFSET_CAPTURE);

		while ( strlen($scss) > 0 ) {
			$scss = $this->parse_selector( $scss, $tree );
		}
		
		$this->tree = $tree;
		return $this->tree;
	}

	/**
	 * Parse a selector with optional comment block
	 */
	function parse_selector( $scss, &$node ) {
		preg_match(self::$Selector, $scss, $selector_matches, PREG_OFFSET_CAPTURE);
		preg_match(self::$CommentBlock, $scss, $comment_matches, PREG_OFFSET_CAPTURE);

		// a comment block is optional, but the selector has to be there
		if ( empty($selector_matches) ) {
			// None found
			return '';
		}

		// The new node value
		$sub_nodes = $this->new_node();

		// Is there a comment before the selector?
		if ( !empty($comment_matches) && $selector_matches[0][1] >= $comment_matches[0][1] ) {
			// Pull out the comment
			$scss = $this->trim_source( $scss, $comment_matches );
			$this->parse_comment( $comment_matches['content'][0], $sub_nodes );

			// Now get the following selector the comment is for
			preg_match(self::$Selector, $scss, $selector_matches, PREG_OFFSET_CAPTURE);

			if ( !preg_match( '#\s*#', substr( $scss, 0, $selector_matches[0][1] ) ) ) {
				// Error
				return '';
			}
		}

		// Parse the selector
		$scss = $this->trim_source( $scss, $selector_matches );
		$selector = trim( $selector_matches['selector'][0] );
		$scss = $this->parse_rule_body( $scss, $sub_nodes );
		$node['selectors'][$selector] = $sub_nodes;

		return $scss;
	}

	function parse_rule_body( $scss, &$node ) {
		preg_match(self::$EndBlock, $scss, $end_matches, PREG_OFFSET_CAPTURE);
		preg_match(self::$Selector, $scss, $selector_matches, PREG_OFFSET_CAPTURE);

		if ( empty($end_matches) ) {
			// Error
			return '';
		}

		while ( !empty($selector_matches) && $selector_matches[0][1] < $end_matches[0][1] ) {
			$scss = $this->parse_selector( $scss, $node );

			preg_match(self::$EndBlock, $scss, $end_matches, PREG_OFFSET_CAPTURE);
			preg_match(self::$Selector, $scss, $selector_matches, PREG_OFFSET_CAPTURE);

			if ( empty($end_matches) ) {
				// Error
				return '';
			}
		}

		return $this->trim_source( $scss, $end_matches );
	}

	/**
	 * Trim the source of what is before in the matches
	 */
	function trim_source( $source, $matches ) {
		$trim_from = $matches[0][1] + strlen($matches[0][0]);
		return substr( $source, $trim_from);
	}

	function parse_comment( $comment_content, &$node) {
		$comment_content = preg_split('#(^|\n)\s*\*[ ]?#', $comment_content);
		foreach ( $comment_content as $line ) {
			preg_match('#^(?<key>@\S+)(\s+(?<content>.*))?#', $line, $matches );
			if ( !empty( $matches ) ) {
				$node[$matches['key']] = $matches['content'];
			}
		}
	}

	/**
	 * Strip out the line comments: // my comment
	 */
	function strip_line_comment( $source ) {
		return preg_replace( '#//[^\n]*#', '', $source );
	}

	/**
	 * Create a new node
	 */
	function new_node() {
		return array( 'selectors' => array() );
	}
}

/**
 * Generate format rules from a parse tree
 *
 * title - @formatTitle
 * classes - from the classes in the selector
 * attributes - from the attributes in the selector
 * block - if the selector has a block element
 * inline - if the selector has an inline element
 * selector - if the selector uses '&' - TODO
 * wrapper - @formatWrapper
 */
class ZEROTHEME_generate_format_rules {
	function __construct() {}

	static $ClassRe = '#\.(?<class>[\w_][\w_]*)#';
	static $ElementRe = '#^(?<element>\w+)#';
	static $AttributesRe = '#\[(?<attr>\w+)="(?<value>[^"]*)"\]#';
	static $SelfRe = '#^&(?<remaining>.*)#';
	static $InlineElements = array(
		"b", "big", "i", "small", "tt", 
		"abbr", "acronym", "cite", "code", "dfn", "em", "kbd", "strong", "samp", "var",
		"a", "bdo", "br", "img", "map", "object", "q", "script", "span", "sub", "sup",
		"button", "input", "label", "select", "textarea"
	);

	/**
	 * Generate format from a tree
	 */
	function generate( $tree ) {
		$this->rules = array();
		$this->walk_children( array(), $tree );
		return $this->rules;
	}

	/**
	 * Walk along the children
	 */
	function walk_children( $prior, $node ) {
		foreach ( $node['selectors'] as $selector => $subnode ) {
			$this->process_node( $prior, $selector, $subnode );
		}
	}

	/**
	 * Process a node
	 */
	function process_node( $prior, $selector, $node ) {
		$original_selector = $selector;
		if ( !empty($node['@formatTitle']) ) {
			$rule = array(
				'title' => $node['@formatTitle']
			);

			// Self '&'
			preg_match( self::$SelfRe, $selector, $matches );
			if ( !empty( $matches ) ) {
				$rule['selector'] = $this->to_css_selector( $prior );
				$selector = trim($matches['remaining']);
			}

			// Classes
			preg_match( self::$ClassRe, $selector, $matches );
			if ( !empty( $matches ) ) {
				$rule['classes'] = $matches['class'];
			}

			// Element
			preg_match( self::$ElementRe, $selector, $matches );
			if ( !empty( $matches ) ) {
				$inline_or_block = in_array( $matches['element'], self::$InlineElements ) ? 'inline' : 'block';
				$rule[$inline_or_block] = $matches['element'];
			} else {
				$rule['inline'] = 'span';
			}

			// Attributes
			preg_match( self::$AttributesRe, $selector, $matches );
			if ( !empty( $matches ) ) {
				$rule['attributes'] = array();
				$rule['attributes'][$matches['attr']] = $matches['value'];
			}

			// Wrapper
			if ( array_key_exists('@formatWrapper', $node) ) {
				$rule['wrapper'] = true;
			}

			$this->rules[] = $rule;
		}

		$prior[] = $original_selector;
		$this->walk_children( $prior, $node );
	}

	/**
	 * Convert the SCCS chain of selectors into actual CSS selectors
	 */
	function to_css_selector( $chain ) {
		$old_rules = array( '' );

		// Go through the chain of selectors
		foreach ( $chain as $scss_selector ) {
			$scss_selector = explode( ',', $scss_selector ); // Split a multiple selectors into each selectors
			$new_rules = array();

			foreach ( $scss_selector as $new_rule ) {
				foreach ( $old_rules as $old_rule ) {
					$new_rule = trim( $new_rule );
					$old_rule = trim( $old_rule );

					// Do we do a '&' join or just a simple join
					preg_match( self::$SelfRe, $new_rule, $matches );
					if ( !empty( $matches ) ) {
						$new_rules[] = $old_rule . $matches['remaining'];
						
					} else {
						$new_rules[] = $old_rule . ' ' . $new_rule;
					}
				}
			}
			$old_rules = $new_rules;
		}
		return implode( ', ', $old_rules );
	}
}