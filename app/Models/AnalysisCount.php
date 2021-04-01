<?php

namespace App\Models;

use App\Models\Analysis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisCount extends Model
{
    use HasFactory;
    public function analysis()
    {
        return $this->hasMany(Analysis::class);
    }
}
