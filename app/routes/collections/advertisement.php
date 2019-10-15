<?php

return call_user_func(function() {
    $collection = new Collection();

    $collection->setPrefix('advertisement')->setHandler("AdvertisementController");

    $collection
        ->setGet("/([0-9]+)", "getOne")
        ->setGet("", "getAll")
        ->setPost("", "insert");

    return $collection;
});