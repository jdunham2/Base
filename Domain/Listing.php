<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/11/18
 * Time: 5:53 PM
 */

namespace Domain;


use App\Listings;
use App\Services\Formatters\FormatListingPrice;
use App\Users;

class Listing extends Repository
{
    public $user;

    function addDomainKnowledge()
    {
        $this->addHeadline();
        $this->formatPrice();
        $this->addMainPhoto();
        $this->addLink();
    }

    public function addLink()
    {
        $this->items['link'] = "/details/{$this->items['id']}";
    }

    public function similarListings()
    {
        $similar_listings = Listings::where('status', 1)
            ->andWhere("listing_type", $this->items["listing_type"])
            ->andWhere('body_style', $this->items['body_style'])
            ->andWhere('images', '!=', '  ')
            ->andWhere('id', '!=', $this->items['id'])
            ->andWhere('car_make', $this->items['car_make'])
            ->orderBy('rand()')
            ->limit(3)
            ->get();

        return $similar_listings;
    }

    public function user()
    {
        if (!$this->user){
            $this->user = Users::where('username', $this->items['username'])->first();
        }

        return $this->user;
    }

    public function seller()
    {
        return $this->user();
    }

    private function formatPrice()
    {
        $this->items["price"] = FormatListingPrice::formatted($this->items["price"]);
    }

    private function addMainPhoto()
    {
        $images = explode(",", trim($this->items["images"], ", "));
        $this->items['main_photo'] = isset($images[0]) ? $images[0] : '';
    }

    protected function addHeadline()
    {
        $headline = stripslashes(($this->items["year"] != 0 && $this->items["year"] != "" ? $this->items["year"] . " " : "") . $this->items["car_make"] . " " . $this->items["car_model"] . " " . $this->items["variant"]);
        if (trim($headline) == "" && trim($this->items["title"]) != "") {
            $headline = stripslashes(strip_tags($this->items["title"]));
        }

        $this->items['headline'] = $headline;
    }

    public function allImages()
    {
        if (isset($this->items['all_images']))
            return $this->items['all_images'];

        $this->items['all_images'] = [];

        if ($this->items['images']){
            $this->items['all_images'] = explode(",", trim($this->items["images"], ", "));
        }

        return $this->items['all_images'];
    }

    public function allFeatures()
    {
        if (isset($this->items['all_features']))
            return $this->items['all_features'];

        $this->items['all_features'] = [];

        if ($this->items['features']) {
            $this->items['all_features'] = explode(",", trim($this->items["features"], ", "));
        }

        return $this->items['all_features'];
    }
}