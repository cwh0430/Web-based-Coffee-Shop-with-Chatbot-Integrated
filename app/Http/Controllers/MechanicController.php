<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\MechanicCategory;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index(Request $req)
    {
        $mechanicCategories = MechanicCategory::all();
        $minPrice = $req->min_price ?? 0;
        $maxPrice = $req->max_price ?? Mechanic::max('price');
        $rangeMaxPrice = Mechanic::max('price');

        $minPriceValue = preg_replace('/[^0-9.]/', '', $minPrice);
        $maxPriceValue = preg_replace('/[^0-9.]/', '', $maxPrice);
        if ($req) {
            $query = Mechanic::query();

            if ($req->has('search')) {
                $query->where('name', 'like', '%' . $req->input('search') . '%');
            }

            if ($req->has('min_price') && $req->has('max_price')) {
                $query->whereBetween('price', [$minPriceValue, $maxPriceValue]);
            }

            if ($req->has('category')) {
                if ($req->category) {
                    $query->where('mechanic_category_id', $req->input('category'));

                }
            }

            $filteredMechanics = $query->get();

            return view('mechanicList.index', ['mechanics' => $filteredMechanics, 'categories' => $mechanicCategories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
        }


        $mechanics = Mechanic::all();


        return view('mechanicList.index', ['mechanics' => $mechanics, 'categories' => $mechanicCategories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
    }

    public function show($id)
    {
        $mechanic = Mechanic::findorFail($id);

        $recommendations = Mechanic::where('mechanic_category_id', $mechanic->mechanic_category_id)
            ->where('id', '!=', $id) // Exclude the beverage with the given ID
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view("mechanicList.show", ['mechanic' => $mechanic, 'recommendations' => $recommendations]);
    }
}