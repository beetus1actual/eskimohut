<?php

require 'init.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Member data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid Excel file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Eskimo Hut</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<h1>Schedules</h1>
<div class="btn-group">
    <button id="selectStore" type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Select Store
        <span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true"></span>
    </button>
    <ul class="dropdown-menu dropdown-centered">
        <li><a class="dropdown-item" href="#" id="austin">Austin Norwood</a></li>
        <li><a class="dropdown-item" href="#" id="beechnut">Beechnut</a></li>
        <li><a class="dropdown-item" href="#" id="louetta">Louetta</a></li>
        <li><a class="dropdown-item" href="#" id="barrow">Barrow</a></li>
        <li><a class="dropdown-item" href="#" id="bosque">Bosque</a></li>
        <li><a class="dropdown-item" href="#" id="ftworth">Ft Worth</a></li>
        <li><a class="dropdown-item" href="#" id="sanangelo">San Angelo</a></li>
        <li><a class="dropdown-item" href="#" id="sheik">Sheik</a></li>
        <li><a class="dropdown-item" href="#" id="treadaway">Treadaway</a></li>
        <li><a class="dropdown-item" href="#" id="western">Western</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a id="clear" class="dropdown-item" href="#">Clear Values</a> </li>
    </ul>
</div>
<table class="table table-hover table-striped">
    <thead class="table-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
            <th scope="col">TTL</th>
            <th scope="col">LM</th>
            <th scope="col">VAR</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th id="forcastedSales" scope="row">$</th>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
        <tr>
            <th id="dailyHours" scope="row">Daily Hours</th>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
        <tr>
            <th id="scheduledHours" scope="row">Scheduled Hours</th>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
            <td>test</td>
        </tr>
    </tbody>
</table>
<div class="d-grid gap-2 d-md-flex">
    <button id="print" class="btn btn-info" type="button" onclick="window.print()">
        <span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true"></span>
        <span role="status">Print</span>
    </button>
    <button id="import" class="btn btn-info" type="button" onclick="formToggle('importFrm');">
        <span class="spinner-border spinner-border-sm visually-hidden" aria-hidden="true"></span>
        <a href="javascript:void(0);">Import Excel Sheet</a>
    </button>
</div>
<div class="col-md-12" id="importFrm" style="display: none;">
    <form class="row g-3" action="importData.php" method="post" enctype="multipart/form-data">
        <div class="col-auto">
            <label for="fileInput" class="visually-hidden">File</label>
            <input type="file" class="form-control" name="file" id="fileInput" />
        </div>
        <div class="col-auto">
            <input type="submit" class="btn btn-primary mb-3" name="importSubmit" value="Import">
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    $('.dropdown-menu li a').click(function () {
        const store = $(this).text();
        const storeName = $(this).parents('.btn-group').find('#selectStore');
        storeName.html('');

        if ($(this).text() === 'Clear Values') {
            storeName.html('Select Store');
        } else {
            storeName.html(store);
        }
    });

    $('#print').click(function () {
       $(this).find('span').removeClass('visually-hidden');
       $(this).addClass('disabled');
    });

    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
        }else{
            element.style.display = "none";
        }
    }
</script>
</body>
</html>
