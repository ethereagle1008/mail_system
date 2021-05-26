@extends('user.layouts.app')

@section('title')
    SOKUAI
@endsection

@section('nav')

    @include('user.layouts.navbar')

@endsection

@section('css4page')
    <style>
        @media (min-width:375px) and (max-width: 576px){
            .top-background{
                background: url(/landing_img/top_background_sp.png);
                width: 100%;
                height: 95vw;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }
            .next-part-background{
                width: 100%;
                height: 350px;
                position: relative;
                background: #0d74b6;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .next-part-background::before{
                background: url(/landing_img/parking_area.jpg);
                background-position: bottom;
                background-repeat: no-repeat;
                opacity: 0.2;
                content: "";
                background-size: cover;
                position: absolute;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
            }

            .next-background{
                width: 100%;
                height: 700px;
                position: relative;
                background: #0d74b6;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .next-background::before{
                background: url(/landing_img/parking_area.jpg);
                background-position: center;
                background-repeat: no-repeat;
                opacity: 0.2;
                content: "";
                background-size: cover;
                position: absolute;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
            }

            .target-area{
                /*font: Yugo Bold;*/
                font-weight: bold;
                font-size: 9px;
                color: white;
                position: absolute;
                left: 10%;
                bottom: 20%;
            }

            .area-name{
                font-weight: bold;
                font-size: 16px;
                color: #fcff1e;
            }
            .board{
                font-weight: bold;
                font-size: 60px;
                color: #111a48;
                background: #fcff1e;
                height: 60px !important;
            }
            .board-after{
                font-weight: bold;
                font-size: 35px;
                color: #fcff1e;
                z-index: 50;
            }
            .d-40{
                position: absolute;
                bottom: 33%;
                right: 5%;
                font-size: 15px;
                font-weight: bold;
                color: white;
                line-height: 1.1;
                background: #00b0d6;
                padding: 20px 10px 20px 10px;
                text-align: center;
                border-radius: 50%;
                z-index: 20;
            }

            .half{
                font-size: 7px;
            }

            .high-speed{
                position: absolute;
                bottom: 18%;
                right: 19%;
                font-size: 25px;
                font-weight: bold;
                color: white;
                line-height: 1.1;
                background: #ff4d47;
                padding: 25px 10px 25px 10px;
                text-align: center;
                border-radius: 50%;
            }

            .speed-half{
                font-size: 12px;
            }

            .on-board{
                width: 100%;
                position: absolute;
                top: -30px;
                background: white;
                text-align: center;
            }

            .board-title{
                font-weight: bold;
                font-size: 22px;
                color: #222e6c;
                margin-top: 30px;
                text-decoration: underline;
                -webkit-text-decoration-color: #fcff1e;
                text-decoration-color: #fcff1e;
            }

            .board-content{
                margin: 20px 5% 30px 5%;
                display: block;
            }

            .mail-question{
                width: 100%;
                margin: 0;
                padding: 20px;
                display: flex;
                text-align: center;
                z-index: 100;
                background: #fcff1e;
                border-radius: 10px;
                box-shadow: 0 5px 5px wheat;
            }

            .mail-question:hover{
                background: #fcff1e;
                border-radius: 10px;
                box-shadow: 0 5px 5px wheat;
                text-decoration: underline !important;
            }

            .mail-text{
                color: #222e6c;
                font-size: 17px;
                font-weight: bold;
                line-height: 1;
                margin-left: auto;
                margin-right: auto;
            }

            .mail-box{
                width: 10%;
                height: auto;
                margin-top: auto;
                margin-bottom: auto;
            }
            .mail-text-24{
                font-size: 12px;
            }

            .phone-question{
                width: 100%;
                padding: 20px;
                display: flex;
                position: relative;
                text-align: center;
                margin-top: 30px;
                background: #222e6c;
                border-radius: 10px;
                box-shadow: 0 5px 5px wheat;
            }
            .phone-img{
                width: 10%;
                height: fit-content;
                margin-top: auto;
                margin-bottom: auto;
            }
            .phone-text{
                font-size: 12px;
                font-weight: bold;
                color: #222e6c;
                text-align: center;
                line-height: 1.1;
                width: 90%;
                position: absolute;
                top: -15px;
            }

            .phone-number{
                font-weight: bold;
                font-size: 30px;
                color: white;
                line-height: .6;
                text-align: center;
                margin: 0 auto;
            }

            .phone-number:hover{
                text-decoration: underline !important;
            }
            .phone-time{
                font-size: 12px;
            }
            .person-img{
                width: 13%;
                height: auto;
                position: absolute;
                bottom: 30px;
                right: 30px;
                display: none;
            }

            .help-board{
                margin: 0;
                width: 90%;
                height: 95%;
                position: absolute;
                top: 48%;
                text-align: center;
            }

            .help-title{
                text-align: center;
                font-size: 23px;
                font-weight: bold;
                color: white;
                margin-bottom: 30px;
                font-style: italic;
            }

            .text-img{
                position: absolute;
                width: 42%;
                height: auto;
            }
            .text-img-1{
                left: 3%;
                top: 49%;
            }
            .text-img-2{
                left: 31%;
                width: 35%;
                top: 19px;
            }
            .text-img-3{
                right: 9%;
                width: 29%;
                top: 49%;
            }
            .text-contain{
                position: absolute;
                width: 48%;
            }
            .text-contain-1{
                left: 0;
                top: 41%;
            }
            .text-contain-2{
                left: 24%;
            }
            .text-contain-3{
                right: 0;
                top: 41%;
            }
            .persons{
                width: 80%;
                height: auto;
                position: absolute;
                left: 10%;
                bottom: -41%;
            }
            .animation-part{
                margin: 100px 5% 30px 5%;
                text-align: center;
            }

            .ani-part-title{
                font-size: 25px;
                color: #111a48;
                font-weight: bold;
                line-height: 1.4;
                font-style: italic;
            }

            .ani-part-description{
                margin-top: 20px;
                margin-bottom: 50px;
                font-size: 15px;
                color: #111a48;
                font-weight: bold;
                line-height: 1.5;
            }
            .ani-part-1{
                width: 100%;
                margin-bottom: 30px;
                position: relative;
            }
            .num-img{
                width: 10%;
                height: auto;
                position: absolute;
                left: 0;
            }
            .num-img-left{
                width: 10%;
                height: auto;
                position: absolute;
                left: 0;
            }

            .text-part{
                width: 100% !important;
                text-align: left;
                padding-top: 5px;
            }
            .title-text{
                font-size: 17px;
                font-style: italic;
                font-weight: bold;
                text-decoration: underline;
                text-decoration-color: #3bc5ed;
                text-decoration-thickness: 5px;
                text-underline-position: under;
                color: #111a48;
                padding-left: 43px;
            }

            .content-text{
                font-size: 12px;
                font-weight: bold;
                color: #333333;
                line-height: 1.5;
                margin-top: 20px;
                margin-bottom: 10px;

            }

            .content-text-sp{
                padding-bottom: 145px;
            }

            .image-img{
                width: 90%;
                height: auto;
                margin-right: -10%;
            }
            .image-left{
                width: 90%;
                height: auto;
                position: absolute;
                top: 110px;
                left: 10%;
            }

            .question-part{
                margin: 40px 10%;
                display: flex;
            }

            .question-part-board{
                font-weight: bold;
                font-size: 70px;
                color: #fcff1e;
            }

            .small-part{
                font-weight: bold;
                font-size: 12px;
                color: white;
            }

            .medium-part{
                font-weight: bold;
                font-size: 22px;
                color: #fcff1e;
            }

            .text-question{
                width: 50%;
            }

            .content-part{
                height: calc(100% - 80px);
                margin: 40px 5%;
                display: block;
                z-index: 10;
                width: 90%;
                position: absolute;
            }

            .w-50{
                width: 100% !important;
            }

            .text-part-q{
                font-size: 12px;
                color: white;
                font-weight: bold;
                line-height: 1.3;
            }

            .big-text{
                font-size: 40px;
                color: #fcff1e;
            }

            .medium-text{
                font-size: 23px;
                color: #fcff1e;
            }

            .phone-area{
                text-align: center;
                line-height: 1.3;
                position: absolute;
                top: 200px;
                width: 100%;
                padding: 15px 8%;
                background: #222e6c;
                border-radius: 10px;
            }

            .text-area{
                color: white;
                font-size: 12px;
                font-weight: bold;
                display: none;
            }

            .number-area{
                font-size: 37px;
                color: white;
                font-weight: bold;
                width: 100%;
                line-height: 1;
            }

            .time-area{
                font-size: 10px;
                font-weight: bold;
                color: white;
            }

            .mail-area{
                padding: 20px 8%;
                display: flex;
                text-align: center;
                position: absolute;
                top: 100px;
                width: 100%;
                background: #fcff1e;
                border-radius: 10px;
            }

            .mail-area:hover{
                background: #fcff1e;
                border-radius: 10px;
            }

            .mail-href{
                font-size: 20px;
                font-weight: bold;
                color: #222e6c;
                line-height: 1.1;
                text-align: center;
                margin: auto;
            }
            .type-part-title{
                font-weight: bold;
                color: #111a48;
                text-align: center;
                margin-bottom: 50px;
            }

            .type-title{
                font-size: 28px;
                font-style: italic;
            }
            .type-desc{
                margin: 20px;
                font-size: 10px;
                line-height: 1.2;
            }

            .empty_img{
                width: 22%;
            }

            .top-text{
                position: absolute; left: 5%; top: 15%; line-height: 1.1;
            }
            .help-diag{
                position: relative; height: calc(100% - 403px)
            }

        }
        @media (min-width:1200px){
            .top-background{
                background: url(/landing_img/top_background.png);
                width: 100%;
                height: 40vw;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }
            .next-part-background{
                width: 100%;
                height: 25vw;
                position: relative;
                background: #0d74b6;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .next-part-background::before{
                background: url(/landing_img/parking_area.jpg);
                background-position: bottom;
                background-repeat: no-repeat;
                opacity: 0.2;
                content: "";
                background-size: cover;
                position: absolute;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
            }

            .next-background{
                width: 100%;
                height: 55vw;
                position: relative;
                background: #0d74b6;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .next-background::before{
                background: url(/landing_img/parking_area.jpg);
                background-position: center;
                background-repeat: no-repeat;
                opacity: 0.2;
                content: "";
                background-size: cover;
                position: absolute;
                top: 0px;
                right: 0px;
                bottom: 0px;
                left: 0px;
            }

            .target-area{
                /*font: Yugo Bold;*/
                font-weight: bold;
                font-size: 18px;
                color: white;
                position: absolute;
                left: 10%;
                bottom: 20%;
            }

            .area-name{
                font-weight: bold;
                font-size: 32px;
                color: #fcff1e;
            }
            .board{
                font-weight: bold;
                font-size: 120px;
                color: #111a48;
                background: #fcff1e;
                height: 120px !important;
            }
            .board-after{
                font-weight: bold;
                font-size: 75px;
                color: #fcff1e;
            }
            .d-40{
                position: absolute;
                top: 22%;
                right: 8%;
                font-size: 30px;
                font-weight: bold;
                color: white;
                line-height: 1.1;
                background: #00b0d6;
                padding: 30px 10px 30px 10px;
                text-align: center;
                border-radius: 50%;
                z-index: 20;
            }

            .half{
                font-size: 15px;
            }

            .high-speed{
                position: absolute;
                top: 37%;
                right: 12%;
                font-size: 50px;
                font-weight: bold;
                color: white;
                line-height: 1.1;
                background: #ff4d47;
                padding: 35px 10px 35px 10px;
                text-align: center;
                border-radius: 50%;
            }

            .speed-half{
                font-size: 25px;
            }

            .on-board{
                margin: 0 40px 0 40px;
                width: calc(100% - 80px);
                height: 37%;
                position: absolute;
                top: -40px;
                background: white;
                border-radius: 10px;
                text-align: center;
            }

            .board-title{
                font-weight: bold;
                font-size: 24px;
                color: #222e6c;
                margin-top: 30px;
                text-decoration: underline;
                -webkit-text-decoration-color: #fcff1e; /* Safari */
                text-decoration-color: #fcff1e;
            }

            .board-content{
                margin: 20px 30px 30px 30px;
                display: flex;
            }

            .mail-question{
                width: 50%;
                margin-left: 30px;
                padding: 30px;
                display: flex;
                text-align: center;
            }

            .mail-question:hover{
                background: #fcff1e;
                border-radius: 10px;
                box-shadow: 0 5px 5px wheat;
                text-decoration: underline !important;
            }

            .mail-text{
                color: #222e6c;
                font-size: 28px;
                font-weight: bold;
                line-height: 1;
                margin-left: 10px;
                margin-right: 10px;
            }

            .mail-box{
                width: fit-content;
                height: fit-content;
                margin-top: auto;
                margin-bottom: auto;
                margin-left: auto;

            }
            .mail-text-24{
                font-size: 14px;
            }

            .phone-question{
                width: 30%;
                padding: 0;
                margin-left: 20px;
                display: flex;
                position: relative;
            }
            .phone-img{
                width: fit-content;
                height: fit-content;
                margin-top: auto;
                margin-bottom: auto;
                margin-left: auto;
            }
            .phone-text{
                font-size: 18px;
                font-weight: bold;
                color: #222e6c;
                text-align: center;
                line-height: 1.1;
                width: 300px;
                position: absolute;
                top: 5px;
            }

            .phone-number{
                font-weight: bold;
                font-size: 36px;
                margin-top: 37px;
                color: #222e6c;
                line-height: .9;
            }

            .phone-number:hover{
                text-decoration: underline !important;
            }
            .phone-time{
                font-size: 12px;
            }
            .person-img{
                width: 13%;
                height: auto;
                position: absolute;
                bottom: 30px;
                right: 30px;
            }

            .help-board{
                margin: 0 10% 0 10%;
                width: 80%;
                height: 57%;
                position: absolute;
                top: 40%;
                text-align: center;
            }

            .help-title{
                text-align: center;
                font-size: 50px;
                font-weight: bold;
                color: white;
                margin-bottom: 30px;
                font-style: italic;
            }

            .text-img{
                position: absolute;
                width: 26%;
                height: auto;
            }
            .text-img-1{
                left: 2%;
                top: 30px;
            }
            .text-img-2{
                left: 40%;
                width: 21%;
                top: 30px;
            }
            .text-img-3{
                right: 6%;
                width: 18%;
                top: 30px;
            }
            .text-contain{
                position: absolute;
                width: 30%;
            }
            .text-contain-1{
                left: 0;
            }
            .text-contain-2{
                left: 35%;
            }
            .text-contain-3{
                right: 0;
            }
            .persons{
                width: 50%;
                height: auto;
                position: absolute;
                left: 25%;
                bottom: -40%;
            }
            .animation-part{
                margin: 150px 10% 30px 10%;
                text-align: center;
            }

            .ani-part-title{
                font-size: 50px;
                color: #111a48;
                font-weight: bold;
                line-height: 1.4;
                font-style: italic;
            }

            .ani-part-description{
                margin-top: 15px;
                margin-bottom: 70px;
                font-size: 18px;
                color: #111a48;
                font-weight: bold;
                line-height: 1.5;
            }
            .ani-part-1{
                width: 100%;
                display: flex;
                margin-bottom: 40px;
            }
            .num-img{
                width: 10%;
                height: max-content;
            }
            .num-img-left{
                width: 10%;
                height: max-content;
                margin-left: -5%;
            }

            .text-part{
                width: 50%;
                text-align: left;
                margin-left: 20px;
            }
            .title-text{
                font-size: 34px;
                font-style: italic;
                font-weight: bold;
                text-decoration: underline;
                text-decoration-color: #3bc5ed;
                text-decoration-thickness: 5px;
                text-underline-position: under;
                color: #111a48;
            }

            .content-text{
                font-size: 18px;
                font-weight: bold;
                color: #333333;
                line-height: 1.5;
                margin-top: 30px;
            }

            .image-img{
                width: 50%;
                height: auto;
                margin-right: -10%;
            }
            .image-left{
                width: 50%;
                height: auto;
                margin-left: -5%;
            }

            .question-part{
                margin: 40px 10%;
                display: flex;
            }

            .question-part-board{
                font-weight: bold;
                font-size: 70px;
                color: #fcff1e;
            }

            .small-part{
                font-weight: bold;
                font-size: 24px;
                color: white;
            }

            .medium-part{
                font-weight: bold;
                font-size: 45px;
                color: #fcff1e;
            }

            .text-question{
                width: 50%;
            }

            .content-part{
                width: 100%;
                margin: 40px 10%;
                display: flex;
                height: calc(100% - 80px);
                z-index: 10;
            }

            .w-50{
                width: 50%;
            }

            .text-part-q{
                font-size: 24px;
                color: white;
                font-weight: bold;
                line-height: 1.3;
            }

            .big-text{
                font-size: 80px;
                color: #fcff1e;
            }

            .medium-text{
                font-size: 46px;
                color: #fcff1e;
            }

            .phone-area{
                text-align: center;
                line-height: 1.3;
            }

            .text-area{
                color: white;
                font-size: 24px;
                font-weight: bold;
            }

            .number-area{
                font-size: 54px;
                color: white;
                font-weight: bold;
                width: 100%;
            }

            .time-area{
                font-size: 20px;
                font-weight: bold;
                color: white;
            }

            .mail-area{
                margin-top: 15px;
                padding: 25px 15%;
                display: flex;
                text-align: center;
            }

            .mail-area:hover{
                background: #fcff1e;
                border-radius: 10px;
            }

            .mail-href{
                font-size: 22px;
                font-weight: bold;
                color: #222e6c;
                line-height: 1.1;
            }
            .type-part-title{
                font-weight: bold;
                color: #111a48;
                text-align: center;
                margin-bottom: 50px;
            }

            .type-title{
                font-size: 56px;
                font-style: italic;
            }
            .type-desc{
                margin: 20px;
                font-size: 20px;
                line-height: 1.2;
            }

            .empty_img{
                width: 22%;
            }

            .top-text{
                position: absolute; left: 10%; top: 15%; line-height: 1.1;
            }

            .help-diag{
                position: relative; height: calc(100% - 105px)
            }

        }
        /*.AboutusTeaser-more {*/
        /*    text-align: center;*/
        /*    text-transform: uppercase;*/
        /*    background-color: transparent;*/
        /*    -webkit-transition: color 0.25s ease-out, background 0.25s ease-out;*/
        /*    transition: color 0.25s ease-out, background 0.25s ease-out;*/
        /*    -webkit-touch-callout: none;*/
        /*    -webkit-user-select: none;*/
        /*    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);*/
        /*}*/

        /*.js-scrollShow {*/
        /*    opacity: 0;*/
        /*    -webkit-transform: translate3d(-60px, 140px, 0px) rotate(3deg);*/
        /*    transform: translate3d(-60px, 140px, 0px) rotate(3deg);*/
        /*    -webkit-transition: opacity 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s, -webkit-transform 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s;*/
        /*    transition: opacity 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s, -webkit-transform 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s;*/
        /*    transition: transform 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s, opacity 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s;*/
        /*    transition: transform 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s, opacity 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s, -webkit-transform 0.3s cubic-bezier(0.55, 0.055, 0.675, 0.19) 0s;*/
        /*}*/
        /*.js-scrollShow.is-show {*/
        /*    opacity: 1;*/
        /*    -webkit-transform: translate3d(0, 0, 0) rotate(0);*/
        /*    transform: translate3d(0, 0, 0) rotate(0);*/
        /*    -webkit-transition: opacity 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s, -webkit-transform 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s;*/
        /*    transition: opacity 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s, -webkit-transform 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s;*/
        /*    transition: transform 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s, opacity 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s;*/
        /*    transition: transform 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s, opacity 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s, -webkit-transform 1.4s cubic-bezier(0.22, 0.94, 0.44, 1) 0s;*/
        /*}*/

        .w3-animate-left-bottom{position:relative;animation:animateleft 1s}@keyframes animateleft{from{left:-300px;bottom:-300px;opacity:0} to{left:0;bottom:0;opacity:1}}
        .w3-animate-right{position:relative;animation:animateright 1s}@keyframes animateright{from{right:-300px;opacity:0} to{right:0;opacity:1}}
        .w3-animate-bottom{position:relative;animation:animatebottom 0.4s}@keyframes animatebottom{from{bottom:-300px;opacity:0} to{bottom:0;opacity:1}}

        /*.ani-part-1 {*/
        /*    !*width: 100%;*!*/
        /*    !*position: absolute;*!*/
        /*    !*top: 50%;*!*/
        /*    left: 50%;*/
        /*    transform: translateX(-50%) translateY(0%);*/
        /*}*/

        /*.ani-part-1 img {*/
        /*    !*font-size: 4.3em;*!*/
        /*    !*letter-spacing: -4px;*!*/
        /*    !*font-weight: 700;*!*/
        /*    !*color: #7e2ea0;*!*/
        /*    !*text-align: center;*!*/
        /*}*/

        /*.cssanimation, .cssanimation span {*/
        /*    animation-duration: 1s;*/
        /*    animation-fill-mode: both;*/
        /*}*/

        /*.cssanimation span { display: inline-block }*/

        /*.fadeInBottom { animation-name: fadeInBottom }*/
        /*@keyframes fadeInBottom {*/
        /*    from {*/
        /*        opacity: 0;*/
        /*        transform: translateY(100%);*/
        /*    }*/
        /*    to { opacity: 1 }*/
        /*}*/
        .ani-part-1 {
            opacity:0;
            margin-top: 200px;
        }
    </style>
@endsection

@section('content')
    <div id="container">
        <div class="top-background">
            <p class="top-text" style="">
                <label class="area-name">泉州·南大阪の</label><br>
                <label class="board">看板</label><span class="board-after">のことなら<br>
                    おまかせください!</span></p>
            <p class="d-40">岸和田<span class="half">で</span><br>
                40年</p>
            <p class="high-speed">早さ<span class="speed-half">に</span><br>
                自信<span class="speed-half">あり!</span></p>
            <p class="target-area">対応エリア<br>
                岸和田市／貝塚市／和泉市／泉大津市<br>
                堺市／高石市／忠岡町／泉佐野市／熊取町／泉南市／阪南市
            </p>
        </div>
        <div class="next-background">
            <div class="on-board">
                <p class="board-title">様々な種類の看板に対応可能！ <br>
                    お気軽にお問い合わせください！</p>
                <div class="board-content">
                    <div class="mail-question">
                        <img src="{{asset('/landing_img/mail_box.png')}}" class="mail-box"/>
                        <a href="\contact" class="mail-text">メールでのお問い合わせ<br>
                            <span class="mail-text-24">（24時間受付）</span></a>
                    </div>
                    <div class="phone-question">
                        <img src="{{asset('/landing_img/phone.png')}}" class="phone-img"/>
                        <p class="phone-text">お電話でのお問い合わせ</p>
                        <a href="tel:072-447-5612" class="phone-number">
                            072-447-5612 <br><span class="phone-time">10:00~17:00（平日）</span>
                        </a>
                    </div>
                    <img class="person-img" src="{{asset('/landing_img/person.png')}}">
                </div>
            </div>

            <div class="help-board">
                <p class="help-title">看板という心強いパートナー </p>
                <div class="help-diag" style="">
                    <img src="{{asset('/landing_img/text_1.png')}}" class="text-img-1 text-img"/>
                    <img src="{{asset('/landing_img/text_contain_1.png')}}" class="text-contain-1 text-contain"/>
                    <img src="{{asset('/landing_img/text_2.png')}}" class="text-img-2 text-img"/>
                    <img src="{{asset('/landing_img/text_contain_2.png')}}" class="text-contain-2 text-contain"/>
                    <img src="{{asset('/landing_img/text_3.png')}}" class="text-img-3 text-img"/>
                    <img src="{{asset('/landing_img/text_contain_3.png')}}" class="text-contain-3 text-contain"/>
                    <img src="{{asset('/landing_img/persons.png')}}" class="persons"/>
                </div>

            </div>
        </div>
        <div class="animation-part">
            <p class="ani-part-title">クライシスリレーションズの<br>５つのポイント</p>
            <p class="ani-part-description">看板製作において、<span style="background: #fcff1e">弊社が選ばれる大きな理由に「早い」と「丁寧な対応」</span>があります。<br>
                窓口の営業スタッフから、実際に現場で施工するスタッフ、事務スタッフの業務分担で、<br>
                <span style="background: #fcff1e">急ぎの案件でもスムーズにお客様のご要望にお応えできます！</span></p>
            <div class="ani-part-1">
                <div class="cssanimation sequence fadeInBottom">
                    <img src="{{asset('/landing_img/img_1.png')}}" class="num-img ">
                    <div class="text-part">
                        <p class="title-text">スピーディーな対応 </p>
                        <p class="content-text">スタッフの業務分担により、 <br>お問い合わせに即日対応いたします！ </p>
                    </div>
                    <img src="{{asset('/landing_img/ani_part_img_1.png')}}" class="image-img">
                </div>

            </div>
            <div class="ani-part-1">
                <img src="{{asset('/landing_img/ani_part_img_2.png')}}" class="image-left">
                <img src="{{asset('/landing_img/img_2.png')}}" class="num-img-left">
                <div class="text-part">
                    <p class="title-text">丁寧なヒアリング</p>
                    <p class="content-text content-text-sp">訓練された営業のスタッフが伺います。<br>
                        それぞれ作る看板の目的に合わせて、<br>
                        お客様のご希望の看板を作成いたします。
                    </p>
                </div>
            </div>
            <div class="ani-part-1">
                <img src="{{asset('/landing_img/img_3.png')}}" class="num-img">
                <div class="text-part">
                    <p class="title-text">豊富な実績</p>
                    <p class="content-text">岸和田で40年、多くの実績と信頼があります。<br>
                        大阪市内にも販路を拡大中。
                    </p>
                </div>
                <img src="{{asset('/landing_img/ani_part_img_3.png')}}" class="image-img">
            </div>
            <div class="ani-part-1">
                <img src="{{asset('/landing_img/ani_part_img_4.png')}}" class="image-left">
                <img src="{{asset('/landing_img/img_4.png')}}" class="num-img-left">
                <div class="text-part" style="width: 60%; margin-right: -10%">
                    <p class="title-text">デザイン制作もお任せください</p>
                    <p class="content-text content-text-sp">お客様のご要望に合わせ、<br>デザインの打ち合わせから<br>
                        施工までを請け負います。
                    </p>
                </div>

            </div>
            <div class="ani-part-1">
                <img src="{{asset('/landing_img/img_5.png')}}" class="num-img">
                <div class="text-part">
                    <p class="title-text">実地調査・打ち合わせ無料</p>
                    <p class="content-text">営業スタッフが常駐しており、<br>
                        営業スタッフによる簡易実地調査は無料です。<br>
                        お気軽にご相談ください。
                    </p>
                </div>
                <img src="{{asset('/landing_img/ani_part_img_5.png')}}" class="image-img">
            </div>
        </div>
        <div class="next-part-background">
            <div class="content-part">
                <div class="w-50">
                    <p class="text-part-q"><span class="big-text">看板</span><span>や</span><br>
                        <span class="medium-text">営業ツール</span><span style="line-height: 1.5">のことなら<br>
                            私たちにお任せください！!</span>
                    </p>
                </div>
                <div class="w-50">
                    <div class="phone-area">
                        <p class="text-area">\ お気軽にご相談ください /</p>
                        <a href="tel:072-447-5612" class="number-area">
                            <img src="{{asset('/landing_img/white_phone.png')}}" style="width: 10%"/> 072-447-5612
                        </a>
                        <p class="time-area">10:00~17:00（平日）</p>
                    </div>
                    <div class="mail-area">
                        <img src="{{asset('/landing_img/mail_box.png')}}" style="width: 12%; margin: auto 10px auto 0;"/>
                        <a href="\contact" class="mail-href">メールでのお問い合わせ<br>
                            <span style="font-size: 14px;">（24時間受付）</span></a>
                    </div>

                </div>
            </div>
        </div>
        <div style="margin: 40px 10%">
            <div class="type-part-title">
                <p class="type-title">看板の種類</p>
                <p class="type-desc">看板の製作以外にもチラシやシール、印刷に関することなら何でもできます。<br>
                    まずはお気軽にお問い合わせください。</p>
            </div>
            <div style="display: flex; width: 100%; margin-bottom: 30px">
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">壁面看板</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">袖看板・突き出し看板</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">スタンド看板</p>
                </div>
                <div style="width: 22%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 100%;">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight:bold">自立看板</p>
                </div>
            </div>
            <div style="display: flex; width: 100%;  margin-bottom: 30px">
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">テント看板</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">垂れ幕・横断幕</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">カッティングシート</p>
                </div>
                <div style="width: 22%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 100%;">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight:bold">ガラスシート</p>
                </div>
            </div>
            <div style="display: flex; width: 100%;  margin-bottom: 30px">
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">のぼり</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">テーブルクロス</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">選挙カー</p>
                </div>
                <div style="width: 22%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 100%;">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight:bold">シルクスクリーン印刷</p>
                </div>
            </div>
            <div style="display: flex; width: 100%;  margin-bottom: 30px">
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">自動車シート</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">マグネットシート</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">ステッカー</p>
                </div>
                <div style="width: 22%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 100%;">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight:bold">ポスター</p>
                </div>
            </div>
            <div style="display: flex; width: 100%;  margin-bottom: 30px">
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">ポケットティッシュ</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">ノベルティ</p>
                </div>
                <div style="width: 26%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 85%; margin-right: 15%">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight: bold; width: 85%">折込チラシ</p>
                </div>
                <div style="width: 22%">
                    <img src="{{asset('/landing_img/empty.png')}}" style="width: 100%;">
                    <p style="text-align: center; font-size: 22px; color: #333333; font-weight:bold">HP制作</p>
                </div>
            </div>

        </div>
        <div class="next-part-background">
            <div class="content-part">
                <div class="w-50">
                    <p class="text-part-q"><span class="big-text">看板</span><span>や</span><br>
                        <span class="medium-text">営業ツール</span><span style="line-height: 1.5">のことなら<br>
                            私たちにお任せください！!</span>
                    </p>
                </div>
                <div class="w-50">
                    <div class="phone-area">
                        <p class="text-area">\ お気軽にご相談ください /</p>
                        <a href="tel:072-447-5612" class="number-area">
                            <img src="{{asset('/landing_img/white_phone.png')}}" style="width: 10%"/> 072-447-5612
                        </a>
                        <p class="time-area">10:00~17:00（平日）</p>
                    </div>
                    <div class="mail-area">
                        <img src="{{asset('/landing_img/mail_box.png')}}" style="width: 12%; margin: auto 10px auto 0;"/>
                        <a href="\contact" class="mail-href">メールでのお問い合わせ<br>
                            <span style="font-size: 14px;">（24時間受付）</span></a>
                    </div>

                </div>
            </div>
        </div>
        <div style="margin: 40px 10%; text-align: center; display: none">
            <img src="{{asset('/landing_img/sign.png')}}" style="width: fit-content">
            <p style="font-weight: bold; font-size: 14px; color: #333333; ">
                岸和田本社<br>
                〒596-0825　大阪府岸和田市土生町２−７−１４<br>
                <br>
                大阪営業所<br>
                〒541-0051　大阪府大阪市中央区備後町３−４−１　山口玄ビル９F
            </p>
        </div>

    </div>
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

    <script>
        $(document).ready(function () {
            $(window).scroll( function(){

                /* Check the location of each desired element */
                $('.ani-part-1').each( function(i){

                    var bottom_of_object = $(this).offset().top + $(this).outerHeight();
                    var bottom_of_window = $(window).scrollTop() + $(window).height();

                    /* If the object is completely visible in the window, fade it it */
                    if( bottom_of_window > bottom_of_object ){
                        $(this).animate({'opacity':'1', 'margin-top':'50px'}, 500);
                    }
                });
            });
        });
    </script>

@endsection
