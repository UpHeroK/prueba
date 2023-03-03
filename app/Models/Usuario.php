<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'status',
        'observation',
        'password',
        'nivel_id'
    ];
    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }
}
