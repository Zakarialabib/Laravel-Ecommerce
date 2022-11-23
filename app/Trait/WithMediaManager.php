<?php

namespace App\Trait;

trait WithMediaManager
{
    public function showFileManager(string $id, ?string $file = null, array $metadata = [])
    {
        $this->emitTo('media-manager', 'media-manager:show', [
            'id' => $id,
            'file' => $file,
            'metadata' => $metadata,
        ]);
    }

    public function removeFileFromMediaManager()
    {
        $this->emitTo('media-manager', 'media-manager:file-removed');
    }
}
