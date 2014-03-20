<!-- apps/frontend/templates/layout.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>
      <?php include_slot('title', 'Jobeet - Your best job board') ?>
    </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="alternate" type="application/atom+xml" title="Latest Jobs"
          href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          <h1>
            <a href="<?php echo url_for('homepage') ?>">
              <img src="/legacy/images/logo.jpg" alt="Jobeet Job Board" />
            </a>
          </h1>

          <div id="sub_header">
            <div class="post">
              <h2>Ask for people</h2>
              <div>
                <a href="<?php echo url_for('job_new') ?>">Post a Job</a>
              </div>
            </div>

            <div class="search">
              <h2>Ask for a job</h2>
              <form action="" method="get">
                <input type="text" name="keywords"
                  id="search_keywords" />
                <input type="submit" value="search" />
                <div class="help">
                  Enter some keywords (city, country, position, ...)
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php $job_history = $sf_user->getJobHistory(); ?>
      <?php if (count($job_history)): ?>
      <div id="job_history">
        Recent viewed jobs:
        <ul>
          <?php foreach ($job_history as $job): ?>
            <li>
              <?php echo link_to($job->getPosition().' - '.$job->getCompany(), 'job_show_user', $job) ?>
            </li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif; ?>


      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif ?>

        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif ?>

        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="footer">
        <div class="content">
          <span class="symfony">
            <img src="/images/jobeet-mini.png" />
            powered by <a href="/">
            <img src="/images/symfony.gif" alt="symfony framework" />
            </a>
          </span>
          <ul>
            <li><a href="">About Jobeet</a></li>
            <li class="feed">
              <a href="<?php echo url_for('job', array('sf_format' => 'atom')) ?>">Full feed</a>
            </li>
            <li><a href="">Jobeet API</a></li>
            <li class="last">
              <a href="<?php echo url_for('affiliate_new') ?>">Become an affiliate</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <?php include_javascripts() ?>
  </body>
</html>