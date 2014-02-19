<?php

/**
 * @copyright 4ward.media 2013 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */

// Add Newsletter Icon to each article list item
$GLOBALS['TL_HOOKS']['news4ward_article_generateListItem'][] = array('News4ward\Newsletter\Helper', 'injectArticleButton');

// prepare Newsletter sending action
$GLOBALS['BE_MOD']['content']['news4ward']['redirect2sendNewsletter'] = array('News4ward\Newsletter\Helper', 'redirect2sendNewsletter');

// support {{news4ward_newsletter::...}} insert tags
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('\News4ward\Newsletter\Helper', 'newsletterInserttagReplacer');
