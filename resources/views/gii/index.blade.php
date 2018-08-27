@extends('layouts._gii')
@section('content')
    <style>

        h1,h2,h3{font-size: 14px;}

        /* å¸ƒå±€ */
        .site-inline{font-size: 0;}
        .site-tree, .site-content{display: inline-block;  *display:inline; *zoom:1; vertical-align: top; font-size: 14px;}
        .site-tree{width: 220px; min-height: 900px; padding: 5px 0 20px;}
        .site-content{width: 899px; min-height: 900px; padding: 20px 0 10px 20px;}

        /* å¤´éƒ¨ */
        .header{height: 59px; border-bottom: 1px solid #404553;  background-color: #393D49;}
        .logo{position: absolute; left: 0; top: 16px;}
        .logo img{width: 82px; height: 31px;}

        .header .layui-nav{position: absolute; right: 0; top: 0; padding: 0; background: none;}
        .header .layui-nav .layui-nav-item{margin: 0 20px; }
        .header .layui-nav .layui-nav-item[mobile]{display: none;}

        .header .layui-container .logo{left: 15px;}
        .header .layui-container .layui-nav{right: 15px;}

        .menu{position: absolute; right: 0; top: 0; line-height: 65px;}
        .menu a{display:inline-block; *display:inline; *zoom:1; vertical-align:top;}
        .menu a{position: relative; padding: 0 20px; margin: 0 20px; color: #c2c2c2; font-size: 14px;}
        .menu a:hover{color: #fff; transition: all .5s; -webkit-transition: all .5s}
        .menu a.this{color: #fff}
        .menu a.this::after{content: ''; position: absolute; left: 0; bottom: -1px; width: 100%; height: 5px; background-color: #5FB878;}

        .header-index{background-color: #05031A; border: none;}
        .header-index .site-banner-bg{}
        .header-index[spring]{background-color: #0D1206}
        .header-index[summer]{background-color: #0A0E11}
        .header-index[autumn]{background-color: #100903}
        .header-index[winter]{background-color: #0E0E0E}

        .header-demo{height: 60px; border-bottom: none;}
        .header-demo .logo{left: 40px;}
        .header-demo .layui-nav{top: 0;}
        .header-demo .layui-nav .layui-nav-item{margin: 0 10px;}

        .header-demo .layui-nav .layui-this a{padding: 0 30px;}

        .component{position: absolute; width: 200px; left: 120px; top: 16px; }
        .component .layui-input{height: 30px; padding-left: 12px; background-color: #424652; background-color: rgba(255,255,255,.05); border: none 0; color: #fff; font-size: 12px;}
        .component .layui-form-select .layui-edge{display: none; border-top-color: #999;}
        .component .layui-form-select dl{top: 36px; background-color: rgba(255,255,255,.9)}
        .header-demo .component{left: 185px;}

        /* å­ä¾§è¾¹ */
        .layui-side-child{width: 160px!important; left: 200px; bottom: 60px!important; border-right: 1px solid #eee; background-color: #fff;}
        .layui-side-child .layui-side-scroll{width: 170px;}
        .layui-side-child .layui-nav{padding: 10px 0; width: 160px; border-radius: 0; background: none}
        .layui-side-child .layui-nav-child{border-radius: 0;}
        .layui-side-child .layui-nav .layui-nav-title a,
        .layui-side-child .layui-nav .layui-nav-title a:hover,
        .layui-side-child .layui-nav-itemed>a{color: #666 !important;}
        .layui-side-child .layui-nav-itemed .layui-nav-child{margin-bottom: 10px; background: none !important;}
        .layui-side-child .layui-nav .layui-nav-item a{height: 30px; line-height: 30px; color: #666;}
        .layui-side-child .layui-nav .layui-nav-item a:hover{background: none !important;}
        .layui-side-child .layui-nav .layui-nav-child a{color: #999 !important;}
        .layui-side-child .layui-nav .layui-nav-more{display: none;}
        .layui-side-child .layui-nav-tree .layui-this,
        .layui-side-child .layui-nav-tree .layui-this>a,
        .layui-side-child .layui-nav-tree .layui-nav-child dd.layui-this,
        .layui-side-child .layui-nav-tree .layui-nav-child dd.layui-this a{background: none; color: #5FB878 !important;}
        .layui-side-child .layui-nav .layui-nav-child a:hover{color: #009688 !important}
        .layui-side-child .layui-nav-bar{background-color: #5FB878;}


        /* åº•éƒ¨ */
        .footer{padding: 30px 0; line-height: 30px; text-align: center; color: #666; font-weight: 300;}
        body .layui-layout-admin .footer-demo{height: 50px; padding: 5px 0;}
        .footer a{padding: 0 5px;}
        .site-union{margin-top: 10px; color: #999;}
        .site-union>*{display: inline-block; vertical-align: middle;}
        .site-union a[upyun] img{width: 80px;}
        .site-union span{position: relative; top: 3px;}
        .site-union span a{padding: 0; display: inline; color: #999;}
        .site-union span a:hover{text-decoration: underline;}

        .footer-demo p{display: inline-block; vertical-align: middle; height: 50px; padding-right: 10px;}
        .footer-demo .site-union{position: relative; top: -9px;}

        /* é¦–é¡µbanneréƒ¨åˆ† */
        .site-banner{position: relative; height: 600px; text-align: center; overflow: hidden; background-color: #393D49;}
        .site-banner-bg
        ,.site-banner-main{position: absolute; left: 0; top: 0; width: 100%; height: 100%;}
        .site-banner-bg{background-position: center 0;}


        .site-zfj{padding-top: 25px; height: 220px;}
        .site-zfj i{position: absolute; left: 50%; top: 25px; width: 200px; height: 200px; margin-left: -100px; font-size: 200px; color: #c2c2c2;}

        @-webkit-keyframes site-zfj {
            0% {opacity: 1;  -webkit-transform: translate3d(0, 0, 0) rotate(0deg) scale(1);}
            10% {opacity: 0.8; -webkit-transform: translate3d(-100px, 0px, 0) rotate(10deg) scale(0.7);}
            35% {opacity: 0.6; -webkit-transform: translate3d(100px, 0px, 0) rotate(30deg) scale(0.4);}
            50% {opacity: 0.4; -webkit-transform: translate3d(0, 0, 0) rotate(360deg) scale(0);}
            80% {opacity: 0.2; -webkit-transform: translate3d(0, 0, 0) rotate(720deg) scale(1);}
            90% {opacity: 0.1; -webkit-transform: translate3d(0, 0, 0) rotate(3600deg) scale(6);}
            100% {opacity: 1; -webkit-transform: translate3d(0, 0, 0) rotate(3600deg) scale(1);}
        }
        @keyframes site-zfj {
            0% {opacity: 1;  transform: translate3d(0, 0, 0) rotate(0deg) scale(1);}
            10% {opacity: 0.8; transform: translate3d(-100px, 0px, 0) rotate(10deg) scale(0.7);}
            35% {opacity: 0.6; transform: translate3d(100px, 0px, 0) rotate(30deg) scale(0.4);}
            50% {opacity: 0.4; transform: translate3d(0, 0, 0) rotate(360deg) scale(0);}
            80% {opacity: 0.2; transform: translate3d(0, 0, 0) rotate(720deg) scale(1);}
            90% {opacity: 0.1; transform: translate3d(0, 0, 0) rotate(3600deg) scale(6);}
            100% {opacity: 1; transform: translate3d(0, 0, 0) rotate(3600deg) scale(1);}
        }

        @-webkit-keyframes site-desc {
            0% { -webkit-transform: scale(1.1);}
            100% {opacity: 1; -webkit-transform: scale(1);}
        }
        @keyframes site-desc {
            0% { transform: scale(1.1);}
            100% {transform: scale(1);}
        }

        .site-zfj-anim i{-webkit-animation-name: site-zfj; animation-name: site-zfj; -webkit-animation-duration: 5s; animation-duration: 5s;  -webkit-animation-timing-function: linear; animation-timing-function: linear;}


        .site-desc{position: relative; height: 70px; margin-top: 25px;  background: url(../images/layui/desc.png) center no-repeat;}
        .site-desc-anim{-webkit-animation-name: site-desc; animation-name: site-desc;}

        .site-desc cite{position: absolute; bottom: -40px; left: 0; width: 100%; color: #c2c2c2; font-style: normal;}
        .site-download{margin-top: 80px; font-size: 0;}
        .site-download a{position: relative; padding: 0 45px 0 90px; height: 60px; line-height: 60px; border: 1px solid #c2c2c2;  border-color: rgba(255,255,255,.2); font-size: 24px; color: #ccc; transition: all .5s; -webkit-transition: all .5s;}
        .site-download a:hover{border-color: rgba(255,255,255,.3); color: #fff; background-color: rgba(255,255,255,.05); border-radius: 30px;}
        .site-download a cite{position: absolute; left: 45px; font-size: 30px;}
        .site-version{position: relative; margin-top: 15px; color: #ccc; font-size: 12px;}
        .site-version span{padding: 0 3px;}
        .site-version *{font-style: normal;}
        .site-version a{color: #e2e2e2; text-decoration: underline;}

        .site-banner-other{position: absolute; left: 0; bottom: 30px; width: 100%; text-align: center; font-size: 0;}
        .site-banner-other iframe{border: none;}
        .site-banner-other a{display: inline-block; vertical-align: middle; height: 28px; line-height: 28px; margin: 0 5px; padding: 0 8px; border-radius: 2px; color: #c2c2c2; color: rgba(255,255,255,.8); border: 1px solid #c2c2c2; border-color: rgba(255,255,255,.2); font-size: 14px; transition: all .5s; -webkit-transition: all .5s;}
        .site-banner-other a:hover{color: #fff; background-color: rgba(255,255,255,.1);}


        .site-idea{margin: 50px 0; font-size: 0; text-align: center; font-weight: 300;}
        .site-idea li{display: inline-block; vertical-align: top; *display: inline; *zoom:1; font-size: 14px; }
        .site-idea li{width: 230px; height: 150px; padding: 30px; line-height: 24px; margin-left: 30px; border: 1px solid #d2d2d2; text-align: left;}
        .site-idea li:first-child{margin-left: 0}
        .site-idea .layui-field-title{border-color: #d2d2d2}
        .site-idea .layui-field-title legend{margin: 0 20px 20px 0; padding: 0 20px; text-align: center;}

        /* èµžåŠ©å•† */
        .site-sponsor-home{margin-top: 40px; text-align: center;}
        .site-sponsor-home .layui-btn{position: relative; width: 233px; height: 65px; line-height: 65px; background: none; border-color: #212121; font-size: 26px; border-radius: 6px; /*padding-left: 55px;*/}
        .site-sponsor-home .layui-btn:hover{background: #4A4855; color: #BAB8C3;}
        .site-sponsor-home .layui-btn:before{/*position: absolute; left: 15px; top: 15px; content: ''; width: 30px; height: 30px; background: url(http://cdn.layui.com/upload/2018_1/168_1514869467160_26113.png) center; background-repeat: no-repeat; background-size: contain;*/}
        .site-sponsor-home p{position: relative; padding-top: 15px; font-size: 22px; color: #212121;}
        .site-sponsor-home p:before{content: ''; position: relative; top: -2px; display: inline-block; vertical-align: middle; width: 30px; height: 30px; margin-right: 10px; background: url(http://cdn.layui.com/upload/2018_1/168_1514869467160_26113.png) center; background-repeat: no-repeat; background-size: contain;}
        @media screen and (max-width: 750px) {
            .site-sponsor-home .layui-btn{width: 180px; height: 45px; line-height: 45px; font-size: 20px;}
            .site-sponsor-home p{font-size: 16px;}
            .site-sponsor-home p:before{width: 20px; height: 20px;}
        }



        /* è¾…åŠ© */
        .site-tips{margin-bottom: 10px; padding: 15px; line-height: 22px; border-left: 5px solid #0078AD; background-color: #f2f2f2;}
        body .site-tips p{margin: 0;}
        body .layui-layer-notice .layui-layer-content{padding: 20px; line-height: 26px; background-color: #393D49; color: #fff; font-weight: 300;}
        .layui-layer-notice .layui-text{color: #f8f8f8;}
        .layui-layer-notice .layui-text a{color: #009688;}

        /* ç›®å½• */
        .site-dir{display: none;}
        .site-dir li{line-height: 26px; margin-left: 20px; overflow: visible; list-style-type: disc;}
        .site-dir li a{display: block;}
        .site-dir li a:active{color: #01AAED;}
        .site-dir li a.layui-this{color: #01AAED;}
        body .layui-layer-dir{box-shadow: none; border: 1px solid #d2d2d2;}
        body .layui-layer-dir .layui-layer-content{padding: 10px;}
        .site-dir a em{padding-left: 5px; font-size: 12px; color: #c2c2c2; font-style: normal;}

        /* æ–‡æ¡£ */
        .site-tree{border-right: 1px solid #eee; }
        .site-tree .layui-tree{line-height: 32px;}
        .site-tree .layui-tree li i{position: relative; font-size: 22px; color: #000}
        .site-tree .layui-tree li a cite{padding: 0 8px;}
        .site-tree .layui-tree .site-tree-noicon a cite{padding-left: 15px;}
        .site-tree .layui-tree li a em{font-size: 12px; color: #bbb; padding-right: 5px; font-style: normal;}
        .site-tree .layui-tree li h2{line-height: 36px; border-left: 5px solid #009E94; margin: 15px 0 5px; padding: 0 10px; background-color: #f2f2f2;}
        .site-tree .layui-tree li ul{margin-left: 27px; line-height: 28px;}
        .site-tree .layui-tree li ul a,
        .site-tree .layui-tree li ul a i{color: #777;}
        .site-tree .layui-tree li ul a:hover{color: #333;}
        .site-tree .layui-tree li ul li{margin-left: 25px; overflow: visible; list-style-type: disc; /*list-style-position: inside;*/}
        .site-tree .layui-tree li ul li cite,
        .site-tree .layui-tree .site-tree-noicon ul li cite{padding-left: 0;}

        .site-tree .layui-tree .layui-this a{color: #01AAED;}
        .site-tree .layui-tree .layui-this .layui-icon{color: #01AAED;}

        .site-fix .site-tree{position: fixed; top: 0; bottom: 0; z-index: 666; min-height: 0; overflow: auto;  background-color: #fff;}
        .site-fix .site-content{margin-left: 220px;}
        .site-fix-footer .site-tree{/*margin-bottom: 120px;*/}


        .site-title{ margin: 30px 0 20px;}
        .site-title fieldset{border: none; padding: 0; border-top: 1px solid #eee;}
        .site-title fieldset legend{margin-left: 20px;  padding: 0 10px; font-size: 22px; font-weight: 300;}

        .site-text a{color: #01AAED;}
        .site-h1{margin-bottom: 20px; line-height: 60px; padding-bottom: 10px; color: #393D49; border-bottom: 1px solid #eee;  font-size: 28px; font-weight: 300;}
        .site-h1 .layui-icon{position: relative; top: 5px; font-size: 50px; margin-right: 10px;}
        .site-text{position:relative;}
        .site-text p{margin-bottom: 10px;  line-height:22px;}
        .site-text em{padding: 0 3px; font-weight: 500; font-style: italic; color: #666;}
        .site-text code{margin:0 5px; padding: 3px 10px; border: 1px solid #e2e2e2; background-color: #fbfbfb; color: #666; border-radius: 2px;}

        .site-table{width: 100%; margin: 10px 0;}
        .site-table thead{background-color:#f2f2f2; }
        .site-table th,
        .site-table td{padding: 6px 15px; min-height: 20px; line-height: 20px; border:1px solid #ddd; font-size: 14px; font-weight: 400;}
        .site-table tr:nth-child(even){background: #fbfbfb;}

        .site-block{padding: 20px; border: 1px solid #eee;}
        .site-block .layui-form{margin-right: 200px;}

        /* æ›´æ–°æ—¥å¿— */
        .site-changelog .layui-timeline-title h2{display: inline-block;}
        .site-changelog .layui-timeline-title .layui-badge-rim{top: -2px; left: 10px;}

        /* é¢œè‰² */
        .site-doc-color{font-size: 0;}
        .site-doc-color li{display: inline-block; vertical-align: middle; width: 180px; margin-left: 20px; margin-bottom: 20px; padding: 20px 10px; color: #fff; text-align: center; border-radius: 2px; line-height: 22px; font-size: 14px;}
        .site-doc-color li p[tips]{opacity: 0.8; font-size: 12px;}

        .site-doc-necolor li{width: 108px; margin-top: 15px; margin-left: 0; border-radius: 0;}

        .site-doc-bgcolor li{padding: 10px;}

        /* å®«æ ¼ */
        .site-doc-icon{margin-bottom: 50px; font-size: 0;}
        .site-doc-icon li{display: inline-block; vertical-align: middle; width: 127px; height: 105px; line-height: 25px; padding: 20px 0; margin-right: -1px; margin-bottom: -1px; border: 1px solid #e2e2e2; font-size: 14px; text-align: center; color: #666; transition: all .3s; -webkit-transition: all .3s;}
        .site-doc-anim li{height: auto;}
        .site-doc-icon li .layui-icon{display: inline-block; font-size: 36px;}

        .site-doc-icon li .doc-icon-name,
        .site-doc-icon li .doc-icon-code{color: #c2c2c2;}
        .site-doc-icon li .doc-icon-fontclass{height: 40px; line-height: 20px; padding: 0 5px; font-size: 13px; color: #333; }
        .site-doc-icon li:hover{background-color: #f2f2f2; color: #000;}

        /* æ …æ ¼ç¤ºä¾‹ */
        .grid-demo{padding: 10px; line-height: 50px; text-align: center; background-color: #79C48C; color: #fff;}
        .grid-demo-bg1{background-color: #63BA79;}
        .grid-demo-bg2{background-color: #49A761;}
        .grid-demo-bg3{background-color: #38814A;}


        /* æ¼”ç¤º */
        body .layui-layout-admin .site-demo{bottom: 60px; padding: 0;}
        body .site-demo-nav .layui-nav-item{line-height: 40px}
        .layui-nav-item .layui-icon{position: relative; font-size: 20px;}
        .layui-nav-item a cite{padding: 0 10px;}
        .site-demo .layui-main{margin: 15px; line-height: 22px;}
        .site-demo-editor{position: absolute; top: 0; bottom: 0; left: 0; width: 50%; }
        .site-demo-area{position: absolute; top: 0; bottom: 0; width: 100%;}
        .site-demo-editor textarea{position: absolute; width: 100%; height: 100%; padding: 10px; border: none; resize: none; background-color: #F7FBFF; background-color: #13151A; color: #999; font-family: Courier New; font-size: 12px; -webkit-box-sizing: border-box !important; -moz-box-sizing: border-box !important; box-sizing: border-box !important;}
        .site-demo-btn{position: absolute; bottom: 15px; right: 20px;}
        .site-demo-zanzhu{position: absolute; bottom: 0; left: 0; width: 100%; height: 90px; text-align: center; background-color: #e2e2e2; overflow: hidden;}
        .site-demo-zanzhu>*{position: relative; z-index: 1;}
        .site-demo-zanzhu:before{content: ""; position: absolute; z-index: 0; top: 50%; left: 50%; width: 120px; margin: -10px 0px 0px -60px; text-align: center; color: rgb(170, 170, 170); font-size: 18px; font-weight: 300; }

        .site-demo-result{position: absolute; right: 0; top: 0; bottom: 0; width: 50%;}
        .site-demo-result iframe{position: absolute; width: 100%; height: 100%;}

        .site-demo-button{margin-bottom: 30px;}
        .site-demo-button div{margin: 20px 30px 10px;}
        .site-demo-button .layui-btn+.layui-btn{margin-left: 0;}
        .site-demo-button .layui-btn{margin: 0 7px 10px 0; }

        .site-demo-text a{color: #01AAED;}

        .site-demo-laytpl{text-align: center;}
        .site-demo-laytpl textarea,
        .site-demo-laytpl div span{width: 40%;  padding: 15px; margin: 0 15px;}
        .site-demo-laytpl textarea{height: 300px; border: none; background-color: #3F3F3F; color: #E3CEAB; font-family: Courier New; resize: none;}
        .site-demo-laytpl div span{display: inline-block; text-align: center; background: #101010; color: #fff;}
        .site-demo-tplres{margin: 10px 0; text-align: center}
        .site-demo-tplres .site-demo-tplh2,
        .site-demo-tplres .site-demo-tplview{display: inline-block; width: 50%;}
        .site-demo-tplres h2{padding: 15px; background: #e2e2e2;}
        .site-demo-tplres h3{font-weight: 700;}
        .site-demo-tplres div{padding: 14px; border: 1px solid #e2e2e2; text-align: left;}

        .site-demo-upload,
        .site-demo-upload img{width: 200px; height: 200px; border-radius: 100%;}
        .site-demo-upload{position: relative; background: #e2e2e2;}
        .site-demo-upload .site-demo-upbar{position: absolute; top: 50%; left: 50%; margin: -18px 0 0 -56px;}
        .site-demo-upload .layui-upload-button{background-color: rgba(0,0,0,.2); color: rgba(255,255,255,1);}

        .site-demo-util{position: relative; width: 300px;}
        .site-demo-util img{width: 300px; border-radius: 100%;}
        .site-demo-util span{position: absolute; left: 0; top: 0; width: 100%; height: 100%; background: #333; cursor: pointer;}
        @-webkit-keyframes demo-fengjie {
            0% {-webkit-filter: blur(0); opacity: 1; background: #fff; height: 300px; border-radius: 100%;}
            80% {-webkit-filter: blur(50px);  opacity: 0.95;}
            100% {-webkit-filter: blur(20px); opacity: 0; background: #fff;}
        }
        @keyframes demo-fengjie {
            0% {filter: blur(0); opacity: 1; background: #fff; height: 300px; border-radius: 100%;}
            80% {filter: blur(50px);  opacity: 0.95;}
            100% {filter: blur(20px); opacity: 0; background: #fff;}
        }
        .site-demo-fengjie{-webkit-animation-name: demo-fengjie; animation-name: demo-fengjie; -webkit-animation-duration: 5s; animation-duration: 5s;}

        .layui-layout-admin .site-demo-body{top: 106px;}
        .site-demo-title{position: fixed; left: 200px; right: 0; top: 65px;}
        .site-demo-code{position: absolute; left: 0; top: 0; width: 100%; height: 100%; border: none; padding: 10px; resize: none; font-size: 12px; background-color: #F7FBFF; color: #881280; font-family: Courier New;}

        .site-demo-overflow{overflow: hidden;}

        /* å…¶å®ƒ */
        #trans-tooltip,
        #tip-arrow-bottom,
        #tip-arrow-top{display: none !important;}


        /* ç‹¬ç«‹ç»„ä»¶ ä¸Ž ä¸»é¡µ */
        .alone{text-align: center; background-color: #009688; color: #fff; font-weight: 300; transition: all .3s; -webkit-transition: all .3s;}
        .alone:hover{background-color: #5FB878;}
        .alone a{display: block; padding: 50px 20px; color: #fff; font-size: 30px;}
        .alone a cite{display: block; padding-top: 10px; font-size: 14px;}


        .alone-banner{height: 190px; text-align: center; font-weight: 300; background-color: #009688; color:#fff;}
        .alone-banner h1{padding-top: 60px; line-height: 32px; font-size: 30px; font-weight: 300;}
        .alone-banner p{padding-top: 20px; color: #e2e2e2; color: rgba(255,255,255,.8);}

        .alone-nav .layui-tab-title li{margin-right: 30px; padding: 0; color: #666;}
        .alone-nav .layui-tab-title li a{  padding: 0 20px;}

        .alone-download{margin: 30px 0;}
        .alone-download .layui-btn{margin-right: 10px;}
        .alone-download span{display: inline-block; line-height: 44px; padding-right: 20px;}
        .alone-download span em{color: #999;}

        .alone-title{margin-top: 20px;}

        .alone-download-btn{text-align: center; margin-top: 50px; font-size: 0;}
        .alone-download-btn .layui-btn{position: relative; width: 206px; height: 60px; line-height: 60px; font-size: 26px; font-weight: 300;}
        .alone-download-btn .layui-btn+.layui-btn{margin: 0;}
        .alone-download-btn .alone-download-right{margin-left: 20px !important; border-color: #009688; background: none; color: #009688;}
        .alone-download-btn .layui-btn img{position: relative; top: -3px; width: 118px;}



        /* é€‚é…å¤šè®¾å¤‡ */
        @media screen and (max-width: 750px) {
            .layui-main{width: auto; margin: 0 10px;}
            .logo,
            .header-demo .logo{left: 10px;}
            .component{display: none}

            .header .layui-nav-child{left: auto; right: 0;}
            .site-demo-overflow{overflow: auto;}

            .site-nav-layim{display: none !important;}
            .header .layui-nav .layui-nav-item{margin: 0;}
            .header .layui-nav .layui-nav-item a{padding: 0 20px;}
            .header .layui-nav .layui-nav-item[pc]{display: none;}
            .header .layui-nav .layui-nav-item[mobile]{display: inline-block;}
            .site-banner{height: 300px;}
            .site-banner-bg{background-size: cover;}
            .site-zfj{height: 100px; padding-top: 5px;}
            .site-zfj i{top: 10px; width: 100px; height: 100px; margin-left: -50px; font-size: 100px;}
            .site-desc{background-size: 70%; margin: 0;}
            .site-desc cite{display: none;}
            .site-download{margin-top: 0; }
            .site-download a{height: 40px; line-height: 40px; padding: 0 25px 0 60px; border-radius: 30px; color: #fff; font-size: 16px;}
            .site-download a cite{left: 20px;}
            .site-banner-other{bottom: 10px;}

            .site-idea{margin: 20px 0;}
            .site-idea li{margin: 0 0 20px 0; width: 100%; height: auto; -webkit-box-sizing: border-box !important; -moz-box-sizing: border-box !important; box-sizing: border-box !important;}
            .site-hengfu img{max-width: 100%}

            .site-block .layui-form{margin-right: 0;}

            .layui-layer-dir{display: none;}
            .site-tree{position: fixed; top: 0; bottom: 0; min-height: 0; overflow: auto; z-index: 1000; left: -260px; background-color: #fff;  transition: all .3s; -webkit-transition: all .3s;}
            .site-content{width: 100%; padding: 0; overflow: auto;}
            .site-content img{max-width: 100%;}
            .site-tree-mobile{display: block!important; position: fixed; z-index: 100000; bottom: 15px; left: 15px; width: 50px; height: 50px; line-height: 50px; border-radius: 2px; text-align: center; background-color: rgba(0,0,0,.7); color: #fff;}
            .site-home .site-tree-mobile{display: none!important;}
            .site-mobile .site-tree-mobile{display: none !important;}
            .site-mobile .site-tree{left: 0;}
            .site-mobile .site-mobile-shade{content: ''; position: fixed; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0,0,0,.8); z-index: 999;}
            .site-tree-mobile i{font-size: 20px;}
            .layui-code-view{-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

            .layui-layout-admin .layui-side{position: fixed; top: 0; left: -260px; transition: all .3s; -webkit-transition: all .3s; z-index: 10000;}
            .layui-body{position: static; bottom: 0; left: 0;}
            .site-mobile .layui-side{left: 0;}
            .site-mobile .layui-side-child{top: 50%; left: 200px; height: 300px; margin-top: -100px;}

            body .layui-layout-admin .footer-demo{position: static; height: auto; line-height: 30px;}
            .footer-demo p{height: auto;}

            .site-demo-area,
            .site-demo-editor,
            .site-demo-result,
            .site-demo-editor textarea,
            .site-demo-result iframe{position: static; width: 100%;}
            .site-demo-editor textarea{height: 350px;}
            .site-demo-zanzhu{display: none;}
            .site-demo-btn{bottom: auto; top: 370px;}
            .site-demo-result iframe{height: 500px;}

            .site-demo-laytpl textarea, .site-demo-laytpl div span{margin: 0;}
            .site-demo-tplres .site-demo-tplh2, .site-demo-tplres .site-demo-tplview{width: 100%; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}

            .site-demo-title{position: static; left: 0;}
            body .layui-layout-admin .site-demo{}
            .site-demo-code{position: static; height: 350px;}
        }



        @-webkit-keyframes site-anim-closeup{ /* ç‰¹å†™ */
            from {-webkit-transform: translate3d(0, 0, 0) scale(1);  opacity: 1;}
            to { -webkit-transform: translate3d(0, 400px, 0) scale(2);  opacity: 0.5;}
        }
        @keyframes site-anim-closeup{
            from {transform: translate3d(0, 0, 0) scale(1); opacity: 1;}
            to {transform: translate3d(0, 400px, 0) scale(2); opacity: 0.5;}
        }
        .site-out-up{-webkit-animation-duration: 3s; animation-duration: 3s; -webkit-animation-fill-mode: both; animation-fill-mode: both; -webkit-animation-name: site-anim-closeup; animation-name: site-anim-closeup; overflow: hidden;}



    </style>
    <div class="layui-main">
        <ul class="site-idea">
            <li class="layui-bg-green" style="cursor:pointer;" onclick="document.location.href='/gii/model'">
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>Model Generator</legend>
                    <center>
                        <p>创建一个数据库表对应的 Eloquent 「模型」</p>
                        <hr class="layui-bg-orange">
                        <button class="layui-btn"  >「点我开始创建」</button>
                    </center>
                </fieldset>
            </li>
            <li class="layui-bg-cyan" style="cursor:pointer;" onclick="document.location.href='/gii/service'">
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>Service Generator</legend>
                    <center>
                        <p>创建一个Service类，用于辅助 controller，处理商业逻辑</p>
                        <hr class="layui-bg-orange">
                        <button class="layui-btn" style="background: #2F4056" >「点我开始创建」</button>
                    </center>
                </fieldset>
            </li>
            <li class="layui-bg-black" style="cursor:pointer;" onclick="document.location.href='/gii/controller'">
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>Controller Generator</legend>
                    <center>
                        <p>在App\Http\Controllers 目录下创建一个 Controller </p>
                        <hr class="layui-bg-orange">
                        <button class="layui-btn" style="background: #393D49"  >「点我开始创建」</button>
                    </center>
                </fieldset>
            </li>
        </ul>

    </div>
    <input type="hidden" id="nav_flag" value="home" />
    <script>
        layui.use(['form','layer','laydate','table','laytpl'],function(){
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : top.layer,
                $ = layui.jquery,
                laydate = layui.laydate,
                laytpl = layui.laytpl,
                table = layui.table;

        });
    </script>
@stop