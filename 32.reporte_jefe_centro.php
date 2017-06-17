<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="iE=edge">
	<meta charset="utf-8">
    <title>Reportes de jefe de centro</title>
      <link rel="stylesheet" type="text/css" href="../../css/demos.css" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,400' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="../../css/jsgrid.css" />
    <link rel="stylesheet" type="text/css" href="../../css/theme.css" />
    <link rel="stylesheet" type="text/css" href="../../css/font-awesome.css">

    <script src="../../js/jquery/jquery-1.8.3.js"></script>

    <script src="../../js/jsgrid/jsgrid.core.js"></script>
    <script src="../../js/jsgrid/jsgrid.load-indicator.js"></script>
    <script src="../../js/jsgrid/jsgrid.load-strategies.js"></script>
    <script src="../../js/jsgrid/jsgrid.sort-strategies.js"></script>
    <script src="../../js/jsgrid/jsgrid.field.js"></script>
	  <script src="../../js/jsgrid/fields/jsgrid.field.text.js"></script>
    <script src="../../js/jsgrid/fields/jsgrid.field.number.js"></script>
    <script src="../../js/jsgrid/fields/jsgrid.field.select.js"></script>
    <script src="../../js/jsgrid/fields/jsgrid.field.checkbox.js"></script>
    <script src="../../js/jsgrid/fields/jsgrid.field.control.js"></script>

    <style>
        .sort-panel {
            padding: 10px;
            margin: 10px 0;
            background: #fcfcfc;
            border: 1px solid #e9e9e9;
            display: inline-block;
        }
    </style>
</head>
<body>
  <img src="../../img/image001.png" />   
  <h1>Reporte para Jefes de Centro</h1>
  <div class="sort-panel">
      <label>Seleccione un Campus - Período
          <select id="campus" class="form-control"></select>
          <a type="button" class="btn btn-primary" onclick="ver_cursos();"><i class="fa fa-search" aria-hidden="true"></i> Ver cursos</a>
      </label>
  </div>
    
  <div id="reporte"></div>

  <div id="cursos"></div>

  <div>
    <p><b>*Es la cantidad de alumnos de ese campus + periodo en ese curso</b></p>
    <p><b>**Es el acta final de notas Curso regular + subsanaci&oacute;n</b></p>
  </div>

	<div id="notas">
		<p>LiSTA DE TUTORES DEL CURSO :</p>
	    <p>Seguridad e higiene industrial (SHiN) - 201620 - SUBSANACiON - Grupo C2 - ZONAL LiMA CALLAO (7647)</p>
  </div>
	
 <div >
    <div class="treeview">
      <ul>
        <li><a href="#">Más reportes</a>
    			<ul>
    				<li><a href="./Reporte%20Jefe%20Centro/Busqueda%20Alumno/reporte_jefes_busca.html"><i class="fa fa-search" aria-hidden="true"></i> Búsqueda de alumnos</a></li>
    				<li><a href="./Reporte%20Jefe%20Centro/Alumno%20Curso%20por%20Periodo/alumno_curso_por_periodo.html"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alumnos-curso x periodo</a></li>
    				<li><a href="./Reporte%20Jefe%20Centro/Alumnos%20Campus%20Zonal%20x%20Periodo/campus_zona_por_periodo.html"><i class="fa fa-university" aria-hidden="true"></i> Alumnos por Campus-zonal x periodo</a></li>
    			</ul>
        </li>
      </ul>
    </div>
  </div>
  <img src="../../img/image002.png" />   

<script>
$(function() {
  //on load
  var usuario = 5; //$usuario=$USER->id; dato sacado de sesion?
  var cursos_data;
  var campus_data;
  var html_campus = "";

  var esjefe;
  var campus_repo;
  var ver_cursos = "";

  var titulo_pagina = ""
  $.ajax({
    url : "http://apisenati.azurewebsites.net/api/DAO/REPORTE_JEFES.php?action=GetListar&usuario="+usuario,
    type: "GET",
    contentType: "application/json;charset=utf-8",
    async: false,
    dataType: "json",
    success: function(data) {
      esjefe = data.jefe_centro;
      campus_repo = campus_repo;
    },
    error : function(xhr,errmsg,err) {
      console.log(xhr.status + ": " + xhr.responseText);
    }
  });

  if (esjefe == 's') {
    titulo_pagina = "Reporte para Jefes de Centro";
    // $site = get_site();
    // print_header("$site->shortname : ". $titulo_pagina, "X1", $titulo_pagina, "", "", true, "");
    if (campus_repo == "") {
      $.ajax({
      url : "http://apisenati.azurewebsites.net/api/DAO/REPORTE_JEFES.php?action=GetCampus",
      type: "GET",
      contentType: "application/json;charset=utf-8",
      async: false,
      dataType: "json",
      success: function(data) {
        campus_data = data;
      },
      error : function(xhr,errmsg,err) {
        console.log(xhr.status + ": " + xhr.responseText);
      }
      });
    } else {
      $.ajax({
      url : "http://apisenati.azurewebsites.net/api/DAO/REPORTE_JEFES.php?action=GetEspecifico&campus_repo="+campus_repo,
      type: "GET",
      contentType: "application/json;charset=utf-8",
      async: false,
      dataType: "json",
      success: function(data) {
        campus_data = data;
      },
      error : function(xhr,errmsg,err) {
        console.log(xhr.status + ": " + xhr.responseText);
      }
      });
    }
    $.each(campus_data, function(key,items) {
      var camp = item.camp;
      var periodo = item.periodo;
      var campus = item.nombre_centro;
      html_campus += "<OPTION"+ este +"value='"+ camp +"-"+ periodo + "'>"+ campus+" - "+periodo +"</OPTION>";
    });
    $("#campus").html(html_campus);

  } else {
    $("body").html("Debe ser Jefe para entrar a esta pagina");
  }
});

function ver_cursos(){
  $.ajax({
  url : "http://apisenati.azurewebsites.net/api/DAO/REPORTE_JEFES.php?action=ListaCampus&id_curso="+id_curso,
  type: "GET",
  contentType: "application/json;charset=utf-8",
  async: false,
  dataType: "json",
  success: function(data) {
    cursos_data = data;
    ver_cursos = "si";
  },
  error : function(xhr,errmsg,err) {
    console.log(xhr.status + ": " + xhr.responseText);
  }
  });

  var html_reporte = "";
  var html_cursos = "";
  var campus_val = $("#campus").val();
  var campus_text = $("#campus option:selected").text();
  var val_index = campus_val.indexOf("-");
  var val_text = campus_text.indexOf(" - ");
  var camp_vc = campus_val.substring(0, val_index);
  var campus_vc = campus_text.substring(0, val_text);
  var periodo_vc = campus_val.substring(val_index+1);
  
  html_reporte += "<table><thead class='lightblue'><tr><th colspan='2'>REPORTE</th></tr></thead><tbody><tr><td>CAMP</td><td>"+camp_vc+"</td></tr><tr><td>CAMPUS</td><td>"+campus_vc+"</td></tr><tr><td>PERIODO</td><td>"+periodo_vc+"</td></tr></tbody></table>";
  $("#reporte").html(html_reporte);

  html_cursos += "<TABLE cellspacing='1' cellpadding='2' border='1'><tr><td bgcolor=silver><strong>ID CURSO</strong></TD><td bgcolor=silver><strong>NOMBRE CURSO</strong></TD><td bgcolor=silver><strong>Alumnos*</strong></TD><td bgcolor=silver><strong>Ver</strong></TD><td bgcolor=silver><strong>Ver</strong></TD><td bgcolor=silver><strong>Ver</strong></TD><td bgcolor=silver><strong>Ver</strong></TD></TR>";
  $.each(cursos_data, function(key,items) {
    html_campus += "<TR><TD align=center>"+items.id+"</TD><TD>"+items.fullname+"</TD><TD align=right>"+items.alumnos+"</TD><TD align=center><a href='./ver_listado.php&id="+items.id+"'><u>Listado</u></a></TD><TD align=center><a href='./ver_listado_evidencias.php&id="+items.id+"'><u>Evidencias</u></a></TD><TD align=center><a href='./ver_tutores.php&id="+items.id+"'><u>Tutores</u></a></TD><TD align=center><a href='./ver_acta_notas.php&id="+items.id+"'><u>Acta de Notas</u></a></TD></TR>";
  });
  html_cursos += "</TABLE>";
  $("#cursos").html(html_cursos);
}
</script>  
<script src="../../js/filter/list.js"></script>
</body>	
</html>
