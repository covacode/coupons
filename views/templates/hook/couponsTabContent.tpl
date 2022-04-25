<div id="blockcoupons" class="blockcoupons tab-pane">      
    <div class="col-md-12">        
        <div class="row">
            {if isset ($coupons)}
                {foreach from=$coupons item=coupon}                   
                    <a href="{$link->getModuleLink('coupons','coupon',[ 'id_coupons' => {$coupon.id_coupons}] )}" target="_blank">
                        <div class="col-md-3">                            
                            <div class="thumbnailCoupons text-center">
                                <img class="img-back" src="{$pathCover}{$coupon.id_coupons}.jpg" alt="{$coupon.supplier_name}"/>
                                <img class="img-front" src="{$pathLogo}{$coupon.id_coupons}.jpg" alt="{$coupon.supplier_name}"/>
                                <h2 class="card-title">{$coupon.supplier_name}</h2>
                                <h4 class="card-description">{$coupon.description}</h4>
                                <h2 class="card-percentage">{$coupon.discount_rate}%</h2>                                
                            </div>
                        </div>
                    </a>
                {/foreach}
            {/if}
        </div>        
    </div>
</div>