$(document).ready(function () {
    $(".datatable").DataTable({ 
        responsive: !1,
        dom: 'Bfrtlip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ] 
    }), $(".dataTables_length select").addClass("form-select form-select-sm");
}),
    flatpickr(".datepicker-range", { mode: "range", altInput: !0, wrap: !0 });
