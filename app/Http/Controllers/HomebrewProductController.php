<?php

namespace App\Http\Controllers;

use App\Models\HomebrewProduct;
use App\Models\HomebrewProductCategory;
use Illuminate\Http\Request;

class HomebrewProductController extends Controller
{
    public function index(Request $req)
    {
        $homebrewCategories = HomebrewProductCategory::all();
        $minPrice = $req->min_price ?? 0;
        $maxPrice = $req->max_price ?? HomebrewProduct::max('price');
        $rangeMaxPrice = HomebrewProduct::max('price');

        $minPriceValue = preg_replace('/[^0-9.]/', '', $minPrice);
        $maxPriceValue = preg_replace('/[^0-9.]/', '', $maxPrice);
        if ($req) {
            $query = HomebrewProduct::query();

            if ($req->has('search')) {
                $query->where('name', 'like', '%' . $req->input('search') . '%');
            }

            if ($req->has('min_price') && $req->has('max_price')) {
                $query->whereBetween('price', [$minPriceValue, $maxPriceValue]);
            }

            if ($req->has('category')) {
                if ($req->category) {
                    $query->where('homebrew_product_category_id', $req->input('category'));

                }
            }

            $filteredHomebrew = $query->get();

            return view('homebrewProductList.index', ['homebrewProducts' => $filteredHomebrew, 'categories' => $homebrewCategories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
        }


        $homebrewProducts = HomebrewProduct::all();


        return view('homebrewProductList.index', ['homebrewProducts' => $homebrewProducts, 'categories' => $homebrewCategories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
    }

    public function show($id)
    {
        $homebrewProduct = HomebrewProduct::findorFail($id);

        $recommendations = HomebrewProduct::where('homebrew_product_category_id', $homebrewProduct->homebrew_product_category_id)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('homebrewProductList.show', ['homebrewProduct' => $homebrewProduct, 'recommendations' => $recommendations]);
    }
}