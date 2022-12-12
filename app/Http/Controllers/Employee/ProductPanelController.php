<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Controllers\forSelector;
use App\Http\Controllers\PrepareTranslations;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Traits\ProductServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPanelController extends Controller
{
    use ProductServices, forSelector, PrepareTranslations;

    private function getProducts()
    {
        try {
            return Product::all();
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index()
    {
        return view('employee_views.product_panel.index')
            ->with('products', $this->getProducts());
    }

    private function getProductById(int $id)
    {
        $product = Product::find($id);

        if (empty($product)) throw new \Exception(__('errorEmptyProduct'));

        return $product;
    }

    /**
     * Display product details.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('employee_views.product_panel.show')
            ->with('product', $this->getProductById($id));
    }

    /**
     * Page with product create form.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('employee_views.product_panel.create')->with([
            'visibilityList' => $this->VisibilityForSelector(),
            'categories' => $this->categoriesForSelector(),
            'promotions' => $this->promotionForSelector(),
            'discounts' => $this->discountForSelector(),
        ]);
    }

    private function saveCategories($cats, $prod_id)  {
        foreach ($cats as $cat) {
            DB::table('category_product')->insert([
                'category_id' => $cat,
                'product_id' => $prod_id,
            ]);
        }
    }

    /**
     * Submit create product form.
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $input = $request->all();

            if (isset($input['image']) && $input['image'] !== null) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/upload'), $imageName);
                $input['image'] = "/images/upload/" .$imageName;
            }

            $input = $this->prepare($input, ["name", "description"]);
            $product = Product::create($input);

            if (!empty($input['categories']))
                $this->saveCategories($input['categories'], $product->id);

            return redirect()
                ->route('product_panel.show', $product->id)
                ->with('success', __('messages.successCreateProduct'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /**
     * Page with edit product form.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        return view('employee_views.product_panel.edit')
            ->with([
                'product' => $this->getProductById($id),
                'visibilityList' => $this->VisibilityForSelector(),
                'categories' => $this->categoriesForSelector(),
                'promotions' => $this->promotionForSelector(),
                'discounts' => $this->discountForSelector(),
            ]);
    }

    /**
     * Submit update product form.
     *
     * @param UpdateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, UpdateProductRequest $request)
    {
        try {
            $product = $this->getProductById($id);
            $input = $request->all();

            if (isset($input['image']) && $input['image'] !== null) {
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/upload'), $imageName);
                $input['image'] = '/images/upload/' .$imageName;
            }

            $input = $this->prepare($input, ["name", "description"]);

            $product->update($input);
            $product->categories()->sync($request->categories);

            return redirect()
                ->route('product_panel.show', $product->id)
                ->with('success', __('messages.successUpdateProduct'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }

    /**
     * Submit update product form.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $product = $this->getProductById($id);

            $product->delete();

            return redirect()
                ->route('product_panel.index')
                ->with('success', __('messages.successDeleteProduct'));
        }
        catch (\Throwable $exc) {
            return back()->with('error', $exc->getMessage());
        }
    }
}
