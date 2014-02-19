<?php

/**
 * @copyright 4ward.media 2013 <http://www.4wardmedia.de>
 * @author Christoph Wiechert <wio@psitrax.de>
 */

namespace Psi\News4ward\Newsletter;


class Helper extends \Psi\News4ward\Helper
{

	public function newsletterInserttagReplacer($strTag)
	{
		list($strTag, $strValue) = explode('::', $strTag);
		if($strTag !== 'news4ward_newsletter') return false;

		$err = '<p class="error">Please use the send-newsletter button in the <a href="contao/main.php?do=news4ward">News4ward</a> article listing.</p>';

		if(!$_SESSION['NEWS4WARD_NEWSLETTER_ARTICLE_ID'])
			return $err;

		$DB = \Database::getInstance();

		static $objArticle;
		if(!$objArticle)
		{
			$objArticle = $DB->prepare('SELECT * FROM tl_news4ward_article WHERE id=?')->execute($_SESSION['NEWS4WARD_NEWSLETTER_ARTICLE_ID']);
		}

		if(!$objArticle->numRows)
			return $err;

		$objArchive = $DB->prepare('SELECT * FROM tl_news4ward WHERE id=?')->execute($objArticle->pid);

		switch($strValue)
		{
			case 'url':
				$objPage = $DB->prepare('SELECT id,alias FROM tl_page WHERE id=?')->execute($objArchive->jumpTo);
				return \Controller::generateFrontendUrl($objPage->row(), '/'.((!$GLOBALS['TL_CONFIG']['disableAlias'] && strlen($objArticle->alias)) ? $objArticle->alias : $objArticle->id));
				break;

			case 'author':
				return $DB->prepare('SELECT name FROM tl_user WHERE id=?')->execute($objArticle->author)->name;
				break;

			case 'teaserImage':
				return \Image::getHtml(\FilesModel::findByUuid($objArticle->teaserImage)->path);
				break;

			default:
				return $objArticle->$strValue;
				break;
		}
	}


	public function redirect2sendNewsletter()
	{
		$_SESSION['NEWS4WARD_NEWSLETTER_ARTICLE_ID'] = \Input::get('id');
		$DB = \Database::getInstance();
		$newsletterId = $DB->prepare('
			SELECT newsletterId
			FROM tl_news4ward_article
			LEFT JOIN tl_news4ward ON (tl_news4ward_article.pid = tl_news4ward.id)
			WHERE tl_news4ward_article.id = ?
			')->execute(\Input::get('id'))->newsletterId;
		\Controller::redirect('contao/main.php?do=newsletter&table=tl_newsletter&key=send&id='.$newsletterId);
	}


	public function injectArticleButton($strReturn, $arrRow)
	{
		$strReturn .= '<div>Newsletter: <a href="contao/main.php?do=news4ward&key=redirect2sendNewsletter&id='.$arrRow['id'].'">'.\Image::getHtml('system/modules/newsletter/assets/icon.gif').'</a></div>';
		return $strReturn;
	}
}