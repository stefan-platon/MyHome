<?php

require_once(APP_PATH . "/models/AdvertisementImage.php");
require_once(APP_PATH . "/database/mysql/Repository.php");

class AdvertisementImageRepository
{
    private $model = null;

    function __construct() {
        $this->model = new AdvertisementImage();
    }

    public function insert($body) {
        if (!file_exists(UPLOADS_PATH . "images")) {
            mkdir(UPLOADS_PATH . "images", 0777);
        }

        $file_name = pathinfo($body['file']["name"], PATHINFO_FILENAME);
        $file_extension = pathinfo($body['file']["name"], PATHINFO_EXTENSION);
        $name = $file_name . date('?Y-m-d?H:i:s') . '.' . $file_extension;
        $destination = UPLOADS_PATH . "images/$name";
//        move_uploaded_file($body['file']['tmp_name'], $destination);

        $this->model->setIdAdvertisement($body['id_advertisement']);
        $this->model->setPath($destination);

        $repository = Repository::getInstance();
        $id_advertisement_image = $repository->insert($this->model);

        return $id_advertisement_image;
    }
}