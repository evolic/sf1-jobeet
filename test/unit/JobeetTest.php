<?php

require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(15);

$t->comment('::slugify()');
$t->is(Jobeet::slugify('Sensio'), 'sensio', '::slugify() converts all characters to lower case');
$t->is(Jobeet::slugify('sensio labs'), 'sensio-labs', '::slugify() replaces a white space by a -');
$t->is(Jobeet::slugify('sensio   labs'), 'sensio-labs', '::slugify() replaces several white spaces by a single -');
$t->is(Jobeet::slugify('  sensio'), 'sensio', '::slugify() removes - at the beginning of a string');
$t->is(Jobeet::slugify('sensio  '), 'sensio', '::slugify() removes - at the end of a string');
$t->is(Jobeet::slugify('paris,france'), 'paris-france', '::slugify() replaces non-ASCII characters by a -');

//$t->is(Jobeet::slugify(' - '), 'n-a', '::slugify() converts a string that only contains non-ASCII characters to n-a');

$t->comment('::slugify() French characters');
$t->is(Jobeet::slugify('Développeur Web'), 'developpeur-web', '::slugify() removes accents');

$t->comment('::slugify() Polish characters');
$t->is(Jobeet::slugify('Kraków'), 'krakow');
$t->is(Jobeet::slugify('Ślęża'), 'sleza');
$t->is(Jobeet::slugify('Śląsk Cieszyński'), 'slask-cieszynski');
$t->is(Jobeet::slugify('Ćmielów'), 'cmielow');
$t->is(Jobeet::slugify('Czyżew'), 'czyzew');
$t->is(Jobeet::slugify('Koźmin Wielkopolski'), 'kozmin-wielkopolski');
$t->is(Jobeet::slugify('Jesień'), 'jesien');
$t->is(Jobeet::slugify('Jasło'), 'jaslo');

// ----

