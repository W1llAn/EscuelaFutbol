@extends('template_tailwind')
@section('title', 'Inicio')
@section('content')

<!-- IMAGEN 1 ------------------------------------------------->
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full bg-gray-50 dark:bg-gray-700 pt-3 pb-3 rounded-lg">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-2">
            <dl
                class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt
                    class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                    {{ $primerGrafico['total_jugadores'] }}
                </dt>
                <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Total jugadores</dd>
            </dl>
            <dl
                class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt
                    class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                    {{ $primerGrafico['total_entrenadores'] }}
                </dt>
                <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Total entrenadores</dd>
            </dl>
            <dl
                class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                <dt
                    class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                    {{ $primerGrafico['total_canchas'] }}
                </dt>
                <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Total canchas</dd>
            </dl>
        </div>
    </div>
</div>

<!-- Contenedor Flex para los dos gráficos -->
<div class="flex flex-col sm:flex-row w-full space-y-4 sm:space-y-0 sm:space-x-4">
    <!-- IMAGEN 2 -->
    <div class="sm:w-1/2 w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between">
            <div>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Ingresos mensuales</h5>
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
        // Datos de ejemplo simulando los recibidos de tu API
        const dataFromApi = @json($tercerGrafico);

        // Procesar los datos para extraer categorías y valores
        const categories = dataFromApi.map(item => item.mes); // ['2025-01', '2025-02']
        const seriesData = dataFromApi.map(item => parseFloat(item.total_pago)); // [215.00, 50.00]

        // Configuración del gráfico
        const options = {
            chart: {
                height: "100%",
                type: "area",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                    enabled: false,
                },
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    },
                },
            },
            tooltip: {
                enabled: true,
                x: {
                    show: true, // Mostrar el valor de la categoría en el tooltip
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
                name: "Total Pago",
                data: seriesData, // [215.00, 50.00]
                color: "#1A56DB",
            }],
            xaxis: {
                categories: categories, // ['2025-01', '2025-02']
                labels: {
                    show: true,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    show: true, // Mostrar los valores en el eje Y
                },
            },
        };

        // Renderizar el gráfico si el contenedor existe
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
        // Datos del gráfico obtenidos desde PHP
        var cuartoGrafico = @json($cuartoGrafico);

        // Extraer categorías y valores del array JSON
        var categorias = cuartoGrafico.map(item => item.estado_pago);
        var valores = cuartoGrafico.map(item => parseInt(item.total_jugadores, 10));

        // Opciones del gráfico de barras
        var opciones = {
            chart: {
                type: 'bar', // Tipo de gráfico: Barras
                height: 350
            },
            series: [{
                name: 'Jugadores',
                data: valores, // Valores dinámicos de total_jugadores
            }],
            xaxis: {
                categories: categorias, // Categorías dinámicas de estado_pago
            },
            title: {
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
            dataLabels: {
                enabled: false // Desactivar valores visuales en las barras
            },
            colors: ['#0EAA61', '#F6DCAC', '#C80000'], // Colores personalizados
        };

        // Crear el gráfico
        var chart = new ApexCharts(document.querySelector("#chart"), opciones);
        chart.render();
    });
</script>

@endsection