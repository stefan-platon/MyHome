<?php

class AdvertisementImage
{
    private $id;

    private $id_advertisement;

    private $path;

    public function toPublic()
    {
        $obj = [];
        foreach ($this as $key => $value) {
            $obj[$key] = $value;
        }
        return $obj;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getIdAdvertisement()
    {
        return $this->id_advertisement;
    }

    public function setIdAdvertisement($id_advertisement)
    {
        $this->id_advertisement = $id_advertisement;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
}