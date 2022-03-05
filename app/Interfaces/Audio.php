<?php


namespace App\Interfaces;


interface Audio
{
    public function createAudio($data);
    public function updateAudio($data, $id);
    public function getAudios();
    public function getAudio($id);
    public function deleteAudio($id);
}
