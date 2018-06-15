<?php

/**
 * decl_of_num: Склоняет словоформу
 *
 * @return string
 */
function decl_of_num($number, $titles) {
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[ ($number%100 > 4 && $number%100 < 20) ? 2 : $cases[($number%10 < 5) ? $number%10 : 5] ];
}

/**
 * dateRU_format: Конвертирует дату input в формат "д м г ч:м:с".
 *
 * @return string
 */
function dateRU_format($input, $full) {
    $month_short = array('01' => 'янв',
        '02' => 'фев',
        '03' => 'мар',
        '04' => 'апр',
        '05' => 'май',
        '06' => 'июн',
        '07' => 'июл',
        '08' => 'авг',
        '09' => 'сен',
        '10' => 'окт',
        '11' => 'ноя',
        '12' => 'дек'
    );
    $month_full = array('01' => 'января',
        '02' => 'февраля',
        '03' => 'марта',
        '04' => 'апреля',
        '05' => 'мая',
        '06' => 'июня',
        '07' => 'июля',
        '08' => 'августа',
        '09' => 'сентября',
        '10' => 'октября',
        '11' => 'ноября',
        '12' => 'декабря'
    );

    if ($input != '') {

        $dt = strtotime($input);
        $day = strftime('%d', $dt);
        $month = ($full == 1) ? $month_full[strftime('%m', $dt)] : $month_short[strftime('%m', $dt)];
        $year = strftime('%Y', $dt);
        $time = strftime('%H:%M:%S', $dt);

        return $day . " " . $month . " " . $year . " г. " . $time;

    }

    else
        return "нет информации";
}