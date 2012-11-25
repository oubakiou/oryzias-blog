<?php
class Controller_Compressor extends Controller_Parent_Common
{
    public function exec()
    {
        if (!isset($this->g['f'])) {
            $this->r('/notfound');
        }
        new Oryzias\PublicFileCompressor($this->g['f']);
    }
}
