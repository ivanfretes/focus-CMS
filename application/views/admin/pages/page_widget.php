
        <!-- Create a component -->
        <div class="form-group">

            <label for="p_description"
                   class="control-label col-md-1">
                   Componente: </label>
        
            <div class="col-md-11">
              <select name="p_list_component" id="p_list_component"
                      class="form-control">
                  <option value="1">Portolio</option>
                  <option value="2">Fila con hasta 2 columnas</option>
                  <option value="3">Slide</option>
              </select>
            </div>
        </div>
      </form>            

      <? // -- Listado de componentes -- ?>
      <ul id="component_created">
        <? 
          foreach ($array_component as $component) : 
            echo $component;  
          endforeach 
        ?>
      </ul>

            <script type="text/javascript">
              var order_component;
              <? if (isset($order_component))
                    echo "order_component = $order_component" ;    
                 else
                    echo "order_component = 0" ;?>                  
            </script>

    </div>
