<meta charset="utf-8" />
<link rel="icon" type="image/png" href="{{url('assets/img/favicon.ico')}}">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<meta name="author" content="Virgilio La Rosa, Paola Brito" />
<meta name="keywords" content="U. E. C. Nuestra Señora de la Consolación" />
<meta name="description" content="Nuestra Señora de la Consolación" />
<title>U.E.C. "Nuestra Señora de la Consolación"</title>
<!-- Bootstrap core CSS -->
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
<!-- Animation library for notifications -->
<link href="{{url('assets/css/animate.min.css')}}" rel="stylesheet"/>
<!-- Light Bootstrap Table core CSS -->
<link href="{{url('assets/css/light-bootstrap-dashboard.css')}}" rel="stylesheet"/>
<!-- CSS for Demo Purpose, don't include it in your project -->
<link href="{{url('assets/css/demo.css')}}" rel="stylesheet" />
<!-- Fonts and icons -->
<link href="{{url('assets/dpd/fontawesome-free-5.3.1-web/css/all.css')}}" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
<link href="{{url('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
<link href="{{url('assets/css/global.css')}}" rel="stylesheet" />
<script src="{{url('assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/dpd/select2-4.0.3/dist/css/select2.min.css')}}"/>
<script src="{{asset('assets/dpd/select2-4.0.3/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/dpd/jquery-ui-1.12.1.custom/jquery-ui.min.css')}}"/>
<script src="{{asset('assets/dpd/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
<script src="{{url('assets/js/light-bootstrap-dashboard.js')}}"></script>
<script src="{{asset('assets/dpd/moment.min.js')}}"></script>
<script type="text/javascript">
 function currentSpace() {
   return "{{url('panel')}}";
 }
</script>
<script type="text/javascript">
 $(document).ready(function() {
   setTimeout(function() {
     $(".ghost").fadeOut(3000);
   },3000);
 });
</script>
<script>
 $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();   
 });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.datepicker').datepicker({dateFormat:'yy-mm-dd'});     
  });
</script>
<script type="text/javascript">
  
  $(function($){
    $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '<Ant',
      nextText: 'Sig>',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
  });
</script>