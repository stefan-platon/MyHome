<?php

require_once(APP_PATH . "/exceptions/InvalidDataException.php");

class Advertisement
{
    private $id;

    private $title;

    private $description;

    private $apartment_type;

    private $address;

    private $price;

    private $phone_number;

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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if (strlen($title) >= 150) {
            throw new InvalidDataException("Title is too long.", 410);
        }
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        if (strlen($description) >= 500) {
            throw new InvalidDataException("Description is too long.", 411);
        }
        $this->description = $description;
        return $this;
    }

    public function getApartmentType()
    {
        return $this->apartment_type;
    }

    public function setApartmentType($apartment_type)
    {
        if (!is_numeric($apartment_type)) {
            throw new InvalidDataException("Invalid apartment type.", 412);
        }
        $this->apartment_type = $apartment_type;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        if (!is_numeric($price)) {
            throw new InvalidDataException("Invalid price.", 412);
        }
        $this->price = $price;
        return $this;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
        return $this;
    }
}