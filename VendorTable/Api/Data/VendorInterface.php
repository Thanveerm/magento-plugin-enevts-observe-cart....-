<?php
namespace Codilar\VendorTable\Api\Data;

interface VendorInterface
{
    const ID = 'id';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getDescription();

    public function setDescription($description);
}
