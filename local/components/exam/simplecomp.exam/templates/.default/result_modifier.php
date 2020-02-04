<?php
foreach ($arResult["PRODUCTS"] as $elem)
{
    if(!empty($minPrice) && !empty($maxPrice))
    {
        $minPrice > $elem["PROPERTY_PRICE_VALUE"] ? $minPrice = $elem["PROPERTY_PRICE_VALUE"] : $minPrice;
        $maxPrice < $elem["PROPERTY_PRICE_VALUE"] ? $maxPrice = $elem["PROPERTY_PRICE_VALUE"] : $maxPrice;
    } else {
        $minPrice = $elem["PROPERTY_PRICE_VALUE"];
        $maxPrice = $elem["PROPERTY_PRICE_VALUE"];
    }
}

$this->SetViewTarget("minMaxPrice");?>
    <div style="color:red; margin: 34px 15px 35px 15px">
        Минимальная цена - <?= $minPrice?>
        Максимальная цена - <?=$maxPrice?>
    </div>
<?$this->EndViewTarget();?>