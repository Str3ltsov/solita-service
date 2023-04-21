<?php

namespace App\Traits;

trait LogTranslator
{
    private $arrayLt = [
        "Admin Set Order" => "Užsakymo statuso keitimas",
        "Return Status To" => "Grąžinimo statusas pakeistas į",
        'Set Order ID' => 'nustatė užsakymo ID',
        "Status To" => "statusą į",
        'Priority To' => 'pirmenybę į',
        'Total Hours To' => 'iš viso valandų į',
        'Hours' => 'valandų',
        'End Date To' => 'pabaigos datą į',
        "Created New Order" => "Naujas Užsakymas",
        "New" => "Naujas",
        "Open" => "Atidarytas",
        "Close" => "Uždarytas",

        "Returned" => "Grąžinta",

        'Administrator' => 'Administratorius',
        'Employee' => 'Darbuotojas',
        'Specialist' => 'Specialistas',
        'Client' => 'Klientas',

        'Created' => 'Sukurtas',
        'Preview' => 'Peržiūra',
        'Previewed' => 'Peržiūrėtas',
        'Approved By' => 'Patvirtino',
        'Approved By Client' => 'Patvirtino klientas',
        'Approved By Employee' => 'Patvirtino darbuotojas',
        'Running' => 'Vykdomas',
        'Completed' => 'Baigtas',
        'Overdue' => 'Pavėluotas',
        'Cancelled' => 'Atšauktas',
    ];

//    private $arrayRu = [
//        "Admin Set Order" => "Изменение статуса",
//        "Return Status To" => "Изменен статус возврата на",
//        "Status To" => "Статус изменен на",
//        "Created New Order" => "Создание нового заказа",
//        "New" => "Новый",
//        "Open" => "Открыт",
//        "Close" => "Закрыт",
//
//        "Draft" => "Черновик",
//        "Waiting" => "Ожидание",
//        "Shipped" => "Отправлено",
//        "Canceled" => "Отменено",
//        "Completed" => "Завершено",
//        "Returned" => "Возврат",
//    ];


    public function logTranslate($string, $lang){
        $a = [];

        if ($lang === "lt") {
            $a = $this->arrayLt;
        }
//        elseif ($lang === "ru"){
//            $a = $this->arrayRu;
//        }

        foreach ($a as $key => $val) {
            $string = str_replace($key, $val, $string);
        }

        return $string;
    }

}
