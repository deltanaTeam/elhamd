<script src="{{asset('select/jquery-3.6.0.min.js')}}" ></script>

<script src="{{asset('select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('select/dist/uploader/image-uploader.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('select/js/jquery.datetimepicker.full.min.js')}}"></script>
<!-- <script  type="text/javascript" src="{{asset('datatable2/datatables.min.js')}}"></script> -->

<!-- datatatable -->

<script  type="text/javascript" src="{{asset('select/datatable/DataTables-1.12.1/js/jquery.dataTables.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('select/datatable/DataTables-1.12.1/js/dataTables.bootstrap4.min.js')}}"></script>



<!-- datatable -button -->
<script  type="text/javascript" src="{{asset('select/datatable/Buttons-2.2.3/js/dataTables.buttons.min.js')}}"></script>

<script  type="text/javascript" src="{{asset('select/datatable/Buttons-2.2.3/js/buttons.bootstrap4.min.js')}}"></script>
<script  type="text/javascript" src="{{asset('/vendor/datatables/buttons.server-side.js')}}"></script>
<!-- pdf -->
<!-- <script  type="text/javascript" src="{{asset('select/datatable/pdfmake-0.1.36/pdfmake.min.js')}}"></script> -->

<!-- <script src="{{asset('assets/plugins/custom/datatables/datatables.bundled1cf.js')}}" ></script> -->
<!-- <script src="{{asset('assets/js/scripts.bundled1cf.js?v=7.1.6')}}"></script> -->
<script type="text/javascript">
  var KTBootstrapSelect=function(){
    var demos=function(){
      $('.kt-selectpicker').selectpicker();
        return
          init: function(){
            demos();
          }
        }
      }

                  jQuery(document).ready(function(){
                    KTBootstrapSelect.init();
                  });
  ////////////////////////////////////////////////////////////////////////////////////////////////////
  </script>
<script type="text/javascript">
  function make_money_format(id){
   var money_input = document.getElementById(id);
   var money_value = Math.abs(money_input.value);
   var numObj = {
     maximumFractionDigits:3
   }
   var value = money_value ;
    if(id=="exchange_rate"){
        numObj = {
        maximumFractionDigits:6
      }
    }
   money_input.value = new Number(money_value).toLocaleString("en-US",numObj);
  }
  function AddRowinput(){
   var count = document.getElementById("tableInputs").rows.length;
   var table = document.getElementById("tableInputs");
    // // var options = document.getElementById("select1");
    var selecte= document.getElementById("selectForm");
    //
    var first_row=document.getElementById("row_1");
    var row = table.insertRow(count);
     row.id="row_"+count;
    var data=first_row.innerHTML;
    var cell1 = row.innerHTML=data;
    var xx = row.firstElementChild.innerHTML = selecte.innerHTML;



  }
  function  DeleteRowinput(id){
    var x=id;
    var p1 = x.parentElement;
    var p2 = p1.parentElement;
    var p3 = p2.parentElement;
    var id1=p3.id;
    if(p3 !=null && id1!="row_1" && id1!="row_2" ){
      p3.remove();
    }

    // document.getElementById("tableInputs").deleteRow(id);

  }
///////////////////////////////////////////////////////////////////////////////////
  function check_all_func(){
      var checkhead = document.getElementById("check_all");
      var check_td = document.getElementsByClassName("check_row");
      var asd = check_td.length;

      if (checkhead.checked == true){
        for (i = 0; i < check_td.length; i++) {
          check_td[i].checked =true;
        }
      }
      else{
        for (i = 0; i < check_td.length; i++) {
          check_td[i].checked =false;
        }
      }
    }

</script>

@if(app()->getLocale() == 'ar')

<script type="text/javascript">
$(document).ready(function () {

    //$(window).bind("load", function() {

        if ($('.BanzinaTable').length > 0) {
        var tableData = $('.BanzinaTable').DataTable({
                //stateSave: true,

               // processing: true,
                //serverSide: true,
                "language":
        {
            "sProcessing": "جارٍ التحميل...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix": "",
            "sSearch": "ابحث:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        },
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                //dom: 'lBfrtip',

                initComplete: function () {
                            this.api().columns().every( function () {
                                var column = this;
                                var select = $('<select class="form-control selectpicker" title=" " data-live-search="true" data-size="2"><option value=""></option></select>')
                                    .appendTo( $(column.header()).empty() )
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                    } );

                                column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d+'">'+d+'</option>' )
                                } );
                            } );
                        }


            });
        }
    //});


});


///////////////////////////////////////////////////////
  $('.input-images-1').imageUploader({
    label:"افلت الصورة هنا  او اختر صورة من جهازك",
    maxFiles: 10,
    imagesInputName: 'photos',
});
//////////////////////////////////////////////////////////////

$('.BanzinaSelect').selectpicker({noneSelectedText:'لم يتم الاختيار ',
  noneResultsText: ' {0} لا يوجد نتيجة مطابقة',
  liveSearch: true,
  showIcon:true,
  dir:'rtl',
  text:'color:grey',
  style:' border: 5px solid red;',
});
////////////////////////////////////////////////////////////
$.datetimepicker.setLocale('ar');

   $('.BanzinaDate').datetimepicker({
  i18n:{
  ar:{
   months:[
    'يناير','فبراير','مارس','ابريل',
    'مايو','يونيه','يوليو','اغسطس',
    'سبتمبر','اكتوبر','نوفمبر','ديسمبر',
   ],

  }
 },
  lang:'ar',
  timepicker:false,
  format:'Y/m/d',
  formatDate:'Y/m/d',
// contentWindow:window,

// size
});


</script>
@else
<script type="text/javascript">
$(document).ready(function(){

  if ($('.BanzinaTable').length > 0) {
var oTable = $('.BanzinaTable').dataTable({
       lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
});
}
});

//////////////////////////////////////////////////////////////////
  $('.input-images-1').imageUploader({
    label:"Drag & Drop files here or click to browse",
       maxFiles: 10,
       imagesInputName: 'photos',


});
/////////////////////////////////////////////////////////////////////
$('.BanzinaSelect').selectpicker({noneSelectedText:'Nothing selected',
  noneResultsText: 'No results matched {0}',
  liveSearch: true,
 showIcon:true,
});

//////////////////////////////////////////////////////////////////
$('.BanzinaDate').datetimepicker({
timepicker:false,
format:'Y/m/d',
formatDate:'Y/m/d',

applyLabel:'Enter to select date',
});

</script>
@endif


<!--end mycode -->
