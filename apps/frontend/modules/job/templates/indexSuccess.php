<h1>Job List</h1>

<div id="jobs">
  <?php foreach ($categories as $category): ?>
    <?php /* @var $category JobeetCategory */ ?>
    <div class="category_<?php echo Jobeet::slugify($category->getName()) ?>">
      <div class="category">
        <div class="feed">
          <a href="<?php echo url_for('category', array('sf_subject' => $category, 'sf_format' => 'atom')) ?>">Feed</a>
        </div>
        <h1>
          <?php echo link_to($category, 'category', $category) ?>
        </h1>
      </div>

      <?php
      $limit = sfConfig::get('app_max_jobs_on_homepage');
      include_partial(
          'job/list',
          array('jobs' => $category->getActiveJobs($limit))
      );
      ?>

      <?php if (($count = $category->countActiveJobs() - sfConfig::get('app_max_jobs_on_homepage')) > 0): ?>
        <div class="more_jobs">
          and <?php echo link_to($count, 'category', $category) ?>
          more...
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>