<?php

namespace App\Modules\ProductGroups;

use App\Modules\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


/**
 * App\Modules\ProductGroups\ProductGroup
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Modules\Products\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\ProductGroups\ProductGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductGroup extends Model
{
    use Notifiable;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
