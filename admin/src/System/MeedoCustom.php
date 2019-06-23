<?php
  Namespace CapeCraft\System;

  use \Medoo\Medoo;

  class MedooCustom extends Medoo {

    public function updateOrCreate(String $table, Array $where, Array $data) {
      if($this->has($table, $where)) {
        $this->update($table, $data, $where);
      } else {
        $this->insert($table, array_merge($where, $data));
      }
    }

  }
