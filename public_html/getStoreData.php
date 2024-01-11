<?php

require 'init.php';

use App\Controllers\Database;

/**
 * @param $store
 * @return array
 */
function getData($store): array
{
    $capsule = (new Database())->getManager();

    return $capsule->table('store_data')
        ->where('name', $store)
        ->get()
        ->toArray();
}

if (isset($_POST['store'])) {
    $store = $_POST['store'];

    $results = getData($store);

    foreach ($results as $result) {
        $monday = $result->monday;
        $tuesday = $result->tuesday;
        $wednesday = $result->wednesday;
        $thursday = $result->thursday;
        $friday = $result->friday;
        $saturday = $result->saturday;
        $sunday = $result->sunday;

        $html = <<<HTML
    <tr>
            <th id="forcastedSales" scope="row">&dollar;</th>
            <td>&dollar;{$monday}</td>
            <td>&dollar;{$tuesday}</td>
            <td>&dollar;{$wednesday}</td>
            <td>&dollar;{$thursday}</td>
            <td>&dollar;{$friday}</td>
            <td>&dollar;{$saturday}</td>
            <td>&dollar;{$sunday}</td>
        </tr>
        <tr>
            <th id="dailyHours" scope="row">Daily Hours</th>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
        </tr>
        <tr>
            <th id="scheduledHours" scope="row">Scheduled Hours</th>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
            <td>na</td>
        </tr>
        <tr>
            <th id="variance" scope="row">Variance</th>
        </tr>
HTML;

        echo $html;
    }
}


