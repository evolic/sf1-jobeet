<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {
    // set which fields are used in the form
    $this->useFields(array(
      'category_id',
      'type',
      'company',
      'logo',
      'url',
      'position',
      'location',
      'description',
      'how_to_apply',
      'is_public',
      'email'
    ));

    // add email validator to email field (not overwrites existing validator)
    $this->validatorSchema['email'] = new sfValidatorAnd(array(
      $this->validatorSchema['email'],
      new sfValidatorEmail(),
    ));

    // configure type field
    $jobTable = Doctrine_Core::getTable('JobeetJob');
    $types = $jobTable->getTypes();
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
      'choices'  => $types,
      'expanded' => true,
    ));
    $this->validatorSchema['type'] = new sfValidatorChoice(array(
      'choices' => array_keys($types),
    ));

    // configure logo field
    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Company logo',
    ));
    $this->validatorSchema['logo'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/jobs',
      'mime_types' => sfConfig::get('app_validation_mime_images'),
    ));

    // configure labels
    $this->widgetSchema->setLabels(array(
      'category_id'    => 'Category',
      'is_public'      => 'Public?',
      'how_to_apply'   => 'How to apply?',
    ));

    // help messages
    $this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');

    // change pattern for widget names
    $this->widgetSchema->setNameFormat('job[%s]');
  }
}
