<?php
           //var_dump($data->veri);
             //  veri tabanindan donen veriler
           



           echo $data->js_css;
           //  paginate icin gerekli css ve js dosyalari 
           echo $data->css;
           // varsayilan css isterseniz siz yazabilirsiniz
           
           // paginate gosterilecek  alan id ile bildiriilir biradaki demo1 olarak belirtilmistir.
           
           echo '
               <table  class="demo">
    <thead>
        <tr><td>Ulke</td><td>Kod</td></tr>
     </thead>
    <tbody>
        ';
               
    

              
    foreach ($data->veri as $value) {
    echo "<tr><td>{$value->ulke}</td><td>{$value->kod}</td></tr>";
        
    }
    echo '</tbody></table>';
        
    
  
    ?>




          <div class="demo">
              
                <div id="demo1">                   
                </div>
            </div> 
           

                        <?php
           //js kod 
           // onChange olayina yazacagini js ile isterseniz ajax olarakta calistirabilirsiniz 
           ?>
        
            <script type="text/javascript">
		$(function() {
               
                    $("#demo1").paginate({
                        count 		: '<?php echo $data->count; ?>',
                        start 		: '<?php echo $data->start; ?>',
                        display     : 12,
                        border					: false,
                        border_color			: "#fff",
                        text_color  			: "#fff",
                        background_color    	: "blue",	
                        border_hover_color		: "#ccc",
                        text_hover_color  		: "#000",
                        background_hover_color	: "#fff", 
                        images					: false,
                        mouse					: "press",
                        onChange     			: function(page){
                        location.replace("<?php echo $url.'/Ss/'; ?>"+page);
                        }
                    });
                });
            </script>
   
