<?php

namespace App\lib\Database;

class DatabaseConnection
{
  public ?\PDO $dbh = null;

  public function connectDb()
  {
    if ($this->dbh === null) {
     
      $this->dbh = new \PDO(SECURE_DNS_DB, SECURE_USER_DB, SECURE_PWD_DB, [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
      ]);
    }
    return $this->dbh;
  }
}
