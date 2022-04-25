{capture name=path}
	<span class="navigation-pipe">{$navigationPipe}</span>{l s='Coupon' mod='coupons'}
{/capture}

<div id="blockcouponsdetail" class="blockcouponsdetail tab-pane">
    <div class="col-md-12">        
        <div class="row">
            {if isset ($coupons)}
                {foreach from=$coupons item=coupon}                                       
                    <div class="col-md-12">                            
                        <div class="thumbnail-coupons-detail text-center">

                            <div class="col-md-8" style="padding:0;">
                                <img class="img-back-detail" src="{$pathCover}{$coupon.id_coupons}.jpg" alt="{$coupon.supplier_name}"/>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <img class="img-front-detail" src="{$pathLogo}{$coupon.id_coupons}.jpg" alt="{$coupon.supplier_name}"/>
                                </div>

                                <div class="col-md-12">
                                    <h2 class="card-title">{$coupon.supplier_name}</h2>
                                    <h4 class="card-description">{$coupon.description}</h4>
                                    <h2 class="card-percentage">{$coupon.discount_rate}%</h2> 
                                    <h1 class="card-percentage">{$coupon.discount_code}</h1> 
                                </div>
                            </div>

                        </div>
                    </div>                                       
                {/foreach}
            {/if}
        </div>        
    </div>
</div>