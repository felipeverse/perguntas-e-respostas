<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Leaderbord  --}}
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/supah/pen/WwrJpw?limit=all&page=86&q=box" />

    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <style class="cp-pen-styles">
    <style>
        .button-container {
            display: flex;
            gap: 5px; /* Espaçamento entre os botões */
        }

        .button-container > * {
            flex: 1; /* Os botões irão ocupar o mesmo espaço */
        }

        .letra {
            float: left;
            margin-right: 5px;
            margin-left: 5px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            min-height: 450px;
            height: 100vh;
            margin: 0;
            background: -webkit-radial-gradient(ellipse farthest-corner at center top, #ffffff 0%, #e6e6e6 100%);
            background: radial-gradient(ellipse farthest-corner at center top, #ffffff 0%, #e6e6e6 100%);
            /* color: #fff; */
            font-family: 'Open Sans', sans-serif;
        }

        input.mb-2,
            label.mb-2,
            button.mb-2 {
            margin-bottom: 0.5rem; /* Ajuste o valor conforme necessário */
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
        }

        /*--------------------
        Leaderboard
        --------------------*/
        .leaderboard {
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);
            width: 55%;
            height: auto;
            background: -webkit-linear-gradient(top, #3a404d, #181c26);
            background: linear-gradient(to bottom, #3a404d, #181c26);
            border-radius: 10px;
            box-shadow: 0 7px 30px rgba(62, 9, 11, 0.3);
        }
        .leaderboard h1 {
            font-size: 18px;
            color: #e1e1e1;
            padding: 12px 13px 18px;
        }
        .leaderboard h1 svg {
            width: 25px;
            height: 26px;
            position: relative;
            top: 3px;
            margin-right: 6px;
            vertical-align: baseline;
        }
        .leaderboard ol {
            counter-reset: leaderboard;
        }
        .leaderboard ol li {
            position: relative;
            color: white;
            z-index: 1;
            font-size: 14px;
            counter-increment: leaderboard;
            padding: 18px 10px 18px 50px;
            cursor: pointer;
            -webkit-backface-visibility: hidden;
                    backface-visibility: hidden;
            -webkit-transform: translateZ(0) scale(1, 1);
                    transform: translateZ(0) scale(1, 1);
        }
        .leaderboard ol li::before {
            /* content: counter(leaderboard); */
            position: absolute;
            z-index: 2;
            top: 15px;
            left: 15px;
            width: 20px;
            height: 20px;
            line-height: 20px;
            color: #c24448;
            background: #fff;
            border-radius: 20px;
            text-align: center;
        }
        .leaderboard ol li mark {
            position: absolute;
            z-index: 2;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 18px 10px 18px 50px;
            margin: 0;
            background: none;
            color: #fff;
        }
        .leaderboard ol li mark::before,
        .leaderboard ol li mark::after {
            content: '';
            position: absolute;
            z-index: 1;
            bottom: -11px;
            left: -9px;
            border-top: 10px solid #3f72af;
            border-left: 10px solid transparent;
            -webkit-transition: all .1s ease-in-out;
            transition: all .1s ease-in-out;
            opacity: 0;
        }
        .leaderboard ol li mark::after {
            left: auto;
            right: -9px;
            border-left: none;
            border-right: 10px solid transparent;
        }
        .leaderboard ol li small {
            position: relative;
            z-index: 2;
            display: block;
            text-align: right;
        }
        .leaderboard ol li::after {
            content: '';
            position: absolute;
            z-index: 1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #2c5282;
            box-shadow: 0 3px 0 rgba(0, 0, 0, 0.08);
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            opacity: 0;
        }
        .leaderboard ol li:nth-child(1) {
            background: #2c5282;
        }
        .leaderboard ol li:nth-child(1)::after {
            background: #2c5282;
        }
        .leaderboard ol li:nth-child(2) {
            background: #1a365d;
        }
        .leaderboard ol li:nth-child(2)::after {
            background: #1a365d;
            box-shadow: 0 2px 0 rgba(0, 0, 0, 0.08);
        }
        .leaderboard ol li:nth-child(2) mark::before, .leaderboard ol li:nth-child(2) mark::after {
            border-top: 6px solid #102549;
            bottom: -7px;
        }
        .leaderboard ol li:nth-child(3) {
            background: #0d223f;
        }
        .leaderboard ol li:nth-child(3)::after {
            background: #0d223f;
            box-shadow: 0 1px 0 rgba(0, 0, 0, 0.11);
        }
        .leaderboard ol li:nth-child(3) mark::before, .leaderboard ol li:nth-child(3) mark::after {
            border-top: 2px solid #091730;
            bottom: -3px;
        }
        .leaderboard ol li:nth-child(4) {
            background: #082034;
        }
        .leaderboard ol li:nth-child(4)::after {
            background: #082034;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
        }
        .leaderboard ol li:nth-child(4) mark::before, .leaderboard ol li:nth-child(4) mark::after {
            top: -7px;
            bottom: auto;
            border-top: none;
            border-bottom: 6px solid #061426;
        }
        .leaderboard ol li:nth-child(5) {
            background: #041c2c;
            border-radius: 0 0 10px 10px;
        }
        .leaderboard ol li:nth-child(5)::after {
            background: #041c2c;
            box-shadow: 0 -2.5px 0 rgba(0, 0, 0, 0.12);
            border-radius: 0 0 10px 10px;
        }
        .leaderboard ol li:nth-child(5) mark::before, .leaderboard ol li:nth-child(5) mark::after {
            top: -9px;
            bottom: auto;
            border-top: none;
            border-bottom: 8px solid #041c2c;
        }
        .leaderboard ol li:nth-child(6) {
            background: #030a16;
        }

        .leaderboard ol li:nth-child(6)::after {
            background: #030a16;
            box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.15);
        }

        .leaderboard ol li:nth-child(6) mark::before,
        .leaderboard ol li:nth-child(6) mark::after {
            top: -7px;
            bottom: auto;
            border-top: none;
            border-bottom: 6px solid #02060d;
        }
        .leaderboard ol li:hover {
            z-index: 2;
            overflow: visible;
        }
        .leaderboard ol li:hover::after {
            opacity: 1;
            -webkit-transform: scaleX(1.06) scaleY(1.03);
                    transform: scaleX(1.06) scaleY(1.03);
        }
        .leaderboard ol li:hover mark::before, .leaderboard ol li:hover mark::after {
            opacity: 1;
            -webkit-transition: all .35s ease-in-out;
            transition: all .35s ease-in-out;
        }
    </style>
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Conteúdo da aplicação --}}
    <main class="container p-5">
        @yield('content')
    </main>

    {{-- Bootstrap scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    {{-- Confetti effect --}}
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.9.3/tsparticles.confetti.bundle.min.js"></script>

</body>
</html>
