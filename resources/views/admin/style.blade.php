<link rel="stylesheet" href="{{asset('select/dist/css/bootstrap-select.min.css')}}" >
<link href="{{asset('select/datatable/datatables.min.css')}}" rel="stylesheet" type="text/css" media="all">

<link href="{{asset('select/datatable/DataTables-1.12.1/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" media="all">

<link href="{{asset('select/datatable/Buttons-2.2.3/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" media="all">

<link rel="stylesheet" href="{{asset('select/dist/uploader/image-uploader.min.css')}}" >
<link href="{{asset('select/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css" media="all">

<style >
.required{
  color:red;
}
.BanzimaTd{
  min-width:80px;
  max-width: 200px;
}

.dt-text{
  color: #26004d;
}
.required{
  color:red;
}
th{
background-color:#fdfff8;
}
@media screen and (min-width: 768px) {
  .dt-bootstrap4{
    display: flex;
flex-wrap: wrap;
/* font-size: 30px; */
text-align: center;
  }
  .dt-buttons{
    position: absolute;
    width:40%;
    margin:auto;

  }
  .dataTables_length{
    /* float:right;
    margin-top: 40px; */

    width:30%;

  }
  .dataTables_filter{
    /* float:left;
    position: absolute; */
    width:30%;


  }
}


.color-text{

  text-transform: capitalize;
font-size: 1rem;
  color: #3d5c5c;
  font-weight: bold;
/* padding-top: 10%; */

}
.Banzima-check-container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 1.2rem;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
/* Hide the browser's default checkbox */
.Banzima-check-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.banzima-check-checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #b3cccc;
}

/* On mouse-over, add a grey background color */
.Banzima-check-container:hover input ~ .banzima-check-checkmark {
  background-color: #527a7a;
}

/* When the checkbox is checked, add a blue background */
.Banzima-check-container input:checked ~ .banzima-check-checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.banzima-check-checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.Banzima-check-container input:checked ~ .banzima-check-checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.Banzima-check-container .banzima-check-checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
/* //////////////////////////////////////////////////////////////// */
/* The container */
.radio-container {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.radio-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.radio-checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #b3cccc;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.radio-container:hover input ~ .radio-checkmark {
  background-color: #527a7a;
}

/* When the radio button is checked, add a blue background */
.radio-container input:checked ~ .radio-checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.radio-checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.radio-container input:checked ~ .radio-checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.radio-container .radio-checkmark:after {
 	top: 7px;
	left: 7px;
	width: 6px;
	height: 6px;
	border-radius: 50%;
	background: white;
}

</style>
@if(app()->getLocale() == 'ar')
<style>
.form-group2 {
  text-transform: capitalize;
font-size: 1.16rem;
  color: #3d5c5c;
  font-weight: bold;
  margin-bottom: 1rem;

}
.custom-file-input:lang(en) ~ .custom-file-label::after {
  content: "تصفح";
}

</style>
@else
<style>
.form-group2 {
  text-transform: capitalize;
font-size: 1.1rem;
  color: #3d5c5c;
  font-weight: bold;
  margin-bottom: 1rem;
}
.color-text-home{

  text-transform: capitalize;
font-size: 1.45rem;
  color: #3d5c5c;
  font-weight: bold;

}
.text-capital{
  text-transform: capitalize;
  font-weight: bold;
}

</style>
@endif
