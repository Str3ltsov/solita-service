<?php

namespace App\Traits;

trait LogTranslator

{
    private $arrayLt = [
        "Admin Set Order" => "Užsakymo statuso keitimas",
        "Return Status To" => "Grąžinimo statusas pakeistas į",
        "Status To" => "Statusas pakeistas į",
        "Created New Order" => "Naujas Užsakymas",
        "New" => "Naujas",
        "Open" => "Atidarytas",
        "Close" => "Uždarytas",

        "Draft" => "Juodraštis",
        "Waiting" => "Laukiama",
        "Shipped" => "Išsiųsta",
        "Canceled" => "Atšaukta",
        "Completed" => "Baigta",
        "Returned" => "Grąžinta",
        "Order" => "Užsakymas",


    ];

    private $arrayRu = [
        "Admin Set Order" => "Изменение статуса",
        "Return Status To" => "Изменен статус возврата на",
        "Status To" => "Статус изменен на",
        "Created New Order" => "Создание нового заказа",
        "New" => "Новый",
        "Open" => "Открыт",
        "Close" => "Закрыт",

        "Draft" => "Черновик",
        "Waiting" => "Ожидание",
        "Shipped" => "Отправлено",
        "Canceled" => "Отменено",
        "Completed" => "Завершено",
        "Returned" => "Возврат",


    ];


    public function logTranslate($string, $lang){
        if ($lang === "lt"){
            $a = $this->arrayLt;
        }
        elseif ($lang === "ru"){
            $a = $this->arrayRu;
        }
        else $a = [];

        foreach ($a as $key => $val) {
            $string = str_replace($key, $val, $string);
        }

        return $string;
    }

}
