<?php

class Jobeet
{
  static public function slugify($text)
  {
    return Doctrine_Inflector::urlize($text);
  }
}