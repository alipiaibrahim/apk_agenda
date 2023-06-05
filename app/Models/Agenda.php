<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = ['id', 'users', 'tanggal', 'isi_agenda'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
