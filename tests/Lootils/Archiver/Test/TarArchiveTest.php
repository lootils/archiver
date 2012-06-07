<?php

namespace Lootils\Archiver\Test;

class TarArchiveTest extends ArchiveTest
{
    public function setUp() {
        parent::setUp();

        $this->class = 'Lootils\Archiver\TarArchive';
        $this->extension = 'tar';
    }
}
