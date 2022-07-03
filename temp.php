<?php
require('./configuration/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .ex {
            padding: 2rem;
            border: 1px solid grey;
        }

        .separator {
            border: 1px solid grey;
            margin: 1rem 0;
        }

        p {
            display: block;
            width: 100%;
            text-align: center;
            font-size: .8rem;
            text-transform: uppercase;
            color: gray;
            text-decoration: underline;
            padding: 1rem 0;
        }
    </style>
</head>

<body>
    <div class="row">
        <p>double-sided</p>
        <div class="small-12 medium-2 columns">
            <input type="number" id="sliderOutput1">
        </div>
        <div class="small-12 medium-8 columns">
            <div class="slider" data-slider data-initial-start="3000" data-start="0" data-initial-end="75000" data-end="100000" data-step="100">
                <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput1"></span>
                <span class="slider-fill" data-slider-fill></span>
                <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput2"></span>
            </div>
        </div>
        <div class="small-12 medium-2 columns">
            <input type="number" id="sliderOutput2">
        </div>
    </div>

    <div class="separator"></div>

    <div class="row">
        <p>on one hand</p>
        <div class="small-6 medium-2 columns">
            <input type="number" id="sliderOutput3">
        </div>
        <div class="small-6 medium-2 columns">
            <input type="number" id="sliderOutput4">
        </div>
        <div class="small-12 medium-8 columns">
            <div class="slider" data-slider data-initial-start="20000" data-start="0" data-initial-end="75000" data-end="100000" data-step="1000">
                <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput3"></span>
                <span class="slider-fill" data-slider-fill></span>
                <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderOutput4"></span>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).foundation();
</script>

</html>