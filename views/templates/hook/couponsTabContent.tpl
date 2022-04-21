<div id="blockcoupons" class="blockcoupons tab-pane">    
    <div class="col-md-12">        
        <div class="row">
            {if isset ($coupons)}
                {foreach from=$coupons item=coupon}
                    <div class="col-md-3">
                        <div class="thumbnail text-center">
                            <img class="img-back" src="{$pathCover}{$coupon.id_coupons}.jpg" alt="" style="width:100%;height:150px;" />
                            <img class="img-front" src="{$pathLogo}{$coupon.id_coupons}.jpg" alt="" style="width:90px;height:90px;" />
                            <h2 class="card-title">{$coupon.supplier_name}</h2>
                            <h4 class="card-description">{$coupon.description}</h4>
                            <h2 class="card-percentage">{$coupon.discount_rate}%</h2>
                        </div>
                    </div>
                {/foreach}
            {/if}
        </div>        
    </div>
</div>