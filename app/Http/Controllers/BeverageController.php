<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\BeverageCategory;
use App\Models\RateReview;
use Illuminate\Http\Request;

class BeverageController extends Controller
{
    public function index(Request $req)
    {
        $categories = BeverageCategory::all();
        $minPrice = $req->min_price ?? 0;
        $maxPrice = $req->max_price ?? Beverage::max('price');


        $rangeMaxPrice = Beverage::max('price');
        $minPriceValue = preg_replace('/[^0-9.]/', '', $minPrice);
        $maxPriceValue = preg_replace('/[^0-9.]/', '', $maxPrice);
        if ($req) {
            $query = Beverage::query();

            if ($req->has('search')) {
                $query->where('name', 'like', '%' . $req->input('search') . '%');
            }

            if ($req->has('min_price') && $req->has('max_price')) {
                $query->whereBetween('price', [$minPriceValue, $maxPriceValue]);
            }

            if ($req->has('category')) {
                if ($req->category) {
                    $query->where('beverage_category_id', $req->input('category'));

                }
            }

            $filteredBeverages = $query->get();

            return view('beverageList.index', ['beverages' => $filteredBeverages, 'categories' => $categories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
        }


        $beverages = Beverage::all();
        return view('beverageList.index', ['beverages' => $beverages, 'categories' => $categories, 'minPrice' => $minPriceValue, 'maxPrice' => $maxPriceValue, 'rangeMaxPrice' => $rangeMaxPrice]);
    }

    public function show($id)
    {
        $beverage = Beverage::findorFail($id);
        $total = 0;
        $averageRating = 0;

        $reviews = RateReview::whereHas('related', function ($query) use ($beverage) {
            $query->where('reviewable_id', $beverage->id)
                ->where('reviewable_type', get_class($beverage));
        })->with('related')->get();

        foreach ($reviews as $key => $review) {

            $reviewable = $reviews[$key]->related;
            $total += $reviewable->sum(function ($r) {
                return $r->rating;
            });


        }

        if (count($reviews)) {
            $averageRating = round($total / count($reviews));

        }

        $recommendations = Beverage::where('beverage_category_id', $beverage->beverage_category_id)
            ->where('id', '!=', $id) // Exclude the beverage with the given ID
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view("beverageList.show", ['beverage' => $beverage, 'recommendations' => $recommendations, 'reviews' => $reviews, 'averageRating' => $averageRating]);
    }

}