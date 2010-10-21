<?php
require_once('config.php');

interface Builder {

  function construct($arrayOfFood);
  function getResult();
  function buildBasicFood();
  function buildCompositeFood();
}
