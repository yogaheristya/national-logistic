<table id="tech-companies-1" class="table  table-striped">
    <thead>
        <tr>
        <th class="table-row-left"><input type="checkbox" name="" id="select-all"></th>
        <th class="table-row-left">NO SPPB</th>
        <th class="table-row-left">NO BL</th>
        <th class="table-row-left">NO Container</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i < count($NO_SPPB) ; $i++) { ?>
            <tr>
            <td><input type="checkbox" name="cek_cont[]" <?=$STATUS_CONT_SPPB[$i]!="" ? "disabled" : ""?> value="<?=$NO_CONT[$i]?>"></td>
            <td class="table-row-left"><?=$NO_SPPB[$i]?></td>
            <td class="table-row-left"><?=$NO_BL_AWB[$i]?></td>
            <td class="table-row-left"><?=$NO_CONT[$i]?></td>
            </tr>   
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    $('#select-all').click(function(event) {
        var $that = $(this);
        $(':checkbox').not("[disabled]").each(function() {
            this.checked = $that.is(':checked');
        });
    });
</script>