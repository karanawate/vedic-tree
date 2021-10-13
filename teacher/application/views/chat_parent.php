<?php

    $usersession    = $this->session->userdata('usersession');
    $studentName    = $usersession[0]['teacherName'];
    $studentEmail   = $usersession[0]['teacherEmail'];
    $studentMobile  = $usersession[0]['teacherMobile'];
    $fk_classId     = $usersession[0]['teacherClass'];
    $fk_teachId = $usersession[0]['teacherId'];
    
  error_reporting(0);
 
?>
<!DOCTYPE html>
<html lang="">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!-- Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="#fe4b7b">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#fe4b7b">
<!-- iOS Safari -->
<meta name="apple-mobile-web-app-status-bar-style" content="#fe4b7b">
<title>Vedic Tree</title>
<link rel="icon" href="<?php echo base_url()?>assets/website/img/favicon.png">
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/animate.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/vedicdash.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/themefy_icon/themify-icons.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/niceselect/css/nice-select.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/owl_carousel/css/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/vendors/magnify_popup/magnific-popup.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/style.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/website/css/teacher.style.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- ////////////////////////////////////////////////////////////////////// -->
<link href="<?php echo base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url()?>assets/website/css/chat.css" rel="stylesheet" />

<!-- ////////////////////////////////////////////////////////////////////// -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>

    <style>
        .chat-window {
            display: grid;
            grid-template-columns: 0.5fr 1fr;   
            grid-gap: 10px;
        }  
        .chat-window .teacher-student-list {
            display: grid;
            grid-template-rows: 0fr 1fr;
            border-radius: 5px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
        .chat-window .teacher-student-list .teacher-profile{
            display: grid;
            grid-template-columns: 0fr 1fr;
            column-gap: 10px;
        }
        .chat-window .teacher-student-list .teacher-profile .teacher-img {
            justify-self: center;
        }
        .chat-window .teacher-img img{
            width: 100px;
            border-radius: 50%;
        }
        .chat-window .conversation-section {
            display: grid;
            grid-template-rows:  0fr 1fr 0fr;
            height: 75vh;
            border-radius: 5px;
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
        .chat-window .conversation-section .title-area{
            padding: 10px;
            background: #efeff0;
        }
        .chat-window .conversation-section .msger-chat{
            overflow-y: auto;
            word-break: break-all;
            padding: 5px;
            background-color: #fcfcfe;
            background-image: url(data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='260' height='260' viewBox='0 0 260 260'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23dddddd' fill-opacity='0.4'%3E%3Cpath d='M24.37 16c.2.65.39 1.32.54 2H21.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06A5 5 0 0 1-17.45 28v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H-20a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1L.9 19.22a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0L2.26 23h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM-13.82 27l16.37 4.91L18.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H-13.1z'/%3E%3Cpath id='path6_fill-copy' d='M284.37 16c.2.65.39 1.32.54 2H281.17l1.17 2.34.45.9-.24.11V28a5 5 0 0 1-2.23 8.94l-.02.06a8 8 0 0 1-7.75 6h-20a8 8 0 0 1-7.74-6l-.02-.06a5 5 0 0 1-2.24-8.94v-6.76l-.79-1.58-.44-.9.9-.44.63-.32H240a23.01 23.01 0 0 1 44.37-2zm-36.82 2a1 1 0 0 0-.44.1l-3.1 1.56.89 1.79 1.31-.66a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .9 0l2.21-1.1a3 3 0 0 1 2.69 0l2.2 1.1a1 1 0 0 0 .86.02l2.88-1.27a3 3 0 0 1 2.43 0l2.88 1.27a1 1 0 0 0 .85-.02l3.1-1.55-.89-1.79-1.42.71a3 3 0 0 1-2.56.06l-2.77-1.23a1 1 0 0 0-.4-.09h-.01a1 1 0 0 0-.4.09l-2.78 1.23a3 3 0 0 1-2.56-.06l-2.3-1.15a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01a1 1 0 0 0-.44.1l-2.21 1.11a3 3 0 0 1-2.69 0l-2.2-1.1a1 1 0 0 0-.45-.11h-.01zm0-2h-4.9a21.01 21.01 0 0 1 39.61 0h-2.09l-.06-.13-.26.13h-32.31zm30.35 7.68l1.36-.68h1.3v2h-36v-1.15l.34-.17 1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.69 0l1.36-.68h2.59l1.36.68a3 3 0 0 0 2.56.06l1.67-.74h3.23l1.67.74a3 3 0 0 0 2.56-.06zM246.18 27l16.37 4.91L278.93 27h-32.75zm-.63 2h.34l16.66 5 16.67-5h.33a3 3 0 1 1 0 6h-34a3 3 0 1 1 0-6zm1.35 8a6 6 0 0 0 5.65 4h20a6 6 0 0 0 5.66-4H246.9z'/%3E%3Cpath d='M159.5 21.02A9 9 0 0 0 151 15h-42a9 9 0 0 0-8.5 6.02 6 6 0 0 0 .02 11.96A8.99 8.99 0 0 0 109 45h42a9 9 0 0 0 8.48-12.02 6 6 0 0 0 .02-11.96zM151 17h-42a7 7 0 0 0-6.33 4h54.66a7 7 0 0 0-6.33-4zm-9.34 26a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-4.34a8.98 8.98 0 0 0 3.34-7h-2a7 7 0 0 1-7 7h-7a7 7 0 1 1 0-14h42a7 7 0 1 1 0 14h-9.34zM109 27a9 9 0 0 0-7.48 4H101a4 4 0 1 1 0-8h58a4 4 0 0 1 0 8h-.52a9 9 0 0 0-7.48-4h-42z'/%3E%3Cpath d='M39 115a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm6-8a6 6 0 1 1-12 0 6 6 0 0 1 12 0zm-3-29v-2h8v-6H40a4 4 0 0 0-4 4v10H22l-1.33 4-.67 2h2.19L26 130h26l3.81-40H58l-.67-2L56 84H42v-6zm-4-4v10h2V74h8v-2h-8a2 2 0 0 0-2 2zm2 12h14.56l.67 2H22.77l.67-2H40zm13.8 4H24.2l3.62 38h22.36l3.62-38z'/%3E%3Cpath d='M129 92h-6v4h-6v4h-6v14h-3l.24 2 3.76 32h36l3.76-32 .24-2h-3v-14h-6v-4h-6v-4h-8zm18 22v-12h-4v4h3v8h1zm-3 0v-6h-4v6h4zm-6 6v-16h-4v19.17c1.6-.7 2.97-1.8 4-3.17zm-6 3.8V100h-4v23.8a10.04 10.04 0 0 0 4 0zm-6-.63V104h-4v16a10.04 10.04 0 0 0 4 3.17zm-6-9.17v-6h-4v6h4zm-6 0v-8h3v-4h-4v12h1zm27-12v-4h-4v4h3v4h1v-4zm-6 0v-8h-4v4h3v4h1zm-6-4v-4h-4v8h1v-4h3zm-6 4v-4h-4v8h1v-4h3zm7 24a12 12 0 0 0 11.83-10h7.92l-3.53 30h-32.44l-3.53-30h7.92A12 12 0 0 0 130 126z'/%3E%3Cpath d='M212 86v2h-4v-2h4zm4 0h-2v2h2v-2zm-20 0v.1a5 5 0 0 0-.56 9.65l.06.25 1.12 4.48a2 2 0 0 0 1.94 1.52h.01l7.02 24.55a2 2 0 0 0 1.92 1.45h4.98a2 2 0 0 0 1.92-1.45l7.02-24.55a2 2 0 0 0 1.95-1.52L224.5 96l.06-.25a5 5 0 0 0-.56-9.65V86a14 14 0 0 0-28 0zm4 0h6v2h-9a3 3 0 1 0 0 6H223a3 3 0 1 0 0-6H220v-2h2a12 12 0 1 0-24 0h2zm-1.44 14l-1-4h24.88l-1 4h-22.88zm8.95 26l-6.86-24h18.7l-6.86 24h-4.98zM150 242a22 22 0 1 0 0-44 22 22 0 0 0 0 44zm24-22a24 24 0 1 1-48 0 24 24 0 0 1 48 0zm-28.38 17.73l2.04-.87a6 6 0 0 1 4.68 0l2.04.87a2 2 0 0 0 2.5-.82l1.14-1.9a6 6 0 0 1 3.79-2.75l2.15-.5a2 2 0 0 0 1.54-2.12l-.19-2.2a6 6 0 0 1 1.45-4.46l1.45-1.67a2 2 0 0 0 0-2.62l-1.45-1.67a6 6 0 0 1-1.45-4.46l.2-2.2a2 2 0 0 0-1.55-2.13l-2.15-.5a6 6 0 0 1-3.8-2.75l-1.13-1.9a2 2 0 0 0-2.5-.8l-2.04.86a6 6 0 0 1-4.68 0l-2.04-.87a2 2 0 0 0-2.5.82l-1.14 1.9a6 6 0 0 1-3.79 2.75l-2.15.5a2 2 0 0 0-1.54 2.12l.19 2.2a6 6 0 0 1-1.45 4.46l-1.45 1.67a2 2 0 0 0 0 2.62l1.45 1.67a6 6 0 0 1 1.45 4.46l-.2 2.2a2 2 0 0 0 1.55 2.13l2.15.5a6 6 0 0 1 3.8 2.75l1.13 1.9a2 2 0 0 0 2.5.8zm2.82.97a4 4 0 0 1 3.12 0l2.04.87a4 4 0 0 0 4.99-1.62l1.14-1.9a4 4 0 0 1 2.53-1.84l2.15-.5a4 4 0 0 0 3.09-4.24l-.2-2.2a4 4 0 0 1 .97-2.98l1.45-1.67a4 4 0 0 0 0-5.24l-1.45-1.67a4 4 0 0 1-.97-2.97l.2-2.2a4 4 0 0 0-3.09-4.25l-2.15-.5a4 4 0 0 1-2.53-1.84l-1.14-1.9a4 4 0 0 0-5-1.62l-2.03.87a4 4 0 0 1-3.12 0l-2.04-.87a4 4 0 0 0-4.99 1.62l-1.14 1.9a4 4 0 0 1-2.53 1.84l-2.15.5a4 4 0 0 0-3.09 4.24l.2 2.2a4 4 0 0 1-.97 2.98l-1.45 1.67a4 4 0 0 0 0 5.24l1.45 1.67a4 4 0 0 1 .97 2.97l-.2 2.2a4 4 0 0 0 3.09 4.25l2.15.5a4 4 0 0 1 2.53 1.84l1.14 1.9a4 4 0 0 0 5 1.62l2.03-.87zM152 207a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6 2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-11 1a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-6 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3-5a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-8 8a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm3 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm0 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4 7a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5-2a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm5 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm6-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm4-3a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-5-4a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm-24 6a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm16 5a5 5 0 1 0 0-10 5 5 0 0 0 0 10zm7-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0zm86-29a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1 246 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM275 214a29 29 0 0 0-57.97 0h57.96zM72.33 198.12c-.21-.32-.34-.7-.34-1.12v-12h-2v12a4.01 4.01 0 0 0 7.09 2.54c.57-.69.91-1.57.91-2.54v-12h-2v12a1.99 1.99 0 0 1-2 2 2 2 0 0 1-1.66-.88zM75 176c.38 0 .74-.04 1.1-.12a4 4 0 0 0 6.19 2.4A13.94 13.94 0 0 1 84 185v24a6 6 0 0 1-6 6h-3v9a5 5 0 1 1-10 0v-9h-3a6 6 0 0 1-6-6v-24a14 14 0 0 1 14-14 5 5 0 0 0 5 5zm-17 15v12a1.99 1.99 0 0 0 1.22 1.84 2 2 0 0 0 2.44-.72c.21-.32.34-.7.34-1.12v-12h2v12a3.98 3.98 0 0 1-5.35 3.77 3.98 3.98 0 0 1-.65-.3V209a4 4 0 0 0 4 4h16a4 4 0 0 0 4-4v-24c.01-1.53-.23-2.88-.72-4.17-.43.1-.87.16-1.28.17a6 6 0 0 1-5.2-3 7 7 0 0 1-6.47-4.88A12 12 0 0 0 58 185v6zm9 24v9a3 3 0 1 0 6 0v-9h-6z'/%3E%3Cpath d='M-17 191a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm19 9a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H3a1 1 0 0 1-1-1zm-14 5a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm-25 1a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm5 4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm9 0a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm15 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm12-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2H4zm-11-14a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-19 0a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2h-2zm6 5a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2h-2a1 1 0 0 1-1-1zm-25 15c0-.47.01-.94.03-1.4a5 5 0 0 1-1.7-8 3.99 3.99 0 0 1 1.88-5.18 5 5 0 0 1 3.4-6.22 3 3 0 0 1 1.46-1.05 5 5 0 0 1 7.76-3.27A30.86 30.86 0 0 1-14 184c6.79 0 13.06 2.18 18.17 5.88a5 5 0 0 1 7.76 3.27 3 3 0 0 1 1.47 1.05 5 5 0 0 1 3.4 6.22 4 4 0 0 1 1.87 5.18 4.98 4.98 0 0 1-1.7 8c.02.46.03.93.03 1.4v1h-62v-1zm.83-7.17a30.9 30.9 0 0 0-.62 3.57 3 3 0 0 1-.61-4.2c.37.28.78.49 1.23.63zm1.49-4.61c-.36.87-.68 1.76-.96 2.68a2 2 0 0 1-.21-3.71c.33.4.73.75 1.17 1.03zm2.32-4.54c-.54.86-1.03 1.76-1.49 2.68a3 3 0 0 1-.07-4.67 3 3 0 0 0 1.56 1.99zm1.14-1.7c.35-.5.72-.98 1.1-1.46a1 1 0 1 0-1.1 1.45zm5.34-5.77c-1.03.86-2 1.79-2.9 2.77a3 3 0 0 0-1.11-.77 3 3 0 0 1 4-2zm42.66 2.77c-.9-.98-1.87-1.9-2.9-2.77a3 3 0 0 1 4.01 2 3 3 0 0 0-1.1.77zm1.34 1.54c.38.48.75.96 1.1 1.45a1 1 0 1 0-1.1-1.45zm3.73 5.84c-.46-.92-.95-1.82-1.5-2.68a3 3 0 0 0 1.57-1.99 3 3 0 0 1-.07 4.67zm1.8 4.53c-.29-.9-.6-1.8-.97-2.67.44-.28.84-.63 1.17-1.03a2 2 0 0 1-.2 3.7zm1.14 5.51c-.14-1.21-.35-2.4-.62-3.57.45-.14.86-.35 1.23-.63a2.99 2.99 0 0 1-.6 4.2zM15 214a29 29 0 0 0-57.97 0h57.96z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E);
        }
        .chat-window .conversation-section .msger-inputsend-area {
            display: flex;
            padding: 10px;
            border-top: var(--border);
        }
        .chat-window .conversation-section .msger-inputsend-area .msger-input {
            flex: 1;
            border: none;
            border-radius: 30px;
            font-size: 1em;
            background: #efeff0;
        }
        .chat-window .conversation-section .msger-inputsend-area .msger-sendbtn {
            background: #695ffe;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
            border: none;
            border-radius: 30px;
            font-size: 1em;
            transition: background 0.23s;
        }
        .emojionearea .emojionearea-editor {
            height: auto !important;
            min-height: 0 !important;
            line-height: 2 !important;
        }
        .emojionearea.emojionearea-inline>.emojionearea-editor {
            top: 5px !important;
            left: 18px !important;
        }
        .emojionearea.emojionearea-inline {
            height: auto !important;
        }
        .emojionearea .emojionearea-button {
            top: 8px !important;
            right: 10px !important;
        }
        .status {
            justify-self: center;
        }
        .teacher-details {
            display: grid;
            justify-content: center;
            text-align: center;
        }
        .teacher-details.name .name-label{
            font-weight: 500;
        }
        .teacher-details.name .name{
            font-size: 18px;
            font-weight: 600;
            color: #695ffe;
        }
        .teacher-details.email .email-label{
            font-weight: 500;
        }
        .teacher-details.email .email{
            font-size: 18px;
            font-weight: 600;
            color: #695ffe;
        }
        .teacher-details.contact .contact-label{
            font-weight: 500;
        }
        .teacher-details.contact .contact{
            font-size: 18px;
            font-weight: 600;
            color: #695ffe;
        }
        .student-grid {
            display: grid;
            grid-template-columns: 0fr 1fr;
            grid-gap: 10px;
        }
        .student-grid .student-img{
        
        }
        .student-grid .student-img img{
            width: 50px;
            border-radius: 50%;
        }
        .student-grid .student-details {
            display: grid;
        }
        .student-grid .student-details .student-details-one{
            display: grid;
            grid-template-columns: 1fr 60px;
            grid-gap: 10px;
            align-self: center;
        }
        .student-grid .student-details .student-details-one .name{
            font-size: 16px;
            font-weight: 600;
            align-self: center;
        }
        .student-grid .student-details .student-details-one .time{
            font-size: 12px;
            justify-self: end;
            font-weight: 500;
            align-self: center;
        }  
        .student-grid .student-details .student-details-two{
            display: grid;
            grid-template-columns: 1fr 60px;
            grid-gap: 10px;
            align-self: center;
        }
        .student-grid .student-details .student-details-two .last-msg{
            font-size: 14px;
            font-weight: 100;
            align-self: center;
        }
        .student-grid .student-details .student-details-two .count{
            align-self: center;
        }
        .search-student #studentInput {
            width: 100%;
            background: #efeff0;
            border: 0;
            height: 50px;
            font-size: 20px;
            padding: 10px
        }
        .student-list {
            padding: 10px;
            height: 69vh;
            overflow-y: auto;
        }
        .send-recieve-img {
            width: 250px;
            border-radius: 10px;
        }
        .single-chat :hover, .single-chat :focus {
            background: #695ffe;
            color: whitesmoke;
            margin: -10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Simulate a smartphone / tablet -->
    <?php $this->load->view('mobilemenus'); ?>
    <!-- End smartphone / tablet look -->
    <div class="boxes">
        <?php $this->load->view('teachersidebar'); ?>
        <div class="box11">
            <div class="box-inside">
                <div class="desktop-mobile-view">
                    <!-- //top header -->
                    <?php $this->load->view('teacher_topheader'); ?>
                    <!-- //end top header -->
                    <h2>Chat</h2>
                    <div class="chat-window">
                        <div class="teacher-student-list">
                            <!--<div class="teacher-profile">-->
                            <!--    <div class="teacher-img"><img src="<?php echo base_url()?>assets/website/img/profile-img.png" alt=""></div>-->
                            <!--    <div>Online</div>-->
                            <!--</div>-->
                            <div class="search-student"><input id="studentInput" type="text" placeholder="Search..."></div>
                            <div id="studentList" class="student-list">
                                <div class="list-students" style="display: grid;row-gap: 20px;">
                                    <label>Group</label>
                                    <div class="group-chat">
                                        <a href="<?php echo site_url("teacher/get_chat_information_student/".$chat_student_list_response[0]['feesId'].'/0'); ?>">
                                        <div class="student-grid" id="<?php echo $chat_student_list_response[0]['feesId'] ?>">
                                        <div class="student-img">
                                            <!--<img src="<?php echo base_url()?>assets/website/img/profile-img.png" alt="">-->
                                                          <?php
                                                             $group_name           =  $chat_student_list_response[0]['packageName'];
                                                          ?>
                                             <img style="width: 45px;border-radius:22px;" class="h-12 w-12 rounded-full" src=" https://ui-avatars.com/api/?uppercase=false&name=<?php echo $group_name ?>+SSar" />
                                        </div>
                                        <div class="student-details">
                                            <div class="student-details-one ">
                                                <div class="name"><?php echo "Group of ".$chat_student_list_response[0]['packageName'] ?></div>
                                                <div class="time">8:32 am</div>
                                            </div>
                                            <div class="student-details-two">
                                                <div class="last-msg" style="">Last msg recieved</div>
                                                <div class="count" style="justify-self: end;"><span class="badge badge-danger badge-pill">0</span></div>
                                            </div>
                                        </div>
                                    </div>
                                        </a>
                                    </div>
                                    <!-- one to one-->
                                    <label>Students</label>
                                    <?php foreach($chat_student_list_response as $chat_student)  { ?>
                                    <div class="single-chat">
                                        <a href="<?php echo site_url("teacher/get_chat_information_student/".$chat_student['fk_feesId']."/".$chat_student['fk_studId']); ?>">
                                        <div class="student-grid" id="<?php echo $chat_student['fk_studId']; ?>" >
                                            <div class="student-img">
                                                <?php
                                                    $fullname      =  ucwords(strtolower($chat_student['studentName']));
                                                    $firstName     = substr($fullname, 0, strpos($fullname, ' ')); 
                                                    $lastName      = substr($fullname, strpos($fullname, " ") + 0);
                                                    $wholename     = $firstName.$lastName;
                                                ?>
                                                <!--<img src="<?php echo base_url()?>assets/website/img/profile-img.png" alt="">-->
                                                <img style="width: 45px;border-radius:22px;" class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?bold=true&background=random&name=<?php echo $wholename ?>" />
                                            </div>
                                            <div class="student-details">
                                                <div class="student-details-one ">
                                                    <div class="name"><?php echo ucwords(strtolower($chat_student['studentName'])); ?></div>
                                                    <div class="time">
                                                        <?php
                                                            if(!empty($msg_last_seen)){
                                                                $msg_last_seen = getChatData_today_count_of_one_to_onemsg_last_seen($chat_student['fk_studId']);
                                                                // echo $msg_last_seen[0]['currentDate'];
                                                                echo date("g:i A", strtotime($msg_last_seen[0]['currentDate']));
                                                            }
                                                            else
                                                            {
                                                                  date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
                                                                   echo $lock_update_date =  date('h:i:s');
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="student-details-two">
                                                    <div class="last-msg">
                                                        <?php
                                                            if(empty($msg_last_seen)){
                                                              $msg_last_seen = getChatData_today_count_of_one_to_onemsg_last_seen($chat_student['fk_studId']);
                                                              echo substr($msg_last_seen[0]['chatMsg'],0,35);
                                                            }else
                                                            {
                                                                echo "No Message found";
                                                            }
                                                        ?>
                                                    
                                                    </div>
                                                    <div class="count" style="justify-self: end;">
                                                        
                                                        <?php 
                                                            $countmsg1 =  getChatData_today_count_of_one_to_onemsgcount($chat_student['fk_studId']);
                                                            if(!empty($countmsg1)){ ?>
                                                                <span class="badge badge-danger badge-pill">
                                                               <?php   echo $countmsg1 = count($countmsg1); ?>
                                                                </span>
                                                            <?php }else { 
                                                                echo " ";
                                                            }
                                                            
                                                        ?>
                                                        
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="conversation-section">
                            <div class="title-area d-flex justify-content-between">
                                <div id="group_name" style="display: flex;align-items: center;">Chat with <?php  echo (isset( $chat_full_info_student[0]['studentName'])) ?  ucwords(strtolower($chat_full_info_student[0]['studentName'])) : $group_chat_get_info[0]['packageName']; ?> </div>
                            </div>
                
                            <div class="msger-chat" id="message_area" >
                                <?php
                                $color="";
                                $me = "";
                                $side= "";
                                $img = "";
                                if(!empty($all_chat_data)) {
                                foreach ($all_chat_data as $key => $value) {
                                    if($fk_teachId==$value['fk_studId']){
                                        $me = "Me";
                                        $side = "right-msg";
                                        $margin = "margin:-12px";
                                        $color = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                        $img = base_url('uploads/chatimgup/'.$value['chatimgup']);
                                        $icon = "fa fa-check-circle-o";
                                    }else{
                                        $me = (isset( $chat_full_info_student[0]['studentName'])) ?  $chat_full_info_student[0]['studentName'] : '';
                                        $side = "left-msg";
                                        $margin = "margin:12px";
                                        $color = "#".str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
                                        $img = 'https://vedictreeschool.com/uploads/chatimgup/'.$value['chatimgup'];
                                        $icon = "";
                                    }
                                ?>
                                <div class="msg <?php echo $side; ?>">
                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name"><?php echo $me;?></div>
                                            <div class="msg-info-time"><?php echo date('H:i ',strtotime($value['currentDate']) );?></div>
                                        </div>
                                        <?php if(!empty($value['chatimgup'])){ ?>
                                        <a download href="<?php echo $img; ?>">
                                            <img class='send-recieve-img' src="<?php echo $img; ?>">
                                        </a>
                                        <?php } ?>
                                        <div class="msg-text" style="color: black;"><?php echo $value['chatMsg'];?></div>
                                        <div class="mt-2"><i class="<?php echo $icon; ?>" aria-hidden="true"></i></div>
                                        <!--<div class="fa fa-check-circle" style="<?php echo $color; ?>"></div>-->
                                    </div>
                                    
                                </div>
                                <?php } } else { echo "No Chat Found"; }?>
                            </div>
                            <form class="msger-inputsend-area" enctype="multipart/form-data"  id="chat_form" method="POST">
                                <textarea class="msger-input" id="emojionearea" placeholder="Enter your message..."></textarea>
                                <input type="hidden"  id="studId" name="studId" value="<?php  echo isset($chat_full_info_student[0]['fk_studId']) ? $chat_full_info_student[0]['fk_studId'] : '';?>">
                                <input type="hidden" id="fk_teachId"  name="teacherId" value="<?php echo $fk_teachId; ?>">
                                <input type="hidden" id="fees_id"  name="fees_id" value="<?php echo  $chat_student_list_response[0]['feesId'] ?>">
                                <div style="padding: 5px 10px;font-size: 20px;">
                                    <input type="file" name="chatimgup" id="OpenImgUpload" style="display:none"/> 
                                    <i id="imgupload"  type="submit" class="fa fa-paperclip" aria-hidden="true" ></i>
                                </div>
                                <?php if(!empty($chat_full_info_student[0]['fk_studId'])){ ?>
                                <div><button type="submit" class="msger-sendbtn"><i class="fa fa-paper-plane p-0 mr-2" aria-hidden="true"></i>Send</button></div>
                                <?php } else { ?>
                                   <div><button type="submit" class="msger-sendbtn"><i class="fa fa-paper-plane p-0 mr-2" aria-hidden="true"></i>Send</button></div>
                                <?php  } ?> 
                            </form>
                            <span id="chat_messagerr" style="color:red;display:none;">Please Enter Message</span>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>
<script src="<?php echo base_url()?>assets/js/push.js"></script>
<script src="<?php echo base_url()?>assets/js/serviceWorker.min.js"></script>
</script>
<script type="text/javascript">

$(".single-chat").click(function(){
    $(this).removeClass("focus");
    $(this).addClass("focus");
    localStorage.ClassName = "focus";
  });

$(document).ready(function() {
    SetClass();
});

function SetClass() {
//before assigning class check local storage if it has any value
    $(".single-chat").addClass(localStorage.ClassName);
}
$('.single-chat').click(function() {
  $(this).siblings().find('.single-chat').removeClass('focus');
  $(this).find('.single-chat').addClass('focus');
});
$(document).ready(function(){
    $("#studentInput").on("keyup", function() {
        var searchValue = $(this).val().toLowerCase();
        $("#studentList .list-students a").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1)
        });
     });
    $("#emojionearea1").emojioneArea({
        pickerPosition: "top",
        toneStyle: "bullet",
        filtersPosition: "bottom",
        tones: false,
        autocomplete: false,
        search: false,
        hidePickerOnBlur: false
    });
    $("#chat_form").on('submit',function(event){

        event.preventDefault();

            var studId        = $("#studId").val();
            var fk_teachId    = $("#fk_teachId").val();
            var chat_message  = $(".msger-input").val();
            var fees_id       = $("#fees_id").val();
            
            var flag          = "true";
            if( chat_message == "" ) {
              $("#chat_messagerr").show();
            }else{
            $("#chat_messagerr").hide();
            $.ajax({
            type:"POST",
            data :{studId:studId,message:chat_message,fk_teachId:fk_teachId,fees_id:fees_id },
            url:"<?php echo base_url('teacher/chat_with_student_msg'); ?>",
            success:function(resp){
              var resp = JSON.parse(resp);
              console.log(resp);
              currentTime = getDateTime();
              currentTime = time_ago(currentTime);
              var UserName="";
              $.each( resp, function( key, value ) {
                if(key=="studentName"){
                 UserName = value;
                }
   
              });
   
              if(studId==studId)
              {
                var me = "Me";
                var side = "right-msg";
                var image = "https://bootdey.com/img/Content/user_1.jpg";
                var margin = "margin:-12px";
                var color = Math.floor((Math.random() * 4) + 1);
   
              }else{
                var me = UserName;
                var side = "left-msg";
                var image = "https://bootdey.com/img/Content/user_3.jpg";
                var margin = "margin:12px";
                var color = Math.floor((Math.random() * 4) + 1);
   
              }
   
              var htmldata  = "<div class='msg "+side+"'><div class='msg-bubble'><div class='msg-info'><div class='msg-info-name'>"+me+"</div><div class='msg-info-time'>"+currentTime+"</div></div><div class='msg-text' style='color: black;'>"+resp.chatMsg+"</div><div class='mt-2'><i class='fa fa-check-circle-o'></i></div></div></div>";          
               $("#message_area").append(htmldata);
               
               $("#emojionearea").val('');
             

            //   Push.create(resp.chatMsg);
             
            },
            error:function(error){
              console.log(error)
            }
          });

          }
        });
});

$(document).ready(function(){
        setInterval(function() { get_chat_messages(); } , 2500);
        $('#OpenImgUpload').change(function(e){
            $("#chat_form").submit();
        });
        $('#chat_form').submit(function(e){
            e.preventDefault();
            $('#OpenImgUpload').html(``);
            $.ajax({
                url:'<?php echo base_url();?>teacher/uploadchatimg_teacher',
                type:"POST",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                    
                    var currentTime = getDateTime();
                    currentTime = time_ago(currentTime);
                    
                    if(data!=""){
                        var resp = JSON.parse(data);
                        if(resp.error){
                        $("#chat_messagerr").html("Maximum 2MB OR Accept Only Image,pdf files only ").css({"color":"red","padding":"12px;"});
                        }else {
                        var fileExtension = resp.chatimgup.substring(resp.chatimgup.lastIndexOf('.') + 1);
                        if(fileExtension=='pdf') {
                            var baseurl = "<div class='msg right-msg'><a download href='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup+"' ><img class='send-recieve-img' src='<?php echo base_url('assets/website/img/teacherimg.png'); ?>'></a></div>";
                        } else {
                            console.log(resp.chatimgup);
                            var baseurl = "<div class='msg right-msg'><div class='msg-bubble'><div class='msg-info'><div class='msg-info-name'>Me</div><div class='msg-info-time'>"+currentTime+"</div></div><a download href='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup+"' ><img class='send-recieve-img' src='<?php echo base_url('uploads/chatimgup/'); ?>"+resp.chatimgup +"'></a><div class='msg-text' style='color: black;'></div><div class='mt-2'><i class='fa fa-check-circle-o'></i></div></div></div>";
                            console.log(baseurl);
                        }
                        $("#message_area").append(baseurl);
                         $("#emojionearea").html("");
                    }
                    
                    }
                }
            });
        });
        function get_chat_messages(){
            var studId        = $("#studId").val();
            var fk_teachId    = $("#fk_teachId").val();
        }
        get_chat_messages();
    });
    
function getDateTime() {
    var now     = new Date();
    var year    = now.getFullYear();
    var month   = now.getMonth()+1;
    var day     = now.getDate();
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds();
    if(month.toString().length == 1) {
         month = '0'+month;
    }
    if(day.toString().length == 1) {
         day = '0'+day;
    }  
    if(hour.toString().length == 1) {
         hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
         minute = '0'+minute;
    }
    if(second.toString().length == 1) {
         second = '0'+second;
    }  
    var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;  
     return dateTime;
}

function time_ago(time) {
        switch (typeof time) {
    case 'number':
      break;
    case 'string':
      time = +new Date(time);
      break;
    case 'object':
      if (time.constructor === Date) time = time.getTime();
      break;
    default:
      time = +new Date();
  }
        var time_formats = [
    [60, 'seconds', 1], // 60
    [120, '1 minute ago', '1 minute from now'], // 60*2
    [3600, 'minutes', 60], // 60*60, 60
    [7200, '1 hour ago', '1 hour from now'], // 60*60*2
    [86400, 'hours', 3600], // 60*60*24, 60*60
    [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
    [604800, 'days', 86400], // 60*60*24*7, 60*60*24
    [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
    [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
    [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
    [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
    [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
    [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
    [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
    [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
  ];
        var seconds = (+new Date() - time) / 1000,
        token = 'ago',
        list_choice = 1;
        
        if (seconds == 0) {
            return 'Just now'
        }
        if (seconds < 0) {
            seconds = Math.abs(seconds);
            token = 'from now';
            list_choice = 2;
         }
        var i = 0,
        format;
        while (format = time_formats[i++])
        if (seconds < format[0]) {
            if (typeof format[2] == 'string')
                return format[list_choice];
            else
            return Math.floor(seconds / format[2]) + ' ' + format[1] + ' ' + token;
        }
        return time;
    }
    
    
 

$('#imgupload').click(function(){ $('#OpenImgUpload').trigger('click'); });
</script>




        



<?php
function get_time_ago( $time )
{
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return  $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
?>
