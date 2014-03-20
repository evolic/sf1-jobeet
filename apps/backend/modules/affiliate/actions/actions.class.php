<?php

require_once dirname(__FILE__).'/../lib/affiliateGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/affiliateGeneratorHelper.class.php';

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateActions extends autoAffiliateActions
{
  public function executeListActivate()
  {
    $affiliate = $this->getRoute()->getObject();
    $affiliate->activate();

    // send an email to the affiliate
    $message = $this->getMailer()->compose(
      array('jobeet@jobeet.com' => 'Jobeet Bot'),
      $affiliate->getEmail(),
      'Jobeet affiliate token',
      <<<EOF
Your Jobeet affiliate account has been activated.

Your token is {$affiliate->getToken()}.

The Jobeet Bot.
EOF
    );

    if ($this->getMailer()->send($message)) {
      $this->getUser()->setFlash('notice', 'The mail with activation token has been sent to the affiliate user.');
    } else {
      $this->getUser()->setFlash('error', 'An error has been encountered when sending e-mail to the affiliate user.');
    }

    $this->redirect('jobeet_affiliate');
  }

  public function executeListDeactivate()
  {
    $this->getRoute()->getObject()->deactivate();

    $this->redirect('jobeet_affiliate');
  }

  public function executeBatchActivate(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $affiliatesTable = Doctrine_Core::getTable('JobeetAffiliate');

    if ($affiliatesTable->activateAffiliates($ids)) {
      $this->getUser()->setFlash('notice', 'The selected affiliates have been activated successfully.');
    } else {
      $this->getUser()->setFlash('error', 'An error has been encountered when activating affiliates.');
    }

    $this->redirect('jobeet_affiliate');
  }

  public function executeBatchDeactivate(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $affiliatesTable = Doctrine_Core::getTable('JobeetAffiliate');

    if ($affiliatesTable->deactivateAffiliates($ids)) {
      $this->getUser()->setFlash('notice', 'The selected affiliates have been deactivated successfully.');
    } else {
      $this->getUser()->setFlash('notice', 'An error has been encountered when deactivating affiliates.');
    }

    $this->redirect('jobeet_affiliate');
  }
}
