<?php
require_once './src/config/db.php';

class Model
{
  protected $db;

  public function __construct()
  {
    $database = new Database();
    $this->db = $database->connect();
  }
}
