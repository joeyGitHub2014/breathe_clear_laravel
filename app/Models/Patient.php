<?php

namespace App\Models;
use App\Models\Analysis;
use App\Models\AnalysisCount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function analysis_count()
    {
        return $this->hasMany(AnalysisCount::class);
    }


}
