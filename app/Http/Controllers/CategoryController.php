<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Traits\ProductRatings;
use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Category;

class CategoryController extends AppBaseController
{
    use ProductRatings;

    /** @var CategoryRepository $categoryRepository*/
    private $categoryRepository;
    private $productRepository;

    use \App\Http\Controllers\forSelector;
    use \App\Http\Controllers\PrepareTranslations;

    public function __construct(CategoryRepository $categoryRepo, ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepo;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the Category.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $categories = $this->categoryRepository->all();
        $categories = Category::translatedIn(app()->getLocale())->get();
        return view('categories.index')
            ->with('categories', $categories);
    }

    private function getTreeCategories(): object
    {
        return Category::where('parent_id', '=', null)->get();
    }

    public function userRootCategories(Request $request)
    {
        //$categories = $this->categoryRepository->allQuery(array("parent_id"=>null))->paginate("5");

        return view('user_views.category.categories_root_user')
            ->with([
                //'categories' => $categories,
                'treeCategories' => $this->getTreeCategories()
            ]);
    }

    public function userInnerCategories(Request $request)
    {
        if (empty($request->category_id))
            return redirect(route('rootcategories'));

        $category = $this->categoryRepository->find($request->category_id);
        $products = $category->products()->paginate(12);

        foreach ($products as $product) {
            $sumAndCount = $this->calculateRatingSumAndCount($this->getProductRatings($product->id));
            $product->sum = $sumAndCount['sum'];
            $product->count = $sumAndCount['count'];
            $product->average = $this->calculateAverageRating($product->sum, $product->count);
        }

        $user = Auth::user();

        if ($user)
            $user->log("Viewed {$category->name}");

        return view('user_views.category.categories_inner_user')
            ->with([
                'treeCategories' => $this->getTreeCategories(),
                'maincategory' => $category,
                'products' => $products,
            ]);
    }

    /*public function userCategoryTree ( Request $request) {
        $categories = Category::where('parent_id', '=', null)->get();
        $allCategories = Category::withTranslation()
            ->translatedIn(app()->getLocale())
//            ->pluck('name','id')
            ->get();
//        ->withTraslate;
        return view('user_views.category.categoryTreeview',
        ["categories" => $categories, "allCategories" => $allCategories]
        );
    }*/

    public function userViewCategory(Request $request)
    {

    }

    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create', [ 'visible_list' => $this->visible_list, 'categories' => $this->categoriesForSelector()]);
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input = $this->prepare($input, ["name", "description"]);
//        dd($input);
        $category = Category::create($input);

        Flash::success('Category saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }


        return view('categories.edit', [ 'visible_list' => $this->visible_list,
            'categories' => $this->categoriesForSelector(),
            'category'=>$category]);
//        )->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }
        $input = $this->prepare($request->all(), ["name", "description"]);
        $category->update($input);
        Flash::success('Category updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }
}
