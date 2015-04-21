 <?php
$templ=DB::table('template')->where('templ_name','bharath')->get();
echo $templ[0]->content;
?>
