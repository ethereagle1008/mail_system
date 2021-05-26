@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        .school-type:before {
            position: absolute;
            bottom: 0px;
            right: 15px;
            display: inline-block;
            border-top: 1rem solid #2B9ca4;
            border-left: 0px solid transparent;
            border-right: 1rem solid white;
            border-bottom: 0px solid transparent;
            content: " ";
        }

        .school-type {
            align-items: center;
            background-color: #31bcc7;
            height: 7rem;
            display: flex;
            justify-content: center;
        }

        p {
            margin-bottom: 0px;
        }

        .badge {
            box-shadow: none;
        }


        .edit-profile {
            margin-top: 1rem;
            text-align: center;
            width: 100%;
        }

        .search-body {
            background-color: #e5eecb;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .search-body > .form-inline {
            background-color: white;
        }

        .location {

        }

        .custom-select {
            border: none;

        }

        .garden-title {
            font-size: 1.5rem;
        }

        .garden-comment {
            font-size: 0.8rem;
            margin-top: 4px;
        }


        .txt-detail {
            text-decoration: underline;
            color: black;
            /*font-size: 0.8rem*/
        }

        .col-4 {
            padding: 0 .25rem;
        }

        .md-form {
            margin-bottom: .5rem !important;
        }


    </style>
@endsection

@section('content')
    <div class="position-relative">
        <img src="{{asset('img/SOKUAI.png')}}" class="img-fluid" alt="Responsive image" style="width: 100%;">
    </div>
    <section class="u-align-left u-clearfix u-valign-middle u-section-1" id="sec-9c8d">
        <div class="u-container-style u-expanded-width u-gradient u-group u-group-1">
            <div class="u-container-layout u-valign-middle u-container-layout-1">
                <h3 class="u-align-center u-text u-text-body-alt-color u-text-1">このサービスについて</h3>
            </div>
        </div>
    </section>
    <section class="u-clearfix u-section-2" id="carousel_ded6" style="height: 35vh;">
        <h5 class="text-center">恋愛を相談する掲示板です。</h5>
{{--        <div class="u-clearfix u-sheet u-valign-middle-sm u-sheet-1">--}}
{{--            <div class="u-expanded-width u-list u-repeater u-list-1">--}}
{{--                <div class="u-align-left u-container-style u-list-item u-repeater-item">--}}
{{--                    <div class="u-container-layout u-similar-container u-valign-top-xs u-container-layout-1"><span--}}
{{--                            class="u-icon u-icon-circle u-text-custom-color-2 u-icon-1"><img src="{{asset('img/free.png')}}"></span>--}}
{{--                        <h5 class="u-text u-text-custom-color-2 u-text-1">初回鑑定が誰でも無料！</h5>--}}
{{--                        <p class="u-text u-text-black u-text-2">--}}
{{--                            当ｻｲﾄでは、初回鑑定1回分(1,800円)が無料で試せるので、はじめての方も安心してご利用になれます。無料ﾎﾟｲﾝﾄを使って、ぜひお試しください。</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="u-align-left u-container-style u-list-item u-repeater-item">--}}
{{--                    <div class="u-container-layout u-similar-container u-valign-top-xs u-container-layout-2"><span--}}
{{--                            class="u-icon u-icon-circle u-text-custom-color-2 u-icon-2"><img src="{{asset('img/man-talking.png')}}"></span>--}}
{{--                        <h5 class="u-text u-text-custom-color-2 u-text-3">在籍している先生は30名以上!!</h5>--}}
{{--                        <p class="u-text u-text-black u-text-4">専門技お客様のどんなお悩みにも対応できるよう、当ｻｲﾄでは多数の先生に在籍していただいております。--}}
{{--                            また、占いｶｳﾝｾﾘﾝｸﾞの種類も豊富に取り揃えておりますので、お客様のお悩みに合った先生をご自由にお選び下さい。</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </section>
{{--    <section class="u-align-center u-clearfix u-section-3" id="carousel_75f5">--}}
{{--        <div--}}
{{--            class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xl u-sheet-1">--}}
{{--            <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">--}}
{{--                <div class="u-layout">--}}
{{--                    <div class="u-layout-col">--}}
{{--                        <div class="u-size-60">--}}
{{--                            <div class="u-layout-row">--}}
{{--                                <div--}}
{{--                                    class="u-align-left-lg u-align-left-xl u-container-style u-layout-cell u-left-cell u-shape-rectangle u-size-20 u-layout-cell-1">--}}
{{--                                    <div class="u-container-layout u-valign-top-md u-container-layout-1"><span--}}
{{--                                            class="u-icon u-icon-circle u-text-custom-color-2 u-icon-1"><svg--}}
{{--                                                class="u-svg-link" preserveAspectRatio="xMidYMin slice"--}}
{{--                                                viewBox="0 0 511.999 511.999" style=""><use--}}
{{--                                                    xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                                    xlink:href="#svg-47e3"></use></svg><svg--}}
{{--                                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"--}}
{{--                                                xml:space="preserve" class="u-svg-content" viewBox="0 0 511.999 511.999"--}}
{{--                                                x="0px" y="0px" id="svg-47e3"--}}
{{--                                                style="enable-background:new 0 0 511.999 511.999;"><g><g><g><path--}}
{{--                                                                d="M267.998,61.092c0.337,0,0.665-0.002,1-0.002c48.74,0,94.412,18.844,128.686,53.118     c34.557,34.557,53.459,80.618,53.225,129.697c-0.052,11.045,8.859,20.042,19.905,20.095c0.033,0,0.064,0,0.097,0     c10.999,0,19.944-8.892,19.997-19.905c0.285-59.837-22.778-116.009-64.94-158.172C384.134,44.088,328.43,21.09,269.004,21.09     c-0.365,0-0.733,0.001-1.099,0.002c-11.046,0.053-19.957,9.05-19.905,20.095C248.053,52.2,256.997,61.092,267.998,61.092z"></path><path--}}
{{--                                                                d="M511.949,412.553c-0.714-19.805-8.964-38.287-23.229-52.042c-27.931-26.933-51.332-42.481-73.646-48.929     c-30.75-8.887-59.226-0.805-84.641,24.016c-0.038,0.037-0.077,0.075-0.115,0.113l-27.066,26.865     c-16.811-9.444-49.491-30.227-85.234-65.971l-2.632-2.63c-35.508-35.507-56.423-68.373-65.939-85.253l26.839-27.041     c0.038-0.038,0.075-0.076,0.113-0.115c24.821-25.414,32.902-53.892,24.016-84.64c-6.448-22.313-21.995-45.715-48.929-73.646     C137.731,9.015,119.249,0.765,99.446,0.051C79.647-0.662,60.614,6.232,45.865,19.472l-0.574,0.516     c-0.267,0.239-0.527,0.486-0.78,0.739c-29.36,29.358-44.75,70.46-44.508,118.861c0.41,82.22,45.599,176.249,120.879,251.528     c0.063,0.063,0.125,0.124,0.188,0.186c14.152,14.132,30.22,28.116,47.762,41.567c8.765,6.721,21.319,5.063,28.041-3.702     c6.721-8.766,5.064-21.32-3.702-28.041c-16.236-12.448-31.041-25.333-44.004-38.296c-0.062-0.062-0.124-0.124-0.187-0.185     C81.095,294.683,40.361,211.239,40.002,139.387c-0.186-37.276,11.027-68.389,32.431-90.014l0.153-0.138     c14.538-13.048,36.548-12.254,50.108,1.808c51.781,53.698,48.031,79.049,25.151,102.511l-37.074,37.353     c-5.814,5.858-7.433,14.686-4.075,22.226c0.941,2.114,23.709,52.427,80.414,109.132l2.632,2.629     c56.698,56.699,107.011,79.466,109.125,80.408c7.54,3.359,16.368,1.739,22.226-4.075l37.346-37.068     c23.466-22.883,48.818-26.638,102.518,25.145c14.062,13.56,14.856,35.57,1.81,50.105l-0.141,0.157     c-21.45,21.229-52.231,32.433-89.102,32.433c-0.303,0-0.608,0-0.912-0.002c-29.471-0.147-63.598-8.226-98.689-23.362     c-10.142-4.376-21.911,0.3-26.286,10.443c-4.375,10.142,0.301,21.911,10.443,26.286c40.562,17.496,79.029,26.456,114.332,26.633     c0.375,0.001,0.748,0.002,1.122,0.002c47.914-0.001,88.608-15.379,117.738-44.51c0.254-0.254,0.5-0.513,0.739-0.78l0.519-0.577     C505.766,451.385,512.663,432.357,511.949,412.553z"></path><path--}}
{{--                                                                d="M369.457,142.549c-21.453-21.454-42.043-27.147-51.939-29.884c-10.649-2.945-21.663,3.299-24.607,13.946     c-2.944,10.646,3.299,21.663,13.946,24.607c8.092,2.238,20.32,5.62,34.316,19.615c13.473,13.473,17.052,25.636,19.421,33.685     l0.289,0.979c2.574,8.697,10.538,14.329,19.169,14.329c1.88,0.001,3.792-0.267,5.686-0.828     c10.591-3.135,16.636-14.263,13.5-24.854l-0.271-0.918C395.882,182.744,390.14,163.232,369.457,142.549z"></path>--}}
{{--</g>--}}
{{--</g>--}}
{{--</g></svg></span>--}}
{{--                                        <h5 class="u-text u-text-1">Call today</h5>--}}
{{--                                        <a href="tel:+800 123 45 67"--}}
{{--                                           class="u-btn u-button-style u-none u-text-active-palette-4-light-2 u-text-custom-color-2 u-text-hover-palette-4-light-2 u-btn-1">+800--}}
{{--                                            123 45 67</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    class="u-align-center-md u-align-center-sm u-align-center-xs u-align-left-lg u-align-left-xl u-container-style u-layout-cell u-shape-rectangle u-size-20 u-layout-cell-2">--}}
{{--                                    <div class="u-container-layout u-valign-top-xl u-container-layout-2">--}}
{{--                                        <h5 class="u-text u-text-2">Request</h5><span--}}
{{--                                            class="u-icon u-icon-circle u-text-custom-color-2 u-icon-2"><svg--}}
{{--                                                class="u-svg-link" preserveAspectRatio="xMidYMin slice"--}}
{{--                                                viewBox="0 0 512 512" style=""><use--}}
{{--                                                    xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                                    xlink:href="#svg-368e"></use></svg><svg--}}
{{--                                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"--}}
{{--                                                xml:space="preserve" class="u-svg-content" viewBox="0 0 512 512" x="0px"--}}
{{--                                                y="0px" id="svg-368e" style="enable-background:new 0 0 512 512;"><g><g><path--}}
{{--                                                            d="M511.738,494.272c-0.064-0.576,0.128-1.184,0-1.76l-64-287.968c-0.448-1.984-1.28-3.744-2.336-5.344    c-0.064-0.096-0.064-0.192-0.128-0.288c-0.256-0.352-0.64-0.544-0.928-0.896c-0.928-1.12-1.92-2.144-3.104-2.976    c-0.608-0.416-1.248-0.736-1.888-1.056c-1.056-0.544-2.112-0.992-3.296-1.28c-0.8-0.192-1.568-0.32-2.368-0.416    c-0.544-0.064-1.024-0.288-1.568-0.288h-192c-8.832,0-16,7.168-16,16c0,8.832,7.168,16,16,16H380.89L40.602,459.584    l37.376-168.128c1.92-8.64-3.52-17.184-12.16-19.104c-8.544-1.728-17.184,3.52-19.104,12.16l-46.208,208    c-0.032,0.096,0.032,0.192,0,0.288c-0.448,2.176-0.448,4.416,0.032,6.624c0.096,0.512,0.448,0.896,0.608,1.376    c0.48,1.472,0.928,2.912,1.824,4.256c0.096,0.16,0.288,0.192,0.416,0.352c0.128,0.16,0.128,0.384,0.256,0.544    c1.024,1.28,2.432,2.112,3.776,3.008c0.576,0.384,0.992,0.96,1.6,1.28c2.208,1.12,4.608,1.76,7.104,1.76h480    c2.688,0,5.216-0.8,7.52-2.048c0.704-0.384,1.184-0.96,1.824-1.44c1.056-0.8,2.272-1.408,3.136-2.496    c0.384-0.48,0.448-1.088,0.8-1.632c0.224-0.384,0.672-0.512,0.864-0.928c0.384-0.736,0.416-1.504,0.672-2.272    c0.32-0.896,0.64-1.696,0.768-2.624C511.962,497.088,511.898,495.712,511.738,494.272z M67.354,480l157.888-109.312L431.706,480    H67.354z M254.874,350.176L421.69,234.688l51.296,230.944L254.874,350.176z"></path>--}}
{{--</g>--}}
{{--</g><g><g><path d="M112.122,64c-26.464,0-48,21.536-48,48s21.536,48,48,48s48-21.536,48-48S138.586,64,112.122,64z M112.122,128    c-8.832,0-16-7.168-16-16c0-8.832,7.168-16,16-16c8.832,0,16,7.168,16,16C128.122,120.832,120.954,128,112.122,128z"></path>--}}
{{--</g>--}}
{{--</g><g><g><path d="M112.122,0c-61.76,0-112,50.24-112,112c0,57.472,89.856,159.264,100.096,170.688c3.04,3.36,7.36,5.312,11.904,5.312    s8.864-1.952,11.904-5.312C134.266,271.264,224.122,169.472,224.122,112C224.122,50.24,173.882,0,112.122,0z M112.122,247.584    c-34.944-41.44-80-105.056-80-135.584c0-44.096,35.904-80,80-80s80,35.904,80,80C192.122,142.496,147.066,206.144,112.122,247.584    z"></path>--}}
{{--</g>--}}
{{--</g></svg></span>--}}
{{--                                        <a href="https://nicepage.com"--}}
{{--                                           class="u-btn u-button-style u-none u-text-active-palette-4-light-2 u-text-custom-color-2 u-text-hover-palette-4-light-2 u-btn-2">+800--}}
{{--                                            123 45 67</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div--}}
{{--                                    class="u-align-center-md u-align-center-sm u-align-center-xs u-align-left-lg u-align-left-xl u-container-style u-layout-cell u-right-cell u-shape-rectangle u-size-20 u-layout-cell-3">--}}
{{--                                    <div class="u-container-layout u-container-layout-3"><span--}}
{{--                                            class="u-icon u-icon-circle u-text-custom-color-2 u-icon-3"><svg--}}
{{--                                                class="u-svg-link" preserveAspectRatio="xMidYMin slice"--}}
{{--                                                viewBox="0 0 511.998 511.998" style=""><use--}}
{{--                                                    xmlns:xlink="http://www.w3.org/1999/xlink"--}}
{{--                                                    xlink:href="#svg-0dd1"></use></svg><svg--}}
{{--                                                xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"--}}
{{--                                                xml:space="preserve" class="u-svg-content" viewBox="0 0 511.998 511.998"--}}
{{--                                                id="svg-0dd1"><g><path--}}
{{--                                                        d="m431.665 139.258v-122.04h-351.332v122.04l-80.333 57.38v298.142h511.998v-298.142zm-249.673 202.811-151.992 108.564v-217.128zm74.007-15.994 194.191 138.705h-388.382zm74.007 15.994 151.992-108.564v217.127zm141.185-137.712-39.526 28.232v-56.464zm-69.526-157.139v206.8l-97.466 69.618-48.2-34.428-48.2 34.428-97.466-69.618v-206.8zm-321.332 185.372-39.526-28.232 39.526-28.232z"></path><path--}}
{{--                                                        d="m152.716 86.074h103.283v30h-103.283z"></path><path--}}
{{--                                                        d="m152.716 154.929h206.566v30h-206.566z"></path><path--}}
{{--                                                        d="m152.716 223.785h206.566v30h-206.566z"></path>--}}
{{--</g></svg></span>--}}
{{--                                        <h5 class="u-text u-text-3">email us</h5>--}}
{{--                                        <a href="mailto:info@business.com"--}}
{{--                                           class="u-btn u-button-style u-none u-text-active-palette-4-light-2 u-text-custom-color-2 u-text-hover-palette-4-light-2 u-btn-3">info@business.com</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}



@endsection

@section('footer_top')
    <div class="card background-transparent position-sticky" style="bottom: 2rem;  margin-top: -140px">
        <div class="card-body background-opacity">

            <img src="{{asset('img/up.png')}}" class="img-up" id="move_top" style="bottom: -.5rem">
        </div>
    </div>
@endsection

@section('footer_image')
    <img src="{{ asset('img/footer_1.png') }}" style="width: 100%">
@endsection

@section('js4event')

@endsection
