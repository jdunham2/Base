<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/16/18
 * Time: 10:25 PM
 */

namespace Domain;


use App\Listings;
use App\Services\Formatters\FormatPhoneNumber;
use App\Services\Formatters\FormatWebsite;

class User extends Repository
{
    protected $listings;
    protected $listingsWithImages;

    function addDomainKnowledge()
    {
        $this->formatPhoneNumber();
        $this->formatWebsite();

        unset($this->items['password']);
    }

    private function formatPhoneNumber()
    {
        $this->items['user_phone'] = $this->items['phone'] = FormatPhoneNumber::formatted($this->items["user_phone"]);
    }

    private function formatWebsite()
    {
        $this->items['website'] = FormatWebsite::formatted($this->items['website']);
    }

    public function listings()
    {
        return Listings::where('username', $this->items['username'])
            ->andWhere('status', 1)->get();
    }

    public function listingsWithImages()
    {
        return $this->listingsWithImages = Listings::where('username', $this->items['username'])
            ->andWhere('status', 1)
            ->andWhere('images', '!=', '  ')
            ->get();
    }

}