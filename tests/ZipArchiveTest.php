<?php

namespace Lootils\Archiver;

class ZipArchiveTest extends ArchiveTest
{
    public function setUp()
    {
        parent::setUp();

        $this->class = 'Lootils\Archiver\ZipArchive';
        $this->extension = 'zip';
    }
}
