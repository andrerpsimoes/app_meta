<?php

 include("../../restrito.php");

  //caso seja feito o logout a sessao tem de ser destruida e faz o refresh pois vai verificar outra vez se tem sessao
  //iniciada, como ve que nao tem este e redirecionado para a pagina incial
  if (isset($_GET['logout'])) {
  session_destroy();
  header("Refresh:0");
  } 

include '../../configs/config.php'; // MetaveiroAppTestes

$id_area_mae = $_POST['id_area_mae'];


if (!$id_area_mae == NULL) {
    $select_filhos = '
<select multiple id=multiple_filhos>
    <option disabled selected>Escolha a Subárea</option>';

    $query_areas = $conn_meta->prepare("select id, descricao from area where id_parent= '" . $id_area_mae . "' and is_active = 1");
    $query_areas->execute();
    $filhos = $query_areas->fetchAll();
    foreach ($filhos as $filho) {
        $select_filhos .= "<option value='" . $filho['id'] . "'>" . $filho['descricao'] . "</option>";
    };

    $select_filhos .= '</select>'
            . '<label>Subáreas</label>';

    echo $select_filhos;
} else {
    return 0;
}
?>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
</script>

