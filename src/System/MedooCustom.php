<?php
  Namespace CapeCraft\System;

  use \Medoo\Medoo;

  class MedooCustom extends Medoo {

    /**
     * Updates the database if the record exists
     * @param  String $table The table name
     * @param  Array  $where The where statement
     * @param  Array  $data  The data to update/create with
     * @return Void        
     */
    public function updateOrCreate(String $table, Array $where, Array $data) {
      if($this->has($table, $where)) {
        $this->update($table, $data, $where);
      } else {
        $this->insert($table, array_merge($where, $data));
      }
    }

  }
