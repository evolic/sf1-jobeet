<?php

class JobeetTestFunctional extends sfTestFunctional
{
    public function loadData()
    {
        Doctrine_Core::loadData(sfConfig::get('sf_test_dir').'/fixtures');

        return $this;
    }

    public function getMostRecentProgrammingJob()
    {
        $jobTable = Doctrine_Core::getTable('JobeetJob');

        $query = Doctrine_Query::create()
            ->select('j.*')
            ->from('JobeetJob j')
            ->leftJoin('j.JobeetCategory c')
            ->where('c.slug = ?', 'programming');
        $query = $jobTable->addActiveJobsQuery($query);

        return $query->fetchOne();
    }

    public function getExpiredJob()
    {
        $query = Doctrine_Query::create()
            ->from('JobeetJob j')
            ->where('j.expires_at < ?', date('Y-m-d'));

        return $query->fetchOne();
    }
}
