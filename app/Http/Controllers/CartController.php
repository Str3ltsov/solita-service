<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CartStatus;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CartRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class CartController extends AppBaseController
{
    use \App\Http\Controllers\forSelector;

    /** @var CartRepository $cartRepository */
    private $cartRepository;

    public function __construct(CartRepository $cartRepo)
    {
        $this->cartRepository = $cartRepo;
    }

    /**
     * Display a listing of the Cart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $carts = $this->cartRepository->all();

        return view('carts.index')
            ->with('carts', $carts);
    }

    /**
     * Show the form for creating a new Cart.
     *
     * @return Response
     */
    public function create()
    {
        return view('carts.create')->with([
            'users_list' => $this->usersForSelector(),
            'statuses_list' => $this->cartStatusesForSelector(),
            'admin_list' => $this->adminForSelector(),
        ]);
    }

    /**
     * Store a newly created Cart in storage.
     *
     * @param CreateCartRequest $request
     *
     * @return Response
     */
    public function store(CreateCartRequest $request)
    {
        $input = $request->all();

        $cart = $this->cartRepository->create($input);

        Flash::success('Cart saved successfully.');

        return redirect(route('carts.index'));
    }

    /**
     * Display the specified Cart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        $cartItems = CartItem::query()
            ->where([
                'cart_id' => $cart->id,
            ])
            ->get();

        return view('carts.show')->with([
            'cart' => $cart,
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Show the form for editing the specified Cart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        return view('carts.edit')->with([
            'cart' => $cart,
            'users_list' => $this->usersForSelector(),
            'statuses_list' => $this->cartStatusesForSelector(),
            'admin_list' => $this->adminForSelector(),
        ]);
    }

    /**
     * Update the specified Cart in storage.
     *
     * @param int $id
     * @param UpdateCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCartRequest $request)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        $cart = $this->cartRepository->update($request->all(), $id);

        Flash::success('Cart updated successfully.');

        return redirect(route('carts.index'));
    }

    /**
     * Remove the specified Cart from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $cart = $this->cartRepository->find($id);

        if (empty($cart)) {
            Flash::error('Cart not found');

            return redirect(route('carts.index'));
        }

        $this->cartRepository->delete($id);

        Flash::success('Cart deleted successfully.');

        return redirect(route('carts.index'));
    }


    /**
     * Add to cart
     *
     * @param AddToCartRequest $request
     * @return void
     */
    public function addToCart(AddToCartRequest $request)
    {
        $validated = $request->validated();

        $product = Product::find($validated['id']);

        // if isset product
        if (null !== $product) {
            $cart = $this->cartRepository->getOrSetCart($request);

            // getOrSet CartItem
            $cartItem = CartItem::query()
                ->where([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    //'price_current' => $product->price,
                ])
                ->first();

            if (null === $cartItem) {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'price_current' => $product->discount ?
                        $product->price - (round(($product->price * $product->discount->proc / 100), 2)) :
                        $product->price,
                    'count' => $validated['count'],
                ]);
                $cartItem->save();
            } else {
                $cartItem->increment('count', $validated['count']);
                $cartItem->save();
            }

            $this->cartRepository->cartSum($cart);

            Flash::success('ok');
        } else {
            Flash::error('Product not found');
        }
        return redirect(route('viewcart'));
    }

    private function getCart($request)
    {
        return $this->cartRepository->getOrSetCart($request);
    }

    private function getCartItemsByCart($cart) {
        return CartItem::query()
            ->with('product')
            ->where('cart_id', $cart->id)
            ->get();
    }

    public function viewCart(Request $request)
    {
        $cart = $this->getCart($request);
        $cartItems = $this->getCartItemsByCart($cart);

        return view('user_views.cart.view')
            ->with([
                'cartItems' => $cartItems,
                'cart' => $cart
            ]);
    }
}
