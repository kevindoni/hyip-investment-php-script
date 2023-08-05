<?php
header("Content-Type:text/css");
function hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if(empty($color))
        return $default;
    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);
    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }
    //Return rgb(a) color string
    return $output;
}

if (isset($_GET['primaryColor']) AND $_GET['primaryColor'] != '') {
    $themeColor = hex2rgba("#" . $_GET['primaryColor']);
    $overlay1 = hex2rgba("#" . $_GET['primaryColor'],0.8);
}else{
    $themeColor = hex2rgba('#fd334c');
    $overlay1 = hex2rgba('#fd334c',0.8);
}
?>


@charset "UTF-8";
/*
BASE STYLES
--------------------------------------------------------------------*/
:root {
--themecolor: <?php echo  $themeColor;?>;
--themebordercolor: <?php echo  $themeColor;?>;
--themecardbg: <?php echo  $themeColor;?>;
--themesidetagbg: #1aa15f;
--themewrapperbg: <?php echo  $themeColor;?>;
--themebg: <?php echo  $themeColor;?>;
--themebgrgba: rgba(253, 51, 76,1);
--heading: #e2e3e5;
--subheading: #204dcc;
--slogan: #232323;
--textcolor: #ffffff;
--textcoloralt: #0f143a;
--pcolor-w: #ffffff;
--btncolor: #ffffff;
--linkcolor: <?php echo  $themeColor;?>;
--bordercolor: #ffffff;
--bordercolor-1: #202b5d;
--fontopensans: 'Open Sans', sans-serif;
--fontlato: 'Lato', sans-serif;
--fontubunto: 'Ubuntu', sans-serif;
--background-w: #ffffff;
--background-l: #131e51;
--background-b: #202b5d;
--background-1: #0f143a;
--background-2: #202b5d;
--background-3: #070b28;
--background-4: #131e51;
--background-5: #303a68;
--overlay-1: <?php echo  $overlay1;?>;
--overlay-2: rgba(30, 35, 39, 0.9);
--overlay-3: rgba(7, 11, 40, 0.65);
--svgshapebg-1: #202b5d;
--svgshapebg-2: #131e51;
--svgshapebg-3: <?php echo  $themeColor;?>;
--shadow: 0px 1px 15.616px 0.384px rgba(233, 233, 233, 0.7);
--shadowblack: 0px 1px 15.616px 0.384px rgba(0, 0, 0, 0.15);
--blogshadow: 0 1px 15px 3px rgba(0, 0, 0, 0.15);
--gradient: linear-gradient(90deg, var(--themecolor) 0%, var(--themecolor) 100%);
--footerbg: #202b5d;
--copyrightbg: #0f143a;
--transition: all 0.35s ease-in-out;
}
*,
*:before,
*:after {
margin: 0;
padding: 0;
-webkit-box-sizing: inherit;
-moz-box-sizing: inherit;
box-sizing: inherit;
}
html {
position: relative;
float: left;
width: 100%;
height: 100%;
color: var(--textcolor);
font-size: 16px;
line-height: 24px;
background-color: var(--background-w);
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
overflow-x: hidden;
}
body {
position: relative;
float: left;
width: 100%;
height: auto;
clear: both;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
line-height: 24px;
background-color: var(--background-w);
-webkit-text-size-adjust: 100%;
-webkit-overflow-scrolling: touch;
-webkit-font-smoothing: antialiased !important;
overflow-x: hidden;
}
body.body {
height: 100%;
}
hr {
display: block;
height: 0;
margin: 70px 0;
padding: 0;
border: 0;
border-top: 1px solid #a1a1a1;
}
.hr {
display: block;
width: 100%;
height: 0;
margin: 30px 0;
padding: 0;
border: 0;
border-top: 1px solid var(--bordercolor);
}
audio,
canvas,
img,
video {
display: initial;
margin: 0;
padding: 0;
border: 0;
vertical-align: middle;
}
p {
margin: 0;
padding: 0;
color: var(--pcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
line-height: 24px;
letter-spacing: normal;
}
a,
a:active,
a:hover,
a:focus {
font-family: var(--fontlato);
text-decoration: none !important;
outline: none;
}
h1,
h2,
h3,
h4,
h5,
h6 {
margin: 0 !important;
padding: 0 !important;
color: var(--textcolor);
font-family: var(--fontlato) !important;
line-height: normal;
letter-spacing: normal;
transition: var(--transition);
}
h1 {
font-size: 52px;
font-weight: 700;
}
h2 {
font-size: 40px;
font-weight: 400;
}
h3 {
font-size: 34px;
font-weight: 400;
}
h4 {
font-size: 28px;
font-weight: 400;
}
h5 {
font-size: 22px;
font-weight: 400;
}
h6 {
font-size: 16px;
font-weight: 400;
}
button,
button:hover,
button:focus {
border: 0;
background: none;
outline: none;
box-shadow: none;
cursor: pointer;
}
figure {
display: block;
margin: 0;
padding: 0;
border: 0;
}
figcaption{
color: var(--textcolor);
font-size: 18px;
font-weight: 700;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
}
label{
margin: 0;
padding: 0;
color: var(--textcolor);
font-size: 16px;
font-weight: 600;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
}
.label {
margin-bottom: 5px;
color: var(--color);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
line-height: 1.5;
letter-spacing: 0;
}
small,
.small {
font-size: 60%;
font-weight: 600;
}
ul {
margin: 0 !important;
padding: 0 !important;
list-style: none;
}
ol {
margin: 0 !important;
padding: 0 !important;
}
nav,
header,
section,
footer {
position: relative;
float: left;
width: 100%;
clear: both;
}
input,
select,
textarea {
color: var(--textcolor);
outline: 0;
}
input::-webkit-input-placeholder,
textarea::-webkit-input-placeholder {
color: var(--textcolor) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
input:-moz-placeholder,
textarea:-moz-placeholder {
color: var(--textcolor) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
input::-moz-placeholder,
textarea::-moz-placeholder {
color: var(--textcolor) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
input:-ms-input-placeholder,
textarea:-ms-input-placeholder {
color: var(--textcolor) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}

section#add-recipient-form {
padding: 220px 0 180px;
background: #131e51;
}
/*---- CUSTOM SELECT ----*/
.select-redesign {
position: relative;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: 0;
}
.select-redesign select {
display: none;
}
.select-selected {
height: 48px;
padding: 0 25px 0 15px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
letter-spacing: 1px;
border: 1px solid #ffffff;
border-radius: 4px;
background-color: transparent;
cursor: pointer;
user-select: none;
display: inline-flex;
width: calc(100% - 0px);
vertical-align: middle;
align-items: center;
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected:hover {
border-color: var(--themecolor);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected:after {
position: absolute;
content: "\eab2";
top: 17px;
right: calc(0% + 25px);
width: 0;
height: 0;
color: var(--textcolor);
font-size: 15px;
font-family: 'IcoFont';
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected.select-arrow-active{
border-color: var(--themecolor);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected.select-arrow-active:after {
color: var(--themecolor);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected:hover.select-selected:after {
color: var(--themecolor);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-selected:hover.select-arrow-active:after {
color: var(--themecolor);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-items {
position: absolute;
top: calc(100% + 4px);
left: 0;
right: 0;
z-index: 100;
border-radius: 4px;
background-color: #f5f5f5;
}
.select-items div {
width: auto;
height: 45px;
margin-top: -1px;
padding: 0 12px;
color: #0f143a;
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 45px;
border: 1px solid #dfdfdf;
cursor: pointer;
user-select: none;
background-color: #ffffff;
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.select-items div:first-child {
border-top-right-radius: 4px;
border-top-left-radius: 4px;
}
.select-items div:last-child {
border-bottom-right-radius: 4px;
border-bottom-left-radius: 4px;
}
.select-hide {
display: none;
}
.select-items div:hover, .same-as-selected {
color: #fff;
background-color: rgba(253, 51, 76, 0.8);
-webkit-transition: 0.35s ease;
-moz-transition: 0.35s ease;
-ms-transition: 0.35s ease;
-o-transition: 0.35s ease;
transition: 0.35s ease;
}
.tick-active {
color: var(--textcolor) !important;
}
.p {
color: var(--pcolor-w);
font-size: 15px;
font-weight: 400;
letter-spacing: normal;
line-height: 24px;
}
.text {
color: var(--pcolor-w);
font-size: 16px;
font-weight: 400;
line-height: 28px;
}
.h1,
.h2,
.h3,
.h4,
.h5,
.h6 {
position: relative;
color: var(--textcolor);
font-family: var(--fontubunto) !important;
letter-spacing: normal;
line-height: 1.8;
transition: var(--transition);
}
.h1 {
font-size: 60px;
font-weight: 700;
}
.h2 {
font-size: 48px;
font-weight: 400;
}
.h3 {
font-size: 36px;
font-weight: 400;
}
.h4 {
font-size: 30px;
font-weight: 400;
}
.h5 {
font-size: 24px;
font-weight: 400;
}
.h6 {
font-size: 18px;
font-weight: 400;
}
.heading-container {
position: relative;
text-align: center;
}
.topheading {
color: var(--themecolor);
font-size: 18px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
}
.heading {
position: relative;
margin-top: 30px !important;
display: block;
color: var(--textcolor);
font-size: 36px;
font-weight: 400;
font-family: var(--fontubunto) !important;
line-height: 1 !important;
letter-spacing: normal;
text-transform: initial;
}
.sub-heading {
position: relative;
display: inline-block;
margin: 15px 0 25px;
}
.slogan {
position: relative;
margin-top: 30px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: 2 !important;
}
.select-redesign select:required:invalid {
color: var(--textcoloralt) !important;
}
.select-resesign select option[value=""][disabled] {
display: none !important;
}
.media-body h6{
font-size:14px;
}
.media-body h6.font-weight-bold{
font-weight: 500!important;
}

.form-control {
max-height: 50px;
padding: 15px 15px;
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 50px;
border: 1px solid #a1a1a1;
border-radius: 4px;
background-color: #ffffff;
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.form-control:hover,
.form-control:focus {
box-shadow: none;
border: 1px solid var(--themecolor);
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.textarea-control {
display: block;
width: 100%;
max-height: 100px;
padding: 15px 15px;
color: var(--textcolor);
font-size: 16px;
font-family: var(--fontlato);
border: 1px solid #a1a1a1;
border-radius: 4px;
background-color: #ffffff;
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.textarea-control:hover,
.textarea-control:focus {
box-shadow: none;
border: 1px solid var(--themecolor);
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.btn-base {
display: inline-block;
padding: 15px 20px;
color: var(--textcolor);
font-size: 14px;
font-weight: 700;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
text-align: center;
text-transform: capitalize;
white-space: nowrap;
vertical-align: middle;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
border: 1px solid var(--themecolor);
border-radius: 25px;
outline: 0;
background-color: rgba(255, 255, 255, 0);
box-shadow: none;
transition: color 0.35s ease-in-out, background-color 0.35s ease-in-out, border-color 0.35s ease-in-out, box-shadow 0.35s ease-in-out;
}
.btn-base:hover,
.btn-base:focus {
border: 1px solid var(--themecolor);
background-color: var(--themebg);
transition: var(--transition)
}
.btn:not(:disabled):not(.disabled).active,
.btn:not(:disabled):not(.disabled):active {
background: linear-gradient(109deg, #ffffff 0%, #ffffff 100%);
}
.checkbox,
.checkbox {
position: relative;
display: flex;
align-items: center;
}
.checkbox > label,
.checkbox > label {
margin-bottom: 0;
color: var(--textcolor);
font-size: 14px;
font-weight: 300;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
cursor: pointer;
}
.custom-control {
min-height: 1.5rem;
padding-left: 2.1rem;
}
.custom-control-label::before {
position: absolute;
top: 0;
left: 0;
display: block;
width: 1.5rem;
height: 1.5rem;
pointer-events: none;
content: '';
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
border-radius: 4px !important;
border: 1px solid var(--bordercolor);
background-color: transparent;
transition: var(--transition);
}
.custom-control-label::after {
position: absolute;
top: 0;
left: 0;
display: block;
width: 1.5rem;
height: 1.5rem;
content: "";
background-repeat: no-repeat;
background-position: center center;
background-size: 50% 50%;
border: 1px solid transparent;
border-radius: 4px;
transition: var(--transition);
}
.custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
box-shadow: none;
border-color: var(--bordercolor);
}
.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
background-color: transparent;
}
.custom-checkbox .custom-control-input:checked~.custom-control-label::after {
border-color: var(--themecolor);
background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
transition: var(--transition);
}
.top-0 {
top: 0 !important;
}
.m-0 {
margin: 0 !important;
}
.mt-0 {
margin-top: 0 !important;
}
.mt-5 {
margin-top: 5px !important;
}
.mt-10 {
margin-top: 10px !important;
}
.mt-15 {
margin-top: 15px !important;
}
.mt-20 {
margin-top: 20px !important;
}
.mt-25 {
margin-top: 25px !important;
}
.mt-30 {
margin-top: 30px !important;
}
.mt-35 {
margin-top: 35px !important;
}
.mt-40 {
margin-top: 40px !important;
}
.mt-45 {
margin-top: 45px !important;
}
.mt-50 {
margin-top: 50px !important;
}
.mr-0 {
margin-right: 0 !important;
}
.mr-5 {
margin-right: 5px !important;
}
.mr-10 {
margin-right: 10px !important;
}
.mr-15 {
margin-right: 15px !important;
}
.mr-20 {
margin-right: 20px !important;
}
.mr-25 {
margin-right: 25px !important;
}
.mr-30 {
margin-right: 30px !important;
}
.mr-35 {
margin-right: 35px !important;
}
.mr-40 {
margin-right: 40px !important;
}
.mr-45 {
margin-right: 45px !important;
}
.mr-50 {
margin-right: 50px !important;
}
.mb-0 {
margin-bottom: 0 !important;
}
.mb-5 {
margin-bottom: 5px !important;
}
.mb-10 {
margin-bottom: 10px !important;
}
.mb-15 {
margin-bottom: 15px !important;
}
.mb-20 {
margin-bottom: 20px !important;
}
.mb-25 {
margin-bottom: 25px !important;
}
.mb-30 {
margin-bottom: 30px !important;
}
.mb-35 {
margin-bottom: 35px !important;
}
.mb-40 {
margin-bottom: 40px !important;
}
.mb-45 {
margin-bottom: 45px !important;
}
.mb-50 {
margin-bottom: 50px !important;
}
.ml-0 {
margin-left: 0 !important;
}
.ml-5 {
margin-left: 5px !important;
}
.ml-10 {
margin-left: 10px !important;
}
.ml-15 {
margin-left: 15px !important;
}
.ml-20 {
margin-left: 20px !important;
}
.ml-25 {
margin-left: 25px !important;
}
.ml-30 {
margin-left: 30px !important;
}
.ml-35 {
margin-left: 35px !important;
}
.ml-40 {
margin-left: 40px !important;
}
.ml-45 {
margin-left: 45px !important;
}
.ml-50 {
margin-left: 50px !important;
}
.p-0 {
padding: 0 !important;
}
.pt-0 {
padding-top: 0 !important;
}
.pt-5 {
padding-top: 5px !important;
}
.pt-10 {
padding-top: 10px !important;
}
.pt-15 {
padding-top: 15px !important;
}
.pt-20 {
padding-top: 20px !important;
}
.pt-25 {
padding-top: 25px !important;
}
.pt-30 {
padding-top: 30px !important;
}
.pt-35 {
padding-top: 35px !important;
}
.pt-40 {
padding-top: 40px !important;
}
.pt-45 {
padding-top: 45px !important;
}
.pt-50 {
padding-top: 50px !important;
}
.pr-0 {
padding-right: 0 !important;
}
.pr-5 {
padding-right: 5px !important;
}
.pr-10 {
padding-right: 10px !important;
}
.pr-15 {
padding-right: 15px !important;
}
.pr-20 {
padding-right: 20px !important;
}
.pr-25 {
padding-right: 25px !important;
}
.pr-30 {
padding-right: 30px !important;
}
.pr-35 {
padding-right: 35px !important;
}
.pr-40 {
padding-right: 40px !important;
}
.pr-45 {
padding-right: 45px !important;
}
.pr-50 {
padding-right: 50px !important;
}
.pl-0 {
padding-left: 0 !important;
}
.pl-5 {
padding-left: 5px !important;
}
.pl-10 {
padding-left: 10px !important;
}
.pl-15 {
padding-left: 15px !important;
}
.pl-20 {
padding-left: 20px !important;
}
.pl-25 {
padding-left: 25px !important;
}
.pl-30 {
padding-left: 30px !important;
}
.pl-35 {
padding-left: 35px !important;
}
.pl-40 {
padding-left: 40px !important;
}
.pl-45 {
padding-left: 45px !important;
}
.pl-50 {
padding-left: 50px !important;
}
.pb-0 {
padding-bottom: 0 !important;
}
.pb-5 {
padding-bottom: 5px !important;
}
.pb-10 {
padding-bottom: 10px !important;
}
.pb-15 {
padding-bottom: 15px !important;
}
.pb-20 {
padding-bottom: 20px !important;
}
.pb-25 {
padding-bottom: 25px !important;
}
.pb-30 {
padding-bottom: 30px !important;
}
.pb-35 {
padding-bottom: 35px !important;
}
.pb-40 {
padding-bottom: 40px !important;
}
.pb-45 {
padding-bottom: 45px !important;
}
.pb-50 {
padding-bottom: 45px !important;
}
.no-gutters {
padding-right: 0;
padding-left: 0;
}
.border {
border: 1px solid var(--bordercolor) !important;
}
.br-4 {
border-radius: 4px !important;
}
.img-br-6 {
border-radius: 6px !important;
}
.f-initial {
float: initial !important;
}
.w-fill {
width: 100% !important;
}
.h-fill {
height: 92% !important;
}
.img-fill {
width: 100% !important;
}
.img-circle {
border-radius: 50% !important;
}
.themecolor {
color: var(--themecolor) !important;
}
.fontlato {
font-family: var(--fontlato) !important;
}
.fontubonto {
font-family: var(--fontubunto) !important;
}
.font-weight-medium {
font-weight: 500 !important;
}
.font-weight-semimedium {
font-weight: 600 !important;
}
.bg-w {
background-color: var(--background-w) !important;
}

.secbg {
background-color: var(--background-b) !important;
}
.secbg-1 {
background-color: var(--background-1) !important;
}
.secbg-2 {
background-color: var(--background-2) !important;
}
.secbg-3 {
background-color: var(--background-3) !important;
}
.secbg-4 {
background-color: var(--background-4) !important;
}
.secbg-5 {
background-color: var(--background-5) !important;
}

.colorbg-1 {
background-color: <?php echo  $themeColor;?> !important;
}
.colorbg-2 {
background-color: #1ba8c6 !important;
}
.colorbg-3 {
background-color: #ad1db6 !important;
}
.colorbg-4 {
background-color: #e2810e !important;
}
.themebg {
background-color: var(--themebg) !important;
}
.shadow {
-webkit-box-shadow: var(--shadow) !important;
-moz-box-shadow: var(--shadow) !important;
box-shadow: var(--shadow) !important;
}
.bx-shadow {
box-shadow: var(--shadowblack) !important;
}
.blog-shadow {
box-shadow: var(--blogshadow) !important;
}
.shadow-none {
box-shadow: none !important;
}
.wrapper {
position: relative;
padding: 0;
z-index: 0;
}
.text-wrapper {
position: relative;
float: left;
width: 100%;
clear: both;
padding-left: 65px;
}
html[dir=rtl] .text-wrapper {
padding-right: 65px;
padding-left: initial;
}
/*--------------------------------------------------------------------
CARD DESIGN
----------------------------------------------------------------------*/
.card-img-top {
border-top-right-radius: 4px;
border-top-left-radius: 4px;
}
.card-img-br-0 {
border-radius: 0 !important;
}
.card-type-1.card {
align-items: center;
height: 100%;
padding: 50px 15px;
border: 0;
border-radius: 4px;
background-color: var(--background-2);
box-shadow: none;
}
.card-type-1 .card-icon {
position: relative;
padding: 15px;
display: inline-flex;
align-items: center;
justify-content: center;
text-align: center;
border: 1px solid var(--themebordercolor);
border-radius: 50%;
}
.card-type-1 .card-icon > img {
width: auto;
max-width: 100%;
}
.card-type-1 > .card-body {
padding: 0 0;
text-align: center;
}
.card-type-1 > .card-body > .card-title {
margin: 30px 0 !important;
color: var(--textcolor);
font-size: 36px;
font-weight: 500;
font-family: var(--fontubunto) !important;
letter-spacing: normal;
line-height: normal;
}
.card-type-1 > .card-body > .card-text {
color: var(--textcolor);
font-size: 24px;
font-weight: 400;
line-height: 28px;
}
/*--------------------------------------------------------------------
MODAL DESIGN
----------------------------------------------------------------------*/
/*---- MODAL-LOGIN ----*/
#investment-modal,
#modal-login {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
float: left;
width: 100%;
height: 100vh;
opacity: 0;
background-color: rgba(0,0,0,0.45);
-webkit-transform: scale(0, 0);
-moz-transform: scale(0, 0);
-ms-transform: scale(0, 0);
-o-transform: scale(0, 0);
transform: scale(0, 0);
-webkit-transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-moz-transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-ms-transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-o-transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
transition: transform 0.75s ease-in-out, opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
overflow: hidden;
z-index: 999999;
}

#investment-modal.modal-open,
#modal-login.modal-open {
display: block;
width: 100%;
height: 100vh;
transform: scale(1, 1);
-moz-transform: scale(1, 1);
-ms-transform: scale(1, 1);
-o-transform: scale(1, 1);
transform: scale(1, 1);
opacity: 1;
-webkit-transition: opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-moz-transition: opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-ms-transition: opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
-o-transition: opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
transition: opacity 0.75s ease-in-out, width 0.75s ease-in-out, height 0.75s ease-in-out;
overflow-x: hidden;
overflow-y: auto;
}
.modal-wrapper {
width: 100%;
height: 100%;
padding: 60px 15px;
display: flex;
flex-direction: column;
flex-wrap: wrap;
align-items: center;
justify-content: center;
}
.modal-login-body {
position: relative;
margin: 0 auto;
padding: 0 0;
width: 100%;
height: auto;
max-width: 635px;
border: 0;
border-radius: 0;
background-color: var(--background-l);
-webkit-transition: all 0.5s ease-in-out;
-moz-transition: all 0.5s ease-in-out;
-ms-transition: all 0.5s ease-in-out;
-o-transition: all 0.5s ease-in-out;
transition: all 0.5s ease-in-out;
box-shadow: 0 0 30px 8px rgba(0, 0, 0, 0.05);
}
.btn-close {
position: absolute;
top: -40px;
right: -1px;
width: auto;
height: auto;
padding: 5px 0 0 5px;
border-radius: 0;
color: #ffffff;
font-size: 26px;
font-weight: 300;
font-family: 'Open Sans', sans-serif;
line-height: 35px;
text-align: center;
cursor: pointer;
background-color: transparent;
z-index: 99999;
}
.form-block {
position: relative;
float: left;
width: 100%;
clear: both;
padding: 40px 65px 0;
border-top-right-radius: 0;
border-top-left-radius: 0;
background-color: var(--background-l);
}
.login-form,
.register-form {
position: relative;
float: left;
width: 100%;
clear: both;
}
.login-form .title,
.register-form .title {
color: var(--textcolor);
font-size: 30px;
font-weight: 400;
font-family: var(--fontubunto);
letter-spacing: 0;
line-height: 1;
text-transform: capitalize;
text-align: center;
}
.signin,
.reset-password,
.register-form {
position: relative;
float: left;
width: 100%;
clear: both;
}
.login-form .form-control {
height: 50px;
padding: 15px 20px !important;
color: var(--textcolor);
font-size: 16px;
font-weight: 300;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
background-color: var(--background-l);
}
.login-form .btn-forget {
color: var(--btncolor);
font-size: 14px;
font-weight: 300;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1.5;
transition: var(--transition);
}
.login-form .btn-forget:hover,
.login-form .btn-forget:focus {
color: var(--themecolor);
transition: var(--transition);
}
.login-form .btn-login {
display: inline-block;
width: 100%;
height: 50px;
padding: 13px 20px;
color: var(--themecolor);
font-size: 16px;
font-weight: 700;
font-family: var(--fontlato);
letter-spacing: normal;
vertical-align: middle;
border: 0;
border-radius: 4px;
background-color: var(--background-w);
transition: var(--transition);
}
.login-form .btn-login:hover,
.login-form .btn-login:focus {
color: var(--btncolor);
background-color: var(--themecolor);
transition: var(--transition);
}
.login-form .login-query a {
color: var(--btncolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
.login-form .custom-control-label::before,
.login-form .custom-control-label::after {
top: -1.5px;
left: -2.1rem;
}
.reset-password,
.register {
display: none;
}
.connectivity {
position: relative;
float: left;
width: 100%;
padding: 30px 65px 40px;
text-align: center;
border-bottom-left-radius: 0;
border-bottom-right-radius: 0;
background-color: var(--background-l);
}
.connectivity > div > p {
margin-bottom: 30px;
position: relative;
color: var(--color);
font-size: 14px;
font-weight: 600;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: capitalize;
}
.connectivity > div > p::before {
content: '';
position: absolute;
top: 50%;
left: -100%;
width: 85px;
height: 2px;
background-color: var(--themebg);
}
.connectivity > div > p::after {
content: '';
position: absolute;
top: 50%;
right: -100%;
width: 85px;
height: 2px;
background-color: var(--themebg);
}
.social-media {
position: relative;
display: inline-flex;
align-items: center;
justify-content: center;
}
.btn-social,
.btn-social:hover,
.btn-social:focus {
padding: 8px 12px;
color: #ffffff;
font-size: 15px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-align: center;
border: 0;
border-radius: 4px;
background-color: initial;
}
.su-facebook,
.su-facebook:hover,
.su-facebook:focus {
background-color: #3b5998;
}
.su-google,
.su-google:hover,
.su-google:focus {
background-color: #db3236;
}
.su-twitter,
.su-twitter:hover,
.su-twitter:focus {
margin-right: 0;
background-color: #1a91da;
}
.su-instagram,
.su-instagram:hover,
.su-instagram:focus {
background-color: #bd30a2;
}
.btn-social > i {
margin-right: 0;
}
@media (max-width: 1199px) {
#modal-login {
width: 100%;
height: 100%;
}
.modal-login-body {
max-height: initial;
overflow: hidden scroll;
}
.btn-close {
top: 0;
right: 17px;
}
}
@media (max-width: 575px) {
.form-block,
.connectivity {
padding-right: 15px;
padding-left: 15px;
}
}
#modal-video {
display: none;
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
float: left;
width: 100%;
height: 100vh;
background-color: rgba(0, 0, 0, 0.75);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
overflow: hidden;
z-index: 999999;
}
#modal-video.modal-open {
display: block;
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
-webkit-overflow: hidden;
overflow: hidden;
}
.modal-content {
position: relative;
margin: 0 auto;
padding: 0 0;
width: 100%;
height: 100%;
max-width: 1110px;
border: 0;
border-radius: 4px;
background-color: #ffffff;
}
.modal-container {
width: 100%;
height: 100%;
}
/*--------------------------------------------------------------------
PAGE STYLES - HOME PAGE
----------------------------------------------------------------------*/
/*---- TOPBAR ----*/
#topbar {
position: relative;
float: left;
width: 100%;
padding: 13px 0;
background-color: var(--background-1);
}
.topbar-contact i {
color: var(--themecolor);
font-size: 14px;
font-weight: normal;
}
.topbar-contact span {
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontopensans);
line-height: normal;
letter-spacing: normal;
vertical-align: text-bottom;
}
.topbar-social a {
padding: 0 10px;
color: var(--textcolor);
font-size: 14px;
font-family: var(--fontopensans);
font-weight: normal;
font-family: inherit;
line-height: normal;
letter-spacing: 0;
vertical-align: text-bottom;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.topbar-social i {
color: var(--textcolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.topbar-social a:hover i,
.topbar-social a:focus i {
color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.language-wrapper {
position: relative;
display: inline-flex;
margin-right: 25px;
}
.control-plugin button,
.control-plugin button:hover,
.control-plugin button:focus {
position: relative;
margin: 0 !important;
padding: 0 10px 0 0 !important;
color: var(--textcolor) !important;
font-size: 14px;
font-weight: 400;
font-family: var(--fontopensans);
line-height: normal;
letter-spacing: 0;
text-transform: capitalize;
vertical-align: middle;
border: 0 !important;
border-radius: 0;
outline: 0 !important;
box-shadow: none !important;
background-color: transparent !important;
background: none !important;
}
.control-plugin button:after {
content: '';
position: absolute;
top: 45%;
right: 0;
display: inline-block;
width: 5px;
height: 5px;
margin-left: .255em;
color: var(--textcolor) !important;
border-top: 0;
border-right: 1px solid var(--bordercolor);
border-bottom: 1px solid var(--bordercolor);
border-left: 0;
-webkit-transform: rotate(45deg) translateY(-50%);
-ms-transform: rotate(45deg) translateY(-50%);
-moz-transform: rotate(45deg) translateY(-50%);
-o-transform: rotate(45deg) translateY(-50%);
transform: rotate(45deg) translateY(-50%);
-webkit-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.control-plugin button:focus:after {
-webkit-transform: rotate(-135deg);
-ms-transform: rotate(-135deg);
-moz-transform: rotate(-135deg);
-o-transform: rotate(-135deg);
transform: rotate(-135deg);
-webkit-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.control-plugin .language button,
.control-plugin .language button:hover,
.control-plugin .language button:focus {
text-transform: capitalize;
}
.control-plugin .dropdown-menu {
position: absolute !important;
height: auto !important;
max-height: 250px !important;
padding: 0.25rem 0.5rem !important;
color: var(--textcolor);
font-size: 14px;
font-weight: 300;
font-family: var(--fontopensans);
letter-spacing: 0;
line-height: 1.8;
text-transform: uppercase;
cursor: pointer;
overflow-x: hidden !important;
will-change: transform !important;
opacity: 0;
background-color: var(--background-2);
-webkit-transition: opacity 0.35s;
-moz-transition: opacity 0.35s;
-ms-transition: opacity 0.35s;
-o-transition: opacity 0.35s;
transition: opacity 0.35s;
}
.control-plugin .dropdown-menu.show {
opacity: 1;
-webkit-transition: opacity 10s;
-moz-transition: opacity 10s;
-ms-transition: opacity 10s;
-o-transition: opacity 10s;
transition: opacity 10s;
}
.language .dropdown-menu {
min-width: 106.6px;
}
.control-plugin .dropdown-menu a,
.control-plugin .dropdown-menu a:hover,
.control-plugin .dropdown-menu a:focus {
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontopensans);
line-height: normal;
letter-spacing: normal;
text-transform: capitalize;
}
.login-signup {
position: relative;
display: flex;
flex-direction: row;
flex-wrap: wrap;
align-items: center;
justify-content: flex-end;
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontopensans);
line-height: normal;
letter-spacing: normal;
}
.login-signup a {
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontopensans);
line-height: normal;
letter-spacing: normal;
text-transform: capitalize;
}

@media (max-width: 767px) {
#topbar .row .col-md-6:first-child {
order: 2;
}
#topbar .row .col-md-6:last-child {
order: 1;
}
.topbar-contact-list,
.topbar-contact .topbar-social {
padding-top: 15px !important;
}
/*---- TOPBAR | TOPBAR-LOGGEDIN ----*/
#topbar.topbar-loggedin .topbar-contact-list {
width: 100%;
}
#topbar.topbar-loggedin .topbar-content .language-wrapper {
order: 2;
margin-right: 0;
}

.account-dropdown .dropdown-content .dropdown-item .media{
padding-bottom: 10px;
}
.account-dropdown .dropdown-content .dropdown-item .media .media-body h6.font-weight-bold{
font-size: 12px;
}
.account-dropdown .dropdown-content .dropdown-item .media .media-body p{
font-size: 10px;
}

}
@media (max-width: 464px) {
.language .dropdown-menu {
right: -5px;
left: initial !important;
}
html[dir=rtl] .topbar-loggedin .language-wrapper .control-plugin .dropdown-menu {
left: 0 !important;
right: initial;
}
}
/*---- NAVBAR ----*/
#navbar {
position: relative;
background-color: var(--background-2);
z-index: 100;
}
#navbar .navbar {
padding: 17px 0;
max-height: initial;
}
#navbar .navbar-brand {
margin-right: 110px;
}
#investmentnavbar {
justify-content: space-between;
}
#investmentnavbar .nav-link {
color: var(--textcolor);
padding: 5px 15px;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
vertical-align: middle;
text-transform: uppercase;
background-color: transparent;
background-image: linear-gradient(90deg, var(--themecolor), var(--themecolor) 50%, #fff 50%);;
background-size: 200% 100%;
background-position: 100%;
-webkit-background-clip: text;
-moz-background-clip: text;
-ms-background-clip: text;
-o-background-clip: text;
background-clip: text;
-webkit-text-fill-color: transparent;
-moz-text-fill-color: transparent;
-ms-text-fill-color: transparent;
-o-text-fill-color: transparent;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
#investmentnavbar .nav-link:hover,
#investmentnavbar .nav-link:focus {
background-position: 0%;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
#investmentnavbar li:first-child .nav-link {
padding-left: 0;
}
#investmentnavbar li:last-child .nav-link {
padding-right: 0;
}
#investmentnavbar .nav-registration a {
position: relative;
display: inline-block;
padding: 13px 25px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
text-transform: uppercase;
vertical-align: middle;
border: 0;
border-radius: 22px;
overflow: hidden;
background-color: var(--themebg);
-webkit-transition: var(--transition);
-ms-transition: var(--transition);
-moz-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.nav-registration a span {
position: relative;
z-index: 1;
}
.nav-registration a::before {
content: '';
position: absolute;
top: 0;
left: -100%;
width: 100%;
height: 100%;
color: var(--themecolor);
font-size: 16px;
font-weight: 600;
font-family: 'Poppins', sans-serif;
line-height: 40px;
text-align: center;
border: 0;
border-radius: 22px;
background: linear-gradient(90deg, var(--background-w) 0%, var(--background-w) 100%);
-webkit-transition: var(--transition);
-ms-transition: var(--transition);
-moz-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
z-index: 0;
}
.nav-registration a:hover,
.nav-registration a:focus {
color: #ffffff;
}
.nav-registration a:hover span {
color: var(--themecolor);
}
.nav-registration a:hover::before {
opacity: 1;
left: 0;
border-radius: 22px;
-webkit-transition: var(--transition);
-ms-transition: var(--transition);
-moz-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
#navbar .navbar-toggler,
#navbar .navbar-toggler:hover,
#navbar .navbar-toggler:focus {
display: none !important;
padding: 6px 0;
display: inline-block;
font-size: 0;
line-height: 0;
border: 0;
border-radius: 0;
}
.menu-icon {
position: relative;
width: 100%;
height: 100%;
display: inline-flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
}
.menu-icon span {
position: relative;
margin-bottom: 6px;
display: inline-block;
width: 30px;
height: 4px;
border: 0;
border-radius: 3px;
background-color: <?php echo  $themeColor;?>;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.menu-icon span::after {
content: '';
display: inline-block;
position: absolute;
top: 0;
left: 0;
width: 0;
height: 100%;
border: 0;
border-radius: 3px;
background: linear-gradient(109deg, #ffffff 0%, #ffffff 100%);
-webkit-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
.menu-icon span:last-child {
margin-bottom: 0;
}
.custom-toggler .menu-icon span::after,
.menu-icon:hover span::after {
width: 100%;
-webkit-transition: width 0.35s ease-in-out;
-moz-transition: width 0.35s ease-in-out;
-ms-transition: width 0.35s ease-in-out;
-o-transition: width 0.35s ease-in-out;
transition: width 0.35s ease-in-out;
}
/*---- NAVBAR | NAVBAR-LOGGEDIN ----*/
.navbar-loggedin .account {
position: relative;
}
.account-dropdown {
position: relative;
width: auto;
height: 100%;
display: flex;
align-items: center;
}
.account-dropdown .dropdown-toggle {
position: relative;
color: var(--textcolor);
font-size: 18px;
}
.account-dropdown .dropdown-toggle::after {
display: none;
border-top: 0.3em solid transparent;
}
.account-dropdown .dropdown-toggle .rotate-icon {
position: relative;
display: inline-block;
-webkit-transform: rotate(25deg);
-moz-transform: rotate(25deg);
-ms-transform: rotate(25deg);
-o-transform: rotate(25deg);
transform: rotate(25deg);
}
.account-dropdown .dropdown-toggle .badge {
position: absolute;
top: -2px;
right: -6px;
width: 15px;
height: 15px;
display: flex;
align-items: center;
justify-content: center;
color: var(--textcolor);
font-size: 11px;
font-weight: 400;
font-family: var(--fontlato);
border: 0;
border-radius: 50%;
background-color: var(--themebg);
}
.account-dropdown .dropdown-toggle img {
width: 48px;
height: 48px;
border-radius: 50%;
}
.dropdown-right {
left: initial;
right: 0;
}
.account-dropdown .dropdown-menu {
display: initial;
opacity: 0;
visibility: hidden;
margin: 17px 0 0;
padding: 0;
border: 0;
border-radius: 0 0 4px 4px;
background-color: var(--background-2);
box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.25);
max-width: 299px;
overflow: hidden;
transform: translateY(50px);
transition: var(--transition);
}
html[dir=rtl] .account-dropdown .dropdown-menu {
left: 0 !important;
right: initial;
}
.account-dropdown .dropdown-menu.show {
opacity: 1;
visibility: visible;
transform: translateY(0%);
transition: var(--transition);
}
.account-dropdown .dropdown-content {
margin: 0;
padding: 2px 0 0;
max-height: 390px;
border-top: 2px solid var(--themecolor);
overflow: hidden;
overflow-y: scroll;
}
html[dir=rtl] .account-dropdown .dropdown-menu .dropdown-content .dropdown-item .media .media-body {
margin-right: 15px;
margin-left: 0 !important;
}
html[dir=rtl] .account-dropdown .dropdown-menu .dropdown-content .dropdown-item .media .media-body h6,
html[dir=rtl] .account-dropdown .dropdown-menu .dropdown-content .dropdown-item .media .media-body p{
text-align: right;
}
.account-dropdown .dropdown-content::-webkit-scrollbar {
width: 5px;
}

/* Track */
.account-dropdown .dropdown-content::-webkit-scrollbar-track {
background: #f1f1f1;
}

/* Handle */
.account-dropdown .dropdown-content::-webkit-scrollbar-thumb {
background: #888;
}

/* Handle on hover */
.account-dropdown .dropdown-content::-webkit-scrollbar-thumb:hover {
background: #555;
}
.account-dropdown .dropdown-content .dropdown-item:first-child {
margin-top: 0;
}
.account-dropdown .dropdown-content .dropdown-item {
margin: 2px 0 0;
padding: 15px 15px 0;
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
white-space: initial !important;
border: 0;
border-radius: 4px;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item:last-child {
margin-bottom: 11px;
}
.account-dropdown .dropdown-content .dropdown-item:hover {
background-color: var(--themebg);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item .media {
padding-bottom: 15px;
border-bottom: 1px dashed var(--bordercolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item:hover .media {
border-color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item .media .media-icon {
width: 35px;
height: 35px;
display: flex;
align-items: center;
justify-content: center;
border: 0;
border-radius: 50%;
background-color: var(--background-w);
}
.account-dropdown .dropdown-content .dropdown-item .media .media-icon i {
color: var(--themecolor) !important;
font-size: 20px;
padding: 10px;
}
.unread-text {
color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item:hover .unread-text {
color: var(--textcolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .dropdown-item .media .media-body p span {
display: inline-block;
vertical-align: middle;
}
.account-dropdown .dropdown-menu .btn-viewnotification,
.account-dropdown .dropdown-menu .btn-clear {
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-menu .btn-clear {
font-size: 16px;
}
.account-dropdown .dropdown-menu .btn-viewnotification:hover,
.account-dropdown .dropdown-menu .btn-clear:hover {
color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.account-dropdown .dropdown-content .ps__rail-y,
.account-dropdown .dropdown-content .ps__rail-y:hover {
right: 0;
width: 6px;
background-color: transparent;
}
.account-dropdown .dropdown-content .ps__rail-y .ps__thumb-y {
right: 0;
width: 6px;
background-color: #ffffff;
}
.responsive-menus .dropdown-menu,
.responsive-menus .dropdown-content {
overflow: unset;
max-height: initial;
}
.responsive-menus .dropdown-content .dropdown-item {
padding: 15px 15px;
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
}
.submenu-wrapper {
position: relative;
opacity: 1;
height: auto;
}
.submenu-wrapper .submenu-toggler {
position: relative;
display: inline-block;
width: 100%;
padding: 15px 15px;
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: initial;
text-transform: uppercase;
border: 0;
border-radius: 4px;
background-color: transparent;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.submenu-wrapper .submenu-toggler:hover {
background-color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.submenu-wrapper .submenu-toggler::after {
content: '';
position: absolute;
top: 45%;
right: 18px;
width: 6px;
height: 6px;
border-top: 0;
border-right: 1px solid var(--bordercolor);
border-bottom: 1px solid var(--bordercolor);
border-left: 0;
transform: rotate(45deg) translateY(-45%)
}
.submenu-wrapper .submenu {
position: relative;
margin-top: 2px;
height: 0;
border: 0;
border-radius: 4px;
background-color: var(--background-3);
transition: height 0.35s ease-in-out;
overflow: hidden;
}
.submenu-wrapper .submenu .submenu-item {
position: relative;
display: inline-block;
width: 100%;
color: var(--textcolor);
padding: 15px 15px 15px 30px;
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
}
.submenu-wrapper .submenu .submenu-item::before {
content: '\eaca';
color: var(--textcolor);
font-size: 14px;
font-family: IcoFont;
position: absolute;
top: 50%;
left: 15px;
transform: translateY(-50%);
}
.submenu-wrapper .submenu-toggler:hover ~ .submenu,
.submenu-wrapper .submenu-toggler:focus ~ .submenu,
.submenu:hover {
display: block;
height: 100%;
transition: height 0.35s ease-in-out;
}
html[dir=rtl] .navbar-loggedin #investmentnavbar .account ul li:last-child {
margin-left: 0 !important;
}
@media (max-width: 767px) {
#navbar .navbar-brand {
margin-right: 0;
}
#navbar.navbar-loggedin .navbar-brand {
margin-right: 15px;
}
html[dir=rtl] #navbar.navbar-loggedin .navbar-brand {
margin-right: 0;
margin-left: 15px;
}
#navbar .navbar-toggler,
#navbar .navbar-toggler:hover,
#navbar .navbar-toggler:focus {
display: inline-block !important;
}
#investmentnavbar {
color: var(--textcolor);
text-align: right;
border: 0;
border-radius: 4px;
background-color: var(--background-1);
-webkit-box-shadow: var(--shadowblack);
-moz-box-shadow: var(--shadowblack);
box-shadow: var(--shadowblack);
}
#investmentnavbar .nav-link {
padding: 10px 15px !important;
color: var(--textcolor);
background: unset;
-webkit-text-fill-color: unset;
-moz-text-fill-color: unset;
-ms-text-fill-color: unset;
-o-text-fill-color: unset;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
#investmentnavbar .nav-link:hover,
#investmentnavbar .nav-link:focus {
color: var(--themecolor);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
html[dir=rtl] .navbar-loggedin #pushNotificationArea > .account > div {
margin-left: 20px;
}
html[dir=rtl] .navbar-loggedin #pushNotificationArea > .account > ul,
html[dir=rtl] .navbar-loggedin #pushNotificationArea > .account > ul > li:last-child {
margin-left: 0 !important;
}
}
@media (min-width: 576px) {
.account-dropdown .dropdown-menu {
min-width: 299px;
}
}
@media (max-width: 464px) {
.xs-dropdown-menu {
right: initial;
left: 0;
/* position: fixed;
top: 205px;
right: initial;
left: 50% !important;
-webkit-transform: translateX(-50%);
transform: translateX(-50%); */
}
.xs-dropdown-menu .dropdown-content .dropdown-item .media {
flex-wrap: wrap;
}
.account-dropdown .dropdown-content .dropdown-item .media{
padding-bottom: 10px;
}
.account-dropdown .dropdown-content .dropdown-item .media .media-body h6.font-weight-bold{
    font-size: 12px;
}
.account-dropdown .dropdown-content .dropdown-item .media .media-body p{
    font-size: 10px;
}
.xs-dropdown-menu .dropdown-content .dropdown-item .media .media-body {
<!--margin-left: 0 !important;-->
}
}
/*---- HERO ----*/
#hero {
position: relative;
padding: 170px 0;
/*background-image: linear-gradient(90deg, rgba(7, 11, 40, 0.8) 0%, rgba(7, 11, 40, 0.8) 100%), url('../images/home/herobanner.jpg');*/
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
background-color: #ffffff;
}
.hero-content .h1 {
text-transform: uppercase;
}
.btn-hero {
display: inline-block;
padding: 15px 35px;
color: var(--themecolor);
font-size: 18px;
font-weight: 600;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: capitalize;
border: 1px solid var(--bordercolor);
border-radius: 30px;
background-color: rgba(255, 255, 255, 0.8);
transition: var(--transition);
}
.btn-hero:hover,
.btn-hero:focus {
padding: 15px 35px;
color: var(--textcolor);
font-size: 18px;
font-weight: 600;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: capitalize;
border-radius: 30px;
border: 1px solid var(--themecolor);
background-color: var(--themebg);
transition: var(--transition);
}
/*---- FEATURE ----*/
#feature {
position: relative;
margin: 0;
background-color: var(--background-1);
}
.feature-wrapper {
position: relative;
top: -70px;
}
.feature-wrapper .card-type-1 {
border-radius: 10px;
background-image: url('../images/shapes/shape-img-2.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
box-shadow: none;
}
.feature-wrapper .card-type-1:hover .card-icon {
background-color: var(--themebg);
transition: var(--transition);
}
@media (max-width: 767px) {
.feature-wrapper .row .col-md-4 {
margin-bottom: 30px;
}
.feature-wrapper .row .col-md-4:last-child {
margin-bottom: 30px;
}
}
/*---- ABOUT-US ----*/
#about-us {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-1);
}
#about-us .heading-container {
margin-bottom: 150px;
}
#about-us .wrapper {
position: relative;
}
#about-us .wrapper .about-fig {
position: relative;
border: 0;
border-radius: 20px;
}

#about-us .wrapper .about-fig::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
border: 0;
border-radius: 20px;
background: linear-gradient(90deg, rgba(253, 71, 76, 0.8) 0%, rgba(253, 71, 76, 0.8) 100%);
z-index: 1;
}
#about-us .wrapper .about-fig img {
border-radius: 20px;
}
#about-us .wrapper .about-overlay-fig {
position: absolute;
width: 100%;
height: 100%;
top: -60px;
left: 60px;
z-index: 2;
}
html[dir=rtl] #about-us .wrapper .about-overlay-fig {
right: 60px;
left: initial;
}
#about-us .wrapper .about-overlay-fig img {
border-radius: 20px;
}
#about-us .text-wrapper {
top: -30px;
}
#about-us .text-wrapper .about-feature .media .media-icon {
width: 78px;
height: 78px;
display: inline-flex;
align-items: center;
justify-content: center;
border: 0;
border-radius: 4px;
transition: var(transiton);
}
#about-us .text-wrapper .about-feature .media:hover .media-body h5 {
color: var(--themecolor);
transition: var(--transition);
}

#about-us .wrapper .d-flex.position-relative{
max-width:480px
}
@media(max-width: 1199px) {
#about-us .text-wrapper {
top: initial;
margin-top: 75px;
padding-left: 0;
}
}
@media(max-width: 767px) {
.about-fig {
display: none;
}
#about-us .wrapper .about-overlay-fig {
position: initial;
}
}
/*---- INVESTMENT ----*/
#investment {
margin: 0 0;
padding: 150px 0 120px;
background-color: var(--background-3);
}
#investment .investment-wrapper {
margin-top: 65px;
}
#investment .investment-wrapper .row .col-lg-4 {
margin-bottom: 30px;
}
.investment-wrapper .card-type-1 {
position: relative;
padding: 35px 35px;
border-radius: 4px;
background-image: url('../images/shapes/shape-img-4.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
box-shadow: none;
overflow: hidden;
}
.investment-wrapper .card-type-1 .featured {
position: absolute;
top: 26px;
right: -32px;
padding: 2px 0;
min-width: 150px;
text-align: center;
background-color: var(--themesidetagbg);
transform: rotate(45deg)
}
.investment-wrapper .card-type-1 .featured span {
color: var(--textcolor);
font-size: 14px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
/*---- INVESTMENT-PLAN ----*/
#investment-plan {
margin: 0 0;
padding: 150px 0 120px;
background-color: var(--background-1);
}
#investment-plan .investment-plan-wrapper {
margin-top: 65px;
}
#investment-plan .investment-plan-wrapper .row .col-md-6 {
margin-bottom: 30px;
}
#investment-plan .investment-plan-wrapper .card-type-1 {
position: relative;
padding: 35px 35px;
border: 1px solid #131e51;
border-radius: 4px;
background-image: url('../images/shapes/shape-img-5.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
box-shadow: none;
overflow: hidden;
transition: var(--transition);
}
#investment-plan .investment-plan-wrapper .card-type-1:hover {
border: 1px solid var(--themecolor);
transition: var(--transition);
}
/*---- BANNER-WRAP ----*/
#banner-wrap {
margin: 0 0;
padding: 80px 0;
background-color: var(--themebg);
}
#banner-wrap::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 50%;
height: 100%;
/*background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%), url('../images/home/videoimage.jpg');*/
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
}
.youtube-wrapper {
position: relative;
width: 100%;
height: 100%;
}
.youtube-wrapper .btn-container {
height: 100%;
display: flex;
align-items: center;
justify-content: center;
}
.youtube-wrapper .btn-container .btn-play {
position: relative;
display: flex;
align-items: center;
justify-content: center;
width: 100px;
height: 100px;
padding: 15px;
border-radius: 50%;
background: #ffffff;
cursor: pointer;
}
.youtube-wrapper .btn-container .btn-play::after {
content: '';
position: absolute;
width: calc(100% + 25px);
height: calc(100% + 25px);
border: 20px solid;
border-radius: 50%;
border-color: rgba(255, 255, 255, 0.95);
transition: all 1.75s ease-in-out;
}
.youtube-wrapper .btn-container .btn-play i {
color: #e93e21;
font-size: 28px;
}
.grow-play::after {
-webkit-animation: grow-play 1.9s ease-in-out infinite;
-moz-animation: grow-play 1.9s ease-in-out infinite;
-ms-animation: grow-play 1.9s ease-in-out infinite;
-o-animation: grow-play 1.9s ease-in-out infinite;
animation: grow-play 1.9s ease-in-out infinite;
}
@keyframes grow-play {
0% {
width: 100%;
height: 100%;
opacity: 1;
-webkit-transition: width 0.5s ease-in-out;
-moz-transition: width 0.5s ease-in-out;
-ms-transition: width 0.5s ease-in-out;
-o-transition: width 0.5s ease-in-out;
transition: width 0.5s ease-in-out;
}
50% {
width: calc(100% + 25px);
height: calc(100% + 25px);
opacity: 0;
-webkit-transition: width 1s ease-in-out;
-moz-transition: width 1s ease-in-out;
-ms-transition: width 1s ease-in-out;
-o-transition: width 1s ease-in-out;
transition: width 1s ease-in-out;
}
100% {
width: 100%;
height: 100%;
opacity: 0;
-webkit-transition: width 1.5s ease-in-out;
-moz-transition: width 1.5s ease-in-out;
-ms-transition: width 1.5s ease-in-out;
-o-transition: width 1.5s ease-in-out;
transition: width 1.5s ease-in-out;
}
}
#banner-wrap .vertical-timeline .media {
position: relative;
z-index: 1;
}
#banner-wrap .vertical-timeline .media:first-child::after {
content: '';
position: absolute;
bottom: -10px;
left: 25px;
width: 0;
height: calc(50% + 0px);
border-left: 1px dashed var(--bordercolor);
z-index: 0;
}
#banner-wrap .vertical-timeline .media::after {
content: '';
position: absolute;
left: 25px;
width: 0;
height: calc(50% + 80px);
border-left: 1px dashed var(--bordercolor);
z-index: 0;
}
#banner-wrap .vertical-timeline .media:last-child::after {
content: '';
position: absolute;
top: -10px;
left: 25px;
width: 0;
height: calc(50% + 0px);
border-left: 1px dashed var(--bordercolor);
z-index: 0;
}
#banner-wrap .vertical-timeline .media .media-counter {
position: relative;
padding: 2px;
width: 50px;
height: 50px;
display: inline-flex;
align-items: center;
justify-content: center;
border: 1px dashed var(--bordercolor);
border-radius: 50%;
z-index: 9;
}
#banner-wrap .vertical-timeline .media .media-counter span {
padding: 2px;
width: 100%;
height: 100%;
display: inline-flex;
align-items: center;
justify-content: center;
border-radius: 50%;
background-color: var(--background-2);
}
#banner-wrap .vertical-timeline .media .media-body .media-title {
color: var(--textcolor);
font-size: 20px;
font-weight: 500;
font-family: var(--fontubunto) !important;
}
@media (max-width: 767px) {
#banner-wrap::before {
width: 100%;
background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.5) 100%), url('../images/home/videoimage.jpg');
}
}
html[dir=rtl] #banner-wrap .offset-md-1 {
margin-right: 8.333333%;
margin-left: initial;
}
html[dir=rtl] #banner-wrap .vertical-timeline .media .media-body {
margin-right: 20px;
margin-left: 0 !important;
}
/*---- DEPOSIT-WITHDRAW ----*/
#deposit-withdraw {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-1);
}
#deposit-withdraw .nav-pills {
margin-top: 65px !important;
text-align: center;
}
#deposit-withdraw .nav-pills .nav-item .nav-link {
position: relative;
display: inline-block;
padding: 12px 30px;
color: var(--textcolor);
font-size: 16px;
font-weight: 700;
font-family: var(--fontlato);
background-color: var(--background-2);
overflow: hidden;
}
#deposit-withdraw .nav-pills .nav-item .active.nav-link {
background-color: var(--themebg);
}
#deposit-withdraw .nav-pills .nav-item:first-child .nav-link {
border-radius: 24px 0 0 24px;
}
#deposit-withdraw .nav-pills .nav-item:last-child .nav-link {
border-radius: 0 24px 24px 0;
}
#deposit-withdraw .nav-pills .nav-item:first-child .nav-link::before {
content: '';
position: absolute;
top: 0;
right: -150px;
width: 100%;
height: 100%;
background-color: var(--themebg);
transition: var(--transition);
}
#deposit-withdraw .nav-pills .nav-item:first-child .nav-link:hover::before {
right: 0;
}
#deposit-withdraw .nav-pills .nav-item:last-child .nav-link::before {
content: '';
position: absolute;
top: 0;
left: -150px;
width: 100%;
height: 100%;
background-color: var(--themebg);
transition: var(--transition);
}
#deposit-withdraw .nav-pills .nav-item:last-child .nav-link:hover::before {
left: 0;
}
#deposit-withdraw .nav-pills .nav-item .nav-link span {
position: relative;
z-index: 1;
}
.statistics-wrapper {
position: relative;
margin-top: 65px;
padding: 35px 35px;
border: 0;
border-radius: 4px;
background-image: url('../images/shapes/shape-img-6.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
background-color: var(--background-4);
}
.statistics-wrapper .data-table-header {
min-width: 1040px;
display: flex;
flex-flow: row nowrap;
align-items: flex-start;
justify-content: flex-start;
border: 0;
border-radius: 4px;
background-color: var(--background-1);
overflow: hidden;
}
.statistics-wrapper .data-table {
min-width: 1040px;
display: flex;
flex-flow: row nowrap;
align-items: stretch;
justify-content: flex-start;
}
.statistics-wrapper .data-table-header .data-column {
flex: 1 0 20%;
max-width: 20%;
min-width: 208px;
}
.statistics-wrapper .data-table .data-column {
flex: 1 0 20%;
max-width: 20%;
min-width: 208px;
align-self: stretch;
display: flex;
flex-flow: column nowrap;
}
.statistics-wrapper .data-table-header .data-column-header {
padding: 10px 15px;
transition: var(--transition);
}
.statistics-wrapper .data-table-header .data-column-header:hover {
background-color: var(--themebg);
transition: var(--transition);
}
.statistics-wrapper .data-table .data-column .data-content-wrapper {
height: 100%;
padding: 10px 15px;
display: flex;
align-items: center;
}
html[dir=rtl] .data-content-wrapper .media > p.text {
margin-right: 10px;
margin-left: 0 !important;
}
.statistics-wrapper .data-table .data-column .data-content-wrapper img{
max-width: 50px;
max-height: 50px;
border-radius: 50%;
}
@media (max-width: 1199px) {
.statistics-wrapper .data-table-container {
overflow: scroll scroll;
}
}
/*---- PROFIT-CALCULATION ----*/
#profit-calculation {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-3);
}
#profit-calculation .calculation-wrapper {
margin-top: 65px;
padding: 38px 38px;
background-image: url('../images/shapes/shape-img-7.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
border: 0;
border-radius: 4px;
background-color: var(--background-2);
}
#profit-calculation .calculation-wrapper div .wrapper-col {
min-width: 270px;
}
#profit-calculation .calculation-wrapper .select-currency {
display: flex;
align-items: flex-start;
justify-content: space-between;
}
.select-currency .custom-control {
display: inline-block;
padding: 0 0;
width: 60px;
height: 48px;
border-radius: 4px;
}
.select-currency .custom-control .custom-control-label {
width: 100%;
height: 100%;
text-align: center;
line-height: 48px;
cursor: pointer;
}
.select-currency .custom-control .custom-control-label::before {
width: 100%;
height: 100%;
border: 1px solid var(--bordercolor);
border-radius: 4px;
transition: var(--transition);
}
.select-currency .custom-control .custom-control-label:hover::before {
border-color: var(--themecolor);
transition: var(--transition);
}
.select-currency .custom-control-input:checked ~ .custom-control-label::before {
color: var(--textcolor);
border: 1px solid var(--themecolor);
border-radius: 4px;
background-color: var(--themebg);
}
.select-currency .custom-radio .custom-control-input:checked ~ .custom-control-label::after {
background-image: none;
}
.select-currency .custom-control-input:focus ~ .custom-control-label::before {
box-shadow: none;
}
.select-currency .custom-control-input:focus:not(:checked) ~ .custom-control-label::before {
border-color: #ffffff;
}
.select-currency .custom-control .custom-control-label span {
position: relative;
z-index: 1;
}
.liquid-amount .form-control {
height: 48px;
line-height: 48px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
border: 1px solid var(--bordercolor);
border-radius: 4px;
background-color: transparent;
transition: var(--transition);
}
.liquid-amount .form-control:hover {
border-color: var(--themecolor);
transition: var(--transition);
}
.overview-graph {
margin-top: 35px;
padding: 35px 35px;
border: 1px dotted var(--bordercolor);
border-radius: 4px;
}
.overview-graph .progress-wrapper {
position: relative;
bottom: -91px;
margin: 0 auto;
width: calc(100% - 60px);
padding: 20px 40px;
border: 0;
border-radius: 4px;
background-color: var(--themebg);
}
.overview-graph .progress-wrapper .progress {
height: 10px;
border-radius: 5px;
}
.progress-bar {
border-radius: 5px;
background-color: var(--background-4);
}
.calculation-wrapper .btn-container {
margin-top: 100px;
}
@media (max-width: 991px) {
.calculation-wrapper div .wrapper-col  {
margin-bottom: 30px;
}
.calculation-wrapper div .wrapper-col:last-child  {
margin-bottom: 30px;
}
#profit-calculation .calculation-wrapper .select-currency {
justify-content: center;
}
.select-currency .custom-control {
margin-right: 10px;
}
.select-currency .custom-control:last-child {
margin-right: 0;
}
}
@media (max-width: 575px) {
#profit-calculation .calculation-wrapper div .wrapper-col {
min-width: initial;
}
#profit-calculation .calculation-wrapper .select-currency {
flex-wrap: wrap
}
.overview-graph {
padding: 35px 10px;
}
.overview-graph .progress-wrapper {
padding: 20px 10px;
width: 100%;
}
}
/*---- TESTIMONIAL ----*/
#testimonial {
margin: 0;
padding: 150px 0;
background-color: var(--background-1);
}
#testimonial .slider-container {
position: relative;
margin: 65px 0 0;
padding: 0
}
#testimonial .slider-container .slider-testimonial .slick-list,
#testimonial .slider-container .slider-testimonial-rtl .slick-list {
height: auto !important;
padding-bottom: 60px;
}
.testimonial-item {
position: relative;
padding: 35px 30px;
border: 0;
border-radius: 4px;
background-image: url('../images/shapes/shape-img-8.png');
background-position: bottom;
background-repeat: no-repeat;
background-size: 100% 100%;
background-color: var(--background-2);
transition: var(--transition);
}
.testimonial-item::before {
content: '';
position: absolute;
bottom: -50px;
left: 50%;
width: 0;
height: 0;
border-top: 50px solid #202b5d;
border-right: 25px solid transparent;
border-left: 25px solid transparent;
border-bottom: 0;
transform: translateX(-50%);
}
.testimonial-item img {
width: 100%;
height: 100%;
max-width: 90px;
max-height: 90px;
border: 2px solid var(--themecolor);
border-radius: 50%;
}
html[dir=rtl] .testimonial-item .media .media-body {
margin-right: 20px;
margin-left: 0 !important;
text-align: right;
}
.slider-nav .slider-nav-item .testimonial-nav,
.slider-nav-rtl .slider-nav-item .testimonial-nav{
min-height: 106px;
display: flex;
align-items: center;
justify-content: center;
}
.slider-nav .slider-nav-item .testimonial-nav .slider-nav-center,
.slider-nav-rtl .slider-nav-item .testimonial-nav .slider-nav-center{
display: inline-block;
border-radius: 50%;
}
.slider-nav .slider-nav-item .testimonial-nav .slider-nav-center img,
.slider-nav-rtl .slider-nav-item .testimonial-nav .slider-nav-center img{
width: 100%;
height: 100%;
max-width: 90px;
max-height: 90px;
object-fit: cover;
cursor: pointer;
border: 2px solid var(--bordercolor);
border-radius: 50%;
}
#testimonial .slider-nav .slider-nav-item.slick-center .slider-nav-center,
#testimonial .slider-nav-rtl .slider-nav-item.slick-center .slider-nav-center{
padding: 7px;
border: 1px dashed var(--themecolor);
border-radius: 50%;
}
#testimonial .slider-nav .slider-nav-item.slick-center .slider-nav-center img,
#testimonial .slider-nav-rtl .slider-nav-item.slick-center .slider-nav-center img{
border-color: var(--themecolor);
}
.slider-container .slick-prev,
.slider-container .slick-prev:hover,
.slider-container .slick-prev:focus,
.slider-container .slick-next,
.slider-container .slick-next:hover,
.slider-container .slick-next:focus {
width: 40px;
height: 35px;
border: 1px solid var(--themecolor);
border-radius: 4px;
background-color: var(--background-1);
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
z-index: 999;
}
.slider-container .slick-prev::before {
content: '\eac6';
font-family: IcoFont;
color: var(--textcolor);
}
html[dir=rtl] .slider-container .slick-prev::before {
content: '\eac7';
}
.slider-container .slick-next::before {
content: '\eac7';
font-family: IcoFont;
color: var(--textcolor);
}
html[dir=rtl] .slider-container .slick-next::before {
content: '\eac6';
}
.slider-container .slick-dots li button::before {
color: var(--textcolor);
font-size: 10px;
opacity: 1;
}
.slider-container .slick-dots li.slick-active button::before {
color: var(--themecolor);
opacity: 1;
}
/*---- INVESTOR ----*/
#investor {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-3);
}
#investor .carousel-container,
#investor .investor-wrapper {
position: relative;
margin-top: 65px;
}
#investor .carousel-container .carousel-investor .item-carousel .card,
#investor .carousel-container .carousel-investor-rtl .item-carousel .card,
#investor .investor-wrapper .col-md-6 .card {
padding: 25px 25px;
border: 1px solid var(--bordercolor-1);
background-color: var(--background-3);
}
#investor .carousel-container .carousel-investor .item-carousel .card .investor-fig,
#investor .carousel-container .carousel-investor .item-carousel .card .investor-fig .img-container,
#investor .carousel-container .carousel-investor .item-carousel .card .investor-fig .img-container img,
#investor .carousel-container .carousel-investor-rtl .item-carousel .card .investor-fig,
#investor .carousel-container .carousel-investor-rtl .item-carousel .card .investor-fig .img-container,
#investor .carousel-container .carousel-investor-rtl .item-carousel .card .investor-fig .img-container img,
#investor .investor-wrapper .col-md-6 .card .investor-fig,
#investor .investor-wrapper .col-md-6 .card .investor-fig .img-container,
#investor .investor-wrapper .col-md-6 .card .investor-fig .img-container img {
position: relative;
max-width: 145px ;
max-height: 145px;
object-fit: cover;
border-radius: 50%;
}
#investor .carousel-container .carousel-investor .item-carousel .card .investor-fig .featured,
#investor .carousel-container .carousel-investor-rtl .item-carousel .card .investor-fig .featured,
#investor .investor-wrapper .col-md-6 .card .investor-fig .featured {
position: absolute;
bottom: 0;
left: 0;
width: 45px;
height: 45px;
text-align: center;
line-height: 45px;
border: 0;
border-radius: 50%;
background-color: var(--themebg);
}
#investor .carousel-container .owl-nav {
position: absolute;
top: -65px;
right: 0;
}
.carousel-container .owl-nav {
margin-top: 0;
}
.carousel-container .owl-nav .owl-prev {
margin: 0 10px 0 0;
}
html[dir=rtl] .carousel-container .owl-nav .owl-prev {
margin: 0 0 0 10px;
}
.carousel-container .owl-nav .owl-next {
margin: 0 0 0 10px;
}
html[dir=rtl] .carousel-container .owl-nav .owl-next {
margin: 0 10px 0 0;
}
.carousel-container .owl-nav .owl-prev,
.carousel-container .owl-nav .owl-prev:hover,
.carousel-container .owl-nav .owl-next,
.carousel-container .owl-nav .owl-next:hover {
width: 40px;
height: 35px;
border: 1px solid var(--themecolor) !important;
border-radius: 4px;
background-color: transparent;
}
.carousel-container .owl-nav .owl-prev span,
.carousel-container .owl-nav .owl-next span {
display: none;
}
.carousel-container .owl-nav .owl-prev::before {
content: '\eac6';
font-size: 20px;
font-family: IcoFont;
opacity: 0.75;
}
html[dir=rtl] .carousel-container .owl-nav .owl-prev::before {
content: '\eac7';
}
.carousel-container .owl-nav .owl-next::before {
content: '\eac7';
font-size: 20px;
font-family: IcoFont;
opacity: 0.75;
}
html[dir=rtl] .carousel-container .owl-nav .owl-next::before {
content: '\eac6';
}
.carousel-container .owl-nav .owl-prev:hover::before,
.carousel-container .owl-nav .owl-next:hover::before {
opacity: 1;
}
.carousel-container .owl-theme .owl-nav.disabled + .owl-dots {
margin-top: 65px;
}
.carousel-container .owl-dots .owl-dot {
display: inline-block;
margin: 0 5px !important;
border-radius: 50%;
}
.carousel-container .owl-dots .owl-dot span {
margin: 0;
background: var(--background-w);
-webkit-transition: all 0.35s ease-in-out;
-moz-transition: all 0.35s ease-in-out;
-ms-transition: all 0.35s ease-in-out;
-o-transition: all 0.35s ease-in-out;
transition: all 0.35s ease-in-out;
}
.carousel-container .owl-dots .owl-dot:hover span,
.carousel-container .owl-dots .owl-dot.active span {
background-color: var(--themebg);
}
/*---- SHARE-OFFER ----*/
#share-offer {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-1);
}
#share-offer .carousel-container {
margin-top: 65px;
}
#share-offer .carousel-container .owl-nav {
margin-top: 65px;
}
/*---- NEWSLETTER ----*/
#refferal {
margin: 0 0;
padding: 107px 0;
background-color: var(--background-2);
}
#refferal::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 50%;
height: 100%;
background-color: var(--themecolor);
}
html[dir=rtl] #refferal::before {
right: 0;
left: initial;
}
html[dir=rtl] #refferal #subscribe > div > div > div {
padding-right: initial !important;
padding-left: 30px;
text-align: right !important;
}
.subscribe-form {
position: relative;
}
.subscribe-form .form-control {
display: block;
height: 46px;
padding: 14px 25px;
color: var(--textcoloralt);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0.5px;
line-height: 46px;
border: 0;
border-radius: 23px;
background-color: #ffffff;
box-shadow: none !important;
}
.subscribe-form .btn-subscribe {
position: absolute;
top: 0;
right: -3px;
padding: 0 35px;
height: 46px;
line-height: 46px;
color: var(--textcolor);
font-size: 18px;
font-weight: 700;
font-family: var(--fontlato);
border: 0;
border-radius: 23px;
background-color: var(--background-1);
}
html[dir=rtl] .subscribe-form .btn-subscribe {
right: initial;
left: -3px;
}
.subscribe-form input.form-control::-webkit-input-placeholder,
.subscribe-form textarea.textarea-control::-webkit-input-placeholder {
color: var(--textcoloralt) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
.subscribe-form input.form-control:-moz-placeholder,
.subscribe-form textarea.textarea-control:-moz-placeholder {
color: var(--textcoloralt) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
.subscribe-form input.form-control::-moz-placeholder,
.subscribe-form textarea.form-control::-moz-placeholder {
color: var(--textcoloralt) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
.subscribe-form input.form-control:-ms-input-placeholder,
.subscribe-form textarea.textarea-control:-ms-input-placeholder {
color: var(--textcoloralt) !important;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: 0;
line-height: 1;
opacity: 1;
}
#refferal .refferal-offer {
padding-left: 65px;
}
html[dir=rtl] #refferal .refferal-offer {
padding-right: 65px;
padding-left: 0 !important;
text-align: right;
}
#refferal .refferal-offer .media-icon {
width: 50px;
height: 50px;
display: inline-flex;
align-items: center;
justify-content: center;
border: 1px solid var(--themecolor);
border-radius: 50%;
text-align: center;
}
html[dir=rtl] #refferal .refferal-offer .row .media .media-body {
margin-right: 20px;
margin-left: 0 important;
}
#refferal .refferal-offer .row .col-lg-6:nth-child(1),
#refferal .refferal-offer .row .col-lg-6:nth-child(2) {
margin-bottom: 30px;
}
@media (max-width: 991px) {
#refferal .refferal-offer .row .col-lg-6 {
margin-bottom: 30px;
}
#refferal .refferal-offer .row .col-lg-6:last-child {
margin-bottom: 0;
}
}
@media (max-width: 767px) {
#refferal::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 50%;
height: 100%;
background-color: rgba(253, 51, 76, 0.5);
}
#refferal .refferal-offer {
margin-top: 65px;
}
}
@media (max-width: 575px) {
#refferal::before {
display: none;
}
#refferal .refferal-offer {
padding-left: 0;
}
html[dir=rtl] #refferal .refferal-offer {
padding-right: 0;
}
}
/*---- BLOG ----*/
#blog {
margin: 0 0;
padding: 150px 0 120px;
background-color: var(--background-1);
}
#blog .blog-wrapper {
margin-top: 65px;
}
#blog .blog-wrapper .row .col-lg-4 {
margin-bottom: 30px;
}
.card-blog.card {
position: relative;
padding: 30px 30px;
border: 0;
border-radius: 4px;
background-color: var(--background-2);
box-shadow: none;
}
.card-blog .fig-container {
position: relative;
}
.card-blog .fig-container img {
border-radius: 4px;
width: 100%;
}
.card-blog .date-wrapper {
position: absolute;
top: 0;
right: 0;
min-width: 85px;
min-height: 85px;
display: inline-flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
border: 0;
border-radius: 4px;
background-color: var(--background-1);
}
@media (max-width: 991px) {
#blog .blog-wrapper .row .col-lg-4 {
margin-bottom: 30px;
}
#blog .blog-wrapper .row .col-lg-4:last-child {
margin-bottom: 30px;
}
}
/*---- FAQ ----*/
#faq {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-3);
}
#faq .faq-wrapper {
margin-top: 65px;
}
#faq .faq-wrapper .slider-controls {
margin-bottom: 70px !important;
}
#faq .faq-wrapper .slider-controls li a {
margin-right: 15px;
padding: 12px 30px;
color: var(--btncolor);
font-size: 16px;
font-weight: 700;
font-family: var(--fontlato);
text-align: center;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
border: 0;
border-radius: 23px;
background-color: var(--background-2);
transition: var(--transition);
}
#faq .faq-wrapper .slider-controls li a:hover,
#faq .faq-wrapper .slider-controls li a:focus,
#faq .faq-wrapper .slider-controls li a.active {
background-color: var(--themebg);
transition: var(--transition);
}
.slider-controls li:last-child a {
margin-right: 0;
}
.faq-card {
margin-bottom: 30px;
background-color: var(--background-2);
}
.faq-card:last-child {
margin-bottom: 0;
}
.faq-card .card-header {
padding: 15px 20px 15px 15px;
border: 0;
border-radius: 4px;
background-color: var(--background-2);
}
.faq-card .card-header button {
position: relative;
display: inline-block;
width: 100%;
color: var(--textcolor);
font-size: 20px;
font-weight: 500;
font-family: var(--fontubunto);
line-height: normal;
letter-spacing: normal;
text-align: left;
transition: var(--transition);
}
.faq-card .card-header button.rotate-icon {
transition: var(--transition);
}
.faq-card .card-header button::after {
content: '\eaca';
color: var(--textcolor);
font-family: IcoFont;
position: absolute;
top: 50%;
right: -5px;
-webkit-transform: translateY(-50%);
-moz-transform: translateY(-50%);
transform: translateY(-50%);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.faq-card .card-header button.rotate-icon::after {
color: var(--themecolor);
-webkit-transform: translateY(-50%) rotate(90deg);
-moz-transform: translateY(-50%) rotate(90deg);
-ms-transform: translateY(-50%) rotate(90deg);
-o-transform: translateY(-50%) rotate(90deg);
transform: translateY(-50%) rotate(90deg);
-webkit-transition: transform 0s ease;
-moz-transition: transform 0s ease;
-ms-transition: transform 0s ease;
-o-transition: transform 0s ease;
transition: transform 0s ease;
}
.faq-card .card-body {
display: none;
justify-content: center;
border-top: 0;
padding: 0;
overflow: hidden;
}
.faq-card .card-body .faq-content {
padding: 3px 15px 15px;
}
.faq-card .card-body p {
padding-top: 15px;
border-top: 1px solid var(--themecolor);
}
.faq-card .card-body.preview {
display: flex;
}
@media (max-width: 991px) {
#faq .faq-wrapper .slider-controls li a {
margin: 0 15px !important;
}
}
/*---- PAYMENT-METHOD ----*/
#payment-method {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-1);
}
#payment-method .carousel-container {
margin-top: 65px;
}
.carousel-payment .item-carousel .payment-fig,
.carousel-payment-rtl .item-carousel .payment-fig{
padding: 15px 15px;
display: flex;
justify-content: center;
border: 1px solid #898989;
border-radius: 4px;
}
.carousel-payment .item-carousel .payment-fig img,
.carousel-payment-rtl .item-carousel .payment-fig img{
width: auto !important;
max-width: 100% !important;
}
#payment-method .carousel-container .owl-nav {
margin-top: 65px;
}
/*---- FOOTER ----*/
#footer {
position: relative;
margin: 0 0;
padding: 150px 0 0;
background-color: var(--footerbg);
}
.footer-brand img {
max-width: 100%;
}
.footer-social .social-icon {
margin-right: 15px;
width: 55px;
height: 55px;
display: inline-flex;
align-items: center;
justify-content: center;
color: #ffffff;
font-size: 18px;
border: 1px solid var(--bordercolor);
border-radius: 50%;
background-color: transparent;
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.footer-social .social-icon:hover,
.footer-social .social-icon:focus {
color: var(--textcolor);
border-color: var(--themecolor);
background-color: var(--themebg);
-webkit-transition: var(--transition);
-moz-transition: var(--transition);
-ms-transition: var(--transition);
-o-transition: var(--transition);
transition: var(--transition);
}
.footer-social .social-icon:last-child {
margin-right: 0;
}
.footer-links ul {
margin-top: 35px !important;
-webkit-column-count: 2;
-moz-column-count: 2;
column-count: 2;
-webkit-column-gap: normal;
-moz-column-gap: normal;
column-gap: normal;
}
.footer-links ul li a {
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
.footer-address ul {
margin-top: 35px !important;
}
.footer-address ul li i {
color: var(--textcolor);
font-size: 20px;
}
html[dir=rtl] .footer-links,
html[dir=rtl] .footer-address {
text-align: right;
}
html[dir=rtl] .footer-social .social-icon:first-child {
margin-right: 0;
}
html[dir=rtl] .footer-social .social-icon:last-child {
margin-right: 15px;
}
html[dir=rtl] .footer-address ul li span {
margin-right: 10px;
margin-left: 0 !important;
}
.copy-rights {
margin: 150px 0 0;
padding: 30px 0;
background: var(--copyrightbg);
text-align: center;
}
.copy-rights p {
color: #ffffff;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato) !important;
letter-spacing: normal;
line-height: normal;
}
html[dir=rtl] .copy-rights p {
direction: rtl;
}
.copy-rights p a,
.copy-rights p a:hover,
.copy-rights p a:focus {
color: #ffffff;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato) !important;
letter-spacing: normal;
line-height: normal;
}
/*--------------------------------------------------------------------
PAGE STYLES - ABOUT PAGE
----------------------------------------------------------------------*/
#page-banner {
position: relative;
background-image: linear-gradient(90deg, var(--overlay-3) 0%, var(--overlay-3) 100%), url('../images/pagebanner.jpg');
background-position: center center;
background-size: cover;
background-repeat: no-repeat;
background-color: var(--background-1);
}
#page-banner .page-header {
position: relative;
padding: 115px 0;
display: flex;
flex-flow: column wrap;
align-items: center;
justify-content: center;
text-align: center;
}
#page-banner .page-breadcrumb {
position: relative;
bottom: -35px;
z-index: 1;
}
#page-banner .page-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
position: relative;
bottom: -2px;
display: inline-block;
padding-right: .5rem;
padding-left: .5rem;
color: #fff;
content: "\eab8";
font-family: IcoFont;
vertical-align: text-bottom;
}
html[dir=rtl] #page-banner .page-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
content: "\ea9d";
}
#page-banner .page-breadcrumb .breadcrumb {
padding: 23px !important;
border: 0;
border-radius: 4px;
background-color: var(--background-b);
}
#page-banner .page-breadcrumb .breadcrumb a {
color: #ffffff;
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
}
#feature.about-page {
margin: 0 0;
padding: 188px 0 150px;
}
#feature.about-page .feature-wrapper {
top: initial;
}
/*---- ABOUT-US ----*/
#about-us.about-page {
padding: 210px 0 100px
}
#about-us.about-page .text-wrapper {
top: -60px;
}
#about-us.about-page .text-wrapper .about-feature .media .media-icon {
border: 1px solid var(--themebordercolor);
transition: var(--transition);
}
#about-us.about-page .text-wrapper .about-feature .media:hover .media-icon {
background-color: var(--themebg);
transition: var(--transition);
}
/*---- OURFEATURE ----*/
#ourfeature {
margin: 0 0;
padding: 150px 0;
background-color: var(--background-1);
}
#ourfeature .feature-wrapper {
top: initial;
}
#ourfeature .feature-wrapper .card-type-1 {
background-image: none;
border: 1px solid #898989;
background-color: var(--background-1);
transition: var(--transition);
}
#ourfeature .feature-wrapper .card-type-1:hover {
border-color: var(--themecolor);
transition: var(--transition);
}
/*---- COUNTER ----*/
.counter-wrapper {
position: relative;
float: left;
width: 100%;
}
.counter-wrapper .row .col-sm-6:nth-child(1),
.counter-wrapper .row .col-sm-6:nth-child(2) {
margin-bottom: 30px;
}
.counting {
text-align: center;
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
}
.counter-wrapper .counting .counter-icon {
width: 75px;
height: 75px;
display: inline-flex;
align-items: center;
justify-content: center;
border: 1px solid var(--bordercolor);
border-radius: 50%;
transition: var(--transition);
}
.counter-wrapper .counting .counter-icon:hover {
background-color: var(--background-1);
border-color: #0f143a;
transition: var(--transition);
}
.counter-heading {
display: flex;
align-items: center;
justify-content: space-between;
}
.counting p {
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
line-height: normal;
letter-spacing: normal;
text-transform: capitalize;
}
/*--------------------------------------------------------------------
PAGE STYLES - INVESTOR PAGE
----------------------------------------------------------------------*/
#investor.investor-page {
margin: 0 0;
padding: 188px 0 120px;
}
#investor .investor-wrapper .row .col-lg-3 {
margin-bottom: 30px;
}
/*--------------------------------------------------------------------
PAGE STYLES - OFFERPLAN PAGE
----------------------------------------------------------------------*/
#share-offer.offerplan-page {
margin: 0 0;
padding: 188px 0 120px;
}
#share-offer.offerplan-page .investment-wrapper {
margin-top: 65px;
}
#share-offer.offerplan-page .investment-wrapper .row .col-lg-4 {
margin-bottom: 30px;
}
/*--------------------------------------------------------------------
PAGE STYLES - BLOG ALL PAGES
----------------------------------------------------------------------*/
#blog.blog-sidebar-page .row .col-lg-8 .card-blog {
margin-bottom: 30px;
}
.blog-sidebar {
position: relative;
background-color: var(--background-1);
}
.sidebar-wrapper {
position: relative;
padding: 30px 28px;
border: 1px solid #a1a1a1;
border-radius: 4px;
}
.blog-sidebar .sidebar-wrapper .h6 {
font-size: 20px;
}
.post-search .form-group {
position: relative;
margin-bottom: 0;
}
.post-search .form-group .form-control {
height: 48px;
padding: 15px 15px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
border: 1px solid var(--bordercolor);
border-radius: 4px;
background-color: var(--background-1);
transition: var(--transition);
}
.post-search .form-group .form-control:hover {
border-color: var(--themebordercolor);
transition: var(--transition);
}
.post-search .form-group .form-control:hover ~ .btn-search {
color: var(--themecolor);
transition: var(--transition);
}
.post-search .form-group .btn-search {
position: absolute;
top: 0;
right: 0;
height: 48px;
padding: 12px 15px;
color: var(--textcolor);
border-radius: 0 4px 4px 0;
transition: var(--transition);
}
.blog-categories li {
margin-bottom: 15px;
}
.blog-categories li:last-child {
margin-bottom: 0;
}
.blog-categories li a {
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
transition: var(--transition);
}
.blog-categories li a:hover {
color: var(--themecolor);
transition: var(--transition);
}
.recent-post .media {
margin-bottom: 20px;
}
.recent-post .media:last-child {
margin-bottom: 0;
}
.recent-post .media .media-body {
overflow: hidden;
}
.recent-post .text,
.blog-related-post .row .col-md-6 .media .text {
line-height: 26px;
transition: var(--transition);
}
.recent-post .media:hover .hover-text,
.blog-related-post .row .col-md-6 .media:hover .hover-text {
color: var(--themecolor);
transition: var(--transition);
}
.tags-wrapper {
display: flex;
flex-flow: row wrap;
}
.tag-link {
display: inline-block;
margin: 0 8px 8px 0;
padding: 10px 15px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
border: 0;
border-radius: 4px;
background-color: var(--background-2);
transition: var(--transition);
}
.tag-link:hover,
.tag-link:focus {
padding: 10px 15px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
background-color: var(--themebg);
transition: var(--transition);
}
.blockqoute {
position: relative;
margin: 30px 0 !important;
padding: 25px 50px;
color: var(--textcolor);
font-size: 18px;
font-weight: 400;
line-height: 1.5;
font-family: var(--fontubunto);
text-align: center;
border: 0;
border-radius: 4px;
background-color: var(--background-1);
}
.blockqoute i {
color: var(--textcolor);
font-size: 36px;
font-family: IcoFont;
}
.blog-tags .tag-link {
margin-right: 10px;
margin-bottom: 0;
padding: 5px 10px;
border: 1px solid var(--bordercolor);
border-radius: 4px;
}
.blog-tags .tag-link:last-child {
margin-right: 0;
}
.blog-tags .tag-link:hover,
.blog-tags .tag-link:focus {
border-color: var(--themecolor);
}
.blog-social .social-icon {
margin-right: 10px;
display: inline-flex;
align-items: center;
justify-content: center;
width: 35px;
height: 35px;
color: var(--textcolor);
font-size: 15px;
border: 1px solid var(--bordercolor);
border-radius: 50%;
transition: var(--transition);
}
.blog-social .social-icon:hover {
color: var(--textcolor);
border-color: var(--themecolor);
background-color: var(--themecolor);
}
.blog-related-post > .h6,
.blog-comments-wrapper > .h6,
.leaves-comment > .h6 {
padding-bottom: 25px !important;
font-size: 20px;
border-bottom: 1px solid #a1a1a1;
}
.blog-related-post .row .col-md-6 {
margin-top: 25px;
}
.blog-comments-wrapper > .media > .media-body > .reply > .textarea-control {
background-color: var(--background-1);
transition: var(--transition);
}
.blog-comments-wrapper > .media > .media-body > .reply > .textarea-control:hover {
border-color: var(--themecolor);
transition: var(--transition);
}
.btn-reply,
.btn-reply:hover,
.btn-reply:focus {
color: var(--themecolor);
font-size: 15px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
.reply {
display: none;
}
.blog-comments-wrapper > .media > .media-body > .star-ratings i {
color: gold;
font-size: 14px;
}
.btn-reply-comment {
padding: 6px 25px;
color: var(--textcolor);
font-size: 13px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
border: 1px solid var(--bordercolor);
border-radius: 17px;
transition: var(--transition);
}
.btn-reply-comment:hover,
.btn-reply-comment:focus {
border-color: var(--themebordercolor);
background-color: var(--themebg);
transition: var(--transition)
}
.badge_lavel_style{
border: 1px solid !important;
padding: 3px 8px !important;
}
.leaves-comment .form-control {
height: 48px;
padding: 15px 15px;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
border: 1px solid var(--bordercolor);
border-radius: 4px;
background-color: var(--background-1);
transition: var(--transition);
}
.leaves-comment .form-control:hover {
border-color: var(--themebordercolor);
transition: var(--transition);
}
.leaves-comment .textarea-control {
display: block;
width: 100%;
max-height: 100px;
padding: 15px 15px;
color: var(--textcolor);
font-size: 16px;
font-family: var(--fontlato);
border: 1px solid #dfdfdf;
border-radius: 4px;
background-color: var(--background-1);
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.leaves-comment .textarea-control:hover,
.leaves-comment .textarea-control:focus {
box-shadow: none;
border: 1px solid var(--themecolor);
-webkit-transition: border 0.35s ease;
-moz-transition: border 0.35s ease;
-ms-transition: border 0.35s ease;
-o-transition: border 0.35s ease;
transition: border 0.35s ease;
}
.btn-post-comment {
padding: 10px 25px;
color: var(--textcolor);
font-size: 14px;
font-weight: 500;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
border: 1px solid var(--bordercolor);
border-radius: 23px;
transition: var(--transition);
}
.btn-post-comment:hover,
.btn-post-comment:focus {
padding: 10px 25px;
color: var(--textcolor);
font-size: 14px;
font-weight: 500;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
border: 1px solid var(--themebordercolor);
background-color: var(--themebg);
transition: var(--transition)
}
#pagination {
margin-top: 30px;
display: flex;
align-items: center;
justify-content: center;
}
.page-item {
margin-left: 15px;
}
#pagination .page-item.active{
background: <?php echo  $themeColor;?>;
border-radius: 4px;
}

.page-item:first-child {
margin-left: 0;
}
html[dir=rtl] .page-item:first-child {
margin-left: 15px;
}
html[dir=rtl] .page-item:last-child {
margin-left: 0;
}
.page-link i {
color: var(--textcolor);
font-weight: 800;
}
.page-link,
.page-link:hover,
.page-link:focus {
padding: 7.5px 15px;
color: var(--themecolor-1);
font-size: 18px;
font-weight: 400;
font-family: var(--fontlato);
margin-left: initial !important;
border: 1px solid var(--themebordercolor);
border-radius: 4px !important;
background-color: transparent;
box-shadow: none;
}

.page-item.disabled .page-link {
color: #ffffff;
background-color: #0f143a;
opacity: 0.6;
border-color: var(--themebordercolor);
}


<!--sidebar level box-->
#sidebar .scroll-sidebar {
max-height: 500px;
}

#sidebarBadge .wallet-wrapper .wallet-box {
border-radius: 10px;
margin: 20px 0 20px 0;
position: relative;
z-index: 1;
}

#sidebarBadge .wallet-box h4 {
font-size: 20px;
margin-bottom: 10px !important;
}
#sidebarBadge .wallet-box h5 {
font-size: 16px;
margin-bottom: 10px !important;
display:flex;
justify-content: space-between;
}

#sidebarBadge .wallet-box h5 span {
float: right;
}
#sidebarBadge .wallet-box h5:last-child {
margin-bottom: 0;
}
#sidebarBadge .wallet-box .tag {
background: var(--primary);
float: right;
background: #ffce00;
color: var(--white);
font-size: 12px;
padding: 2px 6px;
border-radius: 2px;
}
#sidebarBadge .wallet-wrapper {
margin: 10px;
}
#sidebarBadge .wallet-wrapper .btn-custom {
height: 35px;
width: 115px;
font-size: 14px;
font-weight: 500;
text-transform: capitalize;
color: #ffffff;
border-radius: 3px;
text-align: center;
padding-top: 3px
}
#sidebarBadge .wallet-wrapper .btn-custom:first-child {
background: var(--themecolor);
}
#sidebarBadge .wallet-wrapper .btn-custom:last-child {
background: #202b5d;
}
#sidebarBadge .level-box {
margin: auto;
width: 150px;
height: 150px;
border-radius: 300px;
padding-top: 46px;
text-align: center;
border: 2px solid #26cc8c;
position: relative;
}
#sidebarBadge .level-box .level-badge {
position: absolute;
top: 0px;
right: 0px;
width: 42px;
}
#sidebarBadge .level-box h4 {
margin-bottom: 5px;
}

/*dashboard badge area*/
.badge-box {
background-color: #202b5d;
position: relative;
border-radius: 10px;
padding: 30px;
z-index: 1;
text-align: center;
margin-bottom: 25px;
}

.badge-box.locked::after {
content: "";
position: absolute;
width: 100%;
height: 100%;
left: 0;
bottom: 0;
background: rgba(255, 255, 255, 0.6);
z-index: 2;
border-radius: 10px;
}
.badge-box .lock-icon {
display: none;
}
.badge-box.locked .lock-icon {
display: block;
position: absolute;
right: 20px;
top: 30px;
color: var(--primary);
z-index: 3;
}
.badge-box.locked .lock-icon i {
font-size: 18px;
}
.badge-box img {
margin-bottom: 15px;
}
.badge-box h5 {
margin-bottom: 10px !important;
font-size: 16px;
}
.badge-box h5 span {
float: right !important;
}
.badge-box h5:last-child {
margin-bottom: 0;
}



.page-item.active .page-link {
color: #ffffff;
border-color: var(--themebordercolor);
background-color: transparent;
}
@media (max-width: 991px) {
#blog.blog-sidebar-page .row .col-lg-8 {
order: 2;
}
#blog.blog-sidebar-page .row .col-lg-4 {
order: 1;
margin-bottom: 30px;
}
}
/*--------------------------------------------------------------------
PAGE STYLES - POLICY
----------------------------------------------------------------------*/
#policy {
margin: 0 0;
padding: 188px 0 150px;
background-color: var(--background-1);
}
#policy .policy {
margin-top: 65px;
}
ol.policy-list {
counter-reset: list;
margin: 0 !important;
padding: 0 0 0 30px !important;
}
ol.policy-list > li {
list-style: none;
position: relative;
color: var(--textcolor);
font-size: 14px;
font-family: var(--fontlato);
line-height: 27px;
letter-spacing: 0.5px;
}
ol.policy-list > li:before {
counter-increment: list;
content: counter(list, decimal) ") ";
position: absolute;
left: -30px;
}
.policy-list li {
margin-bottom: 15px;
}
.policy-list li:last-child {
margin-bottom: 0;
}
/*--------------------------------------------------------------------
PAGE STYLES - CONTACT
----------------------------------------------------------------------*/
#contact {
margin: 0 0;
padding: 188px 0 150px;
background-color: var(--background-1);
}
.contact-wrapper {
position: relative;
padding: 130px 0;
border: 0;
border-radius: 20px;
}
.contact-wrapper::before {
content: '';
position: absolute;
top: 0;
left: 0;
width: 100%;
height: calc(100% - 200px);
border: 0;
border-radius: 20px;
background: linear-gradient(90deg, var(--themebg) 0%, var(--themebg) 100%);
}
.contact-info {
padding: 60px 60px;
border: 0;
border-radius: 20px;
background-color: var(--background-2);
}
#contact .form-wrapper {
margin: 20px 0 0 32.5px;
padding: 40px 38px;
border: 0;
border-radius: 20px;
background-color: var(--background-2);
}
.contact-form .form-group {
margin-bottom: 45px !important;
}
.contact-form .form-control {
height: 48px;
background-color: var(--background-2);
color: #fff;
}

.contact-form .textarea-control {
background-color: var(--background-2);
}

.contact-form .textarea-control:focus,
.contact-form .textarea-control:visited,
.contact-form .form-control:focus,
.contact-form .form-control:visited{
color: #fff;
}
.contact-form .btn-contact {
display: inline-block;
width: 100%;;
padding: 15px 30px;
color: var(--themecolor);
font-size: 16px;
font-weight: 500;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
text-transform: uppercase;
text-align: center;
border: 0;
border-radius: 4px;
background-color: var(--background-w);
transition: var(--transition);
}
.contact-form .btn-contact:hover,
.contact-form .btn-contact:focus {
color: var(--btncolor);
background-color: var(--themebg);
transition: var(--transition);
}
html[dir=rtl] .contact-form .form-group .h6 {
text-align: right;
}
html[dir=rtl] .contact-info .h4 {
text-align: right;
}
html[dir=rtl] .contact-info .media .media-body {
margin-right: 20px;
margin-left: 0 !important;
}
html[dir=rtl] .contact-info .media .media-body p {
text-align: right;
}
@media (max-width: 991px) {
.contact-wrapper::before {
height: 75%;
}
#contact .form-wrapper {
margin-top: 65px;
margin-left: 0;
}
}
/*--------------------------------------------------------------------
PAGE STYLES - DASHBOARD PAGE
----------------------------------------------------------------------*/
/*---- DASHBOARD PAGE LAYOUT ----*/
#dashboard-page-layout.theme-dark {
height: 100%;
position: relative;
display: flex;
flex-direction: column;
flex-wrap: nowrap;
background-color: var(--background-1);
/* overflow: hidden; */
}
.theme-dark #page-container {
padding: 0 0;
display: flex;
flex-direction: row;
flex-wrap: nowrap;
/* overflow: hidden; */
}
#dashboard-page-layout.theme-dark #page-container #sidebar {
position: relative;
padding: 55px 15px 0;
width: 320px;
height: 100%;
min-height: 100vh;
background-color: var(--background-1);
/* overflow: hidden; */
}
#dashboard-page-layout.theme-dark #page-container #dashboard {
position: relative;
margin: 0;
padding: 0;
float: left;
width: calc(100% - 320px);
background-color: var(--background-1);
/* overflow: hidden scroll; */
}
#dashboard-page-layout.theme-dark #page-container #dashboard .dashboard-wrapper {
padding: 55px 15px 0;
}
/*---- PAGE-NAVIGATOR ----*/
#page-navigator {
margin: 0;
padding: 5px 0;
background-color: var(--background-3);
}
#page-navigator .breadcrumb {
border: 0;
border-radius: 0;
background-color: var(--background-3);
}
#page-navigator .breadcrumb .breadcrumb-item {
align-items: center;
}
#page-navigator .breadcrumb-item + .breadcrumb-item::before {
display: inline-block;
padding-right: .5rem;
padding-left: .5rem;
color: #fff;
content: "\eab8";
font-family: Icofont;
vertical-align: middle;
}
html[dir=rtl] #page-navigator .breadcrumb-item + .breadcrumb-item::before {
content: '\ea9d';
}
#page-navigator .breadcrumb a {
color: var(--textcolor);
font-size: 13px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
/*---- DASHBOARD-NAV ----*/
.dashboard-nav {
padding: 30px 15px;
border: 1px solid var(--bordercolor);
border-radius: 4px;
}
.dashboard-nav .nav-item {
position: relative;
margin-bottom: 15px;
padding: 0 0;
display: flex;
align-items: center;
justify-content: space-between;
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
transition: var(--transition);
}
.dashboard-nav .nav-item:last-child {
margin-bottom: 0;
}
.dashboard-nav .nav-item:hover,
.dashboard-nav .nav-item:focus {
color: var(--themecolor);
transition: var(--transition);
}
.dashboard-nav .nav-item.active::before,
.dashboard-nav .nav-item::before {
content: '';
position: absolute;
top: 0;
left: -30px;
width: 0;
height: 50px;
border: 0;
border-radius: 0 0 25px 0;
background-color: var(--themebg);
z-index: 0;
transition: width 0.35s ease-in-out;
}
html[dir=rtl] .dashboard-nav .nav-item.active::before,
html[dir=rtl] .dashboard-nav .nav-item::before {
right: -30px;
left: initial;
}
.dashboard-nav .nav-item.active::before,
.dashboard-nav .nav-item:hover::before {
width: 90px;
transition: width 0.35s ease-in-out;
}
.dashboard-nav .nav-item .icon-wrapper {
display: flex;
align-items: center;
}
.dashboard-nav .nav-item .icon-wrapper .nav-icon {
position: relative;
padding: 10px 15px 10px 10px;
border: 0;
border-radius: 0 0 25px 0;
}
.dashboard-nav .nav-item .icon-wrapper .nav-icon img {
position: relative;
z-index: 1;
max-height: 30px;
max-width: 35px;
}
.dashboard-nav .nav-item .icon-wrapper span {
margin-left: 20px;
}
html[dir=rtl] .dashboard-nav .nav-item .icon-wrapper span {
margin-right: 20px;
margin-left: 0;
}
/*---- SIDENAVBAR | DASHBOARD-NAV ----*/
#sidenavbar {
position: fixed;
top: 0;
left: -330px;
width: 320px;
height: 100%;
min-height: 100vh;
padding-bottom: 50px;
background-color: var(--background-1);
box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.25);
z-index: 99999;
transition: var(--transition);
}
#sidenavbar .sidenav-header {
text-align: right;
}
#sidenavbar .sidenav-header .sidenav-close {
padding: 10px 15px 10px 10px;
color: var(--themecolor);
font-size: 24px;
font-weight: 400;
font-family: var(--fontlato);
cursor: pointer;
}
#sidenavbar .sidenavbar-wrapper {
height: 100%;
overflow: hidden scroll;
}
#sidenavbar .sidenavbar-wrapper .dashboard-nav {
border: 0;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper {
position: relative;
border: 0;
border-radius: 5px;
background-image: url('../images/shapes/shape-img-1.png');
background-repeat: no-repeat;
background-position: bottom right;
background-size: 100% 100%;
background-color: var(--themebg);
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container {
padding: 15px 15px;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container .content-icon img {
max-width: 45px;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container .content-block {
padding: 50px 0 50px 15px;
}
#dashboard #container {
background-color: var(--background-4);
}
#dashboard #container .highcharts-axis .highcharts-axis-title {
color: var(--textcolor) !important;
font-size: 16px !important;
font-weight: 400 !important;
font-family: var(--fontlato) !important;
fill: var(--textcolor) !important;
}
#dashboard #container .highcharts-axis-labels text {
color: var(--textcolor) !important;
font-size: 14px !important;
font-weight: 400 !important;
font-family: var(--fontlato) !important;
fill: var(--textcolor) !important;
}
#dashboard #container .highcharts-legend-item text {
color: var(--textcolor) !important;
font-size: 16px !important;
font-weight: 400 !important;
font-family: var(--fontlato) !important;
fill: var(--textcolor) !important;
}
#dashboard .chart-information .progress-wrapper {
padding: 30px 15px;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
background-color: var(--background-4);
}
#dashboard .chart-information .progress-wrapper .cp_2 {
margin: 0 40px;
}
#dashboard .dashboard-wrapper .balance-information .content-wrapper {
position: relative;
border: 0;
border-radius: 5px;
background-image: url('../images/shapes/shape-img-2.png');
background-repeat: no-repeat;
background-position: bottom left;
background-size: 100% 100%;
background-color: var(--background-2);
}
#dashboard .dashboard-wrapper .balance-information .content-wrapper .content-container {
padding: 40px 15px;
}
#dashboard .dashboard-wrapper .refferal-information .content-wrapper {
position: relative;
border: 0;
border-radius: 5px;
background-color: var(--background-4);
}
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .content-container {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
padding: 15px 15px;
}
#dashboard .dashboard-wrapper .balance-information .content-wrapper .content-container .content-icon,
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .content-container .content-icon {
position: relative;
width: 75px;
height: 75px;
min-height: 75px;
max-height: 75px;
display: inline-flex;
align-items: center;
justify-content: center;
border: 0;
border-radius: 50%;
background-color: var(--themebg);
}
#dashboard .dashboard-wrapper .balance-information .content-wrapper .content-container .content-icon img,
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .content-container .content-icon img {
max-width: 50px;
}
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .img-container,
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .img-container img {
min-height: 120px;
}
html[dir=rtl] #dashboard .dashboard-wrapper .refferal-information .form-group.form-block h5 {
text-align: right;
}
html[dir=rtl] #dashboard .dashboard-wrapper .refferal-information .input-group .form-control {
border-radius: 0 4px 4px 0;
}
html[dir=rtl] #dashboard .dashboard-wrapper .refferal-information .input-group .input-group-append {
margin-left: initial;
margin-right: -1px;
}
html[dir=rtl] #dashboard .dashboard-wrapper .refferal-information .input-group .input-group-append .input-group-text {
border-radius: 4px 0 0 4px;
}
html[dir=rtl] #dashboard .dashboard-wrapper .refferal-information .content-container .media .media-body {
margin-right: 20px;
margin-left: 0 !important;
}
.dashboard-footer {
margin: 50px 0 0;
padding: 50px 0;
border-top: 1px solid var(--bordercolor);
}
.db-footer-nav li {
margin-left: 20px;
}
.db-footer-nav li:first-child {
margin-left: 0;
}
.db-footer-nav li a {
color: var(--textcolor);
font-size: 16px;
font-weight: 400;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
}
@media(max-width: 1366px) {
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container .content-main-block {
flex-direction: column;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container .content-block {
padding: 30px 0;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container .content-block .h4,
#dashboard .dashboard-wrapper .balance-information .content-wrapper .content-container .content-block .h4 {
font-size: 24px;
}
}
@media(max-width: 1199px) {
#dashboard .dashboard-nav {
margin-bottom: 50px;
}
#dashboard .audit-information .row .col-lg-6:nth-child(1),
#dashboard .audit-information .row .col-lg-6:nth-child(2) {
margin-bottom: 30px;
}
#dashboard .chart-information .row .col-xl-6:first-child {
margin-bottom: 30px;
}
#dashboard .balance-information .row .col-lg-6:nth-child(1),
#dashboard .balance-information .row .col-lg-6:nth-child(2) {
margin-bottom: 30px;
}
#dashboard .dashboard-wrapper .audit-information .content-wrapper .content-container {
text-align: center;
}
}
@media (max-width: 991px) {
#sidebar {
display: none;
}
#dashboard-page-layout.theme-dark #page-container #dashboard {
width: 100% !important;
}

}
@media(max-width: 767px) {
#dashboard .refferal-information .row .col-md-6 {
margin-bottom: 30px;
}
#dashboard .refferal-information .row .col-md-6:last-child {
margin-bottom: 0;
}
}
@media(max-width: 575px) {
#dashboard .audit-information .row .col-sm-6,
#dashboard .balance-information .row .col-sm-6,
#dashboard .refferal-information .row .col-md-6 {
margin-bottom: 30px;
}
#dashboard .audit-information .row .col-sm-6:last-child,
#dashboard .balance-information .row .col-sm-6:last-child,
#dashboard .refferal-information .row .col-md-6:last-child {
margin-bottom: 0;
}
#dashboard .dashboard-wrapper .refferal-information .content-wrapper {
background-image: url('../images/shapes/shape-img-3.png');
background-position: 0 0;
background-size: contain;
background-repeat: repeat-y;
}
#dashboard .dashboard-wrapper .refferal-information .content-wrapper .content-container {
position: relative;
}
#dashboard .chart-information .progress-wrapper .cp_2 {
margin: 0 0;
}
}
/*--------------------------------------------------------------------
RESPONSIVE - FOR ALL SCREENS
----------------------------------------------------------------------*/
@media (max-width: 1199px) {
}
@media (max-width: 991px) {
/*------ BLOG ------*/
.blog-wrapper .row .col-lg-4 {
margin-bottom: 60px;
}
.blog-wrapper .row .col-lg-4:last-child {
margin-bottom: 0;
}
.card-blog .fig-container {
width: 100%;
}
.card-blog .card-body {
text-align: center;
}
.card-blog .card-body .blog-date {
justify-content: center;
}
.card-blog .card-body .blog-comments {
justify-content: center;
}
#blog .blog-sidebar {
margin-top: 30px;
}
/*------ FOOTER ------*/
.responsive-footer .col-sm-6:nth-child(1) {
margin-bottom: 60px;
}
.responsive-footer .col-sm-6:nth-child(2) {
margin-bottom: 60px;
}
}
@media (max-width: 767px) {
/*------ TOPBAR ------*/
.mt-ms-30 {
margin-top: 30px !important;
}
.justify-content-xs-center {
justify-content: center !important;
}
.hero-content > div {
text-align: center;
}
/*------ BANNER-WRAP ------*/
#banner-wrap .content {
text-align: center;
}
#banner-wrap .content .h3,
#banner-wrap .content p {
width: 100%;
}
}
@media (max-width: 575px) {
/*------ FONTS ------*/
.p,
.text {
font-size: 13px;
}
.h1 {
font-size: 40px;
}
.h2 {
font-size: 36px;
}
.h3 {
font-size: 30px;
}
.h4 {
font-size: 24px;
}
.h5 {
font-size: 20px;
}
.h6 {
font-size: 16px;
}
.mt-xs-15 {
margin-top: 15px;
}
.mr-xs-0 {
margin-right: 0 !important;
}
.mb-xs-10 {
margin-bottom: 10px !important;
}
.ml-xs-0 {
margin-left: 0 !important;
}
.flex-xs-column {
flex-direction: column !important;
}
.card-type-1 > .card-body > .card-title {
font-size: 20px;
}
.card-type-1 > .card-body > .card-text {
font-size: 13px;
}
.card-blog .card-body .card-title {
font-size: 20px;
}
.footer-address li span {
font-size: 15px;
}
.footer-address .media .media-text {
font-size: 15px;
}
.footer-brand p {
font-size: 14px;
}
.footer-links h5 {
font-size: 18px;
}
.footer-links .nav-link {
font-size: 14px;
}
}





/*******Custom CSS*********/

#feature .nav-link {
position: relative;
background: transparent;
margin-bottom: 20px;
border: 1px solid #fff;
color: #ffff;
transition: var(--transition);
display: block;
}
#feature .nav-link:hover,
#feature .nav-link.active {
background:var(--themebg) !important;
color:#fff;
}
#feature .nav-link::after {
content:"";
height:20px;
width:2px;
background:#fff;
position: absolute;
top:100%;
left:calc(50% - 1px);
}
#feature .nav-link:last-child::after {
display: none;
}
#feature .tab-content {
flex: 1;
display: block;
border:1px solid #fff;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
height: 100%;
margin-left: 20px;
padding:15px;
}

#feature .card-body .nav {
flex-direction: column;
text-align:center;
}
@media screen and (max-width: 575px) {
#feature .card-body > div {
flex-direction: column;
}
#feature .card-body .nav {
flex-direction: row;
flex-wrap: wrap;
}
#feature .card-body .nav .nav-link {
flex:1;
min-width: 90px;
margin: 5px;
}
#feature .nav-link::after {
display: none;
}
#feature .tab-content {
width:100%;
margin-left:0;
margin-top:5px;
}
}

.feature-wrapper.add-fund .card-type-1 {
border-radius: 10px;
background-position: bottom;
background-repeat: no-repeat;
box-shadow: none;
padding: 25px 25px;
}

.feature-wrapper.add-fund .card-type-1 .card-icon {
position: relative;
padding: 0;
display: inline-flex;
align-items: center;
justify-content: center;
text-align: center;
border: unset;
border-radius: unset;
}

div#wait {
position: absolute;
z-index: 999;
height: 100vh;
width: 100vw;
display: flex;
justify-content: center;
align-items: center;
}

.modal-content.form-block{
background-color: #131e51 !important;
}


.modal-content.form-block .form-control ,
.card.form-block .form-control{
height: 50px;
padding: 15px 20px !important;
color: var(--textcolor);
font-size: 16px;
font-weight: 300;
font-family: var(--fontlato);
letter-spacing: normal;
line-height: normal;
background-color: var(--background-l);
}

input[type="date"]::-webkit-calendar-picker-indicator {
cursor: pointer;
border-radius: 4px;
margin-right: 2px;
opacity: 0.6;
filter: invert(0.8);
}

input[type="date"]::-webkit-calendar-picker-indicator:hover {
opacity: 1
}

.modal-content.form-block .input-group-text{
color: var(--textcolor);
background-color: var(--background-l);
}

.colorbg-1.addFund,
.colorbg-1.addFund:hover,
.colorbg-1.addFund:active,
.colorbg-1.addFund:focus
{
background-color: <?php echo  $themeColor;?>!important;
border-color: <?php echo  $themeColor;?>!important;
color: #fff;
}

.base-btn,
.base-btn:hover,
.base-btn:active,
.base-btn:focus
{
background-color: <?php echo  $themeColor;?>!important;
border-color: <?php echo  $themeColor;?>!important;
color: #fff;
}
.cursor-inherit{
cursor: inherit;
}

.card.secbg .table td, .table th,
.card.secbg .table thead th
{
border-top: 1px solid #0f143a;
}
.card.secbg .table thead th {
vertical-align: bottom;
border-bottom: 2px solid #0f143a;
}

.card.secbg .table-hover tbody tr:hover {
color: #fff;
}


.card.secbg .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
color: #fff;
}


.card.secbg .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
color: #fff;
background-color: #131e51;
border-color: #dee2e6 #dee2e6 #fff;
}

.font-20{font-size: 20px}
.font-18{font-size: 18px}



.image-input {
position: relative;
width: 100%;
min-height: 300px;
background: #f0f8ff;
}

.image-input #image {
position: absolute;
opacity: 0;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 10;
cursor: pointer;
}

.image-input #image-label {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
padding: 70px 100px;
z-index: 5;
opacity: 0.3;
cursor: pointer;
background-color: #fff;
font-size: 25px;
border: 2px dashed #000;
margin: auto;
text-align: center;
}

.image-input .preview-image {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
max-width: 150px;
}

.bg-danger {
background-color: <?php echo  $themeColor;?>!important;
}


.btn-danger,
.btn-danger:hover,
.btn-danger:active,
.btn-danger:focus,
.btn-danger:visited
{
color: #fff;
background-color: <?php echo  $themeColor;?>;
border-color: <?php echo  $themeColor;?>;
}


.btn-success,
.btn-success:hover,
.btn-success:active,
.btn-success:focus
{
color: #fff;
background-color: #2ecc71;
border-color: #2ecc71;
}







/**Global for this css **/

#Notiflix-Icon-Success,
#Notiflix-Icon-Failure,
#Notiflix-Icon-Warning
{
fill: #fff !important;
}
[v-cloak] {
display: none;
}

.copytext{
background: <?php echo  $themeColor;?>;
color: #fff;
cursor: pointer;
}

@media screen and (max-width: 767px) {
table {
border: 0;
}
table thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table tr {
display: block;
margin-bottom: .625em;
}
table td {
border-bottom: none;
display: block;
font-size: .8em;
text-align: right;
}
table td::before {
content: attr(data-label);
float: left;
font-weight: bold;
}
table td:last-child {
border-bottom: 0;
}
}




/*Support Ticket*/

.chat-list .chat-item .chat-content .msg {
background-color: rgba(255,255,255,0.11);
font-size: 14px;
max-width: 95%;
border-radius: 6px;
margin-top: 5px;
}

li.chat-item.list-style-none.replied.mt-3.text-right {
display: flex;
flex-direction: row-reverse;
}
.chat-img {
padding-top:9px;
}
.chat-list .chat-item.replied .chat-img {
margin-left: 15px;
}

.chat-list .chat-item.replied .chat-content .msg{
text-align: left;
}



.button-wrapper span.label {
position: relative;
z-index: 0;
background: #00bfff;
cursor: pointer;
color: #fff;
font-size: 18px;
}
#upload {
opacity: 0;
cursor: pointer;

}
.new-file-upload {
position: relative;
padding: 0;
display: flex;
align-items: center;
justify-content: center;
line-height: initial;
overflow: hidden;
width: 42px;
height: 42px;
border-radius: 50%;
background-color: #5f76e8;
cursor: pointer;
}
.new-file-upload input[type=file] {
position: absolute;
top: 0;
left: 0;
width: 42px;
height: 42px;
border-radius: 50%;
cursor: pointer;
}
.new-file-upload span,
.new-file-upload span::before{
cursor: pointer;
}
.upload-btn{
position: relative;
}
.new-file-upload a{
color: #fff;
}

.select-files-count{
position: absolute;
font-size: 12px;
white-space: nowrap;
right: 20px;
}
.ticket-box
{
height:200px;
max-height: initial;
background: #131e51;
}
button[name="replayTicket"]{
border-radius: 50%;
}
.card.form-block .form-control {
height:120px;
}
.card-body-inner {
border: 1px solid rgba(0,0,0,.125);
}
.card-body-buttons {
height: 100%;
display: flex;
align-items: center;
justify-content: center;
}
.submit-btn button {
background: limegreen;
padding:9px 13px;
border-radius: 50%;
color: white;
border:1px solid limegreen;
transition: background .1s ease;
}
.submit-btn button:hover {
background:limegreen;
}
.chat-time {
font-size: 12px;
}

.w-15{ width: 15%}
.w-150px{width: 150px}
.wh-200-150{
width: 200px;
height: 150px;
}
textarea{
max-height: initial !important;
padding: 0 0 0 15px;
}
.preview-form input,
.preview-form textarea{color: #fff !important;}

.pt-70{
padding-top: 70px !important;
}
.pt-125{
padding-top: 125px !important;
}

.investor-fig .img-container .img-circle{
height: 100px !important;
width: 100px !important;
}
.refferal-offer .media-icon img{
max-width: 32px;
}
.recent-post .media-img img {
max-width: 80px;
}
/**Card js redesign**/
.--payment-card > div,
.--payment-card > div > div {
-webkit-box-shadow:none !important;
-moz-box-shadow:none !important;
box-shadow:none !important;
}
@media screen and (max-width: 575px) {
.dropdown-menu {
min-width: 260px;
}
}

@media  only screen and (max-width: 468px) {


.xs-dropdown-menu {
transform: translateX(-40px) !important;
}
.xs-dropdown-menu1{
transform: translateX(-10px) !important;
}
    .xs-dropdown-menu3{
        transform: translateX(-60px) !important;
    }
}
/*-- RTL FOR ALL PAGES --*/
html[dir=rtl] #topbar .topbar-content .topbar-social a {
padding: 0 10px !important;
}
html[dir=rtl] #topbar .topbar-content .topbar-social a:last-child {
padding-left: 0 !important;
}
html[dir=rtl] #topbar .topbar-contact .topbar-social a {
padding: 0 10px !important;
}
html[dir=rtl] #topbar .topbar-contact .topbar-social a:last-child {
padding-left: 0 !important;
}
html[dir=rtl] .control-plugin .language .flagstrap-icon {
margin-right: 0;
margin-left: 5px;
}
html[dir=rtl] #topbar .topbar-contact-list li:first-child {
margin-left: 20px !important;
}
html[dir=rtl] #topbar .topbar-contact-list li:last-child {
margin-left: 0 !important;
}
html[dir=rtl] #investmentnavbar li:first-child .nav-link {
padding-right: 0;
padding-left: 15px;
}
html[dir=rtl] #investmentnavbar li:last-child .nav-link {
padding-right: 15px;
padding-left: 0;
}
@media (max-width: 767px) {
.language-wrapper {
margin-right: 5px;
}

#sidebarBadge .level-box {
margin: auto;
margin-top: 12px;
width: 90px;
height: 90px;
padding-top: 25px;
}
#sidebarBadge .level-box h4 {
font-size: 18px;
margin-bottom: 0;
}

#sidebarBadge .level-box .level-badge {
position: absolute;
top: 0;
right: 0;
width: 25px;
}
#sidebarBadge .level-box p {
font-size: 12px;
}
#sidebarBadge .wallet-box h4 {
font-size: 18px;
}
#sidebarBadge .wallet-box h5 {
font-size: 15px;
}
#sidebarBadge .wallet-wrapper {
margin: 0 10px;
}

}

@media (max-width: 468px) {

}

html[dir=rtl] #navbar .navbar-brand {
margin-right: 0;
margin-left: 110px;
}
html[dir=rtl] #banner-wrap .vertical-timeline .media:first-child::after {
right: 25px;
left: initial;
}
html[dir=rtl] #banner-wrap .vertical-timeline .media::after {
right: 25px;
left: initial;
}
html[dir=rtl] #banner-wrap .vertical-timeline .media:last-child::after {
right: 25px;
left: initial;
}
html[dir=rtl] #deposit-withdraw .nav-pills .nav-item:first-child .nav-link {
border-radius: 0 24px 24px 0;
}
html[dir=rtl] #deposit-withdraw .nav-pills .nav-item:last-child .nav-link {
border-radius: 24px 0 0 24px;
}

#about-us .wrapper .about-fig img {
max-width: 480px!important;
}

html[dir=rtl] .investment-wrapper .card-type-1 .featured {
position: absolute;
top: 22px;
right: unset;
padding: 2px 0;
min-width: 150px;
text-align: center;
background-color: var(--themesidetagbg);
transform: rotate(
-45deg);
left: -35px;
}
@media  only screen and (max-width: 448px) {
    html[dir=rtl] .account-dropdown .dropdown-menu{
    right: 0 !important;
    left: initial;
    }
}
