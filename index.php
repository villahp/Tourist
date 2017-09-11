<!DOCTYPE html>
<html> 
    <head> 
        <!-- https://www.syncfusion.com/kb/5235/how-to-explode-a-segment-in-the-pie-chart -->
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
        <meta name="viewport" content = "width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  

        <!--<link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        -->
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        
        
        <script src='jquery-paginate.min.js'></script> <!-- https://github.com/wikiti/jquery-paginate --> 
        <!-- <link rel="stylesheet" type="text/css" href="web_layout.css"> -->

        <title>MOTHER OF ALL DEMOS</title> 
        <!-- <script src="https://maps.google.com/maps/api/js"   type="text/javascript"></script> -->
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCfNOSIXPs8g6HqIHM5YpkCM-1bSgIf5DE &libraries=visualization  " type="text/javascript"></script>
        <!--
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/highcharts-more.js"></script>
        <script src="http://code.highcharts.com/maps/modules/map.js"></script>
        <script src="http://code.highcharts.com/maps/modules/data.js"></script>
        <script src="http://code.highcharts.com/mapdata/custom/world.js"></script>
        -->
        <script src="http://d3js.org/d3.v2.min.js?2.9.6"></script>
        <style>
            
           
        body {
            font-family: 'Oswald', sans-serif;
        }     
            #map {
                /* width: 670px;  */
                width: 100%; 
                
                /* height: 400px;   */
                /* height:100%; */
                /*position: absolute; */
                height: 50vh;
                /* border: 1px solid green; */
                float: left;
                /* margin: 5px; */
                margin: 0px;
                padding: 0px;
            }

            #world_map {
                /* width: 670px;  */
                width: 100%;  
             
                height: 50vh;
                /* height:100%; */
                /* height: 400px;        */
                
                float: left;
                margin: 0px;
                padding: 0px;
            }
            #piechart {
                /* width: 500px;  */
                width: 100%; 
        
                height: 50vh;
                /* height:100%; */
                /* height: 400px;                 */
                
                float: left;
                margin: 0px;
                padding: 0px;
            }    
            .panel-body {
                padding: 0px;
            }

            #data_table th{
                text-align: center;
                background-color:#4F6677;
                color: #fff;
            }
            
            /*html, body {
                width: 100%; height: 100%;
            } */

            /*
            #data_table {
                border-collapse: collapse;        
            }
            #data_table th{
                border: 2px solid #69899F;
                color: #fff;
                padding:10px;
                background-color:#4F6677;
            }    
            #data_table td{
                border: 1px dotted black;        
                padding:15px;
                width:100px;        
                font-family: 'Lato', sans-serif;
                font-weight: 400;
            }
            
            tr:nth-child(odd) {        
                background: #b8d1f3;
            }
        
            tr:nth-child(even){        
                background: #dae5f4;
            }
            */

            tr:nth-child(even){
                background-color: #f2f2f2;
            }   


            /*
            #data_table {
                table-layout: fixed;
                width: 100%;
            }    
            */




            .Positive_comment {
                color: blue;  
                text-align: center;
            }
            .Negative_comment {
                color: red;
                text-align: center;
            }
            .Neutral_comment {        
                text-align: center;
            }

            .page-navigation a {
                margin: 0 2px;
                display: inline-block;
                padding: 3px 5px;
                color: #ffffff;
                background-color: #70b7ec;
                border-radius: 5px;
                text-decoration: none;
                font-weight: bold;
            }   

            .page-navigation a[data-selected] {
                background-color: #3d9be0;
            }
        </style>
    </head> 
    <body>
        <div class="container-fluid">   
            <div class = "row">  
                <div class =" col-xs-4" style="padding:0">
                    <div class = "panel panel-default">
                        <div class="panel-heading" >Map</div>
                        <div class="panel-body" >  
                            <div id="map"  ></div> 
                        </div>                
                    </div>
                </div> 
                <div class =" col-xs-4" style="padding:0"> 
                    <div class = "panel panel-default">
                        <div class = "panel-heading">Pie chart</div>
                        <div class = "panel-body">
                            <div id="piechart"  ></div> 
                        </div>
                    </div>
                </div> 
                <div class = "col-xs-4" style="padding:0">

                    <div class = "panel panel-default">
                        <div class = "panel-heading">World map</div>
                        <div class = "panel-body">
                            <div id = "world_map"></div>
                        </div>
                    </div>
                </div> 
            </div> 

            <div id = "submit_form"> 
                <form id = "mother_of_all_demos" method="get" >      
                    <input type="hidden" name="data" id="data" > 
                    <!--
                    </br> </br> </br></br> </br></br> </br></br> </br></br> </br></br> </br>
                    </br> </br></br> </br></br> </br></br> </br></br> </br>         -->
                </form>
            </div>    

            <!-- <div class = "container"> -->
            <div class = "row">
            <div class = "col-xs-12" style="padding:0">
            <div id ="data_table" >
                <?php
                $file_handle = fopen("BothAnnotatorAverage_extracted_data.csv", "r");
                $data_list = array();
                while (!feof($file_handle)) {
                    $line_of_text = fgetcsv($file_handle, 1024);
                    $data_list[] = $line_of_text;
                }
                fclose($file_handle);
                ?>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th> <p class = "table_header"> Comment </p> </th>
                            <th> <p class = "table_header"> Location </p> </th>
                            <th> <p class = "table_header"> Sentiment score </p> </th>
                            <th> <p class = "table_header"> Positive/negative/neutral </p> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        function is_positive($num) {
                            return $num >= 0.5;
                        }

                        function is_negative($num) {
                            return $num <= -0.5;
                        }

                        function is_neutral($num) {
                            if (is_positive($num) || is_negative($num)) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        function check_sentiment($num) {
                            if (!isset($_GET["Sentiment_type"])) {
                                return true;
                            } else {
                                switch ($_GET["Sentiment_type"]) {
                                    case "Positive":
                                        return is_positive($num);
                                    case "Negative":
                                        return is_negative($num);
                                    case "Neutral":
                                        return is_neutral($num);
                                }
                            }
                        }

                        $num_of_positives = 0;
                        $num_of_negatives = 0;
                        $num_of_neutrals = 0;
                        $chosen_list = array();
                        $business_targets = array();
                        $location_list = array();
                        $location_info = array();
                        for ($i = 0; $i < count($data_list); $i++) {
                            $ok = 1;
                            if (isset($_GET["data"])) {
                                if (strcmp($_GET["data"], "") !== 0) {
                                    if ((strcmp($data_list[$i][8], $_GET["data"]) !== 0) && (strcmp("All", $_GET["data"]) !== 0)) {
                                        $ok = 0;
                                    }
                                }
                            }
                            $sentiment_score = $data_list[$i][12];
                            if ($ok === 1) {
                                if (!check_sentiment($sentiment_score)) {
                                    $ok = 0;
                                } else {
                                    $business_type = $data_list[$i][9];
                                    if (array_key_exists($business_type, $business_targets)) {
                                        if (strcmp($business_targets[$business_type], "") !== 0) {
                                            $business_targets[$business_type] ++;
                                        }
                                    } else {
                                        $business_targets[$business_type] = 1;
                                    }
                                    $user_location = $data_list[$i][2];

                                    if (!in_array($user_location, $location_list)) {
                                        if (($i !== 0 ) && (strcmp($user_location, "") !== 0)) {                                            
                                            array_push($location_list, $user_location);   
                                            array_push($location_info,1);                                            
                                        }
                                    }
                                    else {
                                        $location_info[array_search($user_location,$location_list)]++;
                                    }                                       
                                    
                                }
                            }
                            $chosen_list[] = $ok;
                        }
                        for ($i = 1; $i < count($data_list); $i++) {
                            if ($chosen_list[$i] == 0) {
                                continue;
                            }
                            ?> 
                            <tr>
                                <td style = "word-break:break-all"> <?php echo $data_list[$i][5] ?> </td>
                                <?php $user_location = $data_list[$i][2]; ?>
                                <td style = "word-break:break-all"> <?php echo $user_location ?> </td>

                                <?php // <td> <?php echo $data_list[$i][12]?>
                                <?php //</td> ?>
                                <?php // <td> ?> 
                                <?php
                                $sentiment_score = $data_list[$i][12];
                                if (is_positive($sentiment_score)) {
                                    $num_of_positives++;
                                    //echo "Positive";
                                    echo '<td class = "Positive_comment">';
                                    echo $sentiment_score;
                                    echo '</td>';
                                    //echo '<p class = "Positive_comment">';
                                    //echo 'Positive';
                                    //echo '</p>';
                                    echo '<td class = "Positive_comment">';
                                    echo 'Positive';
                                    echo '</td>';
                                } elseif (is_negative($sentiment_score)) {
                                    $num_of_negatives++;
                                    //echo "Negative";
                                    //echo '<p class = "Negative_comment">';
                                    //echo 'Negative';
                                    //echo '</p>';
                                    echo '<td class = "Negative_comment">';
                                    echo $sentiment_score;
                                    echo '</td>';
                                    echo '<td class = "Negative_comment">';
                                    echo 'Negative';
                                    echo '</td>';
                                } else {
                                    $num_of_neutrals++;
                                    //echo '<p class = "Neutral_comment">';
                                    //echo 'Neutral';
                                    //echo '</p>';
                                    echo '<td class = "Neutral_comment">';
                                    echo $sentiment_score;
                                    echo '</td>';
                                    echo '<td class = "Neutral_comment">';
                                    echo 'Neutral';
                                    echo '</td>';
                                }
                                ?>
                                <?php //</td> ?>    
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            </div>
        </div>

        <script>
            //$('#data_table').paginate({ limit: 100 });
        </script>      

<!-- <div class='tableauPlaceholder' id='viz1503036024125' style='position: relative'><noscript><a href='#'><img alt='Dashboard 1 ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Hi&#47;HihiheheDangManhTruong&#47;Dashboard1&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='site_root' value='' /><param name='name' value='HihiheheDangManhTruong&#47;Dashboard1' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Hi&#47;HihiheheDangManhTruong&#47;Dashboard1&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /><param name='filter' value='publish=yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1503036024125');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.minWidth='424px';vizElement.style.maxWidth='654px';vizElement.style.width='100%';vizElement.style.minHeight='629px';vizElement.style.maxHeight='929px';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>    
        -->
        <?php
        unset($business_targets[""]);
        unset($business_targets["Business Target (Physical) (general)"]);
        //foreach($business_targets as $key => $value){
        //    echo $key . " ". $value;
        //    echo "</br>";  
        //};   
        ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <?php
        echo '<script>';
        echo 'var num_of_positives = ' . json_encode($num_of_positives) . ';';
        echo 'var num_of_negatives = ' . json_encode($num_of_negatives) . ';';
        echo 'var num_of_neutrals = ' . json_encode($num_of_neutrals) . ';';
        echo 'var isset_Sentiment_type = ' . json_encode(isset($_GET["Sentiment_type"])) . ';';
        echo 'var business_targets = ' . json_encode($business_targets) . ';';
        if (isset($_GET["Sentiment_type"])) {
            echo 'var Sentiment_type = ' . json_encode($_GET["Sentiment_type"]) . ';';
        }
        if (isset($_GET["data"])) {
            echo 'var current_location = ' . json_encode($_GET["data"]) . ';';
        } else {
            echo 'var current_location = "All";';
        }

        echo 'var location_list = ' . json_encode($location_list) . ';';
        echo 'var location_info = ' . json_encode($location_info) . ';';
        echo '</script>';
        ?>     
        <script type="text/javascript">
            // Code to handle the map
            var locations = [
                ['All', -28.024347, 153.454081], // Select all locations
                ['Surfer Paradise', -28.000767, 153.429642],
                ['Burleigh Heads', -28.1040, 153.4360],
                ['Oxenford', -27.89033, 153.31309],
                ['Main Beach', -27.9638026, 153.42626719998],
                ['Coolangatta', -28.1669958, 153.53447860000006],
                ['Coomera', -27.8454958, 153.34017110000002],
                ['Bilinga', -28.1599946, 153.5099937],
                ['Broadbeach', -28.0307125, 153.43195149999997]
            ];

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: new google.maps.LatLng(-28.000767, 153.429642), // Gold Coast
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    optimized: false,
                    draggable: false
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        document.getElementById("data").value = locations[i][0];
                        document.getElementById('mother_of_all_demos').submit();
                    };
                })(marker, i));

                google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    };
                })(marker, i));

            }
        </script>     

        <script type="text/javascript">
            // Code to handle the pie chart
            if (!isset_Sentiment_type) {
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Positive', num_of_positives],
                        ['Negative', num_of_negatives],
                        ['Neutral', num_of_neutrals],
                    ]);
                    var str = 'Sentiments in Tweets (';
                    str += current_location;
                    str += ')';
                    var options = {
                        //title: 'Sentiments in Tweets'
                        title: str,
                        tooltip: {isHtml: true},
                        is3D: true,
                        slices: {
                            0: {offset: 0.0},
                            1: {offset: 0.0},
                            2: {offset: 0.0}
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    google.visualization.events.addListener(chart, 'select', function () {
                        var selectedItem = chart.getSelection()[0];
                        if (selectedItem) {
                            var topping = data.getValue(selectedItem.row, 0);
                            var dest;
                            dest = "index.php?data=";
                            dest += current_location;
                            dest += "&Sentiment_type=";
                            dest += topping;
                            //alert(dest);
                            window.location.href = dest;
                        }
                    });

                    /*
                     google.visualization.events.addListener(chart, 'onmouseover', function(e) {            
                     options.slices[e['row']].offset = 0.2;
                     chart.draw(data, options);                      
                     options.slices[e['row']].offset = 0.0;                 
                     
                     });
                     */

                    /*
                     google.visualization.events.addListener(chart, 'onmouseout', function(e){
                     options.slices[e['row']].offset = 0.0;
                     chart.draw(data, options);
                     });
                     */
                    chart.draw(data, options);
                    
                    
                    //create trigger to resizeEnd event     
                    $(window).resize(function() {
                        if(this.resizeTO) clearTimeout(this.resizeTO);
                        this.resizeTO = setTimeout(function() {
                            $(this).trigger('resizeEnd');
                        }, 500);
                    });
                    //redraw graph when window resize is completed  
                    $(window).on('resizeEnd', function() {
                        drawChart(data);
                    });
                    
                }
            } else {
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var arr = [];
                    arr.push(['Task', 'Hours per Day']);
                    for (target in business_targets) {
                        arr.push([target, Number(business_targets[target])]);
                    }
                    var data = google.visualization.arrayToDataTable(arr);
                    var str = 'Business targets (';
                    str += Sentiment_type;
                    str += ')';
                    var options = {
                        //title: 'Sentiments in Tweets'
                        title: str,
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                    chart.draw(data, options);
                    
                    //create trigger to resizeEnd event     
                    $(window).resize(function() {
                        if(this.resizeTO) clearTimeout(this.resizeTO);
                        this.resizeTO = setTimeout(function() {
                            $(this).trigger('resizeEnd');
                        }, 500);
                    });
                    //redraw graph when window resize is completed  
                    $(window).on('resizeEnd', function() {
                        drawChart(data);
                    });
                }
            }

        </script>   

        <script>
            // Code to handle the world map
            var world_locations = [// Hard-coded to make my life easier :) 
                ['Brisbane', -27.4697707, 153.02512350000006],
                ['Alaska', 64.2008413, -149.4936733],
                ['Melbourne', -37.8136276, 144.96305759999996],
                ['Sydney', -33.8688197, 151.20929550000005],
                ['Kuala Lumpur', 3.139003, 101.68685499999992],
                ['Singapore', 1.352083, 103.81983600000001],
                ['Hawaii', 19.8967662, -155.58278180000002],
                ['Eastern Time (US & Canada)', 47.7687255, -70.37277660000001],
                ['Wellington', -41.2864603, 174.77623600000004],
                ['Madrid', 40.4167754, -3.7037901999999576],
                ['Tokyo', 35.6894875, 139.69170639999993],
                ['Karachi', 24.8614622, 67.00993879999999],
                ['Hong Kong', 22.396428, 114.10949700000003],
                ['Osaka', 34.6937378, 135.50216509999996],
                ['Beijing', 39.90419989999999, 116.40739630000007],
                ['Santiago', -33.4488897, -70.6692655],
                ['Hanoi', 21.0277644, 105.83415979999995],
                ['Mumbai', 19.0759837, 72.87765590000004],
                ['Perth', -31.9505269, 115.86045719999993],
                ['Canberra', -35.2809368, 149.13000920000002],
                ['Kuwait', 29.31166, 47.48176599999999],
                ['Urumqi', 43.825592, 87.616848],
                ['Brasilia', -15.7941569, -47.88252890000001],
                ['Bangkok', 13.7563309, 100.50176510000006],
                ['New Caledonia', -20.904305, 165.61804200000006],
                ['Sri Jayawardenepura', 6.894002899999999, 79.90515649999998],
                ['Jakarta', -6.17511, 106.86503949999997],
                ['International Date Line West', 0, -169.85946660000002],
                ['Hobart', -42.8821377, 147.3271949],
                ['Yakutsk', 62.0354523, 129.67547450000006],
                ['Auckland', -36.8484597, 174.76333150000005],
                ['Bogota', 4.710988599999999, -74.072092],
                ['Adelaide', -34.9284989, 138.60074559999998],
                ['Quito', -0.1806532, -78.46783820000002],
                ['Abu Dhabi', 24.453884, 54.37734380000006],
                ['Rome', 41.9027835, 12.496365500000024],
                ['London', 51.5073509, -0.12775829999998223],
                ['Baghdad', 33.3128057, 44.36148750000007],
                ['Greenland', 71.706936, -42.604303000000016],
                ['Caracas', 10.4805937, -66.90360629999998],
                ['Solomon Is.', -9.64571, 160.15619400000003],
                ['Amsterdam', 52.3702157, 4.895167899999933],
                ['Belgrade', 44.786568, 20.44892159999995],
                ['Darwin', -12.4634403, 130.84564180000007],
                ['Australia/Sydney', -33.8688197, 151.20929550000005],
            ];
            var hard_coded_locations = [
                'Brisbane',
                'Alaska', 
                'Melbourne', 
                'Sydney', 
                'Kuala Lumpur', 
                'Singapore',
                'Hawaii', 
                'Eastern Time (US & Canada)', 
                'Wellington', 
                'Madrid',
                'Tokyo',
                'Karachi',
                'Hong Kong', 
                'Osaka', 
                'Beijing', 
                'Santiago',
                'Hanoi', 
                'Mumbai', 
                'Perth', 
                'Canberra', 
                'Kuwait',
                'Urumqi', 
                'Brasilia',
                'Bangkok', 
                'New Caledonia', 
                'Sri Jayawardenepura',
                'Jakarta', 
                'International Date Line West', 
                'Hobart',
                'Yakutsk',
                'Auckland', 
                'Bogota', 
                'Adelaide', 
                'Quito', 
                'Abu Dhabi', 
                'Rome', 
                'London', 
                'Baghdad', 
                'Greenland', 
                'Caracas',
                'Solomon Is.', 
                'Amsterdam',
                'Belgrade',
                'Darwin', 
                'Australia/Sydney'
            ];
            var heatMapData = [
            ];
            var map = new google.maps.Map(document.getElementById('world_map'), {
                zoom: 1,
                center: new google.maps.LatLng(-28.000767, 153.429642), // Gold Coast
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                    { "elementType": "geometry", "stylers": [ { "color": "#f5f5f5" } ] }, { "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "elementType": "labels.text.fill", "stylers": [ { "color": "#616161" } ] }, { "elementType": "labels.text.stroke", "stylers": [ { "color": "#f5f5f5" } ] }, { "featureType": "administrative.land_parcel", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [ { "color": "#bdbdbd" } ] }, { "featureType": "administrative.neighborhood", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "road", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "geometry", "stylers": [ { "color": "#ffffff" } ] }, { "featureType": "road.arterial", "elementType": "labels.text.fill", "stylers": [ { "color": "#757575" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#dadada" } ] }, { "featureType": "road.highway", "elementType": "labels.text.fill", "stylers": [ { "color": "#616161" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [ { "color": "#e5e5e5" } ] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [ { "color": "#eeeeee" } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#c9c9c9" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#9e9e9e" } ] }
                ]
            });

            var infowindow = new google.maps.InfoWindow();
            var geocoder = new google.maps.Geocoder();

            //var marker;            
            //alert(location_list.length);
            
            for (let i = 0; i < location_list.length; i++) {
                console.log(location_list[i]);
            }
            
            slice_of_location_list = location_list;
            //slice_of_location_list = location_list.slice(0,5);
            var str_tmp = "";
            
            slice_of_location_list.forEach(function (address) {
                var idx = hard_coded_locations.indexOf(address);
                //alert(address + "," + idx);                
                if (idx > -1){
                    var selected_location = world_locations[idx];
                    /*
                    var marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(selected_location[1], selected_location[2]),
                        optimized: false,
                        draggable: false
                    });
                    google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                        return function () {
                            infowindow.setContent(address);
                            infowindow.open(map, marker);
                        };
                    })(marker, i));
                    */
                    heatMapData.push({location: new google.maps.LatLng(selected_location[1], selected_location[2]), weight: location_info[idx] * 100000});                    
                }
            });
            var heatmap = new google.maps.visualization.HeatmapLayer({
                data: heatMapData
            });
            heatmap.setMap(map);
            /*
            slice_of_location_list.forEach(function (address) {
                geocoder.geocode({'address': address}, function (results, status) {
                    if ((status === 'OK') && (hard_coded_locations.indexOf(address) > -1)){
                        map.setCenter(results[0].geometry.location);
                        //var addr_coordinates = results[0].geometry.location;
                        var idx = hard_coded_locations.indexOf(address);
                        
                        
                        var marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                            optimized: false,
                            draggable: false
                        });
                        //alert(addr_coordinates.lat + "," addr_coordinates.lng);
                        //var str_tmp;
                       
                        //str_tmp = "['";     
                        //str_tmp += "'";
                        //str_tmp += address;
                        //str_tmp += "',";
                        //str_tmp += "',";
                        //str_tmp += addr_coordinates.lat();
                        //str_tmp += ",";
                        //str_tmp += addr_coordinates.lng();
                        //str_tmp += ",";
                        //str_tmp += "],";
                        //
                        //alert(str_tmp);
                        //console.log(str_tmp);
                    } else {
                        //alert('Geocode was not successful for the following reason: ' + status + '(' address + ')');

                        var str_err;
                        str_err = "Geocode was not successful for the following reason: ";
                        str_err += status;
                        str_err += '(';
                        str_err += address;
                        str_err += ')';
                        //alert(str_err);
                        //console.log(str_err);
                    }
                });
            });
            */
            //console.log(str_tmp);
            /*
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    optimized: false,
                    draggable: false
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        document.getElementById("data").value = locations[i][0];
                        document.getElementById('mother_of_all_demos').submit();
                    };
                })(marker, i));

                google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    };
                })(marker, i));
            }
            */
        </script>
    </body>
</html>
