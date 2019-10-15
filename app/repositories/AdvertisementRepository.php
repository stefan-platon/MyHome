<?php

require_once(APP_PATH . "/models/Advertisement.php");
require_once(APP_PATH . "/repositories/AdvertisementImageRepository.php");
require_once(APP_PATH . "/database/mysql/Repository.php");

class AdvertisementRepository
{
    private $model = null;

    function __construct() {
        $this->model = new Advertisement();
    }

    public function insert($body) {
        $this->model->setTitle($body['title']);
        $this->model->setDescription($body['description']);
        $this->model->setPrice($body['price']);
        $this->model->setAddress($body['address']);
        $this->model->setApartmentType($body['apartment_type']);
        $this->model->setPhoneNumber($body['phone_number']);

        if (count($_FILES) < 2) {
            throw new InvalidDataException("Too few images.", 412);
        }

        $repository = Repository::getInstance();
        $id_advertisement = $repository->insert($this->model);

        if ($id_advertisement) {
            $rollback = false;

            foreach ($_FILES as $file) {
                $advertisement_image_repository = new AdvertisementImageRepository();
                $id_advertisement_image = $advertisement_image_repository->insert([
                        "file" => $file,
                        "id_advertisement" => $id_advertisement
                ]);

                if (!$id_advertisement_image) {
                    $rollback = true;
                }
            }

            if ($rollback) {
                $this->model->setId($id_advertisement);
                $repository->delete($this->model);

                $id_advertisement = null;
            }
        }

        return $id_advertisement;
    }
}