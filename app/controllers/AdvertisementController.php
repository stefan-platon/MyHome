<?php

require_once(APP_PATH . "/repositories/AdvertisementRepository.php");

class AdvertisementController
{
    private $repository = null;

    function __construct() {
        $this->repository = new AdvertisementRepository();
    }

    public function getOne($id) {

    }

    public function getAll() {

    }

    public function insert() {
        $response = [];

        try {
            $id = $this->repository->insert([
                "title" => $_POST['title'],
                "description" => $_POST['description'],
                "price" => $_POST['price'],
                "address" => $_POST['address'],
                "apartment_type" => $_POST['apartment_type'],
                "phone_number" => $_POST['phone_number']
            ]);

            if ($id) {
                $response['status'] = true;
                $response['code'] = 200;
                $response['id'] = $id;
            } else {
                $response['status'] = false;
                $response['code'] = 500;
                $response['message'] = "Could not insert.";
            }
        } catch (InvalidDataException $e) {
            $response['status'] = false;
            $response['code'] = 409;
            $response['message'] = $e->getMessage();
        } catch (Exception $e) {
            $response['status'] = false;
            $response['code'] = 500;
            $response['message'] = "Unknown server error.";
        }

        return $response;
    }
}