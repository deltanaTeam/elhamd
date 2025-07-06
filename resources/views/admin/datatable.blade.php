<script src="{{asset('select/jquery-3.6.0.min.js')}}" ></script>

<script  type="text/javascript" src="{{asset('select/datatable/DataTables-1.12.1/js/jquery.dataTables.min.js')}}"></script>

<script  type="text/javascript" src="{{asset('select/datatable/DataTables-1.12.1/js/dataTables.bootstrap4.min.js')}}"></script>

<script  type="text/javascript" src="{{asset('select/datatable/Buttons-2.2.3/js/dataTables.buttons.min.js')}}"></script>

<script  type="text/javascript" src="{{asset('select/datatable/Buttons-2.2.3/js/buttons.bootstrap4.min.js')}}"></script>

<script  type="text/javascript" src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>

<script type="text/javascript">
window.initDataTable = function (selector, ajaxUrl, columns) {
  const isArabic = document.documentElement.lang === 'ar';

  $(selector).DataTable({
      processing: true,
      serverSide: true,
      ajax: ajaxUrl,
      columns: columns,
      language: isArabic ? arabicLang : {},

      // Optional styling & layout
      responsive: true,
      autoWidth: false,
      pageLength: 10,
  });
};

const arabicLang = {
  processing: "جارٍ التحميل...",
  lengthMenu: "أظهر _MENU_ مدخلات",
  zeroRecords: "لم يُعثر على أية سجلات",
  info: "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
  infoEmpty: "يعرض 0 إلى 0 من أصل 0 سجل",
  infoFiltered: "(منتقاة من مجموع _MAX_ مُدخل)",
  search: "ابحث:",
  paginate: {
      first: "الأول",
      previous: "السابق",
      next: "التالي",
      last: "الأخير"
  },
  emptyTable: "لا توجد بيانات متاحة في الجدول",
};
$(function () {
    $('.datatable').each(function () {
        const url = $(this).data('url');
        const columns = window.getColumnsFor($(this).attr('id'));
        if (url && columns) {
            initDataTable('#' + $(this).attr('id'), url, columns);
        }
    });
});
</script>
