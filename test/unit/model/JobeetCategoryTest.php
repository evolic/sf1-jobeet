<?php

include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');

$t = new lime_test(1);

$t->comment('->getSlug()');
$category = Doctrine_Core::getTable('JobeetCategory')->createQuery()->fetchOne();
$t->is(
  $category->getSlug(),
  Jobeet::slugify($category->getName()),
  '->getSlug() return the slug for the category'
);
