<?php

namespace App\Modules\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Modules\Products\Product
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $product_group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product whereProductGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Modules\Products\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'product_group_id'];
}
