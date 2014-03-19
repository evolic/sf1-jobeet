<?php

class myUser extends sfBasicSecurityUser
{
  public function addJobToHistory(JobeetJob $job)
  {
    $ids = $this->getAttribute('job_history', array());

    if (!in_array($job->getId(), $ids)) {
      array_unshift($ids, $job->getId());

      $this->setAttribute('job_history', array_slice($ids, 0, 3));
    }
  }

  public function getJobHistory()
  {
    $ids = $this->getAttribute('job_history', array());

    if (!empty($ids)) {
      $jobsTable = Doctrine_Core::getTable('JobeetJob');
      return $jobsTable->getJobsByIds($ids);
    }

    return array();
  }

  public function resetJobHistory()
  {
    $this->getAttributeHolder()->remove('job_history');
  }
}
