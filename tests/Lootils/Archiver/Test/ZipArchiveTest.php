<?php

namespace Lootils\Archiver\Test;

class ZipArchiveTest extends ArchiveTest
{
    public function setUp()
    {
        parent::setUp();

        $this->class = 'Lootils\Archiver\ZipArchive';
        $this->extension = 'zip';
    }
}
