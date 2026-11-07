<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $fillable = [
        'nama','slug','jabatan','bidang','foto','periode','parent_id','urutan','bio','deskripsi',
        'tempat_lahir','tanggal_lahir','pendidikan','alamat','email','telepon','status'
    ];

    protected function casts(): array
    {
        return ['status' => 'boolean', 'tanggal_lahir' => 'date'];
    }

    public function parent(): BelongsTo { return $this->belongsTo(self::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(self::class, 'parent_id')->orderBy('urutan')->orderBy('nama'); }

    public function isDescendantOf(?int $candidateId): bool
    {
        if (!$candidateId) return false;
        $cursor = $candidateId;
        $seen = [];
        while ($cursor && !in_array($cursor, $seen, true)) {
            if ($cursor === $this->id) return true;
            $seen[] = $cursor;
            $cursor = static::query()->whereKey($cursor)->value('parent_id');
        }
        return false;
    }
}
