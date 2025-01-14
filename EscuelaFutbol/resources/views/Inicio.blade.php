@extends('template_tailwind')
@section('title', 'Inicio')
@section('content')

    <!-- IMAGEN 1 ------------------------------------------------->
    <div class="min-h-screen flex items-center justify-center">
        <div class=" w-full bg-gray-50 dark:bg-gray-700 pt-3 pb-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <dl
                    class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px] w-1/3">
                    <dt
                        class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $primerGrafico['total_jugadores'] }}</dt>
                    <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Total jugadores</dd>
                </dl>
                <dl class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px] w-1/3">
                    <dt
                        class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $primerGrafico['total_entrenadores'] }}</dt>
                    <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Total entrenadores</dd>
                </dl>
                <dl class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px] w-1/3">
                    <dt
                        class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                        {{ $primerGrafico['total_canchas'] }}</dt>
                    <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Total canchas</dd>
                </dl>
            </div>
        </div>
    </div>

    <!-- Contenedor Flex para los dos gráficos -->
    <div class="flex w-full space-x-4"> <!-- Esto hace que estén al lado y tenga espacio entre ellos -->
        <!-- IMAGEN 2 -->
        <div class="sm:w-1/2 w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between">
                <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">32.4k</h5>
                </div>
            </div>
            <div id="area-chart"></div>
        </div>

        <!-- IMAGEN 3 -->
        <div class="sm:w-1/2 w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                    <div class="flex items-center mb-1">
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Jugadores por
                            categoria</h5>
                    </div>
                </div>
            </div>
            <div id="pie-chart"></div>
        </div>
    </div>

    <!-- CHART5 HTML ------------------------------------------------->
    <div id="grafico-barras" class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg mt-6">
        <h2 class="text-xl font-semibold text-center mb-4">Estado de Pago de Jugadores</h2>
        <div id="chart"></div>
    </div>

    <!-- scripts core ------------------------------------------------->
    <script src="{{ asset('tailwind/apexcharts.js') }}"></script>
    <script src="{{ asset('tailwind/flowbite.min.js') }}"></script>

    <!-- IMAGEN 2 JS ------------------------------------------------->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const options = {
                chart: {
                    height: "100%", // Configuración de altura 100%
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    dropShadow: {
                        enabled: false,
                    },
                    toolbar: {
                        show: true, // Activamos la barra de herramientas
                        tools: {
                            download: true, // Habilitamos la opción de descarga
                        },
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {
                        show: false,
                    },
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: "#1C64F2",
                        gradientToColors: ["#1C64F2"],
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: {
                        left: 2,
                        right: 2,
                        top: 0
                    },
                },
                series: [{
                    name: "New users",
                    data: [6500, 6418, 6456, 6526, 6356, 6456],
                    color: "#1A56DB",
                }],
                xaxis: {
                    categories: ['01 February', '02 February', '03 February', '04 February', '05 February',
                        '06 February', '07 February'
                    ],
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                yaxis: {
                    show: false,
                },
            }

            if (document.getElementById("area-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("area-chart"), options);
                chart.render();
            }
        });
    </script>

    <!-- IMAGEN 3 JS ------------------------------------------------->
    <script>
        // Los datos de categorías y jugadores se pasan desde el controlador en la vista
        const categorias = @json($segundoGrafico); // Convierte los datos PHP a un objeto JavaScript

        // Generar los datos para el gráfico
        const seriesData = categorias.map(item => item.total_jugadores);
        const labelsData = categorias.map(item => item.categoria);

        const getChartOptions = () => {
            return {
                series: seriesData, // Usamos los datos de jugadores
                colors: ["#1C64F2", "#16BDCA", "#9061F9"], // Puedes ajustar los colores
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                    toolbar: {
                        show: true, // Activamos la barra de herramientas
                        tools: {
                            download: true, // Habilitamos la opción de descarga
                        },
                    },
                },
                stroke: {
                    colors: ["white"],
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: labelsData, // Usamos las categorías como etiquetas
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
            }
        }

        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
        }
    </script>

    <!-- CHART5 JS ------------------------------------------------->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datos del gráfico: estado de pago de los jugadores
            var opciones = {
                chart: {
                    type: 'bar', // Tipo de gráfico: Barras
                    height: 350
                },
                series: [{
                    name: 'Jugadores',
                    data: [3, 4, 3], // Ejemplo: [Pagado, Pendiente, Retrasado]
                }],
                xaxis: {
                    categories: ['Pagado', 'Pendiente', 'Retrasado'], // Etiquetas de las barras
                },
                title: {
                    text: 'Estado de Pago de Jugadores',
                    align: 'center',
                    style: {
                        fontSize: '18px',
                        fontWeight: 'bold',
                        color: '#333'
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false, // Barras verticales
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                colors: ['#0EAA61', '#F6DCAC', '#C80000'], // Colores personalizados
            };

            // Crear el gráfico
            var chart = new ApexCharts(document.querySelector("#chart"), opciones);
            chart.render();
        });
    </script>

@endsection
