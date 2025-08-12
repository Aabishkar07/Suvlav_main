<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;
// use App\Models\OrderItem;
// use App\Models\Shipping;
// use App\Models\Transaction;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "discount",
        "tax",
        "total_amt",
        "total_items",
        "total_no_qnty",
        "fullname",
        "mobile",
        "email",
        "address",
        "province",
        "country",
        "district_id",
        "city",
        "tole",
        "houseno",
        "delivered_date",
        "tracking_code",
        "status",
        "use_point",
        "is_shipping_different"
    ];
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    //  public function orderItems(){
    //      return $this->hasMany(OrderItem::class);
    //  }

    // public function shipping(){
    //     return $this->hasOne(Shipping::class);
    // }

    // public function transaction(){
    //     return $this->hasOne(Transaction::class);
    // }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function shipping()
    {
        return $this->hasOne(Shipping::class, "order_id", "id");
    }

}