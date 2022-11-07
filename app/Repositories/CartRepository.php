<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartStatus;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CartRepository
 * @package App\Repositories
 * @version March 29, 2022, 4:14 pm UTC
*/

class CartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'code',
        'status_id',
        'admin_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cart::class;
    }

    public function getOrSetCart(Request $request)
    {
        $userId = Auth::id();

        // getOrSet session/code
        if ($request->session()->has('appToken')) {
            $cartCode = $request->session()->get('appToken');
        } else {
            $cartCode = md5(time() . 'ಉಪ್ಪು');
            $request->session()->put('appToken', $cartCode);
        }

        // getOrSet Cart
        $cart = Cart::query()
            ->where([
                'user_id' => $userId,
                'code' => $cartCode,
                'status_id' => Cart::STATUS_ON,
            ])
            ->first();

        if (null === $cart) {
            $firstStatus = CartStatus::query()
                ->first();

            $firstAdmin = User::query()
                ->where('type', 1)
                ->first();

            $cart = new Cart([
                'user_id' => $userId,
                'code' => $cartCode,
                'status_id' => $firstStatus->id,
                'admin_id' => $firstAdmin->id,
            ]);
            $cart->save();
        }

        return $cart;
    }

    public function cartSum($cart, $save = true)
    {
        $cartItems = CartItem::query()
            ->where([
                'cart_id' => $cart->id,
            ])
            ->get();

        $sum = 0;
        foreach ($cartItems as $item) {
            $sum += $item->price_current * $item->count;
        }

        if ($save) {
            $cart->sum = $sum;
            $cart->save();
        }

        return $sum;
    }
}
