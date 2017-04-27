<?php
/**
 * Created by PhpStorm.
 * User: Ange KOUAKOU
 * Date: 20-Jul-15
 * Time: 9:03 AM
 */

if (isset($_POST["nbr"])) {
    $nbr = htmlspecialchars($_POST['nbr'], ENT_QUOTES);

    echo '
<div class="col-md-12">
    <div style="text-align: center; margin-bottom: 1%">
        <button class="btn btn-info" type="button" onclick="ajout_proforma();" name="valider" style="width: 150px">
            Valider
        </button>
    </div>
    <div class="panel panel-default">
        <table border="0" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th class="entete" style="text-align: center; width: 60%">Libellé*</th>
                <th class="entete" style="text-align: center">Quantité</th>
                <th class="entete" style="text-align: center; width: 15%">P.U.*</th>
                <th class="entete" style="text-align: center; width: 15%">Remise (%)</th>
            </tr>
        </thead>
            ';

    for ($i = 1; $i <= $nbr; $i++) {
        $tot_ht = 0;
        $tot_ttc = 0;
        echo '
            <tr>
                <td class="champlabel" style="text-align: left">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" onblur="this.value = this.value.toUpperCase();" class="form-control" name="libelle[]" id="libelle_dp' . $i . '" required style="font-weight: lighter">
                    </label>
                </td>
                <td class="champlabel" style="text-align: center">
                    <label style="margin-left: auto; margin-right: auto" class="nomargin_tb">
                        <input type="number" value="1" min="1" maxlength="4" class="form-control nomargin_tb" name="qte[]" id="qte_dp' . $i . '">
                    </label>
                </td>
                <td class="champlabel" style="text-align: right">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="pu[]" id="pu_dp' . $i . '" style="font-weight: lighter; text-align: right" placeholder="0" required>
                    </label>
                </td>
                <td class="champlabel" style="text-align: center">
                    <label style="width: 100%" class="nomargin_tb">
                        <input type="text" class="form-control" name="rem[]" id="rem_dp' . $i . '" style="font-weight: lighter; text-align: right" value="0">
                    </label>
                </td>
                <script>
                    $("input[type=text]#pu").click(function(){
                        var pu = $("input[type=text]#pu").val();
                        var qte = $("input[type=number]#qte").val();
                        
                        $.ajax({
                            type: "POST",
                            url: "proformas/ajax_details_proforma.php",
                            data: {
                                pu: pu,
                                qte: qte
                            },
                            success: function (tot_ht, tot_ttc) {
                                var tot = resultat.split(";");

                                $("#total_ht").val(tot[0]);
                                $("#total_ttc").val(tot[1]);
                            }
                        })
                    })
                </script>
              </tr>
            ';
    }

    echo '
        </table>
    </div>
</div>
';
}