<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{

    public function testIndex()
    {
        $gestor = User::where('username', 'gestor')->first();
        $this->actingAs($gestor)->get(route('document.index'))->assertStatus(200)->assertSee('Documentos');
    }

    public function testCreate()
    {

        $gestor = User::where('username', 'gestor')->first();
        $this->actingAs($gestor)->get(route('document.create'))->assertStatus(200);
    }

    public function testStore()
    {
        //TODO
        $this->assertTrue(true);
    }

    public function testShow()
    {
        //TODO
        $this->assertTrue(true);
    }

    public function testEdit()
    {
        //TODO
        $this->assertTrue(true);
    }

    public function testUpdate()
    {
        //TODO
        $this->assertTrue(true);
    }

    public function testDestroy()
    {
        //TODO
        $this->assertTrue(true);
    }
}
