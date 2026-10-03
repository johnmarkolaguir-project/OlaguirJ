<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'species', 'room', 'water_every_days', 'last_watered_at', 'notes'])]
class Plant extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'water_every_days' => 'integer',
            'last_watered_at' => 'date',
        ];
    }

    public function daysSinceWatering(): ?int
    {
        return $this->last_watered_at?->diffInDays(today());
    }

    public function isThirsty(): bool
    {
        if ($this->last_watered_at === null) {
            return true;
        }

        return $this->daysSinceWatering() >= $this->water_every_days;
    }

    public function water(): void
    {
        $this->forceFill(['last_watered_at' => today()])->save();
    }

    public function status(): string
    {
        return $this->isThirsty() ? 'Thirsty' : 'Happy';
    }

    public function statusColor(): string
    {
        return $this->isThirsty() ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800';
    }
}
