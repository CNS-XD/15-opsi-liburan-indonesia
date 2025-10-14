<style>
    ::selection {
        color: #fff !important;
        background: {{ getColorTheme()->color_1 }} !important;
    }
    select option:checked,
    select option:hover,
    select:focus>option:checked {
        color: #fff !important;
        background: {{ getColorTheme()->color_1 }} !important;
    }
    .main-menu.menu-light .navigation>li.open>a {
        border-right: 4px solid {{ getColorTheme()->color_1 }};
    }

    .pagination .page-link {
        color: {{ getColorTheme()->color_1 }};
    }

    .modal-header:first-child,
    .modal-footer {
        background-color: {{ getColorTheme()->color_1 }} !important;
    }

    .nav-tabs .nav-link.active {
        color: {{ getColorTheme()->color_1 }} !important;
    }

    .nav-tabs .nav-link::before {
        background-color: {{ getColorTheme()->color_1 }} !important;
    }

    .border-info {
        border-color: {{ getColorTheme()->color_1 }} !important;
    }
    .bg-primary-c{
        background: {{ getColorTheme()->color_1 }} !important;
    }
    .color-primary{
        color: {{ getColorTheme()->color_1 }} !important;
    }
    /* Track */
    /* ::-webkit-scrollbar-track {
        background: #DFE0E4 !important;
    } */

    /* Handle */
    /* ::-webkit-scrollbar-thumb {
        background: {{ getColorTheme()->color_1 }} !important;
    } */

    /* Handle on hover */
    /* ::-webkit-scrollbar-thumb:hover {
        background: {{ getColorTheme()->color_1 }} !important;
    } */
    .main-menu.menu-light .navigation > li.menu-collapsed-open > a {
        color: #000;
        border-right: 4px solid {{ getColorTheme()->color_1 }} !important;
    }
    .loader-primary div {
        background-color: {{ getColorTheme()->color_1 }} !important;
    }
</style>