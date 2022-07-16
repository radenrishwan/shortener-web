<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $resultUrls = $this->getRecentUrls();

        return view('home', ['urls' => $resultUrls]);
    }

    public function createUrl(UrlRequest $request)
    {
        $endpoint = config('endpoint.endpoint');
        $apiEndpoint = config('endpoint.api_endpoint') . 'api/url';

        $response = Http::post($apiEndpoint, [
            "destination" => $request->destination,
            "alias" => $request->alias,
        ]);

        if ($response->json()['code'] == 200) {
            $url = [
                "destination" => $response->json()['data']['destination'],
                "alias" => $endpoint . '/' . $response->json()['data']['alias'],
            ];

            // save cookie
            Cookie::queue("url-" . $url["alias"], json_encode($url));

            $resultUrls = $this->getRecentUrls();
            return view('home', ['url' => $url, 'urls' => $resultUrls, 'success' => 'success create new url']);
        } else {
            $resultUrls = $this->getRecentUrls();
            return view('home', ['error' => $response->json()['data'], 'urls' => $resultUrls]);
        }
    }

    public function clearUrl()
    {
        $urls = Cookie::get();
        $resultUrls = [];

        foreach ($urls as $url) {
            if (str_contains($url, 'http')) {
                $newUrl = json_decode($url);

                array_push($resultUrls, $newUrl);
            }
        }

        foreach ($resultUrls as $url) {
            Cookie::queue(Cookie::forget("url-" . $url->alias));
        }

        return Redirect::to('/');
    }

    public function redirect($alias)
    {
        $apiEndpoint = config('endpoint.api_endpoint') . 'api/url/';

        $response = Http::get($apiEndpoint, [
            "alias" => $alias,
        ]);

        if ($response->json()['code'] == 200) {
            return Redirect::to('http://' . 'www.google.com');
        } else {
            return Redirect::to('/notfound');
        }
    }

    private function remoteHttp(string $url)
    {
        if (str_contains($url, 'https')) {
            return str_replace('https://', '', $url);
        } else {
            return str_replace('http://', '', $url);
        }
    }

    private function getRecentUrls()
    {
        $urls = Cookie::get();
        $resultUrls = [];

        foreach ($urls as $url) {
            if (str_contains($url, 'http')) {
                $newUrl = json_decode($url);

                $newUrl->alias = $this->remoteHttp($newUrl->alias);
                array_push($resultUrls, $newUrl);
            }
        }

        return $resultUrls;
    }
}
