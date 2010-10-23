<?php
require_once('config.php');

interface Builder {

  function __construct($arrayOfFood);
  function getResult();
  function buildBasicFood();
  function buildCompositeFood();
}
