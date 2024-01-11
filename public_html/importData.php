<?php

use App\Controllers\Database;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require 'init.php';

function isArrayNotNull(array $array): bool
{
    foreach ($array as $key => $value) {
        if (!empty($value) || $value != null || $value != '') {
            return true;
        }

        return false;
    }
}

if (isset($_POST['importSubmit'])) {
    $excelMimes = [
        'text/xls',
        'text/xlsx',
        'application/excel',
        'application/vnd.msexcel',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $reader = new Xlsx();
            $reader->setReadDataOnly(true);
            $spreadSheet = $reader->load($_FILES['file']['tmp_name']);
            $workSheet = $spreadSheet->getActiveSheet();
            $workSheetArray = $workSheet->rangeToArray('A30:I40');

            $capsule = (new Database)->getManager();
            $cleanedEmpty = [];

            foreach ($workSheetArray as $data) {
                if (isArrayNotNull($data)) {
                    $capsule->table('store_data')
                        ->where('name', $data[0])
                        ->updateOrInsert([
                            'name' => $data[0],
                            'monday' => $data[1],
                            'tuesday' => $data[2],
                            'wednesday' => $data[3],
                            'thursday' => $data[4],
                            'friday' => $data[5],
                            'saturday' => $data[6],
                            'sunday' => $data[7],
                            'updated_at' => Carbon::now()->toDateTimeString(),
                        ]);
                }
            }
            $status = '?status=success';
        } else {
            $status = '?status=error';
        }
    } else {
        $status = '?status=invalidFile';
    }
}

header("Location: index.php{$status}");
