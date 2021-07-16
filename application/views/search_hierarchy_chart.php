<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dynamic Family Tree/Organization Chart Plugin Example</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/css/jquery.orgchart.min.css" rel="stylesheet" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.3/js/jquery.orgchart.min.js"></script>


    <style>
        
element.style {
}   
        .orgchart #red .title {
  
  background-color: red !important;
}
.orgchart .node .title {
  
    background-color: #008000ed !important;
}
        .example input{
            width: 170px;
    height: 26px;
    background: #80808024;
    border: 1px solid #3f51b582;
        }
        .example button{
            width: 53px;
    height: 31px;
    border-radius: 11px;
        }
    #chart-container {
        font-family: Arial;
        height: 420px;

        overflow: auto;
        text-align: center;
    }

    #github-link {
        position: fixed;
        right: 10px;
        font-size: 3em;
    }

    .orgchart {
        box-sizing: border-box;
        display: inline-block;
        min-height: 202px;
        min-width: 100%;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        /* background-image: linear-gradient(
90deg
,rgba(200,0,0,.15) 10%,rgba(0,0,0,0) 10%),linear-gradient(rgba(200,0,0,.15) 10%,rgba(0,0,0,0) 10%); */
        /* background-size: 10px 10px; */
        border: none !important;
        padding: 20px;
    }

    .center {
        text-align: center;
    }
    .logout{
        background: black;
    color: white;
    padding: 9px;
    text-decoration: none;
    border-radius: 20px;
    }
    </style>
</head>

<body>
    <script>
    (function($) {

        $(function() {

            var datascource = <?php echo $data ?>

            var oc = $('#chart-container').orgchart({
                'data': datascource,
                'nodeContent': 'title',
                'pan': true,
                'zoom': false
            });

        });

    })(jQuery);
    </script>
    <div style="text-align: end; padding:12px">
    <a class="logout" href="<?php echo base_url('HierarchyChart'); ?>">Logout</a>
    </div>
    <div class="center">
        <p>Enter User ID:</p>
        <form class="example" method="get" action="<?php echo base_url('HierarchyChart/search')?>">
            <input type="text" placeholder="Search.." name="id">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div id="chart-container"></div>

</body>

</html>