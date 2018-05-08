<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\User;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $guarded = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function getRestaurantNameAttribute()
    {
        return $this->restaurant->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->user->name;
    }

     public function getBookingDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_item')->withPivot(['price', 'qty', 'customs']);
    }

    public function getStatusTextAttribute()
    {   
        $statuses = ['Order Placed', 'Confirmed by Restaurant', 'Order Ready' , 'Order Picked', 'Order Delivered'];
        return $statuses[$this->status];
    }


     public function getItemsCountAttribute()
    {
        return count($this->items);
    }

    public function getAmountAttribute()
    {
        return  $this->attributes['amount'];
    }

    public function getCommissionEarnedAttribute()
    {
        return $this->amount * ($this->restaurant->commission/100);
    }

    public function getAmountEarnedAttribute()
    {
        return $this->amount - $this->commission_earned;
    }

     public function confirmOrder($crud = false)
    { 
        if($this->status < 1)
        {
           return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/confirm" data-toggle="tooltip" title="Confirm Order"><i class="fa fa-check"></i> Confirm Order</a>';
        } elseif($this->status == 1) {

                 return '<a class="btn btn-xs btn-info" href="/orders/'. $this->id . '/ready" data-toggle="tooltip" title="Order Ready" ><i class="fa fa-check"></i> Order Ready</a>';
        } elseif($this->status == 2) {

                 return '<a class="btn btn-xs btn-info" href="/orders/'. $this->id . '/picked" data-toggle="tooltip" title="Order Picked" ><i class="fa fa-check"></i> Order Picked</a>';
        } elseif($this->status == 3) {

                 return '<a class="btn btn-xs btn-success" href="/orders/'. $this->id . '/delivered" data-toggle="tooltip" title="Order Delivered" ><i class="fa fa-check"></i> Order Delivered</a>';
        } else {
             return '<a class="btn btn-xs btn-success" href="#" data-toggle="tooltip" title="Order Delivered" disabled><i class="fa fa-check"></i> Order Closed</a>';
        }
       
    }

    public function viewOrder($crud = false)
    { 
      
           return 
           '<a class="btn btn-xs btn-danger" href="/orders/'. $this->id . '" data-toggle="tooltip" target="_blank" title="Confirm Order"><i class="fa fa-eye"></i> View</a>';
       
       
       
    }

    public function invoice($crud = false)
    { 
      
           return 
           '<a class="btn btn-xs btn-primary" href="/orders/'. $this->id . '/invoice" data-toggle="tooltip" target="_blank" title="Confirm Order"><i class="fa fa-file-text"></i> Invoice</a>';
       
       
       
    }

}
