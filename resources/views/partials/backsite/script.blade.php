<script src="/backsite-assets/vendors/js/material-vendors.min.js"></script>
<script src="/backsite-assets/js/scripts/charts/chartjs/chart.js"></script>
<script src="/backsite-assets/js/scripts/charts/chartjs/chartjs-plugin-datalabels.js"></script>
<script src="/backsite-assets/js/scripts/charts/chartjs/chartjs-plugin-zoom.js"></script>
<script src="/backsite-assets/vendors/js/charts/raphael-min.js"></script>
<script src="/backsite-assets/vendors/js/charts/morris.min.js"></script>
<script src="/backsite-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js"></script>
<script src="/backsite-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js"></script>
<script src="/backsite-assets/data/jvector/visitor-data.js"></script>
<script src="/backsite-assets/vendors/js/table/datatable/datatables.min.js"></script>
<script src="/backsite-assets/js/core/app-menu.js"></script>
<script src="/backsite-assets/js/core/app.js"></script>
<script src="/backsite-assets/vendors/js/forms/select/select2.full.min.js"></script>
<script src="/backsite-assets/js/scripts/forms/select/form-select2.js"></script>
<script src="/backsite-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="/backsite-assets/vendors/js/forms/toggle/bootstrap-switch.min.js"></script>
<script src="/backsite-assets/js/scripts/pages/material-app.js"></script>
<script src="/backsite-assets/js/vendor/sweetalert.min.js"></script>
<script src="/backsite-assets/js/vendor/summernote.min.js"></script>
<script src="/backsite-assets/js/scripts/forms/custom-file-input.js"></script>
<script src="/backsite-assets/vendors/js/forms/toggle/switchery.min.js"></script>
<script src="/backsite-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>
<script src="/backsite-assets/js/scripts/forms/switch.js"></script>
<script src="/backsite-assets/js/scripts/helper.js"></script>
<script src="/backsite-assets/vendors/js/pickers/miniColors/jquery.minicolors.min.js"></script>
<script src="/backsite-assets/vendors/js/pickers/spectrum/spectrum.js"></script>
<script src="/backsite-assets/js/scripts/pickers/colorpicker/picker-color.js"></script>
<script src="/backsite-assets/js/flatpickr.js"></script>
<script src="/backsite-assets/js/jquery-ui.js"></script>

<script>
    $('.switchBootstrap').bootstrapSwitch();
    $(".flatpickr").flatpickr();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('.summernote').summernote({
        height: '300px',
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            ['font', ['fontname', 'fontsize', 'fontsizeunit', 'color']],
            ['para', ['ul', 'ol', 'paragraph', 'height']],
            ['insert', ['link', 'picture', 'video', 'table', 'hr']],
            ['misc', ['undo', 'redo', 'fullscreen', 'codeview', 'help']],
        ]
    });

    $('.auto-underscore').on('keyup', function() {
        var txtVal = $(this).val();
        txtVal = txtVal.toLowerCase();
        var finalres = txtVal.replace(/ /g,"_")
        $('.auto-underscore').val(finalres);
    })

    function formatDate(dateString) {
        if (!dateString) return ''; // Jika tidak ada tanggal, kembalikan string kosong

        const date = new Date(dateString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const day = String(date.getDate()).padStart(2, '0');
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}`;
    }

    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID', { style: 'decimal' }).format(number);
    }

    function getRandomColor(index) {
        const colors = ['#E50046', '#F7A8C4', '#FADA7A', '#FF9D23', '#4CC9FE', '#3674B5', '#B3D8A8', '#3A7D44', '#AA60C8', '#997C70', '#A6AEBF'];
        return colors[index % colors.length]; // Loop jika dataset lebih dari jumlah warna
    }
    
    function createSlug(text) {
        return text
            .toString()                 // Konversi ke string
            .toLowerCase()              // Ubah huruf ke lowercase
            .trim()                     // Hilangkan spasi di awal/akhir
            .replace(/[\s\W-]+/g, '-')  // Ganti spasi dan karakter tidak valid dengan "-"
            .replace(/^-+|-+$/g, '');   // Hilangkan "-" di awal/akhir
    }

    // ================================
    // UX SIDEBAR: AUTO SCROLL KE MENU AKTIF
    // ================================
    document.addEventListener("DOMContentLoaded", function () {
        const activeMenu = document.querySelector(
            ".main-menu .navigation li.active"
        );

        if (activeMenu) {
            activeMenu.scrollIntoView({
                behavior: "smooth",
                block: "center"
            });
        }
    });

</script>