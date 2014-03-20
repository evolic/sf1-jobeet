<?php

include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');

$t = new lime_test(4);

$table = Doctrine_Core::getTable('JobeetCategory');
/* @var $table JobeetCategoryTable */

$t->comment('->getSlug()');
$category = $table->findByName('Design')->getFirst();
$t->is(
  $category->getSlug(),
  Jobeet::slugify($category->getName()),
  '->getSlug() return the slug for the category'
);
$t->is(
  $category->getSlug(),
  Jobeet::slugify($category->getName()),
  '->getSlug() return the slug for the category'
);

$t->comment('Design category');
$t->is(
  count($category->getActiveJobs(1)),
  1,
  '$category->getActiveJobs(1) return two active categories'
);
$t->is(
  $category->countActiveJobs(),
  1,
  '$category->countActiveJobs() return 1 job in Design category'
);