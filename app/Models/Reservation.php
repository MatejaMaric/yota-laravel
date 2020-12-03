<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    public function getFromTimeAttribute() {
        return Carbon::parse($this->attributes['fromTime'])->format('d.m.Y. H:i');
    }

    public function setFromTimeAttribute($value) {
        $this->attributes['fromTime'] = Carbon::createFromFormat('d.m.Y. H:i', $value)->toDateTimeString();
    }

    public function getToTimeAttribute() {
        return Carbon::parse($this->attributes['toTime'])->format('d.m.Y. H:i');
    }

    public function setToTimeAttribute($value) {
        $this->attributes['toTime'] = Carbon::createFromFormat('d.m.Y. H:i', $value)->toDateTimeString();
    }

    // I am quite sure this not working is a bug.
    //protected function serializeDate(\DateTimeInterface $date)
    //{
        //return $date->format('d.m.Y. H:i');
    //}

    protected $casts = [
      'fromTime' => 'datetime:d.m.Y. H:i',
      'toTime' => 'datetime:d.m.Y. H:i',
    ];
}
