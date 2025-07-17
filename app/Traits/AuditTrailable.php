<?php

namespace App\Traits;

use App\Models\Audit_tr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait AuditTrailable
{
    public static function bootAuditTrailable()
    {
        static::creating(function ($model) {
            // Generate UUID jika model belum memiliki UUID
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            // Simpan log saat data dibuat
            Audit_tr::create([
                'model' => get_class($model),
                'model_id' => $model->id,
                'action' => 'created',
                'new_data' => $model->getAttributes(),
                'user_id' => auth()->id(),
            ]);
        });

        static::updating(function ($model) {
            // Simpan log saat data diupdate
            Audit_tr::create([
                'model' => get_class($model),
                'model_id' => $model->id,
                'action' => 'updated',
                'old_data' => $model->getOriginal(),
                'new_data' => $model->getAttributes(),
                'user_id' => auth()->id(),
            ]);
        });

        static::deleting(function ($model) {
            // Simpan log saat data dihapus
            Audit_tr::create([
                'model' => get_class($model),
                'model_id' => $model->id,
                'action' => 'deleted',
                'old_data' => $model->getAttributes(),
                'user_id' => auth()->id(),
            ]);
        });
    }
}