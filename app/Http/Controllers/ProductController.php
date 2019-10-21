<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\ProductGroups\ProductGroup;
use App\Modules\ProductGroups\ProductGroupRepository;
use App\Modules\Products\Product;
use App\Modules\Products\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productGroupRepository;
    private $productRepository;

    public function __construct(ProductGroupRepository $productGroupRepository, ProductRepository $productRepository)
    {
        $this->productGroupRepository = $productGroupRepository;
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        $seo['title'] = 'Продукция';

        $productGroups = $this->productGroupRepository->all();

        return view('products.all')->with(['seo' => $seo, 'productGroups' => $productGroups]);
    }

    public function formGroup(ProductGroup $productGroup = null)
    {
        $seo['title'] = ($productGroup === null ?  'Добавление' : 'Редактирование').' группы';

        return view('products.save')->with(['productGroup' => $productGroup, 'seo' => $seo]);
    }

    public function save(Request $request, Product $product = null)
    {
        $this->productRepository->save($request->all(), $product);

        Flash::success('Продукция успешно сохранена!');

        return redirect('product-group-form/'.$request->input('product_group_id'));
    }

    public function delete(Role $product)
    {
        $this->productRepository->delete($product->id);

        Flash::success('Должность успешно удален!');
        return redirect('products');
    }

    public function saveGroup(Request $request, ProductGroup $productGroup = null)
    {
        $id = $this->productGroupRepository->save($request->all(), $productGroup)->id;

        Flash::success('Группа сохранена!');

        if ($productGroup == null)
            return redirect('product-group-form/'.$id);

        return redirect('products');
    }

}
