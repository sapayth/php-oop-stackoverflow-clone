        <!--footer start-->
        <div id="footer" class="ui-footer">
                2020 &copy; Arup Paul .
            </div>
            <!--footer end-->

        </div>

        <!-- inject:js -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
        <script src="assets/bower_components/autosize/dist/autosize.min.js"></script>
        <!-- endinject -->

        <!--highcharts-->
        <script src="assets/bower_components/highcharts/highcharts.js"></script>
        <script src="assets/bower_components/highcharts/highcharts-more.js"></script>
        <script src="assets/bower_components/highcharts/modules/exporting.js"></script>
        <!--polar-chart init-->
        <script>

            //polar chart

            $(function () {

                Highcharts.chart('polar-chart', {

                    chart: {
                        polar: true
                    },

                    title: {
                        text: 'Highcharts Polar Chart'
                    },

                    pane: {
                        startAngle: 0,
                        endAngle: 360
                    },

                    xAxis: {
                        tickInterval: 45,
                        min: 0,
                        max: 360,
                        labels: {
                            formatter: function () {
                                return this.value + '°';
                            }
                        }
                    },

                    yAxis: {
                        min: 0
                    },

                    plotOptions: {
                        series: {
                            pointStart: 0,
                            pointInterval: 45
                        },
                        column: {
                            pointPadding: 0,
                            groupPadding: 0
                        }
                    },

                    series: [{
                        type: 'column',
                        name: 'Column',
                        data: [8, 7, 6, 5, 4, 3, 2, 1],
                        pointPlacement: 'between'
                    }, {
                        type: 'line',
                        name: 'Line',
                        data: [1, 2, 3, 4, 5, 6, 7, 8]
                    }, {
                        type: 'area',
                        name: 'Area',
                        data: [1, 8, 2, 7, 3, 6, 4, 5]
                    }]
                });
            });
        </script>

        <!--sparkline-->
        <script src="assets/bower_components/bower-jquery-sparkline/dist/jquery.sparkline.retina.js"></script>
        <script src="assets/assets/js/init-sparkline.js"></script>


        <!--echarts-->
        <script type="assets/text/javascript" src="assets/js/echarts/echarts-all-3.js"></script>

        <!--basic line echarts init-->
        <script type="text/javascript">

            var chartOneDom = document.getElementById("b-line");
            var chartOne = echarts.init(chartOneDom);

            var chartOneOption = {
                color: ['#4aa9e9','#eac459'],

                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['Max','Min']
                },

                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data: ['Sat','Sun','Mon','Tue','Wed','Thu','Fri']
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLabel : {
                            formatter: '{value} °C'
                        }
                    }
                ],
                series : [
                    {
                        name:'Max',
                        type:'line',
                        data:[11, 11, 15, 13, 12, 13, 10],
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                                {type : 'min', name: 'Min'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
                    {
                        name:'Min',
                        type:'line',
                        data:[1, -2, 2, 5, 3, 2, 0],
                        markPoint : {
                            data : [
                                {name : 'Min of Week', value : -2, xAxis: 1, yAxis: -1.5}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : 'Average'}
                            ]
                        }
                    }
                ]
            };

            if (chartOneOption && typeof chartOneOption === "object") {
                chartOne.setOption(chartOneOption, true);
            }

        </script>

        <!--basic area echarts init-->
        <script type="text/javascript">

            var dom = document.getElementById("b-area");
            var myChart = echarts.init(dom);

            var app = {};
            option = null;
            option = {
                color: ['#8dcaf3','#67f3e4', '#4aa9e9' ],

                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:['Preorder','Sale','Deal']
                },

                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : ['Mon','Tue','Wed','Thu','Fri','Sat','Sun']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Deal',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[10, 12, 21, 54, 260, 830, 710]
                    },
                    {
                        name:'Sale',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[30, 182, 434, 791, 390, 30, 10]
                    },
                    {
                        name:'Preorder',
                        type:'line',
                        smooth:true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[1320, 1132, 601, 234, 120, 90, 20]
                    }
                ]
            };

            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, false);
            }

            /**
             * Resize chart on window resize
             * @return {void}
             */
            window.onresize = function() {
                chartOne.resize();
                myChart.resize();
            };


        </script>

        <!--easypiechart-->
        <script src="assets/assets/js/jquery-easy-pie-chart/jquery.easypiechart.js"></script>
        <script>
            $(function() {
                $('.chart').easyPieChart({
                    //your configuration goes here
                });
            });
        </script>


        <!--horizontal-timeline-->
        <script src="assets/assets/js/horizontal-timeline/js/jquery.mobile.custom.min.js"></script>
        <script src="assets/assets/js/horizontal-timeline/js/main.js"></script>

        <!-- Common Script   -->
        <script src="assets/dist/js/main.js"></script>


    </body>
</html>
