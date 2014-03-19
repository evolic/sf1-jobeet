<?php /* @var $category JobeetCategory */ ?>

<?php slot('title', sprintf('Jobs in the %s category', $category->getName())) ?>

<div class="category">
  <div class="feed">
    <a href="<?php echo url_for('category', array('sf_subject' => $category, 'sf_format' => 'atom')) ?>">Feed</a>
  </div>
  <h1><?php echo $category ?></h1>
</div>

<?php
include_partial(
  'job/list',
  array('jobs' => $pager->getResults())
);
?>

<?php
include_partial(
  'general/pagination',
  array(
    'pager' => $pager,
    'route' => 'category',
    'object' => $category,
  )
);
?>

<div class="pagination_desc">
  <strong><?php echo count($pager) ?></strong> jobs in this category

  <?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>