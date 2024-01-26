<style>
    footer {
        position: fixed;
        bottom: -0.6cm;
        left: 1.3cm;
        right: 1.3cm;
        height: 2.8cm;
        background: white;
        color: black;

        line-height: 35px;
    }
</style>
<footer>
</footer>
<script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $pdf->text(545, 725, "P.  $PAGE_NUM/$PAGE_COUNT", $font, 10);
        ');
  }
</script>
