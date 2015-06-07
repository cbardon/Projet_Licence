<?php

use Silex\WebTestCase;

class WebAppTreeTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__ . '/../src/app.php';
    }
    
    public function testLayoutElements()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetIndex()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetAbout()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetSets()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetSetNotExists()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetSetExists()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetGalleryNotExists()
    {
        $this->markTestIncomplete('Not yet implemented');
    }

    public function testGetGalleryExists()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
}

?>