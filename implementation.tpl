...

{if isset($product)}
    <section class="page-product-box clearfix manual-preview" id="widget_manuals">
      <h3 class="page-product-heading">Instrukcja</h3>
      <div class='manual'>
        <div class='manual-pages' style='width:100%;'></div>
        <div class='manual-text'>Pobierz instrukcję w formacie .pdf</div>
      </div>
    </section>		
  {/if}


 ...
 
<script src="https://agtom.eu/f/kajtek/skrypty/kajtek_widget_manuals.js"></script>
<script src="https://agtom.eu/f/kajtek/skrypty/kajtek_product_translate.js"></script>
<script src="https://agtom.eu/f/kajtek/skrypty/kajtek_widget_tools.js"></script>
<script src="https://agtom.eu/f/kajtek/skrypty/kajtek_side_menu.js"></script>

...

<script>
{literal}

$(document).ready(function(){
	
	//WIDGET MANUALS
	kajtek_widget_manuals();
	kajtek_widget_manuals_translate();
  
})

{/literal}
{/script}
