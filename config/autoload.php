<?php

/**
 * @copyright 4ward.media 2013 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */


// Register the classes
ClassLoader::addClasses(array
(
	'Psi\News4ward\Newsletter\Helper' 	=> 'system/modules/news4ward_newsletter/Helper.php',
));

// Register the templates
TemplateLoader::addFiles(array
(
//	'mod_' 					=> 'system/modules/news4ward_newsletter/templates',
));
