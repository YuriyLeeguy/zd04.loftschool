<?php

/* Задание № 1
  Написать скрипт, который выведет всю информацию из этого файла в удобно
читаемом виде. Представьте, что результат вашего скрипта будет распечатан и выдан
курьеру для доставки, разберется ли курьер в этой информации?
*/
function task1()
{
    $xml = simplexml_load_file('data.xml');
    $result = $result1 = "";
    $delimiterLine = '<BR>';
    $deliveryNotes = "Примечание: " . $xml->DeliveryNotes->__toString() . $delimiterLine . $delimiterLine;
    foreach ($xml->Address as $adr) {
        $result .= "Тип доставки: " . $adr->attributes()->Type->__toString() . $delimiterLine
            . "на Имя: " . $adr->Name->__toString() . $delimiterLine
            . "доставить по Адресу:" . $delimiterLine
            . "Улица: " . $adr->Street->__toString() . $delimiterLine
            . "Город: " . $adr->City->__toString() . $delimiterLine
            . "Штат: " . $adr->State->__toString() . $delimiterLine
            . "Индекс: " . $adr->Zip->__toString() . $delimiterLine . $delimiterLine;
    }
    foreach ($xml->Items->Item as $val) {
        $result1 .= "Артикул: " . $val->attributes()->PartNumber->__toString() . $delimiterLine;
        $result1 .= "Наименование товара: " . $val->ProductName->__toString() . $delimiterLine;
        $result1 .= "Количество: " . $val->Quantity->__toString() . $delimiterLine;
        $result1 .= "Стоимость: " . $val->USPrice->__toString() . $delimiterLine;
        $result1 .= "Дата отгрузки: " . $val->ShipDate->__toString() . $delimiterLine . $delimiterLine;
    }
    return $result . $delimiterLine . $deliveryNotes . $result1;
}

/*
    Задача #2
1. Создайте массив, в котором имеется как минимум 1 уровень вложенности.
Преобразуйте его в JSON. Сохраните как output.json
2. Откройте файл output.json. Случайным образом, используя функцию rand(), решите
изменять данные или нет. Сохраните как output2.json
3. Откройте оба файла. Найдите разницу и выведите информацию об отличающихся
элементах
*/

function task2($potato, $onion, $garlic, $sourCream)
{
// Создали массив "Рецепт Борща"
    if (($potato < 0 or $onion < 0) or ($garlic < 0 or $sourCream < 0)) {
        echo 'Ведите положительные значения';
        return null;
    }
    $recipe = ['Рецепт' => ['Борщ' => ['картошка' => $potato,
        'Лук' => $onion,
        'Чеснок' => $garlic,
        'Сметана' => $sourCream]]];
    $writeJason = json_encode($recipe, JSON_UNESCAPED_UNICODE); // Преобразовали в код Json
    file_put_contents('output.json', $writeJason);//  Создали файл output.json и поместили преобразованный код Json
    if (!file_exists('output.json')) {
        echo "<BR>Нет такого файла!<BR>";
    }
    $readJason = file_get_contents('output.json'); //Достали информацию из из файла 'output.json'
    $array = $decoderOutput1 = json_decode($readJason, true); // Преобразовали код Json в PHP
    if (1 == rand(1, 2)) {
        echo "<BR> Файл успешно создан <BR>";
        foreach ($array as $key => $val) {
            foreach ($val as $key1 => $value1) {
                foreach ($value1 as $key2 => $value2) {
                    $array[$key][$key1][$key2] += rand(0, 10);
                    $writeJason = json_encode($array, JSON_UNESCAPED_UNICODE);
                    file_put_contents('output2.json', $writeJason);
                }
            }
        }
        $readJason2 = file_get_contents('output2.json');
        $decoderOutput2 = json_decode($readJason2, true);
        foreach ($decoderOutput2 as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $newdecoderOutput2 = $decoderOutput2[$key][$key1];
            }
        }

        foreach ($decoderOutput1 as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $newDecoderOutput1 = $decoderOutput1[$key][$key1];
            }
        }
        $result = array_diff_assoc($newdecoderOutput2, $newDecoderOutput1);
        echo "<BR>Изменения были в следующих элементах: <BR>";
        print_r($result);
    } else {
        echo "<BR>Файл не создан!<BR>";
        echo "<BR>Не возмиожно сравнить два файла!<BR>";
        return null;
    }
}

/*Задача #3
1. Программно создайте массив, в котором перечислено не менее 50 случайных чисел
от 1 до 100
2. Сохраните данные в файл csv
3. Откройте файл csv и посчитайте сумму четных чисел
*/

function task3()
{
    for ($i = 0; $i < 50; $i++) {
        $array[$i] = rand(1, 100);
    }
    echo "Создали массив" . "<BR><BR>";

    $fileCsv = fopen('fileCsv.csv', 'w');
    fputcsv($fileCsv, $array, ';');
    fclose($fileCsv);
    echo "Информацию передали в fileCsv.csv" . "<BR><BR>";

    $pathCsv = './fileCsv.csv';
    $openfile = fopen($pathCsv, 'r');
    if ($openfile) {
        $res = fgetcsv($openfile, null, ";");
    }
    echo "Открыли файл fileCsv.csv для работы с данными." . "<BR><BR>";

    $count = count($res);
    $result = [];
    for ($i = 1; $i < $count; $i++) {
        if ($res[$i] % 2 == 0) {
            $result[$i] = $res;
        };
    }
    echo "Общая сумма четных чисел: " . count($result) . "<BR>";
}

/*Задача #4
1. С помощью PHP запросить данные по адресу:
https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&r
vprop=content&format=json
2. Вывести title и page_id*/
function task4()
{
    $url = 'https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json';
    $data = file_get_contents($url);
    $decoderOutput1 = json_decode($data, true);
    function search($array, $key)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key])) {
                $results[] = $array;
            }
            foreach ($array as $subArray) {
                $results = array_merge($results, search($subArray, $key));
            }
        }
        return $results;
    }
    $pageId = 'page_id';
    $title = 'title';
    $results1 = array_shift(search($decoderOutput1, $pageId));
    $results2 = array_shift(search($decoderOutput1, $title));

    if ($results1 == 0) {
        echo "$pageId - Нет данных";
    } else {
        echo "$pageId - " . $results1[$pageId] . "<BR>";
    }
    if ($results2 == 0) {
        echo "<BR> $title - Нет данных";
    } else {
        echo "<BR>$title - " . $results2[$title];
    }
}
