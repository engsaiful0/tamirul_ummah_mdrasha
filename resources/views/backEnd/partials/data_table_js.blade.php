
@push('css')
<link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/jquery.data-tables.css') }}">
<link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/rowReorder.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/backEnd/assets/vendors/css/responsive.dataTables.min.css') }}">
@endpush

@push('script')
<script src="{{asset('public/backEnd/')}}/vendors/js/jquery.data-tables.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.buttons.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.flash.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/jszip.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/pdfmake.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/vfs_fonts.js"></script>
<script src="{{asset('public/backEnd/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.html5.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.print.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.rowReorder.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/backEnd/')}}/vendors/js/buttons.colVis.min.js"></script>

<script type="text/javascript">

if ($("#table_id, .school-table-data").length) {
    window.table = $("#table_id, .school-table-data").DataTable({
      bLengthChange: false,
      bDestroy: true,
      language: {
        search: "<i class='ti-search'></i>",
        searchPlaceholder: window.jsLang("search"),
        paginate: {
          next: "<i class='ti-arrow-right'></i>",
          previous: "<i class='ti-arrow-left'></i>",
        },
      },
      dom: "Bfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: '<i class="fa fa-files-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("copy_table"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "excelHtml5",
          text: '<i class="fa fa-file-excel-o"></i>',
          titleAttr: window.jsLang("export_to_excel"),
          title: $("#logo_title").val(),
          margin: [10, 10, 10, 0],
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "csvHtml5",
          text: '<i class="fa fa-file-text-o"></i>',
          titleAttr: window.jsLang("export_to_csv"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "pdfHtml5",
          text: '<i class="fa fa-file-pdf-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("export_to_pdf"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
          orientation: "landscape",
          pageSize: "A4",
          margin: [0, 0, 0, 12],
          alignment: "center",
          header: true,
          customize: function (doc) {
            doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
            doc.content.splice(1, 0, {
              margin: [0, 0, 0, 12],
              alignment: "center",
              image: "data:image/png;base64," + $("#logo_img").val(),
            });
            doc.defaultStyle = {
              font: "DejaVuSans",
            };
          },
        },
        {
  extend: "print",
  text: '<i class="fa fa-print"></i>',
  titleAttr: window.jsLang("print"),
  title: $("#logo_title").val(),
  exportOptions: {
    columns: ":visible:not(.not-export-col)",
  },
  customize: function (win) {
    // Get dynamic logo URL from input (e.g., hidden input field)
    const logoUrl = "data:image/png;base64," + $("#logo_img").val(); // Make sure it's a full URL or base64 string

    // Prepend the logo to the print body
    $(win.document.body)
      .prepend(`
        <div style="text-align:center; margin-bottom:20px;">
          <img src="${logoUrl}" style="height:80px;" />
        </div>
      `);

    // Optional: Styling tweaks
    $(win.document.body).css('font-size', '10pt');
    $(win.document.body).find('table')
      .addClass('compact')
      .css('font-size', 'inherit');
  }
},
        {
          extend: "colvis",
          text: '<i class="fa fa-columns"></i>',
          postfixButtons: ["colvisRestore"],
        },
      ],
      columnDefs: [
        {
          // visible: false,
          targets: -1,
          orderable: false
        },
      ],
      // responsive: true,
    });
  }

  if ($("#tableWithoutSort").length) {
    $("#tableWithoutSort").DataTable({
      bLengthChange: false,
      bDestroy: true,
      language: {
        search: "<i class='ti-search'></i>",
        searchPlaceholder: window.jsLang("search"),
        paginate: {
          next: "<i class='ti-arrow-right'></i>",
          previous: "<i class='ti-arrow-left'></i>",
        },
      },
      dom: "Bfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: '<i class="fa fa-files-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("copy_table"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "excelHtml5",
          text: '<i class="fa fa-file-excel-o"></i>',
          titleAttr: window.jsLang("export_to_excel"),
          title: $("#logo_title").val(),
          margin: [10, 10, 10, 0],
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "csvHtml5",
          text: '<i class="fa fa-file-text-o"></i>',
          titleAttr: window.jsLang("export_to_csv"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "pdfHtml5",
          text: '<i class="fa fa-file-pdf-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("export_to_pdf"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
          orientation: "landscape",
          pageSize: "A4",
          margin: [0, 0, 0, 12],
          alignment: "center",
          header: true,
          customize: function (doc) {
            doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
            doc.content.splice(1, 0, {
              margin: [0, 0, 0, 12],
              alignment: "center",
              image: "data:image/png;base64," + $("#logo_img").val(),
            });
            doc.defaultStyle = {
              font: "DejaVuSans",
            };
          },
        },
        {
          extend: "print",
          text: '<i class="fa fa-print"></i>',
          titleAttr: window.jsLang("print"),
          title: $("#logo_title").val(),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "colvis",
          text: '<i class="fa fa-columns"></i>',
          postfixButtons: ["colvisRestore"],
        },
      ],
      columnDefs: [
        {
          visible: false,
        },
      ],
      responsive: true,
      ordering: false,
    });
  }

  if ($("#noSearch").length) {
    $("#noSearch").DataTable({
      bLengthChange: false,
      bDestroy: true,
      language: {
        search: "<i class='ti-search'></i>",
        searchPlaceholder: window.jsLang("search"),
        paginate: {
          next: "<i class='ti-arrow-right'></i>",
          previous: "<i class='ti-arrow-left'></i>",
        },
      },
      dom: "Bfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: '<i class="fa fa-files-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("copy_table"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "excelHtml5",
          text: '<i class="fa fa-file-excel-o"></i>',
          titleAttr: window.jsLang("export_to_excel"),
          title: $("#logo_title").val(),
          margin: [10, 10, 10, 0],
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "csvHtml5",
          text: '<i class="fa fa-file-text-o"></i>',
          titleAttr: window.jsLang("export_to_csv"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "pdfHtml5",
          text: '<i class="fa fa-file-pdf-o"></i>',
          title: $("#logo_title").val(),
          titleAttr: window.jsLang("export_to_pdf"),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
          orientation: "landscape",
          pageSize: "A4",
          margin: [0, 0, 0, 12],
          alignment: "center",
          header: true,
          customize: function (doc) {
            doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
            doc.content.splice(1, 0, {
              margin: [0, 0, 0, 12],
              alignment: "center",
              image: "data:image/png;base64," + $("#logo_img").val(),
            });
            doc.defaultStyle = {
              font: "DejaVuSans",
            };
          },
        },
        {
          extend: "print",
          text: '<i class="fa fa-print"></i>',
          titleAttr: window.jsLang("print"),
          title: $("#logo_title").val(),
          exportOptions: {
            columns: ":visible:not(.not-export-col)",
          },
        },
        {
          extend: "colvis",
          text: '<i class="fa fa-columns"></i>',
          postfixButtons: ["colvisRestore"],
        },
      ],
      columnDefs: [
        {
          visible: false,
        },
      ],
      responsive: true,
      ordering: false,
      searching: false,
    });
  }
  
     pdfMake.fonts = {
         DejaVuSans: {
             normal: 'DejaVuSans.ttf',
             bold: 'DejaVuSans-Bold.ttf',
             italics: 'DejaVuSans-Oblique.ttf',
             bolditalics: 'DejaVuSans-BoldOblique.ttf'
         }
     };
</script>
@endpush