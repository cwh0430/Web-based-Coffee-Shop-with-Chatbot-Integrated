<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\HomebrewProduct;
use App\Models\Mechanic;
use App\Models\RateReview;
use Illuminate\Http\Request;

class RateReviewController extends Controller
{
    public function index()
    {
    }

    public function store(Request $req)
    {

        $rating = $req->rating;
        $comment = $req->comment;
        $modelType = $req->modelType;
        $id = $req->product_id;
        $user = auth()->user();
        $review = new RateReview();

        if ($modelType === "Beverage") {
            $item = Beverage::find($id);
        } elseif ($modelType === "HomebrewProduct") {
            $item = HomebrewProduct::findOrFail($id);
        } elseif ($modelType === "Mechanic") {
            $item = Mechanic::findOrFail($id);
        }

        $exist = RateReview::join('reviewables', 'rate_reviews.id', '=', 'reviewables.rate_review_id')
            ->where('rate_reviews.user_id', $user->id)
            ->where('reviewables.reviewable_id', $item->id)
            ->where('reviewables.reviewable_type', get_class($item))
            ->first();

        if (!$exist) {
            $user->rateReview()->save($review);
            $reviewable = $review->related()->make();
            $reviewable->reviewable()->associate($item);
            $reviewable->comment = $comment;
            $reviewable->rating = intval($rating);
            $reviewable->save();

            return redirect()->back()->with('msg', 'Successful write');
        } else {
            return redirect()->back()->with('msg', 'You have written review');
        }



    }
}