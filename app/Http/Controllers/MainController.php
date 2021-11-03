<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function createOrder(Request $request) {
        $rules = [
            "FIO" => "required",
            "article" => "required",
            "brand" => "required"
        ];

        $messages = [
            "FIO.required" => "Необходимо указать  ФИО",
            "article.required" => "Необходимо указать артикул",
            "article.brand" => "Необходимо указать бренд"
        ];

        $validator = Validator::make($request->all(), $rules, $messages)->validate();

        $response = Http::get("https://superposuda.retailcrm.ru/api/v5/store/products", [
            "apiKey" => "QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb",
            "filter[manufacturer]" => $request->brand,
            "filter[name]" => $request->article
        ]);
        $FIO = explode(" ",$request->FIO);
        $idItem = $response->object()->products[0]->offers[0]->id;
        $order = [
            "status" => "trouble",
            "orderType" => "fizik",
            "site" => "test",
            "orderMethod" => "test",
            "number" => "23121992",
            "lastName" => $FIO[0],
            "firstName" => $FIO[1],
            "patronymic" => $FIO[2],
            "customerComment" => $request->comment,
            "items" => [
                [
                    "offer" =>
                        [
                            "id" => $idItem
                        ],
                    "quantity" => 1
                ]
            ]
        ];

        $numOrder = Http::post("https://superposuda.retailcrm.ru/api/v5/orders/create", [
            "apiKey" => "QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb",
            "order" => $order
        ]);

        if ($numOrder->status() == "201") {
            session()->flash("success", "Заказ создан");
        } else {
            session()->flash("error", "Не уадлось создать заказ");
        }

        return view ("homepage");
    }
}
