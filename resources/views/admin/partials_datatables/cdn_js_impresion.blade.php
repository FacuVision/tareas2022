<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> --}}
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabla').DataTable({

            responsive: true,
            autowidth: false,

            "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pagina",
            "zeroRecords": "No hay registros, lo sentimos",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay datos",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "search": "Buscar:",

            'paginate':{
                'next':'Siguiente',
                'previous':'Anterior'
            }
        },
        dom:'Bfrtilp',
        buttons:[
                {
                    extend:'excelHtml5',
                    text:'<i class="fas fa-file-excel"></i>',
                    titleAttr:'Exportar a Excel',
                    className:'btn btn-success'
                },
                {
                    extend:'pdfHtml5',
                    text:'<i class="fas fa-file-pdf"></i>',
                    titleAttr:'Exportar a PDF',
                    className:'btn btn-danger'
                },
                {
                    extend:'print',
                    text:'<i class="fas fa-print"></i>',
                    titleAttr:'Imprimir',
                    className:'btn btn-info'
                }
            ]

        });
    } );
</script>
