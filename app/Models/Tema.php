<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    public function topik()
    {
        return $this->belongsTo(Topik::class, 'topiks', 'id')
            ->withDefault(['topiks' => 'Tahun Akademik Belum Dipilih']);
    }
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agendas', 'id')
            ->withDefault(['agendas' => 'Tahun Akademik Belum Dipilih']);
    }
}
