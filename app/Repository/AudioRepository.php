<?php


namespace App\Repository;

use App\Http\Resources\User\AudioResource;
use App\Interfaces\Audio;
use App\Models\AudioRecord;
use App\Traits\ApiResponser;
use App\Traits\FileManager;

class AudioRepository implements Audio
{
    use ApiResponser,FileManager;
    public function createAudio($data)
    {
        $res = $this->fileUpload($data['audio_file']->getRealPath());
        $data['audio_file'] = $res->getSecurePath();
        $data['audio_file_id'] = $res->getPublicId();
        $data['extension'] = $res->getExtension();
        $data['size'] = $res->getReadableSize();
        $data['file_name'] = $res->getOriginalFileName();
        $audio = AudioRecord::create($data);
        return $this->showOne($audio,201);
    }

    public function updateAudio($data, $id)
    {
        $res = $this->fileUpload($data['audio_file']->getRealPath());
        $data['audio_file'] = $res->getSecurePath();
        $data['audio_file_id'] = $res->getPublicId();
        $data['extension'] = $res->getExtension();
        $data['size'] = $res->getReadableSize();
        $data['file_name'] = $res->getOriginalFileName();
        $audio = AudioRecord::findorFail($id);
        $audio->update($data);
        return $this->showOne('audio updated successfully',200);
    }

    public function getAudios()
    {
        return $this->showAll(AudioResource::collection(AudioRecord::all()));
    }

    public function getAudio($id)
    {
        return $this->showOne(new AudioResource(AudioRecord::findorFail($id)));
    }

    public function deleteAudio($id)
    {
        $audio = AudioRecord::findorFail($id);
        $audio->delete();
        return $this->showMessage('audio deleted successfully');
    }
}
