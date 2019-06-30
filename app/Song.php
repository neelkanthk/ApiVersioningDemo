<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model {

    /**
     * Modify model object
     * @return $this
     */
    public function modify() {
        $this->duration = round($this->duration / 60, 2); //change the duration from seconds to minutes
        return $this;
    }

}
