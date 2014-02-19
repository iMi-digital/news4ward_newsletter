<?php

/**
 * @copyright 4ward.media 2013 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */
$GLOBALS['TL_DCA']['tl_news4ward']['fields']['newsletterId'] = array
(
	'label'         => &$GLOBALS['TL_LANG']['tl_news4ward']['newsletterId'],
	'inputType'     => 'select',
	'exclude'       => true,
	'filter'        => true,
	'options_callback' => function()
	{
		$erg = array();
		$chans = \NewsletterChannelModel::findAll();
		if(!$chans) return array();

		foreach($chans as $chan) {
			$erg[$chan->title] = \NewsletterModel::findBy('pid', $chan->id)->fetchEach('subject');
		}
		return $erg;
	},
	'eval'          => array('tl_class'=>'w50', 'chosen'=>true)
);


$GLOBALS['TL_DCA']['tl_news4ward']['palettes']['default'] = str_replace(';{protected_legend', ';{newsletter_legend},newsletterId;{protected_legend', $GLOBALS['TL_DCA']['tl_news4ward']['palettes']['default']);